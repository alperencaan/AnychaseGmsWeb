<?php
// Prod ortamda hataları gizle
error_reporting(0);

// Sadece POST ile gelirse çalışsın
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Form verilerini al
    $ad_soyad = trim($_POST["ad_soyad"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $mesaj    = trim($_POST["mesaj"] ?? "");

    // Boş alan kontrolü
    if ($ad_soyad === "" || $email === "" || $mesaj === "") {
        echo "<script>
                alert('Lütfen tüm alanları doldurun.');
                window.location.href='contact.html';
              </script>";
        exit;
    }

    // Güvenlik (XSS)
    $ad_soyad = htmlspecialchars($ad_soyad, ENT_QUOTES, "UTF-8");
    $email    = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
    $mesaj    = htmlspecialchars($mesaj, ENT_QUOTES, "UTF-8");

    // Mail ayarları
    $kime = "alperencan2020@gmail.com";
    $konu = "Anychase Games - Yeni İletişim Mesajı";

    $icerik  = "Siteden yeni bir mesaj aldınız:\n\n";
    $icerik .= "Ad Soyad: $ad_soyad\n";
    $icerik .= "E-posta: $email\n\n";
    $icerik .= "Mesaj:\n$mesaj\n";

    $headers  = "From: info@anychasegames.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Mail gönder
    if (mail($kime, $konu, $icerik, $headers)) {
        echo "<script>
                alert('Mesajınız başarıyla gönderildi!');
                window.location.href='contact.html';
              </script>";
    } else {
        echo "<script>
                alert('Mesaj gönderilemedi. Sunucu mail ayarlarını kontrol edin.');
                window.location.href='contact.html';
              </script>";
    }

} else {
    // Dosyaya direkt girilirse ana sayfaya at
    header("Location: index.html");
    exit;
}
?>
