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

                                <form method="POST" action="{{route('form-kayit-on.form-kayit-form.store')}}">

                                    @csrf
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <div class="login-top">
                                        <h3>{{$data -> egitim_adi }}</h3><br>
                                        <h5>Ön Başvuru Formu</h5><br>
                                    </div>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            <b>{{ session('success') }}</b>
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            <b>{{ session('error') }}</b>
                                        </div>
                                    @endif
                                    <p>
                                        <label><span class="text-danger">*</span> Ad Soyad</label>
                                        <input placeholder="Adınız" type="text"  name="name" value="{{old('name')}}"  >
                                        <span class="text-danger">
                                    @error('name')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </p>
                                    <p>
                                        <label><span class="text-danger">*</span> Soyadınız</label>
                                        <input placeholder="Soyadınız" type="text"  name="surname" value="{{old('surname')}}"  >
                                        <span class="text-danger">
                                    @error('surname')
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
                                            Antalya Bilim Üniversitesi Sürekli Eğitim Merkezi faaliyetleriyle ilgili olarak 6563 Sayılı Elektronik Ticaretin Düzenlenmesi Hakkında Kanun
                                            uyarınca tarafıma elektronik ileti  gönderilmesine onay veriyorum.<br/><u>Elektronik İleti Gönderiminin Onaylanmaması Durumunda İletişime Geçilemeyecektir.</u>
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
                                    <button type="submit">Ön Başvuru Yap <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
