<?php
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: index.php?page=giris");
    exit();
}

$kullanici_id = $_SESSION['kullanici_id'];
$sorgu = "SELECT * FROM kullanicilar WHERE id = ?";
$stmt = $conn->prepare($sorgu);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$sonuc = $stmt->get_result();
$kullanici = $sonuc->fetch_assoc();
?>

<div class="container mt-5">
    <h2>Hoş Geldiniz, <?php echo isset($kullanici['kullanici_adi']) ? htmlspecialchars($kullanici['kullanici_adi']) : 'Kullanıcı'; ?>!</h2>
    <p>Giriş başarılı!</p>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Kullanıcı Bilgileri</h5>
            <p><strong>Kullanıcı Adı:</strong> <?php echo isset($kullanici['kullanici_adi']) ? htmlspecialchars($kullanici['kullanici_adi']) : 'Bilinmiyor'; ?></p>
            <p><strong>Email:</strong> <?php echo isset($kullanici['email']) ? htmlspecialchars($kullanici['email']) : 'Bilinmiyor'; ?></p>
            <a href="index.php?page=uye_duzenle&id=<?php echo $kullanici_id; ?>" class="btn btn-primary">Bilgileri Düzenle</a>
        </div>
    </div>

    <div class="mt-4">
        <h5>Diğer Üyeler</h5>
        <?php
        $sorgu = "SELECT * FROM kullanicilar";
        $sonuc = $conn->query($sorgu);

        if ($sonuc->num_rows > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>ID</th><th>Kullanıcı Adı</th><th>Email</th><th>İşlemler</th></tr></thead>';
            echo '<tbody>';
            while ($uye = $sonuc->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $uye['id'] . '</td>';
                echo '<td>' . htmlspecialchars($uye['kullanici_adi']) . '</td>';
                echo '<td>' . htmlspecialchars($uye['email']) . '</td>';
                echo '<td>';
                echo '<a href="index.php?page=uye_duzenle&id=' . $uye['id'] . '" class="btn btn-warning btn-sm">Düzenle</a> ';
                echo '<a href="index.php?page=uye_sil&id=' . $uye['id'] . '" class="btn btn-danger btn-sm">Sil</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>Henüz üye yok.</p>';
        }
        ?>
    </div>
    <a href="index.php?page=cikis" class="btn btn-danger mt-3">Çıkış Yap</a>
    <a href="index.php" class="btn btn-secondary mt-3">Ana Sayfaya Dön</a>
</div>
