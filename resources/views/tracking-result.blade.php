@extends('layouts.front')
@section('content')


<style>
    .bg-cosmekarn {
  background-color: #E41F85 !important;
    }
</style>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Suivi de la commande </li>
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
            @if(!$response_array)

                <div class="member-area-from-wrap">
                    <div class="row d-flex justify-content-center">
                        <!-- Login Content Start -->
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap">
                                <h5 style="color: #E41F85">{{$code}}</h5>
                                <p>Aucune donnée pour ce code de suivi !</p>
                            </div>
                        </div>
                    </div>

                </div>
            @else

            <div class="member-area-from-wrap">
                <div class="row d-flex justify-content-center">
                    <!-- Login Content Start -->
                    <div class="col-lg-6">
                        <div class="login-reg-form-wrap">
                            <h5 style="color: #E41F85">{{$code}}</h5>
                        </div>
                    </div>
                </div>

                @foreach($response_array as $response)
                    <div class="row d-flex justify-content-center mt-2">
                        <!-- Login Content Start -->
                        <div class="col-lg-6" >
                            <div class="login-reg-form-wrap">
                                <h5> {{$response['commune_name']}} </h5> <span class="badge bg-cosmekarn ">{{$response['status']}}</span>
                                <p>Date : <b>{{$response['date_status']}}</b> </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            @endif
        </div>
    </div>

</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->


@endsection

