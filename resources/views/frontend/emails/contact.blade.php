<!DOCTYPE html>
<html>
<head>
    <title>Yeni İletişim Formu Mesajı</title>
</head>
<body>
<h2>Yeni İletişim Formu Mesajı</h2>
<p><strong>Ad Soyad:</strong> {{ $data['name'] }}</p>
<p><strong>E-Posta:</strong> {{ $data['email'] }}</p>
<p><strong>Konu:</strong> {{ $data['subject'] }}</p>
<p><strong>Telefon:</strong> {{ $data['phone'] }}</p>
<p><strong>Mesaj:</strong> {{ $data['message'] }}</p>
</body>
</html>
