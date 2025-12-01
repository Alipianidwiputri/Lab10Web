<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "database.php";
include "form.php";

$db = new Database();

// LOGIC PENCARIAN
$where = "";
if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $where = "WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR alamat LIKE '%$keyword%'";
}

$sql = "SELECT * FROM data_mahasiswa $where";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - Violet Theme</title>
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
            padding: 30px;
        }
        
        .container {
            max-width: 1300px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(138, 43, 226, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #8A2BE2;
        }
        
        h1 {
            color: #4B0082;
            font-size: 2.8rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .subtitle {
            color: #9370DB;
            font-size: 1.1rem;
        }
        
        /* BUTTONS */
        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #8A2BE2, #9370DB);
            color: white;
            box-shadow: 0 4px 15px rgba(138, 43, 226, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(138, 43, 226, 0.6);
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
        }
        
        .btn-danger {
            background: linear-gradient(45deg, #FF1493, #DA70D6);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.4);
        }
        
        .btn-danger:hover {
            background: linear-gradient(45deg, #DA70D6, #FF1493);
            transform: translateY(-3px);
        }
        
        /* TABLE */
        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        thead {
            background: linear-gradient(45deg, #8A2BE2, #4B0082);
        }
        
        th {
            color: white;
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        th:first-child {
            border-radius: 15px 0 0 0;
        }
        
        th:last-child {
            border-radius: 0 15px 0 0;
        }
        
        td {
            padding: 16px 15px;
            border-bottom: 1px solid #E6E6FA;
            color: #333;
        }
        
        tbody tr {
            transition: all 0.2s ease;
        }
        
        tbody tr:hover {
            background: rgba(138, 43, 226, 0.08);
            transform: scale(1.002);
        }
        
        tbody tr:nth-child(even) {
            background: rgba(230, 230, 250, 0.3);
        }
        
        tbody tr:nth-child(even):hover {
            background: rgba(138, 43, 226, 0.12);
        }
        
        /* ACTION BUTTONS */
        .action-btns {
            display: flex;
            gap: 10px;
        }
        
        .btn-small {
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #666;
        }
        
        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #9370DB;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .btn-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn {
                justify-content: center;
            }
            
            th, td {
                padding: 12px 10px;
                font-size: 14px;
            }
        }
        
        /* STATS */
        .stats {
            display: flex;
            justify-content: space-between;
            background: linear-gradient(45deg, #E6E6FA, #F8F0FF);
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            color: #4B0082;
            font-weight: 600;
            border: 2px solid #9370DB;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .stat-icon {
            font-size: 1.5rem;
        }
        
        /* ===== SIMPLE SEARCH CONTAINER ===== */
        .simple-search-container {
            margin: 40px 0;
        }

        .simple-search-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .simple-search-title {
            display: inline-flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
        }

        .simple-search-title i {
            color: #8A2BE2;
            font-size: 2.5rem;
            background: rgba(138, 43, 226, 0.1);
            padding: 20px;
            border-radius: 50%;
            border: 3px solid #E6E6FA;
        }

        .simple-search-title h2 {
            color: #4B0082;
            font-size: 2.2rem;
            margin: 0;
        }

        .simple-search-subtitle {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* ===== SIMPLE SEARCH BOX ===== */
        .simple-search-box {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(138, 43, 226, 0.15);
            border: 3px solid #8A2BE2; /* BORDER VIOLET */
        }

        /* ===== SEARCH INPUT BESAR ===== */
        .search-input-wrapper-large {
            position: relative;
        }

        .search-icon-large {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #8A2BE2;
            font-size: 1.8rem;
            z-index: 2;
        }

        .search-input-extra-large {
            width: 100%;
            padding: 25px 25px 25px 75px;
            border: 3px solid #9370DB; /* BORDER VIOLET */
            border-radius: 15px;
            font-size: 1.4rem;
            transition: all 0.3s ease;
            background: rgba(230, 230, 250, 0.2);
            color: #333;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .search-input-extra-large:focus {
            outline: none;
            border-color: #8A2BE2; /* BORDER VIOLET FOCUS */
            background: white;
            box-shadow: 0 10px 30px rgba(138, 43, 226, 0.2);
            transform: translateY(-3px);
        }

        .search-input-extra-large::placeholder {
            color: #9370DB;
            opacity: 0.7;
            font-size: 1.2rem;
        }

        /* ===== SEARCH BUTTONS ===== */
        .search-button-wrapper {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .search-button-large {
            padding: 20px 60px;
            background: linear-gradient(45deg, #8A2BE2, #9370DB);
            color: white;
            border: 3px solid #8A2BE2; /* BORDER VIOLET */
            border-radius: 15px;
            font-size: 1.4rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 8px 25px rgba(138, 43, 226, 0.4);
        }

        .search-button-large:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(138, 43, 226, 0.5);
            background: linear-gradient(45deg, #9370DB, #8A2BE2);
            border-color: #9370DB; /* BORDER VIOLET HOVER */
        }

        .reset-button-large {
            padding: 20px 40px;
            background: white;
            color: #4B0082;
            border: 3px solid #9370DB; /* BORDER VIOLET */
            border-radius: 15px;
            font-size: 1.4rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .reset-button-large:hover {
            background: #9370DB;
            color: white;
            transform: translateY(-5px);
            border-color: #8A2BE2; /* BORDER VIOLET HOVER */
        }

        /* ===== RESULTS INFO ===== */
        .simple-results-info {
            margin-top: 30px;
            padding: 20px;
            background: rgba(138, 43, 226, 0.05);
            border-radius: 15px;
            border: 2px dashed #9370DB; /* BORDER VIOLET DASHED */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .results-count-large {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #4B0082;
            font-size: 1.2rem;
        }

        .results-count-large i {
            color: #8A2BE2;
            font-size: 1.8rem;
        }

        .search-keyword-display {
            background: rgba(138, 43, 226, 0.1);
            padding: 10px 25px;
            border-radius: 30px;
            color: #4B0082;
            font-size: 1.1rem;
            border: 2px solid #9370DB; /* BORDER VIOLET */
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .simple-search-box {
                padding: 25px 20px;
            }
            
            .simple-search-title {
                flex-direction: column;
                gap: 10px;
            }
            
            .simple-search-title h2 {
                font-size: 1.8rem;
            }
            
            .search-input-extra-large {
                font-size: 1.2rem;
                padding: 20px 20px 20px 60px;
            }
            
            .search-icon-large {
                left: 20px;
                font-size: 1.5rem;
            }
            
            .search-button-wrapper {
                flex-direction: column;
            }
            
            .search-button-large,
            .reset-button-large {
                width: 100%;
                justify-content: center;
                padding: 18px;
                font-size: 1.2rem;
            }
            
            .simple-results-info {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <h1>📚 Data Mahasiswa</h1>
            <p class="subtitle">Sistem Manajemen Data Mahasiswa - Violet Theme</p>
        </div>
        
        <!-- STATS -->
        <div class="stats">
            <div class="stat-item">
                <span class="stat-icon">👥</span>
                <span>Total Mahasiswa: 
                    <?php 
                        $countResult = $db->query("SELECT COUNT(*) as total FROM data_mahasiswa");
                        $countData = $countResult->fetch_assoc();
                        echo $countData['total'];
                    ?>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-icon">🎓</span>
                <span>Praktikum OOP PHP</span>
            </div>
            <div class="stat-item">
                <span class="stat-icon">💜</span>
                <span>Violet Theme</span>
            </div>
        </div>
        
        <!-- BUTTONS -->
        <div class="btn-container">
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Data Baru
            </a>
            
            <div style="display: flex; gap: 10px;">
                <a href="#" class="btn btn-secondary" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak
                </a>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-sync-alt"></i> Refresh
                </a>
            </div>
        </div>
        
        <!-- TABLE -->
        <div class="table-container">
            <?php if ($result && $result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">NIM</th>
                            <th width="25%">Nama Lengkap</th>
                            <th width="30%">Alamat</th>
                            <th width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><strong>#<?php echo htmlspecialchars($row['id']); ?></strong></td>
                            <td>
                                <span style="background: #E6E6FA; padding: 5px 10px; border-radius: 20px; font-family: monospace;">
                                    <?php echo htmlspecialchars($row['nim']); ?>
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(45deg, #8A2BE2, #9370DB); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                        <?php echo strtoupper(substr($row['nama'], 0, 1)); ?>
                                    </div>
                                    <?php echo htmlspecialchars($row['nama']); ?>
                                </div>
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt" style="color: #9370DB; margin-right: 8px;"></i>
                                <?php echo htmlspecialchars($row['alamat']); ?>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-small btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-small btn-danger" onclick="return confirm('Yakin menghapus data <?php echo addslashes($row['nama']); ?>?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h3 style="color: #4B0082; margin-bottom: 10px;">Tidak Ada Data</h3>
                    <p style="margin-bottom: 20px;">Belum ada data mahasiswa yang tersimpan.</p>
                    <a href="create.php" class="btn btn-primary" style="text-decoration: none;">
                        <i class="fas fa-plus-circle"></i> Tambah Data Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- SEARCH BOX - SIMPLE & BESAR -->
        <div class="simple-search-container">
            <div class="simple-search-header">
                <div class="simple-search-title">
                    <i class="fas fa-search"></i>
                    <h2>Cari Mahasiswa</h2>
                </div>
                <p class="simple-search-subtitle">
                    Temukan data mahasiswa berdasarkan NIM, Nama, atau Alamat
                </p>
            </div>
            
            <div class="simple-search-box">
                <form method="POST" action="index.php" class="simple-search-form">
                    <div class="search-input-wrapper-large">
                        <div class="search-icon-large">
                            <i class="fas fa-search"></i>
                        </div>
                        <input type="text" 
                               id="keyword" 
                               name="keyword" 
                               placeholder="Contoh: J2104097, Rizki, Jakarta" 
                               value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>"
                               class="search-input-extra-large">
                        
                        <div class="search-button-wrapper">
                            <button type="submit" class="search-button-large">
                                <i class="fas fa-search"></i>
                                Cari Data
                            </button>
                            
                            <?php if (isset($_POST['keyword']) && !empty($_POST['keyword'])): ?>
                            <a href="index.php" class="reset-button-large">
                                <i class="fas fa-times"></i>
                                Reset
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if (isset($_POST['keyword']) && !empty($_POST['keyword'])): ?>
                    <div class="simple-results-info">
                        <div class="results-count-large">
                            <i class="fas fa-chart-bar"></i>
                            <span>Ditemukan: <strong><?php echo $result->num_rows; ?></strong> hasil</span>
                        </div>
                        <div class="search-keyword-display">
                            Kata kunci: "<strong><?php echo htmlspecialchars($_POST['keyword']); ?></strong>"
                        </div>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        
        <!-- FOOTER -->
        <div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 2px solid #E6E6FA; color: #9370DB; font-size: 0.9rem;">
            <p>💜 <strong>Lab 10: PHP OOP</strong> | Violet Theme | <?php echo date('Y'); ?></p>
            <p>Modular OOP dengan Class Database & Form</p>
        </div>
    </div>
    
    <script>
        // Animasi untuk hover
        document.addEventListener('DOMContentLoaded', function() {
            // Efek ketik untuk judul
            const title = document.querySelector('h1');
            const text = title.textContent;
            title.textContent = '';
            
            let i = 0;
            function typeWriter() {
                if (i < text.length) {
                    title.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                }
            }
            
            // Mulai efek ketik setelah 500ms
            setTimeout(typeWriter, 500);
            
            // Efek untuk tombol hapus
            const deleteButtons = document.querySelectorAll('.btn-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
            
            // Toast untuk actions
            const actionLinks = document.querySelectorAll('a[href*="edit.php"], a[href*="create.php"]');
            actionLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if(this.href.includes('delete.php')) return;
                    
                    const action = this.href.includes('edit.php') ? 'mengedit' : 'menambah';
                    console.log(`Memulai proses ${action} data...`);
                });
            });
        });
    </script>
</body>
</html>