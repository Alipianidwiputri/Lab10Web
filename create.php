<?php
// create.php - Halaman tambah data dengan Violet Theme
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses simpan data ke database
    include "database.php";
    $db = new Database();
    
    $data = [
        'nim' => $_POST['nim'],
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat']
    ];
    
    $result = $db->insert('data_mahasiswa', $data);
    
    if ($result) {
        header("Location: index.php?pesan=sukses&nama=" . urlencode($_POST['nama']));
    } else {
        $error = "Gagal menyimpan data: " . $db->conn->error;
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa - Violet Theme</title>
    <style>
        /* VIOLET THEME */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #8A2BE2 0%, #4B0082 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.98);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(138, 43, 226, 0.4);
            backdrop-filter: blur(10px);
            border: 3px solid #9370DB;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #8A2BE2;
        }
        
        h1 {
            color: #4B0082;
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        
        .subtitle {
            color: #9370DB;
            font-size: 1.1rem;
        }
        
        /* FORM STYLING */
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: #4B0082;
            font-weight: 600;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        label i {
            color: #8A2BE2;
            font-size: 1.2rem;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .form-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #9370DB;
            font-size: 1.2rem;
            z-index: 1;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 15px 20px 15px 55px;
            border: 2px solid #9370DB;
            border-radius: 15px;
            font-size: 16px;
            transition: all 0.3s;
            background: rgba(230, 230, 250, 0.3);
            color: #333;
            box-sizing: border-box;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #8A2BE2;
            background: white;
            box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.2);
            transform: translateY(-2px);
        }
        
        input[type="text"]::placeholder {
            color: #9370DB;
            opacity: 0.7;
        }
        
        /* BUTTONS */
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }
        
        .btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 16px 25px;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            font-size: 17px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #8A2BE2, #9370DB);
            color: white;
            box-shadow: 0 6px 20px rgba(138, 43, 226, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(138, 43, 226, 0.6);
            background: linear-gradient(45deg, #9370DB, #8A2BE2);
        }
        
        .btn-secondary {
            background: #E6E6FA;
            color: #4B0082;
            border: 2px solid #9370DB;
        }
        
        .btn-secondary:hover {
            background: #9370DB;
            color: white;
            transform: translateY(-4px);
        }
        
        /* ERROR MESSAGE */
        .error-message {
            background: linear-gradient(45deg, #FFE6F0, #FFD6E7);
            color: #D81B60;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 5px solid #D81B60;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* DECORATION */
        .decoration {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .decoration i {
            font-size: 4rem;
            color: #8A2BE2;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        
        /* VALIDATION */
        .required::after {
            content: " *";
            color: #FF1493;
            font-weight: bold;
        }
        
        input:invalid {
            border-color: #FF69B4;
            background: rgba(255, 182, 193, 0.1);
        }
        
        input:valid {
            border-color: #32CD32;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <div class="decoration">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h1>
                <i class="fas fa-plus-circle"></i> Tambah Data Mahasiswa
            </h1>
            <p class="subtitle">Isi form berikut untuk menambahkan data baru</p>
        </div>
        
        <!-- ERROR MESSAGE -->
        <?php if (isset($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>
        
        <!-- FORM -->
        <form method="POST" action="" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="nim" class="required">
                    <i class="fas fa-id-card"></i> NIM
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-hashtag form-icon"></i>
                    <input type="text" 
                           id="nim" 
                           name="nim" 
                           placeholder="Contoh: J2104097" 
                           required
                           pattern="[A-Za-z0-9]{8,20}"
                           title="Format NIM: 8-20 karakter (huruf/angka)">
                </div>
                <small style="color: #9370DB; margin-top: 5px; display: block;">
                    <i class="fas fa-info-circle"></i> Masukkan NIM mahasiswa (8-20 karakter)
                </small>
            </div>
            
            <div class="form-group">
                <label for="nama" class="required">
                    <i class="fas fa-user"></i> Nama Lengkap
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-signature form-icon"></i>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           placeholder="Contoh: Rizki Pratama" 
                           required
                           minlength="3"
                           title="Masukkan nama lengkap minimal 3 karakter">
                </div>
            </div>
            
            <div class="form-group">
                <label for="alamat" class="required">
                    <i class="fas fa-map-marker-alt"></i> Alamat
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-home form-icon"></i>
                    <input type="text" 
                           id="alamat" 
                           name="alamat" 
                           placeholder="Contoh: Jakarta, Indonesia" 
                           required
                           minlength="5"
                           title="Masukkan alamat lengkap">
                </div>
                <small style="color: #9370DB; margin-top: 5px; display: block;">
                    <i class="fas fa-info-circle"></i> Gunakan format: Kota, Provinsi
                </small>
            </div>
            
            <!-- BUTTONS -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
                
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </form>
        
        <!-- FOOTER NOTE -->
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 2px solid #E6E6FA; color: #9370DB; font-size: 0.9rem;">
            <p><i class="fas fa-shield-alt"></i> Data yang Anda masukkan akan disimpan secara aman</p>
        </div>
    </div>
    
    <script>
        // Form validation
        function validateForm() {
            const nim = document.getElementById('nim').value;
            const nama = document.getElementById('nama').value;
            const alamat = document.getElementById('alamat').value;
            
            // Validasi NIM
            if (!/^[A-Za-z0-9]{8,20}$/.test(nim)) {
                alert('❌ NIM harus 8-20 karakter dan hanya boleh berisi huruf dan angka');
                document.getElementById('nim').focus();
                return false;
            }
            
            // Validasi Nama
            if (nama.length < 3) {
                alert('❌ Nama harus minimal 3 karakter');
                document.getElementById('nama').focus();
                return false;
            }
            
            // Validasi Alamat
            if (alamat.length < 5) {
                alert('❌ Alamat harus minimal 5 karakter');
                document.getElementById('alamat').focus();
                return false;
            }
            
            // Show loading effect
            const submitBtn = document.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.disabled = true;
            
            return true;
        }
        
        // Add input effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="text"]');
            
            inputs.forEach(input => {
                // Real-time validation
                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.style.borderColor = '#32CD32';
                        this.style.background = 'rgba(50, 205, 50, 0.1)';
                    } else {
                        this.style.borderColor = '#9370DB';
                        this.style.background = 'rgba(230, 230, 250, 0.3)';
                    }
                });
            });
        });
    </script>
</body>
</html>