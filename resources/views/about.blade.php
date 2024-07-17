@extends('main.app')
@section('title','About')
@section('page-title','Profile')
@section('content')
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Arsip</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
</nav>

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{ asset('img/Foto ijazah.jpg') }}" alt="Profile" class="rounded-circle">
                    <h2 class="text-center">Deatrisya Mirela Harahap</h2>
                    <h3>Web Developer</h3>
                    <div class="social-links mt-2">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">About</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Aplikasi ini dibuat oleh : </h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama</div>
                                <div class="col-lg-9 col-md-8">Deatrisya Mirela Harahap</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Prodi</div>
                                <div class="col-lg-9 col-md-8">D-IV Teknik Informatika</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">NIM</div>
                                <div class="col-lg-9 col-md-8">2041720013</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tanggal</div>
                                <div class="col-lg-9 col-md-8">10 Juli 2024</div>
                            </div>



                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
