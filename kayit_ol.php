<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Hata mesajlarını tutacak değişkenler
    $hataMesaji = '';

    // Kullanıcı adı kontrolü
    $kullaniciAdiSorgu = "SELECT * FROM kullanicilar WHERE kullanici_adi = ?";
    $stmt = $conn->prepare($kullaniciAdiSorgu);
    $stmt->bind_param("s", $kullanici_adi);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hataMesaji .= "<div class='alert alert-danger'>Kullanıcı adı zaten mevcut!</div>";
    }

    // Email kontrolü
    $emailSorgu = "SELECT * FROM kullanicilar WHERE email = ?";
    $stmt = $conn->prepare($emailSorgu);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hataMesaji .= "<div class='alert alert-danger'>Email zaten mevcut!</div>";
    }

    // Hata yoksa yeni kullanıcıyı kaydet
    if (empty($hataMesaji)) {
        $sorgu = "INSERT INTO kullanicilar (kullanici_adi, sifre, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sorgu);
        $stmt->bind_param("sss", $kullanici_adi, $sifre, $email);
        $stmt->execute();

        header("Location: index.php?page=giris");
        exit();
    }
}
?>

<div class="container">
    <h2>Kayıt Ol</h2>
    <?php
    if (!empty($hataMesaji)) {
        echo $hataMesaji;
    }
    ?>
    <form action="index.php?page=kayit_ol" method="POST">
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
        <button type="submit" class="btn btn-primary">Kayıt Ol</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Ana Sayfaya Dön</a>
</div>
