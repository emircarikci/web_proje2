<?php
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: index.php?page=giris");
    exit();
}

$kullanici_id = $_GET['id'];
$sorgu = "DELETE FROM kullanicilar WHERE id = ?";
$stmt = $conn->prepare($sorgu);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();

header("Location: index.php?page=panel");
exit();
?>
