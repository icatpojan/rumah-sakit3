<?php

// Fungsi untuk mengambil data dari API menggunakan metode POST
function fetchDataFromAPI($url, $data)
{
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Fungsi untuk menyimpan data ke database
function saveDataToDatabase($conn, $data)
{
    foreach ($data as $item) {
        $dev_name = $item['dev_name'] ?? $item['device_name'];
        $dev_eui = $item['dev_eui'];
        $type_device = $item['type'];
        $longitude = $item['longitude'];
        $latitude = $item['latitude'];
        $created_at = date("Y-m-d H:i:s", $item['created_at']);
        $updated_at = date("Y-m-d H:i:s", $item['updated_at']);

        // Cek apakah data dengan dev_eui sudah ada dalam tabel
        $check_existing_query = "SELECT * FROM smart_pju_device WHERE dev_eui = ?";
        $stmt = $conn->prepare($check_existing_query);
        $stmt->bind_param("s", $dev_eui);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Jika data dengan dev_eui sudah ada, lakukan update
            $update_query = "UPDATE smart_pju_device SET dev_name=?, type_device=?, longitude=?, latitude=?, created_at=?, updated_at=? WHERE dev_eui=?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("ssddsss", $dev_name, $type_device, $longitude, $latitude, $created_at, $updated_at, $dev_eui);
        } else {
            // Jika data dengan dev_eui belum ada, lakukan entri baru
            $insert_query = "INSERT INTO smart_pju_device (dev_name, dev_eui, type_device, longitude, latitude, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("sssdsss", $dev_name, $dev_eui, $type_device, $longitude, $latitude, $created_at, $updated_at);
        }

        // Jalankan statement
        if ($stmt->execute()) {
            echo "Data berhasil di" . ($result->num_rows > 0 ? "update" : "masukkan") . " ke database.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    }
}

// Fungsi memulai service
function startService()
{
    // Konfigurasi untuk koneksi ke database
    $servername = '20.10.20.13';
    $username = 'live';
    $password = 'JML1V3__';
    $dbname = 'jm_digi_map_db';

    // URL API pertama untuk mendapatkan auth token
    $auth_url = 'https://trial.wspiot.xyz/user/auth-token';
    $auth_data = array(
        "username" => "jasamarga",
        "password" => "Pju_1ndonesia!"
    );

    // Ambil auth token dari API pertama

    $auth_response = fetchDataFromAPI($auth_url, $auth_data);

    if ($auth_response['status'] == 'ok' && isset($auth_response['auth_token'])) {
        $auth_token = $auth_response['auth_token'];

        // URL API kedua untuk mendapatkan data dengan menggunakan auth token
        $data_url = 'https://trial.wspiot.xyz/api/device/get-all';

        // Set header untuk otorisasi menggunakan auth token
        $headers = array(
            'x-auth-token:' . $auth_token,
        );

        // Mengambil data dari API kedua
        $ch = curl_init($data_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $data_response = curl_exec($ch);
        curl_close($ch);

        $dataArrayGetAll = json_decode($data_response, true);

        if ($dataArrayGetAll['status'] == 'ok' && isset($dataArrayGetAll['data'])) {
            // Koneksi ke database
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Koneksi ke database gagal: " . $conn->connect_error);
            }

            // Simpan data ke database
            saveDataToDatabase($conn, $dataArrayGetAll['data']);

            // Tutup koneksi ke database
            $conn->close();
        } else {
            startService();
            echo "Gagal mendapatkan data dari API kedua.";
        }
    } else {
        echo "Gagal mendapatkan auth token dari API pertama.";
    }
}

startService();