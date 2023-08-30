<?php

// Fungsi untuk mengambil data dari API menggunakan metode POST
function fetchDataFromAPI($url, $data, $headers = [])
{
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge(['Content-Type: application/json'], $headers));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Fungsi memulai service
function startService()
{
    // Konfigurasi untuk koneksi ke database
    $servername = '20.10.20.13';
    $username = 'live';
    $password = 'JML1V3__';
    $dbname = 'jm_digi_map_db';


    // Ambil data terakhir dari tabel log_smart_pju_device
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    $last_data_query = "SELECT MAX(created_at) as max_created_at FROM log_smart_pju_device";
    $result = $conn->query($last_data_query);
    $last_data = $result->fetch_assoc();

    if ($last_data['max_created_at'] !== null) {
        $last_created_at_unix = strtotime($last_data['max_created_at']) + 1; // Ambil data setelah timestamp terakhir di database
    } else {
        // Jika data tidak ada atau tabel log_smart_pju_device kosong, ambil data dari 5 menit yang lalu sebagai nilai awal
        $now_unix_timestamp = time();
        $last_created_at_unix = $now_unix_timestamp - (160 * 60); // 5 menit x 60 detik
    }

    $conn->close();

    // UNIX timestamp sekarang
    $now_unix_timestamp = time();

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
        $data_url = 'https://trial.wspiot.xyz/api/device/uplink';

        // Set header untuk otorisasi menggunakan auth token
        $headers = array(
            'Authorization: Bearer ' . $auth_token,
            'Content-Type: application/json',
            'x-auth-token: ' . $auth_token,
        );

        // Body request untuk API kedua
        $request_body = array(
            "dev_eui" => "",
            "ftime" => $last_created_at_unix, // Ambil data setelah timestamp terakhir di database atau 5 menit yang lalu
            "ttime" => $now_unix_timestamp, // Waktu sekarang
            "itemPerPage" => 100000,
            "page" => 1
        );

        // Mengambil data dari API kedua
        $data_response = fetchDataFromAPI($data_url, $request_body, $headers);

        if ($data_response['status'] == 'ok' && isset($data_response['data'])) {
            // Koneksi ke database
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Koneksi ke database gagal: " . $conn->connect_error);
            }

            // Simpan data ke database
            foreach ($data_response['data'] as $item) {
                $dev_name = $item['dev_name'];
                $dev_eui = $item['dev_eui'];
                $online = $item['online'];
                $ampere = $item['ampere'];
                $power = $item['power'];
                $energy = $item['energy'];
                $dimming = $item['dimming'];
                $created_at = date("Y-m-d H:i:s", $item['timestamp']);

                // Jika data dengan dev_eui belum ada, lakukan entri baru
                $insert_query = "INSERT INTO log_smart_pju_device (dev_name, dev_eui, online, ampere, power, energy, dimming, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("ssdddiss", $dev_name, $dev_eui, $online, $ampere, $power, $energy, $dimming, $created_at);

                // Jalankan statement
                if ($stmt->execute()) {
                    echo "Data berhasil dimasukkan ke database.";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $status = $item['online'] == 1 ? 'ON': 'OFF';

                $update_query = "UPDATE smart_pju_device SET status=?, ampere=?, power=?, energy=?, dimming=?, updated_at=? WHERE dev_eui=?";
                $stmt = $conn->prepare($update_query);
                $stmt->bind_param("sddisss", $status, $ampere, $power, $energy, $dimming, $created_at, $dev_eui);

                // Jalankan statement update
                if ($stmt->execute()) {
                    echo "Data di smart_pju_device berhasil diupdate.";
                } else {
                    echo "Error saat melakukan update: " . $stmt->error;
                }


                // Tutup statement
                $stmt->close();
            }

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