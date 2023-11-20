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
                                <li class="breadcrumb-item active" aria-current="page">Connexion-Inscription</li>
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
                <div class="row">
                    <!-- Login Content Start -->
                    @if($visited_carts_page)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Vous devez vous connecter d'abord pour continuer vos achats !
                        </div>
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                    <div class="col-lg-6">
                        <div class="login-reg-form-wrap">
                            <h5>Connexion</h5>
                            <form action="{{ route('login') }}" method="post">
                            @csrf
                                <div class="single-input-item">
                                    <input type="email" name="email" placeholder="Email" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="password" name="password" placeholder="Mot de passe" required />
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <div class="remember-meta">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                <label class="custom-control-label" for="rememberMe">Se souvenir de moi</label>
                                            </div>
                                        </div>
                                        <a href="#" class="forget-pwd">mot de passe oublié?</a>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Se connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->

                    <!-- Register Content Start -->
                    <div class="col-lg-6">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h5>Inscription</h5>
                            <form action="{{ route('register') }}" method="post">
                            @csrf
                                <div class="single-input-item">
                                    <input name="name" type="text" placeholder="Nom complet" required/>
                                </div>
                                <div class="single-input-item">
                                    <input name="phone" type="text" placeholder="N° téléphone" required />
                                </div>
                                <div class="single-input-item">
                                    <input  name="email" type="email" placeholder="Email" required />
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="password" name="password" placeholder="mot de passe" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="password" name="password_confirmation" placeholder="Retaper le mot de passe" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta">
                                        <div class="remember-meta">
                                        </div>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">S'inscrire</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Register Content End -->
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

