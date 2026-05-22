# 🏘️ Aplikasi Kas RT Laravel

Aplikasi Kas RT berbasis Laravel yang digunakan untuk mengelola data warga, kas masuk, kas keluar, laporan keuangan, dan manajemen user berdasarkan role.

---

# ✨ Fitur Utama

## 🔐 Login Multi Role

Aplikasi memiliki 3 role user:

| Role      | Hak Akses                  |
| --------- | -------------------------- |
| Admin     | Mengelola seluruh sistem   |
| Bendahara | Mengelola data warga & kas |
| Warga     | Melihat kas & laporan      |

---

# 📊 Dashboard Modern

Dashboard dibuat dengan tampilan modern menggunakan:

* Bootstrap 5
* Sidebar Navigation
* Card Statistik
* Avatar User Login
* Ringkasan Kas

---

# 👥 Data Warga

Fitur:

* Tambah warga
* Edit warga
* Hapus warga
* Pencarian data warga
* Pagination per 10 data
* Menampilkan:

  * Nama
  * Alamat
  * No HP
  * Status

---

# 💰 Manajemen Kas

Fitur:

* Kas Masuk
* Kas Keluar
* Total Kas
* Edit data kas
* Hapus data kas

---

# 📈 Laporan Kas

Fitur:

* Menampilkan laporan seluruh transaksi
* Filter laporan berdasarkan tanggal
* Ringkasan pemasukan & pengeluaran

---

# 👤 Manajemen User

Khusus Admin:

* Tambah user
* Edit role user
* Hapus user

---

# 🛠️ Teknologi yang Digunakan

| Teknologi   | Keterangan         |
| ----------- | ------------------ |
| Laravel 12  | Framework Backend  |
| PHP 8.2     | Bahasa Pemrograman |
| MySQL       | Database           |
| Bootstrap 5 | UI Framework       |
| Blade       | Template Engine    |

---

# 📂 Struktur Role

## Admin

Dapat mengakses:

* Dashboard
* Data Warga
* Kas
* Laporan
* Data User

## Bendahara

Dapat mengakses:

* Dashboard
* Data Warga
* Kas
* Laporan

## Warga

Dapat mengakses:

* Dashboard
* Kas
* Laporan

---

# 🚀 Cara Menjalankan Project

## 1. Clone Repository

```bash
git clone https://github.com/USERNAME/aplikasi-kas-rt.git
```

---

## 2. Masuk Folder Project

```bash
cd aplikasi-kas-rt
```

---

## 3. Install Dependency

```bash
composer install
```

---

## 4. Copy File ENV

```bash
cp .env.example .env
```

---

## 5. Generate Key

```bash
php artisan key:generate
```

---

## 6. Atur Database

Buka file `.env`

Ubah:

```env
DB_DATABASE=kas_rt
DB_USERNAME=root
DB_PASSWORD=
```

---

## 7. Jalankan Migrasi

```bash
php artisan migrate
```

---

## 8. Jalankan Server

```bash
php artisan serve
```

---

# 🔑 Akun Login Default

## Admin

```txt
Email : admin@gmail.com
Password : password
```

## Bendahara

```txt
Email : bendahara@gmail.com
Password : password
```

## Warga

```txt
Email : warga@gmail.com
Password : password
```

---

# 📸 Tampilan Aplikasi

Fitur tampilan:

* Sidebar modern
* Dashboard statistik
* Avatar user
* Responsive design
* Card laporan kas

---

# 📌 Catatan

Project ini dibuat untuk:

* Pembelajaran Laravel
* Sistem administrasi RT
* Pengelolaan kas warga

---

# 👨‍💻 Developer

Dibuat oleh:
**Armand**

---

# 📄 License

Project ini bebas digunakan untuk pembelajaran.
