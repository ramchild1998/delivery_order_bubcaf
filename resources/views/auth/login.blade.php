@extends('layouts.app_simple')

@section('content')
<!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden">
  <style>
        @media only screen and (max-width: 600px) {
            .logo-ats{
                position:absolute;
                left: 0;
                bottom:83%;
        }
        
    }
    .logo-ats{
        max-width:40%;
        height:auto;
        margin-bottom: 2rem;
        margin-left : 30%;
    }

    .form-control{
        border-radius: 1rem;
        padding: 1rem;
        border : solid #00000009 2px;
        font-weight:500;
    }

    .test{
        background-color: #16151503;
        border : solid #00000008 2px;
        border-radius:2rem;
        box-shadow: 10px 10px 4px #16151508;
    }

    .bg-glass {
        border-left: 2px solid #00000009;
    }

    .btn-test{
        background-color: #03C0D0;
        color: #fff;
        width:100%;
        padding: 0.8rem;
        border-radius: 2rem;
        border: none;
        font-weight:bold;
    }

  </style>

  <div class="container test px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="text-align:center; color:#1F41BB">
          Welcome! <br />
          <span style="color:#03C0D0">Administrator</span>
        </h1>
      </div>
      <div class="  col-lg-6 mb-5 mb-lg-0 position-relative">
        <div class=" bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
          <div class="row mb-3">
                <div class="col-md-12">
                    <img class="logo-ats" src="{{ asset('images/logoats-removebg-preview.png') }}" alt="description of myimage">
                 </div>
          <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="row mb-3">
                        <div class="col-md-12">
                            <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-test">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
@endsection
