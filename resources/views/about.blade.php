@extends('layouts.front')
@section('content')

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Qui sommes-nous</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- about us area start -->
    <section class="about-us section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="about-thumb">
                        <img src="{{ asset('front/assets/img/about/about.png') }}" alt="about thumb">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="about-content">
                        <h2 class="about-title">BOUTIQUE DE COSMÉTIQUES EN LIGNE</h2>
                        <h5 class="about-sub-title">
                            Expert en cosmétiques depuis l'année 2000.
                        </h5>
                        <p>Cosmekarn est votre boutique de cosmétiques et beauté en Algérie proposant des produits européens au meilleur prix car nous sommes importateur et distributeur exclusif de toutes les marques du site, donc garanti produits 100% originaux et prix bas !
                            Livraison 58 Wilayas.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us area end -->




    <!-- testimonial area end -->

    <!-- team area start -->

    <!-- team area end -->
</main>
@endsection
