@extends('login/main')

@section('container')

<div class="content">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
            <div class="col-md-lg content d-flex align-items-stretch">
                <div class="form-block">
                    {{-- <div class="mb-4"> --}}
                    <h3>Masuk ke <strong>Difeeding</strong></h3>
                    {{-- </div> --}}
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="card-body">
                            @if(session('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for=""><strong>Email</strong></label>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Password</strong></label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-pill text-white btn-block btn-primary">Masuk</button>
                        </div>

                        <div class="text-center p-t-57 p-b-20">
                            <span class="txt1">
                                Atau masuk dengan
                            </span>
                        </div>

                        <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-md-sm">
                                <a href="{{ route('login.facebook') }}" class="">
                                    <img src="assets/login/images/icon-facebook.png" alt="FACEBOOK"
                                    style="width: 50px; height: auto; float:left; margin-right: 7px;">
                                </a>
                              </div>
                              <div class="col-md-sm">
                                <a href="{{ route('login.google') }}" class="">
                                    <img src="assets/login/images/icon-google.png" alt="GOOGLE"
                                    style="width: 50px; height: auto; float:left; margin-right: 7px;">
                                    </a>
                              </div>
                            </div>
                        </div>
                        <p class="text-center">Belum punya akun? <a href="{{ route('register') }}">Daftar</a> sekarang!</p>

                    </form>
            </div>
        </div>
    </div>
</div>
    
@endsection