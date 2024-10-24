const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true })); // Tambahkan ini

// Konfigurasi koneksi ke database
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'your_database_name' // Ganti dengan nama database Anda
});

// Koneksi ke database
db.connect((err) => {
    if (err) {
        console.error('Database connection failed:', err.stack);
        return;
    }
    console.log('Connected to database');
});

// Endpoint untuk menyimpan data pengguna
app.post('/api/saveUser', (req, res) => {
    console.log('Request body:', req.body); // Tambahkan log ini
    const { fullName, phoneNumber, service, organization } = req.body;
    if (!fullName || !phoneNumber || !service || !organization) {
        return res.status(400).json({ success: false, message: 'All fields are required' });
    }
    const sql = 'INSERT INTO users (fullName, phoneNumber, service, organization) VALUES (?, ?, ?, ?)';
    db.query(sql, [fullName, phoneNumber, service, organization], (err, result) => {
        if (err) {
            console.error('Database error:', err); // Tambahkan log ini
            return res.status(500).json({ success: false, message: 'Database error', error: err });
        }
        res.json({ success: true, message: 'Data berhasil disimpan' });
    });
});

app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});