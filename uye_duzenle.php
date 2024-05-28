<?php
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: index.php?page=giris");
    exit();
}

$kullanici_id = $_GET['id'];
$sorgu = "SELECT * FROM kullanicilar WHERE id = ?";
$stmt = $conn->prepare($sorgu);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$sonuc = $stmt->get_result();
$kullanici = $sonuc->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici_adi = $_POST['kullanici_adi'];
    $email = $_POST['email'];
    $sorgu = "UPDATE kullanicilar SET kullanici_adi = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sorgu);
    $stmt->bind_param("ssi", $kullanici_adi, $email, $kullanici_id);
    $stmt->execute();
    header("Location: index.php?page=panel");
    exit();
}
?>

<div class="container mt-5">
    <h2>Bilgileri Düzenle</h2>
    <form action="index.php?page=uye_duzenle&id=<?php echo $kullanici_id; ?>" method="POST">
        <div class="form-group">
            <label for="kullanici_adi">Kullanıcı Adı:</label>
            <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" value="<?php echo htmlspecialchars($kullanici['kullanici_adi']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($kullanici['email']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
    <a href="index.php?page=panel" class="btn btn-secondary mt-3">Geri Dön</a>
</div>
