<?php
// proses.php - Contoh handler form
include "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    
    // Contoh penggunaan berbagai method Database class
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'insert':
                $data = [
                    'nim' => $_POST['nim'],
                    'nama' => $_POST['nama'],
                    'alamat' => $_POST['alamat']
                ];
                $db->insert('data_mahasiswa', $data);
                break;
                
            case 'query_custom':
                $sql = $_POST['query'];
                $result = $db->query($sql);
                // Tampilkan hasil
                break;
        }
    }
    
    header("Location: index.php");
}
?>