# Lab10Web

Nama: Alipini Dwi Putri

NIM: 312410691

Kelas: TI 24 A2

Praktikum: 12 - PHP Object Oriented Programming (OOP)

Mata Kuliah: Pemrograman Web 1

Dosen Pengampu: Agung Nugroho, S.Kom., M.Kom.



# Pertanyaan dan Tugas 

**Implementasikan konsep modularisasi pada kode program pada praktukum sebelumnya 
dengan menggunakan class library untuk form dan database connection.**


**Halaman Utama Data Mahasiswa**


Halaman utama yang menampilkan semua data mahasiswa dalam tabel dengan tema violet.

    Bukti Modularisasi:
- Class Database digunakan untuk mengambil data dari database
- Tema Violet diterapkan konsisten
- Tabel responsif dengan fitur edit/hapus

Code penting
```
$db = Database::getInstance();  // Singleton pattern
$data = $db->fetchAll("SELECT * FROM data_mahasiswa");
```

  Output



  
<img width="653" height="692" alt="Screenshot 2025-12-01 211239" src="https://github.com/user-attachments/assets/6943ac1c-8bda-4ec2-a577-37a4bd3e9380" />


  
 **Form Tambah Data Mahasiswa**

 Form untuk menambahkan data mahasiswa baru dengan validasi.

    Bukti Modularisasi:
- Class Form digunakan untuk membuat form input
- Validasi client-side JavaScript
- UI konsisten dengan tema violet


Code penting
```
  $form = new Form("", "POST");  // ✅ Form class
$form->addInput("nim", "NIM", "text", "", true);
echo $form->render();  // ✅ Render form otomatis
<img width="996" height="828" alt="image" src="https://github.com/user-attachments/assets/3834f473-f19e-4612-8ea7-d6604c2b301c" />
```

Output






<img width="448" height="663" alt="Screenshot 2025-12-01 211315" src="https://github.com/user-attachments/assets/76558bea-0c78-400c-a610-125dc9d69945" />







**Hasil Pencarian Data**

Hasil pencarian real-time berdasarkan NIM, nama, atau alamat.

    Bukti Modularisasi:
- Method search di class Database
- Filter data dengan query OOP
- Tampilan hasil terintegrasi dengan sistem

Code Penting
```
$keyword = $db->escape($_POST['keyword']);  // Auto escape
$result = $db->fetchAll("SELECT * FROM data_mahasiswa WHERE nama LIKE '%$keyword%'");
```

Output






<img width="996" height="828" alt="Screenshot 2025-12-01 211351" src="https://github.com/user-attachments/assets/5f8d66cd-57d8-487f-8cd1-07d860ccaf0f" />






