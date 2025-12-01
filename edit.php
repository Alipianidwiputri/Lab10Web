<?php
// edit.php - Halaman edit data dengan Violet Theme
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "database.php";
include "form.php";

$db = new Database();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data yang akan diedit
$data = $db->get('data_mahasiswa', "id=$id");

if (!$data) {
    header("Location: index.php?pesan=notfound");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses update data
    $updateData = [
        'nim' => $_POST['txtnim'],
        'nama' => $_POST['txtnama'],
        'alamat' => $_POST['txtalamat']
    ];
    
    $result = $db->update('data_mahasiswa', $updateData, "id=$id");
    
    if ($result) {
        header("Location: index.php?pesan=updated&nama=" . urlencode($_POST['txtnama']));
    } else {
        $error = "Gagal update data: " . $db->conn->error;
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa - Violet Theme</title>
    <style>
        /* COPY STYLE DARI create.php DI ATAS */
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
        
        input[type="text"] {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #9370DB;
            border-radius: 15px;
            font-size: 16px;
            transition: all 0.3s;
            background: rgba(230, 230, 250, 0.3);
            color: #333;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #8A2BE2;
            background: white;
            box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.2);
            transform: translateY(-2px);
        }
        
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
        }
        
        .input-wrapper input {
            padding-left: 55px;
        }
        
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
        
        .required::after {
            content: " *";
            color: #FF1493;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <div class="decoration">
                <i class="fas fa-user-edit"></i>
            </div>
            <h1>
                <i class="fas fa-edit"></i> Edit Data
            </h1>
            <p class="subtitle">Edit data mahasiswa #<?php echo $data['id']; ?> - <?php echo htmlspecialchars($data['nama']); ?></p>
        </div>
        
        <!-- ERROR MESSAGE -->
        <?php if (isset($error)): ?>
            <div style="background: linear-gradient(45deg, #FFE6F0, #FFD6E7); color: #D81B60; padding: 15px; border-radius: 12px; margin-bottom: 25px; border-left: 5px solid #D81B60;">
                <i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <!-- FORM -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="txtnim" class="required">
                    <i class="fas fa-id-card"></i> NIM
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-hashtag form-icon"></i>
                    <input type="text" 
                           id="txtnim" 
                           name="txtnim" 
                           value="<?php echo htmlspecialchars($data['nim']); ?>" 
                           required
                           pattern="[A-Za-z0-9]{8,20}"
                           title="Format NIM: 8-20 karakter (huruf/angka)">
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtnama" class="required">
                    <i class="fas fa-user"></i> Nama Lengkap
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-signature form-icon"></i>
                    <input type="text" 
                           id="txtnama" 
                           name="txtnama" 
                           value="<?php echo htmlspecialchars($data['nama']); ?>" 
                           required
                           minlength="3">
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtalamat" class="required">
                    <i class="fas fa-map-marker-alt"></i> Alamat
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-home form-icon"></i>
                    <input type="text" 
                           id="txtalamat" 
                           name="txtalamat" 
                           value="<?php echo htmlspecialchars($data['alamat']); ?>" 
                           required
                           minlength="5">
                </div>
            </div>
            
            <!-- BUTTONS -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Data
                </button>
                
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
        
        <!-- FOOTER -->
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 2px solid #E6E6FA; color: #9370DB; font-size: 0.9rem;">
            <p><i class="fas fa-history"></i> Terakhir diupdate: <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>
    </div>
    
    <script>
        // Animasi untuk form
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="text"]');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.transform = 'scale(1.02)';
                    this.style.boxShadow = '0 5px 15px rgba(138, 43, 226, 0.3)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.transform = 'scale(1)';
                    this.style.boxShadow = 'none';
                });
            });
            
            // Confirm before leaving if changes were made
            let formChanged = false;
            const form = document.querySelector('form');
            
            form.addEventListener('input', function() {
                formChanged = true;
            });
            
            window.addEventListener('beforeunload', function(e) {
                if (formChanged) {
                    e.preventDefault();
                    e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Yakin ingin keluar?';
                }
            });
            
            // Submit button animation
            const submitBtn = document.querySelector('button[type="submit"]');
            submitBtn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-check"></i> Data Diupdate!';
                }, 1500);
            });
        });
    </script>
</body>
</html>