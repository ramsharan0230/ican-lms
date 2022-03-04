@extends('account.layout.master-layout')
@section('title', 'Register')

@section('content')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="card mb-3">
            <div class="card-body">
                <img src="{{ asset('assets/images/login_banner.jpg')}}" class="img-responsive logo_login">
                <div class="container" style="margin:30px;">
                    {{-- @include('flash-messages.partial_flash_alert_message') --}}
                    <h2>ICAN Terms and Conditions</h2>
                {!! $term->description !!}
                    <form method="POST" action="{{ route('auth.terms.accept') }}">
                        {{ csrf_field() }}
                        <input class="btn btn-primary" type="submit" value="I AGREE"/>
                    </form>
                    
                </div>
            </div>
          </div>

          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>

        </div>
      </div>
    </div>

  </section>
@endsection
    