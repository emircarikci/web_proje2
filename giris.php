<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    $sorgu = "SELECT * FROM kullanicilar WHERE kullanici_adi = ?";
    $stmt = $conn->prepare($sorgu);
    $stmt->bind_param("s", $kullanici_adi);
    $stmt->execute();
    $sonuc = $stmt->get_result();
    $kullanici = $sonuc->fetch_assoc();

    if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
        $_SESSION['kullanici_id'] = $kullanici['id'];
        header("Location: index.php?page=panel");
        exit();
    } else {
        $hata = "Geçersiz kullanıcı adı veya şifre.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="my-4">Giriş Yap</h2>
    <?php if (isset($hata)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $hata; ?>
        </div>
    <?php endif; ?>
    <form action="index.php?page=giris" method="POST">
        <div class="form-group">
            <label for="kullanici_adi">Kullanıcı Adı:</label>
            <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" required>
        </div>
        <div class="form-group">
            <label for="sifre">Şifre:</label>
            <input type="password" class="form-control" id="sifre" name="sifre" required>
        </div>
        <button type="submit" class="btn btn-primary">Giriş Yap</button>
    </form>
    <p class="mt-3">Hesabınız yok mu? <a href="index.php?page=kayit_ol">Kayıt Ol</a></p>
    <a href="index.php" class="btn btn-secondary mt-3">Ana Sayfaya Dön</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
