@extends('frontend.components.master')
@section('title') {{$data->egitim_adi}}  @endsection

@section('addcss')

    <style>
        .react-login-page .login-right-form form .login-top{
            padding-bottom: 0!important;
        }

        .react-login-page .login-right-form{
            max-width: 100% !important;

        }
        .react-login-page .login-right-form form .back-check-box{
            display: block!important;
        }

        .react-login-page .text-danger{
            font-size: 15px;
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

                                <form method="POST" action="{{route('form.kesin-kayit-form.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <div class="login-top">
                                        <h3>{{$data -> egitim_adi }}</h3><br>
                                        <h5>Kesin Kayıt Formu</h5><br>
                                    </div>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            <b>{{ session('success') }}</b>
                                            <div class="mt-2">
                                                <a href="https://payment.antalya.edu.tr/Payment/UnAuthenticatedPayment?notAut=True">
                                                    <b>Kredi Kartı İle Ödeme Yap</b>
                                                </a>
                                            </div>
                                            <div class="alert alert-info mt-3">
                                                <b>HAVALE İLE ÖDEME YAPMAK İÇİN TL HESAP BİLGİLERİ (SEM)</b>
                                                <table class="table table-bordered mt-2">
                                                    <tbody>
                                                    <tr>
                                                        <th>HESAP ADI (ACCOUNT NAME)</th>
                                                        <td>ANTALYA BİLİM ÜNİVERSİTESİ</td>
                                                    </tr>
                                                    <tr>
                                                        <th>BANKA (BANK)</th>
                                                        <td>VAKIFLAR BANKASI</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ŞUBE (BRANCH)</th>
                                                        <td>ANTALYA ŞUBE</td>
                                                    </tr>
                                                    <tr>
                                                        <th>HESAP TİPİ</th>
                                                        <td>VADESİZ TL HESAP</td>
                                                    </tr>
                                                    <tr>
                                                        <th>HESAP NO (ACCOUNT NO.)</th>
                                                        <td>445000266714</td>
                                                    </tr>
                                                    <tr>
                                                        <th>IBAN</th>
                                                        <td>TR440001500158007317484665</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif



                                @if(session('error'))
                                        <div class="alert alert-danger">
                                            <b>{{ session('error') }}</b>
                                        </div>
                                    @endif
                                    <p>
                                        <label><span class="text-danger">*</span> Ad Soyad</label>
                                        <input placeholder="Ad Soyad" type="text"  name="name" value="{{old('name')}}"  >
                                        <span class="text-danger">
                                    @error('name')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> E-Posta</label>
                                        <input placeholder="E-Posta" type="text" name="email" value="{{old('email')}}" >
                                        <span class="text-danger">
                                    @error('email')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> Telefon</label>
                                        <input placeholder="Telefon" type="text"  name="phone" value="{{old('phone')}}" >
                                        <span class="text-danger">
                                    @error('phone')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> TC</label>
                                        <input placeholder="TC" type="text"  name="tc" value="{{old('tc')}}" >
                                        <span class="text-danger">
                                    @error('tc')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>

                                    @if($data->kimlik == 'on')
                                        <p>
                                            <label><span class="text-danger">*</span> Kimlik</label>
                                            <input type="file"  name="kimlik" >
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
                                            <input type="file"  name="diploma" >
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
                                            <input type="file"  name="kurumkarti" >
                                            <span>Lütfen belgelerinizi "pdf" formatında yükleyiniz. Yükleyebileceğiniz dosya boyutu maksimum 2 MB dır. Hata almanız durumunda belgeleri tekrar yüklemelisiniz.</span>

                                            <span class="text-danger">
                                    @error('kurumkarti')
                                                {{ $message }}
                                                @enderror
                            </span>
                                        </p>

                                    @endif



                                    <div class="back-check-box">
                                        <input type="checkbox" id="box-1" name="kvkk" {{ old('kvkk') ? 'checked' : '' }}><em><span class="text-danger">*</span> Kişisel verilerin korunması ve işlenmesi</em>&nbsp;  hakkında bilgilendirme metnini ve haklarımı okudum.<br>
                                        <p></p>
                                        <span class="text-danger">
                                    @error('kvkk')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                    <button type="submit">Kesin Kayıt Yap <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


