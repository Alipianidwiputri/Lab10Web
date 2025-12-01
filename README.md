# Lab10Web

Nama: Alipini Dwi Putri

NIM: 312410691

Kelas: TI 24 A2

Praktikum: 12 - PHP Object Oriented Programming (OOP)

Mata Kuliah: Pemrograman Web 1

Dosen Pengampu: Agung Nugroho, S.Kom., M.Kom.



Langkah-langkah Praktikum
1. Persiapan Database
Screenshot 1: Setup Database di phpMyAdmin
https://screenshots/database-setup.png

Penjelasan:

Membuat database mahasiswa di phpMyAdmin

Membuat tabel data_mahasiswa dengan struktur:

sql
CREATE TABLE data_mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20),
    nama VARCHAR(100),
    alamat TEXT
);
Menambahkan data dummy untuk pengujian

2. Implementasi Class Database (database.php)
Konsep OOP yang diterapkan:

Encapsulation: Property database connection dibuat protected

Constructor: __construct() untuk inisialisasi koneksi

Method: Fungsi CRUD (query(), get(), insert(), update(), delete())

Kode Utama:

php
class Database {
    protected $host, $user, $password, $db_name, $conn;
    
    public function __construct() {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
    }
    
    // Method CRUD lainnya...
}
3. Implementasi Class Form (form.php)
Konsep OOP yang diterapkan:

Property Private: $fields, $action, $submit, $jumField

Method Public: __construct(), addField(), displayForm()

Kode Utama:

php
class Form {
    private $fields = array();
    private $action;
    private $submit;
    private $jumField = 0;
    
    public function __construct($action, $submit) {
        $this->action = $action;
        $this->submit = $submit;
    }
    
    public function addField($name, $label) {
        $this->fields[$this->jumField]['name'] = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->jumField++;
    }
}
4. Halaman Utama (index.php)
Screenshot 1: Tampilan Awal Data Mahasiswa
https://screenshots/data-mahasiswa.png

Penjelasan:

Menampilkan semua data dari database dalam bentuk tabel

Fitur:

Header dengan judul dan subtitle

Stats card menampilkan total mahasiswa

Tombol aksi: Tambah Data, Cetak, Refresh

Tabel dengan kolom: ID, NIM, Nama, Alamat, Aksi

Avatar lingkaran dengan inisial nama

Tombol Edit dan Hapus dengan konfirmasi

Kode Penting:

php
// Modularisasi: Include class Database dan Form
include "database.php";
include "form.php";

// Buat object Database
$db = new Database();

// Query data dengan atau tanpa filter pencarian
$sql = "SELECT * FROM data_mahasiswa $where";
$result = $db->query($sql);
5. Form Pencarian dengan Violet Theme
Screenshot 2: Fitur Pencarian Data
https://screenshots/search-feature.png

Penjelasan:

Form pencarian besar dengan input field yang jelas

Desain Violet Theme:

Border warna #8A2BE2 (BlueViolet)

Background gradient ungu

Icon search dengan animasi

Fungsi: Mencari berdasarkan NIM, Nama, atau Alamat

Hasil: Menampilkan jumlah hasil dan kata kunci yang dicari

Kode CSS untuk Search Box:

css
.simple-search-box {
    border: 3px solid #8A2BE2;
    background: white;
    border-radius: 20px;
    padding: 40px;
}

.search-input-extra-large {
    border: 3px solid #9370DB;
    font-size: 1.4rem;
    padding: 25px 25px 25px 75px;
}
6. Halaman Tambah Data (create.php)
Screenshot 3: Form Tambah Data Mahasiswa
https://screenshots/tambah-data.png

Penjelasan:

Form input dengan validasi client-side

Field Required: NIM, Nama, Alamat

Validasi:

NIM: 8-20 karakter (huruf/angka)

Nama: Minimal 3 karakter

Alamat: Minimal 5 karakter

UI Features:

Icon untuk setiap field

Placeholder dengan contoh

Tooltip informasi

Button dengan efek hover

Kode Validasi JavaScript:

javascript
function validateForm() {
    const nim = document.getElementById('nim').value;
    if (!/^[A-Za-z0-9]{8,20}$/.test(nim)) {
        alert('NIM harus 8-20 karakter dan hanya boleh berisi huruf dan angka');
        return false;
    }
    // Validasi lainnya...
}
7. Halaman Edit Data (edit.php)
Fitur:

Menampilkan data yang akan diedit

Form dengan value pre-filled dari database

Validasi sama dengan form tambah data

Konfirmasi sebelum meninggalkan halaman jika ada perubahan

Kode untuk mengambil data:

php
$id = $_GET['id'];
$data = $db->get('data_mahasiswa', "id=$id");
8. Halaman Hapus Data (delete.php)
Fitur:

Konfirmasi sebelum menghapus (menggunakan JavaScript confirm())

Redirect kembali ke halaman utama setelah penghapusan

Menampilkan pesan sukses/gagal

Kode Hapus Data:

php
$id = $_GET['id'];
$result = $db->delete('data_mahasiswa', "WHERE id=$id");
if ($result) {
    header("Location: index.php?pesan=deleted");
}
9. Tema Violet yang Konsisten
Desain Visual:

Color Palette:

Primary: #8A2BE2 (BlueViolet)

Secondary: #9370DB (MediumPurple)

Dark: #4B0082 (Indigo)

Light: #E6E6FA (Lavender)

UI Elements:

Gradient background: linear-gradient(135deg, #8A2BE2 0%, #4B0082 100%)

Box shadow dengan warna ungu

Border dan outline warna violet

Icon dari Font Awesome

Responsive Design:

Media query untuk tampilan mobile

Flexbox untuk layout adaptif

10. Konsep Modularisasi yang Diterapkan
Keuntungan Modularisasi:

Reusability: Class Database dan Form bisa dipakai di banyak file

Maintainability: Perubahan hanya di satu file

Separation of Concerns:

Database logic di database.php

Form logic di form.php

Presentation logic di masing-masing view

Contoh Implementasi:

php
// Di index.php, create.php, edit.php
include "database.php";
include "form.php";

$db = new Database();  // Object yang sama bisa dipakai dimana saja

<img width="996" height="828" alt="image" src="https://github.com/user-attachments/assets/3834f473-f19e-4612-8ea7-d6604c2b301c" />
