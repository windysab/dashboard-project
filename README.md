# PTSP Online - Pelayanan Terpadu Satu Pintu

[![Website](https://img.shields.io/badge/Website-PA%20Amuntai-blue)](https://pa-amuntai.go.id)
[![Version](https://img.shields.io/badge/Version-1.0.0-green)]()
[![License](https://img.shields.io/badge/License-ISC-yellow)]()

## 📋 Deskripsi

**PTSP Online** adalah aplikasi web yang menyediakan layanan Pelayanan Terpadu Satu Pintu secara online untuk Pengadilan Agama Amuntai Kelas IB. Aplikasi ini memungkinkan masyarakat untuk mengakses berbagai layanan informasi dan pengaduan melalui platform digital yang mudah digunakan.

## 🏛️ Tentang Pengadilan Agama Amuntai

**Alamat:** Jl. Empu Mandastana No.10, Sungai Malang, Kec. Amuntai Tengah, Kabupaten Hulu Sungai Utara, Provinsi Kalimantan Selatan

**Website Resmi:** [pa-amuntai.go.id](https://pa-amuntai.go.id)

## ✨ Fitur Utama

### 🔊 Layanan Komunikasi
- **Voice Call (0527-61002)** - Layanan informasi melalui telepon
- **Video Call** - Layanan informasi melalui Zoom Meeting
- **Online Chat** - Layanan informasi melalui chat online

### 📊 Layanan PTSP
- **Layanan Informasi** - Informasi umum terkait pengadilan
- **Layanan Pendaftaran** - Bantuan proses pendaftaran perkara
- **Layanan Pembayaran** - Informasi dan bantuan pembayaran

### 🌐 Fitur Aplikasi
- **Responsive Design** - Kompatibel dengan desktop dan mobile
- **Real-time Visitor Counter** - Menampilkan jumlah pengunjung
- **Social Media Integration** - Terintegrasi dengan Facebook, YouTube, dan Instagram
- **Interactive Navigation** - Navigasi yang user-friendly
- **Database Integration** - Penyimpanan data pengguna dan statistik

## 🛠️ Teknologi yang Digunakan

### Frontend
- **HTML5** - Struktur halaman web
- **CSS3** - Styling dan layout
- **JavaScript** - Interaktivitas dan dinamika
- **Bootstrap** - Framework CSS responsif
- **jQuery** - Library JavaScript
- **Font Awesome** - Icon library
- **Animate.css** - Animasi CSS

### Backend
- **PHP** - Server-side scripting
- **Node.js** - Runtime environment
- **Express.js** - Web framework untuk Node.js
- **MySQL** - Database management system

### Dependencies
```json
{
  "express": "^4.17.1",
  "mysql": "^2.18.1",
  "body-parser": "^1.19.0",
  "cors": "^2.8.5"
}
```

## 📦 Instalasi

### Prasyarat
- XAMPP atau server lokal dengan PHP support
- Node.js dan npm
- MySQL database
- Web browser modern

### Langkah Instalasi

1. **Clone atau download repository**
   ```bash
   git clone <repository-url>
   cd dashboard-project
   ```

2. **Install dependencies Node.js**
   ```bash
   npm install
   ```

3. **Setup Database**
   - Buat database MySQL
   - Import struktur database yang diperlukan
   - Konfigurasi koneksi database di `dbConnection.php`

4. **Konfigurasi Environment**
   - Salin file `.env.example` ke `.env` (jika ada)
   - Sesuaikan konfigurasi database

5. **Jalankan Server**
   ```bash
   # Untuk Node.js server
   npm start
   
   # Atau langsung
   node server.js
   ```

6. **Akses Aplikasi**
   - Buka browser dan akses `http://localhost/dashboard-project`
   - Atau sesuai dengan konfigurasi server lokal Anda

## 📁 Struktur Direktori

```
dashboard-project/
├── assets/                 # Asset statis
│   ├── css/               # File CSS
│   ├── images/            # Gambar dan icon
│   ├── js/                # JavaScript files
│   └── webfonts/          # Font files
├── partials/              # Template partial
├── vendor/                # Composer dependencies
├── index.html             # Halaman utama
├── server.js              # Node.js server
├── dbConnection.php       # Koneksi database PHP
├── package.json           # Node.js dependencies
├── composer.json          # PHP dependencies
└── README.md              # Dokumentasi
```

## 🗄️ Database

### Tabel Users
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    service VARCHAR(100) NOT NULL,
    organization VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabel Visitor Count
```sql
CREATE TABLE visitor_count (
    id INT AUTO_INCREMENT PRIMARY KEY,
    count INT DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## 🔧 Konfigurasi

### Database Configuration
Edit file `dbConnection.php`:
```php
$servername = '127.0.0.1';
$username = 'your_username';
$password = 'your_password';
$dbname = 'your_database';
$port = 3306;
```

### Server Configuration
Edit file `server.js` untuk mengubah port:
```javascript
const port = 3000; // Ubah sesuai kebutuhan
```

## 📱 Responsive Design

Aplikasi ini dioptimalkan untuk berbagai ukuran layar:
- **Desktop** (1200px+)
- **Tablet** (768px - 1199px)
- **Mobile** (< 768px)

## 🔐 Keamanan

- Sanitasi input data pengguna
- Prepared statements untuk query database
- CORS configuration
- Environment variables untuk kredensial sensitif

## 📊 Monitoring

### Visitor Counter
Aplikasi memiliki fitur penghitung pengunjung yang menampilkan:
- Jumlah pengunjung hari ini
- Total pengunjung keseluruhan
- Update real-time

### Database Logging
- Log aktivitas pengguna
- Tracking layanan yang digunakan
- Statistik penggunaan

## 🤝 Kontribusi

Untuk berkontribusi pada proyek ini:

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 Lisensi

Distributed under the ISC License. Lihat `LICENSE` untuk informasi lebih lanjut.

## 📞 Kontak

**Pengadilan Agama Amuntai Kelas IB**
- **Alamat:** Jl. Empu Mandastana No.10, Sungai Malang, Kec. Amuntai Tengah, Kabupaten Hulu Sungai Utara, Provinsi Kalimantan Selatan
- **Telepon:** 0527-61002
- **Website:** [pa-amuntai.go.id](https://pa-amuntai.go.id)

**Tim IT PA Amuntai**
- **Author:** IT PA Amuntai

## 🔗 Link Terkait

- [Website Resmi PA Amuntai](https://pa-amuntai.go.id)
- [Facebook](https://facebook.com/pa-amuntai) 
- [YouTube](https://youtube.com/pa-amuntai)
- [Instagram](https://instagram.com/pa-amuntai)

## 📋 Changelog

### Version 1.0.0
- ✅ Implementasi layanan Voice Call, Video Call, dan Online Chat
- ✅ Sistem visitor counter
- ✅ Responsive design
- ✅ Database integration
- ✅ Social media integration
- ✅ Interactive user interface

## 🚀 Roadmap

- [ ] Implementasi sistem autentikasi
- [ ] Dashboard admin untuk monitoring
- [ ] Sistem notifikasi real-time
- [ ] Mobile app version
- [ ] API documentation
- [ ] Unit testing implementation

---

**Dibuat dengan ❤️ oleh Tim IT Pengadilan Agama Amuntai Kelas IB**
