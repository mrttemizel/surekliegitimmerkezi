<!DOCTYPE html>
<html>
<head>
    <title>Kesin Kayıt Bilgilendirme</title>
</head>
<body>
    <h2>Sayın {{ $data['name'] }} {{ $data['surname'] }},</h2>
    
    <p>{{ $data['kurs_adi'] }} kursuna kesin kayıt başvurunuz alınmıştır.</p>
    
    <p>Ekte satış sözleşmesi dokümanını bulabilirsiniz.</p>
    
    <p>Saygılarımızla,<br>
    Antalya Bilim Üniversitesi SEM</p>
</body>
</html> 