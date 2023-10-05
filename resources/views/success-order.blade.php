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
                                <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container">
            <div class="member-area-from-wrap">
                <div class="row ">
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="alert alert-success-cosmekarn text-center"   role="alert">
                           <p class="mt-3" style="font-size: 15px;"> Votre commande a bien été prise en compte,
                            nous vous remercions pour votre commande. </p>
                            <a  href="{{url('/')}}" type="button" style="margin-top:20px;" class="btn btn-cart2">Page d'acceuil</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->


@endsection

