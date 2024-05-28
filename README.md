# Php ile Site

Bu proje, kullanıcıların kayıt olabileceği, giriş yapabileceği ve diğer kullanıcıların profillerini görebileceği bir web uygulamasıdır.

Özellikler
Kullanıcılar kayıt olabilir ve giriş yapabilir.
Kullanıcılar kendi profillerini düzenleyebilir.
Kullanıcılar diğer kullanıcıların profillerini görüntüleyebilir.
Yönetici kullanıcılar, kullanıcıları düzenleyebilir ve silebilir.

KURULUM
Sql dosyasını indirin ve xammp uygulamasını açıp mysql ve apache çalıştırın.
Sql dosyalarını phpMyAdmin arayüzünden import edin ve veritabanını oluşturun.

Php dosyalarını indirin ve bunları bir web sunucusuna yükleyin filezilla gibi.
Kök dizini olan /public_html kısmına hepsini yükleyin ve bağlayın.
Ardından index.php dosyasındaki sunucu bağlama kısmını (genellikle aşagıdaki gibi degiştirilir) degiştirin.
$sunucu = "localhost";
$kullanici_adi = "root";
$sifre = "";
$veritabani = "oluşturdugunuz veritabanının adı olacak burada";
