<?php
// delete.php - Hapus data
include "database.php";

$db = new Database();
$id = $_GET['id'];

$result = $db->delete('data_mahasiswa', "WHERE id=$id");

if ($result) {
    header("Location: index.php?pesan=deleted");
} else {
    echo "Gagal menghapus data";
}
?>