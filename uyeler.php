<?php
include 'index.php'; // Veritabanı bağlantısını içerir

$sorgu = "SELECT * FROM uyeler";
$sonuc = $conn->query($sorgu);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üyeler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Üyeler</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>İsim</th>
                    <th>Hobi</th>
                    <th>Email</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($satir = $sonuc->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $satir['id']; ?></td>
                    <td><?php echo htmlspecialchars($satir['isim']); ?></td>
                    <td><?php echo htmlspecialchars($satir['hobi']); ?></td>
                    <td><?php echo htmlspecialchars($satir['email']); ?></td>
                    <td>
                        <a href="uye_duzenle.php?id=<?php echo $satir['id']; ?>" class="btn btn-warning">Düzenle</a>
                        <a href="uye_sil.php?id=<?php echo $satir['id']; ?>" class="btn btn-danger">Sil</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
