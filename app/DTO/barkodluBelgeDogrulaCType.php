<?php

namespace App\DTO;

class barkodluBelgeDogrulaCType
{
    public $kurumKodu;
    public $sonucKodu;
    public $sonucAciklamasi;
    public $belge;
    public $tcKimlikNo;
    public $ad;
    public $soyad;
    public $belgeOlusturulmaTarihi;
    public $detayListesi = []; // Array of DetailType
}
