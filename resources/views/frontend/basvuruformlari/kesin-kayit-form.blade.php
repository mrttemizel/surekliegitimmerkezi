@extends('frontend.components.master')
@section('title')
    {{$data->egitim_adi}}
@endsection

@section('addcss')

    <style>
        .react-login-page .login-right-form form .login-top {
            padding-bottom: 0 !important;
        }

        .react-login-page .login-right-form {
            max-width: 100% !important;

        }

        .react-login-page .login-right-form form .back-check-box {
            display: block !important;
        }

        .react-login-page .text-danger {
            font-size: 15px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: bold;
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .list-unstyled {
            list-style: none;
            padding-left: 0;
        }

        .list-unstyled li {
            margin-bottom: 0.25rem;
        }
    </style>

@endsection

@section('content')

    <div class="react-wrapper mt-4 mb-4">
        <div class="react-wrapper-inner">
            <div class="react-login-page react-signup-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">


                            <div class="login-right-form">

                                <form method="POST" action="{{route('form.kesin-kayit-form.store')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <div class="login-top">
                                        <h3>{{$data -> egitim_adi }}</h3><br>
                                        <h5>Kesin Kayıt Formu</h5><br>
                                    </div>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            <b>{{ session('success') }}</b>
                                            <p>Ödeme için <a href="https://payment.antalya.edu.tr/Payment/UnAuthenticatedPayment?notAut=True" target="_blank" id="paymentLink">buraya tıklayınız</a>.</p>
                                        </div>
                                        <script>
                                            window.onload = function() {
                                                window.open('https://payment.antalya.edu.tr/Payment/UnAuthenticatedPayment?notAut=True', '_blank');
                                            };
                                        </script>
                                    @endif


                                    <h5>Kullanıcı tarafından bildirilen verilerin doğruluğu tamamen kendisine
                                        aittir.</h5>
                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            <b>{{ session('error') }}</b>
                                        </div>
                                    @endif
                                    <p>
                                        <label><span class="text-danger">*</span> Adınız</label>
                                        <input placeholder="Adınız" type="text" name="name" value="{{old('name')}}">
                                        <span class="text-danger">
                                    @error('name')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> Soyadınız</label>
                                        <input placeholder="Soyadınız" type="text" name="surname"
                                               value="{{old('surname')}}">
                                        <span class="text-danger">
                                    @error('surname')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> E-Posta</label>
                                        <input placeholder="E-Posta" type="text" name="email" value="{{old('email')}}">
                                        <span class="text-danger">
                                    @error('email')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> Adres</label>
                                        <input placeholder="Adres" type="text" name="address"
                                               value="{{old('address')}}">
                                        <span class="text-danger">
                                    @error('address')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> Telefon</label>
                                        <input placeholder="Telefon" type="text" name="phone" value="{{old('phone')}}">
                                        <span class="text-danger">
                                    @error('phone')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> TC</label>
                                        <input placeholder="TC" type="text" name="tc" value="{{old('tc')}}">
                                        <span class="text-danger">
                                    @error('tc')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>

                                    <p>
                                        <label>
                                            <span class="text-danger">*</span> Sınıf
                                        </label>
                                        <select id="sinif_select" name="sinif" class="form-control">
                                            <option value="">Bir sınıf seçin</option>
                                            @foreach ($siniflar as $sinif)
                                                <option value="{{ $sinif->id }}"
                                                        data-egitici="{{ $sinif->egitici_adi }}">
                                                    {{ $sinif->sinif_adi }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <span class="text-danger">
                                            @error('tc')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </p>

                                    <p id="egitici_label">
                                        <label>Eğitici Adı:</label>
                                        <span id="egitici_adi"></span>
                                    </p>

                                    @if($data->kimlik == 'on')
                                        <p>
                                            <label><span class="text-danger">*</span> Kimlik</label>
                                            <input type="file" name="kimlik">
                                            <span>Lütfen belgelerinizi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.</span>
                                            <span class="text-danger">
                                    @error('kimlik')
                                                {{ $message }}
                                                @enderror
                            </span>
                                        </p>

                                    @endif
                                    @if($data->diploma == 'on')
                                        <p>
                                            <label><span class="text-danger">*</span> Diploma</label>
                                            <input type="file" name="diploma">
                                            <span>Lütfen belgelerinizi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.</span>

                                            <span class="text-danger">
                                    @error('diploma')
                                                {{ $message }}
                                                @enderror
                            </span>
                                        </p>

                                    @endif
                                    @if($data->kurumkarti == 'on')
                                        <p>
                                            <label><span class="text-danger">*</span> Kurum Kartı</label>
                                            <input type="file" name="kurumkarti">
                                            <span>Lütfen belgelerinizi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.</span>

                                            <span class="text-danger">
                                    @error('kurumkarti')
                                                {{ $message }}
                                                @enderror
                            </span>
                                        </p>

                                    @endif


                                    <div class="back-check-box">
                                        <input type="checkbox" id="box-3" name="kvkk" {{ old('kvkk') ? 'checked' : '' }}>
                                        <em>
                                            <span class="text-danger">*</span>
                                            <a href="{{ route('kvkk') }}" target="_blank">Kişisel verilerime ilişkin aydınlatma metnini</a> ve haklarımı okudum, bilgilendirildim.
                                        </em>
                                        <br>
                                        <p></p>
                                        <span class="text-danger">
                                            @error('kvkk')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="back-check-box">
                                        <input type="checkbox" id="box-2" name="electronic" {{ old('electronic') ? 'checked' : '' }}>
                                        <em>
                                            Antalya Bilim Üniversitesi Sürekli Eğitim Merkezi faaliyetleriyle ilgili olarak 6563 Sayılı Elektronik Ticaretin
                                            Düzenlenmesi Hakkında Kanun uyarınca tarafıma elektronik ileti gönderilmesine onay veriyorum.
                                            <br/><u>Elektronik İleti Gönderiminin Onaylanmaması Durumunda İletişime Geçilemeyecektir.</u>
                                        </em>
                                        <br>
                                        <p></p>
                                        <span class="text-danger">
                                            @error('electronic')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="back-check-box">
                                        <input type="checkbox" id="box-1" name="explicit" {{ old('explicit') ? 'checked' : '' }}>
                                        <em><span class="text-danger">*</span></em>
                                        <a href="{{ route('acik.riza') }}" target="_blank">SEM Açık Rıza Metni</a>&nbsp;Okudum ve Onaylıyorum.
                                        <br>
                                        <p></p>
                                        <span class="text-danger">
                                            @error('explicit')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <button type="submit" id="submit">Kesin Kayıt Yap
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-arrow-right">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form'); // Form elemanını seçiyoruz
        const sinifSelect = document.getElementById('sinif_select');
        const egiticiAdiSpan = document.getElementById('egitici_adi');
        // Form tanımlı değilse veya boşsa işlemi durdur
        if (!form) {
            console.error('Form elemanı bulunamadı.');
            return;
        }

        const fileInputs = document.querySelectorAll('input[type="file"]'); // Tüm dosya girişlerini seçiyoruz
        const submitButton = document.getElementById('submit'); // ID ile butonu seçiyoruz

        // Submit butonu yoksa işlemi durdur
        if (!submitButton) {
            console.error('Submit butonu bulunamadı.');
            return;
        }

        fileInputs.forEach(input => {
            input.addEventListener('change', function () {
                const file = this.files[0];
                console.log('Dosya değiştirildi.');

                if (file && file.size > 2 * 1024 * 1024) { // 2 MB limit
                    alert('Dosya boyutu 2 MB\'ı geçemez.');
                    submitButton.style.visibility = 'hidden'; // Butonu gizle
                    this.value = ''; // Dosya seçim alanını temizle
                } else if (file && file.type !== 'application/pdf') {
                    alert('Sadece PDF dosyaları yüklenebilir.');
                    submitButton.style.visibility = 'hidden'; // Butonu gizle
                    this.value = '';
                } else {
                    submitButton.style.visibility = 'visible'; // Geçerliyse butonu görünür yap
                }
            });
        });


        sinifSelect.addEventListener('change', function () {
            // Seçilen option'un 'data-egitici' değerini al
            const selectedOption = sinifSelect.options[sinifSelect.selectedIndex];
            const egiticiAdi = selectedOption.getAttribute('data-egitici');

            // Eğitici adını ekrana yaz
            egiticiAdiSpan.textContent = egiticiAdi ? egiticiAdi : 'Seçilmedi';
        });
    });
</script>

