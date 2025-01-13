<!DOCTYPE html>
<html>
<head>
    <title>Kesin Kayıt Bilgilendirme</title>
</head>
<body>
    <h2>Sayın {{ $details['name'] }} {{ $details['surname'] }},</h2>
    
    <p>{{ $details['kurs_adi'] }} eğitimi için kesin kayıt başvurunuz alınmıştır.</p>
    
    <p>Mesafeli satış sözleşmenizi aşağıdaki linkten indirebilirsiniz:</p>
    <a href="{{ $details['sozlesme_url'] }}">Mesafeli Satış Sözleşmesi</a>
    
    <p>Saygılarımızla,<br>
    Antalya Bilim Üniversitesi SEM</p>
</body>
</html> 