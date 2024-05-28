<?php
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: index.php?page=giris");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sorgu = "INSERT INTO kullanicilar (kullanici_adi, sifre, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sorgu);
    $stmt->bind_param("sss", $kullanici_adi, $sifre, $email);
    $stmt->execute();

    header("Location: index.php?page=panel");
    exit();
}
?>

<div class="container mt-5">
    <h2>Üye Ekle</h2>
    <form action="index.php?page=uye_ekle" method="POST">
        <div class="form-group">
            <label for="kullanici_adi">Kullanıcı Adı:</label>
            <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" required>
        </div>
        <div class="form-group">
            <label for="sifre">Şifre:</label>
            <input type="password" class="form-control" id="sifre" name="sifre" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Ekle</button>
    </form>
    <a href="index.php?page=panel" class="btn btn-secondary mt-3">Geri Dön</a>
</div>
