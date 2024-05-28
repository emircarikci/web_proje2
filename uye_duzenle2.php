<?php
include 'index.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isim = $_POST['isim'];
    $hobi = $_POST['hobi'];
    $email = $_POST['email'];

    $sorgu = "UPDATE uyeler SET isim = ?, hobi = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sorgu);
    $stmt->bind_param("sssi", $isim, $hobi, $email, $id);
    $stmt->execute();

    header("Location: uyeler.php");
}
?>
