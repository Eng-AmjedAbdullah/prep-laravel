@extends('layouts.app')
@section('content')
<section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 text-center">
        <h2> <span>PrepPal</span> - Your Interactive Guide to Emergency Preparedness</h2>
        <p>Embark on a journey of learning and readiness with PrepPal, where we transform emergency preparedness into an engaging experience for all ages. Our platform, powered by advanced AI and Laravel technology, offers interactive scenarios, personalized guidance, and inclusive features to ensure everyone is equipped to handle emergencies with confidence.</p>
        <a href="{{ route('login') }}" class="btn-get-started">Join the PrepPal Community</a>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->
<main id="main" data-aos="fade" data-aos-delay="1500">
  <!-- ======= Gallery Section ======= -->
  <section id="gallery" class="gallery">

  </section><!-- End Gallery Section -->
</main><!-- End #main -->
@endsection
