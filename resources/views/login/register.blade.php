@extends('login/main')

@section('container')

<div class="content">
<div class="container" data-aos="fade-up">
  <div class="row justify-content-center">
  <div class="col-md-6 content">
      <div class="form-block">
        <div class="mb-4">
          <h3>Daftar ke <strong>AutoFeed</strong></h3>
        </div>
          <form action="{{ route('register') }}" method="post">
          @csrf
          <div class="card-body">
              @if(session('errors'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                  </div>
              @endif
              <div class="form-group">
                  <label for=""><strong>Nama Lengkap</strong></label>
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nama Lengkap">
              </div>
              <div class="form-group">
                  <label for=""><strong>Email</strong></label>
                  <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
              </div>
              <div class="form-group">
                  <label for=""><strong>Password</strong></label>
                  <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-group">
                  <label for=""><strong>Konfirmasi Password</strong></label>
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
              </div>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-pill text-white btn-block btn-primary">Register</button>
              <br>
              <p class="text-center">Sudah punya akun? <a href="{{ route('login') }}">Login</a> sekarang!</p>
          </div>
          </form>
      </div>
  </div>
</div>
</div>
</div>
    
@endsection