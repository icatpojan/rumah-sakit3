const https = require('https');
const mysql = require('mysql');

// Fungsi untuk mengambil data dari API menggunakan metode POST
function fetchDataFromAPI(url, data) {
    return new Promise((resolve, reject) => {
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
        };

        const req = https.request(url, options, (res) => {
            let responseData = '';

            res.on('data', (chunk) => {
                responseData += chunk;
            });

            res.on('end', () => {
                resolve(JSON.parse(responseData));
            });
        });

        req.on('error', (error) => {
            reject(error);
        });

        req.write(JSON.stringify(data));
        req.end();
    });
}

// Fungsi untuk menyimpan data ke database
function saveDataToDatabase(connection, data) {
    for (const item of data) {
        const devName = item.dev_name || item.device_name;
        const devEui = item.dev_eui;
        const typeDevice = item.type;
        const longitude = item.longitude;
        const latitude = item.latitude;
        const createdAt = new Date(item.created_at * 1000).toISOString().replace('T', ' ').replace('Z', '');
        const updatedAt = new Date(item.updated_at * 1000).toISOString().replace('T', ' ').replace('Z', '');

        const checkExistingQuery = 'SELECT * FROM smart_pju_device WHERE dev_eui = ?';
        connection.query(checkExistingQuery, [devEui], (error, results) => {
            if (error) {
                console.error('Error checking existing data:', error);
                return;
            }

            if (results.length > 0) {
                const updateQuery = 'UPDATE smart_pju_device SET dev_name=?, type_device=?, longitude=?, latitude=?, created_at=?, updated_at=? WHERE dev_eui=?';
                connection.query(updateQuery, [devName, typeDevice, longitude, latitude, createdAt, updatedAt, devEui], (error, results) => {
                    if (error) {
                        console.error('Error updating data:', error);
                    } else {
                        console.log(`Data updated for dev_eui: ${devEui}`);
                    }
                });
            } else {
                const insertQuery = 'INSERT INTO smart_pju_device (dev_name, dev_eui, type_device, longitude, latitude, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)';
                connection.query(insertQuery, [devName, devEui, typeDevice, longitude, latitude, createdAt, updatedAt], (error, results) => {
                    if (error) {
                        console.error('Error inserting data:', error);
                    } else {
                        console.log(`Data inserted for dev_eui: ${devEui}`);
                    }
                });
            }
        });
    }
}

// Fungsi untuk memulai service
async function startService() {
    const authData = {
        username: 'jasamarga',
        password: 'Pju_1ndonesia!',
    };

    try {
        const authResponse = await fetchDataFromAPI('https://trial.wspiot.xyz/user/auth-token', authData);

        if (authResponse.status === 'ok' && authResponse.auth_token) {
            const authToken = authResponse.auth_token;

            const headers = {
                'x-auth-token': authToken,
            };

            const dataResponse = await fetchDataFromAPI('https://trial.wspiot.xyz/api/device/get-all', {}, headers);

            if (dataResponse.status === 'ok' && dataResponse.data) {
                const dbConfig = {
                    host: '20.10.20.13',
                    user: 'live',
                    password: 'JML1V3__',
                    database: 'jm_digi_map_db',
                };

                const connection = mysql.createConnection(dbConfig);

                connection.connect((error) => {
                    if (error) {
                        console.error('Error connecting to database:', error);
                    } else {
                        console.log('Connected to database.');

                        saveDataToDatabase(connection, dataResponse.data);

                        connection.end((error) => {
                            if (error) {
                                console.error('Error closing database connection:', error);
                            } else {
                                console.log('Database connection closed.');
                            }
                        });
                    }
                });
            } else {
                console.error('Failed to fetch data from the second API.');
            }
        } else {
            console.error('Failed to fetch auth token from the first API.');
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }
}

startService();
