@extends('layout/main')

@section('container')

<section></section>

<section id="featured-services" class="featured-services">
    <div class="container" data-aos="fade-up">
  
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box1" data-aos="fade-up" data-aos-delay="100">
            <h4 class="title"><a>Form Edit Profile</a></h4>
            
            <form action="{{ url('/edit_profile/'.$users->id) }}" method="post">
            @method('patch')
            @csrf
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row">Nama</th>
                  <td><input class="form-control" type="text" name="jumlah_tbr" value="{{ $users->name }}" placeholder="Isi berupa angka"></td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                  <td colspan="2"><input class="form-control" type="text" name="jumlah_tbr" value="{{ $users->email }}" placeholder="Isi berupa angka"></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="form-group text-center">
                        <input class="btn btn-outline-dark" type="submit" value="Ubah Data">
                    </div>
                </td>
                </tr>
                
            </table>
        </form>
  
          </div>
        </div>
    </div>
  </section>
  </div>
  </div>
  </div>
  </section><!-- End Contact Section -->

 
@endsection