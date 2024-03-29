<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cosmekarn</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/img/favicon.png') }}">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/bootstrap.min.css') }}">
    <!-- Pe-icon-7-stroke CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/pe-icon-7-stroke.css') }}">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/font-awesome.min.css') }}">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/slick.min.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/animate.css') }}">
    <!-- Nice Select css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/nice-select.css') }}">
    <!-- jquery UI css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/jqueryui.min.css') }}">
    <!-- main style css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <link rel="stylesheet" href="{{ asset('plugins/star-rating-svg.css') }}" />

    <link href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

</head>


<style>
    .alert-success-cosmekarn{
        color: #E41F85;
        background-color: #FFEEFA;
        border-color: #E85BAC;
    }

    .btn-attribute {
        height: 40px;
        color: #000;
        line-height: 40px;
        border-radius: 50px;
        padding: 0 25px;
        background-color: #E0E0E0;
        margin-right: 5px;
        opacity: 0.5;
    }
    .btn-attribute:hover{
        transition: 0.3s;
        opacity: 1;
    }

    .selected-attribute{
        opacity: 1;
        border: #6e6e6e solid 1px;
    }


</style>
<body>
    <!-- Start Header Area -->
    <header class="header-area header-wide">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <div class="header-top bdr-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="welcome-message text-center">
                                <p><b style="color: #E41F85">Black Friday 2022</b> : promos de folie jusqu'à <b style="color: #E41F85">-60%</b> - Cosmekarn</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- header top end -->

            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a style="cursor: pointer">
                                   <a href="{{asset('/')}}"> <img style="max-width: 70%;" src="{{ asset('front/assets/img/logo/logo-cosmekarn.png') }}" alt="cosmekarn Logo"></a>
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-6 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li><a href="{{ asset('/') }}">Accueil</a></li>
                                            @foreach($categories as $category)
                                                <li><a href="{{ asset('category-parent-products/'.$category->id) }}">{{ $category->designation }} <i class="fa fa-angle-down"></i></a>
                                                    <ul class="dropdown">
                                                        @foreach($category->childCategories as $childCategory)
                                                        <li><a href="{{ asset('category-products/'.$childCategory->id) }}">{{ $childCategory->designation }}</a></li>
                                                    @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                            <li><a href="{{ asset('/tracking') }}"> Tracking </a></li>
                                            <li><a href="{{ asset('/about') }}"> Qui sommes-nous ? </a></li>

                                            <li><a href="{{ asset('/contact') }}">Contact</a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                                <div class="header-search-container">
                                    <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                    <form class="header-search-box d-lg-none d-xl-block"action="/search" method="GET" role="search">
                                        <input type="text" placeholder="Je cherche sur..." class="header-search-field" name="search">
                                        <button class="header-search-btn" type="submit"><i class="pe-7s-search"></i></button>
                                    </form>
                                </div>
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <li class="user-hover">
                                            @auth
                                                <a href="#">
                                                    <i style="color: #E41F85" class="pe-7s-user"></i>
                                                </a>
                                                <ul class="dropdown-list">
                                                    <li style="color: #E41F85; margin-bottom:10px;" >Hi ! {{strtok(Auth::user()->name, " ")}}</li>
                                                    @if(Auth::user()->type == 'customer')
                                                    <li><a href="{{asset('/customer')}}" style="cursor: pointer">Dashboard</a></li>
                                                    @else
                                                    <li><a href="{{asset('/admin')}}" style="cursor: pointer">Dashboard</a></li>
                                                    @endif
                                                    <li>
                                                        <a style="cursor: pointer" href="{{route('logout')}}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                            <span class="ml-2">Déconnexion </span>
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                        </a>
                                                    </li>
                                                </ul>
                                            @endauth

                                            @guest
                                                <a href="#">
                                                    <i class="pe-7s-user"></i>
                                                </a>
                                                <ul class="dropdown-list">
                                                    <li><a href="{{asset('/login-register')}}" style="cursor: pointer">Connexion</a></li>
                                                </ul>

                                            @endauth

                                        </li>
                                        <li>
                                            <a href="{{ asset('/favorite') }}">
                                                <i class="pe-7s-like"></i>
                                                <div class="notification nbr_product_favorite">{{ $nbr_favoritelines }}</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a style="cursor: pointer" class="minicart-btn">
                                                <i class="pe-7s-shopbag"></i>
                                                <div class="notification nbr_product">{{$nbr_cartitem}}</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->

                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->

        <!-- mobile header start -->
        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="{{ asset('/') }}">
                                    <img src="{{ asset('front/assets/img/logo/logo.pn') }}g" alt="Brand Logo">
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <div class="mini-cart-wrap">
                                    <a href="{{ asset('/carts') }}">
                                        <i class="pe-7s-shopbag"></i>
                                        <div class="notification nbr_product">{{$nbr_cartitem}}</div>
                                    </a>
                                </div>
                                <button class="mobile-menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
        <!-- mobile header end -->

        <!-- offcanvas mobile menu start -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="pe-7s-close"></i>
                </div>

                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box-offcanvas">
                        <form action="/search" method="GET" role="search">
                            <input type="text" placeholder="Je cherche sur..." name="search">
                            <button type="submit" class="search-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->

                    <!-- mobile menu start -->
                    <div class="mobile-navigation">

                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><a href="{{ asset('/') }}">Accueil</a></li>
                                <li class="menu-item-has-children"><a href="#">Catégories</a>
                                    <ul class="megamenu dropdown">
                                        @foreach($categories as $category)
                                        @if($category->childCategories)
                                            <li class="mega-title menu-item-has-children"><a href="#">{{ $category->designation }}</a>
                                                <ul class="dropdown">
                                                    @foreach($category->childCategories as $childCategory)
                                                    <li><a href="{{ asset('category-products/'.$childCategory->id) }}">{{ $childCategory->designation }}</a></li>
                                                   @endforeach
                                                </ul>
                                            </li>
                                        @else
                                        <li class="mega-title menu-item-has-children"><a href="{{ asset('category-products/'.$category->id) }}">{{ $category->designation }}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>

                                <li><a href="{{ asset('/about') }}">Qui sommes-nous ?</a></li>
                                <li><a href="{{ asset('/contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->

                    <div class="mobile-settings">
                        <ul class="nav">
                           <li>
                                <div class="dropdown mobile-top-dropdown">
                                    <a href="#" class="dropdown-toggle" id="myaccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Mon compte
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    @auth
                                    <div class="dropdown-menu" aria-labelledby="myaccount">

                                        <a class="dropdown-item" style="cursor: pointer"> Hi ! {{strtok(Auth::user()->name, " ")}}</a>
                                        <a class="dropdown-item"href="{{asset('/customer')}}" >Dashboard</a>
                                        <a class="dropdown-item" style="cursor: pointer" href="{{route('logout')}}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <span class="ml-2">Déconnexion </span>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                            </form>
                                        </a>
                                    </div>
                                    @endauth
                                    @guest
                                    <a class="dropdown-item"href="{{asset('/login-register')}}" >Connexion</a>
                                    @endguest
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- offcanvas widget area start -->
                    <div class="offcanvas-widget-area">
                        <div class="off-canvas-contact-widget">
                            <ul>
                                <li><i class="fa fa-mobile"></i>
                                    <a style="cursor: pointer">05 61 93 42 66 / 05 55 52 94 44</a>
                                </li>
                                <li><i class="fa fa-envelope-o"></i>
                                    <a style="cursor: pointer">Service.client@cosmekarn.dz</a>
                                </li>
                            </ul>
                        </div>
                        <div class="off-canvas-social-widget">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                    <!-- offcanvas widget area end -->
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- offcanvas mobile menu end -->
    </header>
    <!-- end Header Area -->
    @yield('content')

    <!-- footer area start -->
    <footer class="footer-widget-area">
        <div class="footer-top section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <div class="widget-title">
                                <div class="widget-logo">
                                    <a style="cursor: pointer">
                                        <img src="{{ asset('front/assets/img/logo/logo.png') }}" alt="brand logo">
                                    </a>
                                </div>
                            </div>
                            <div class="widget-body">
                                <p>Producteur, Importateur et distributeur exclusif pour l'Algérie de produits cosmétiques & d'hygiene corporelle.
                                     </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Service client</h6>
                            <div class="widget-body">
                                <address class="contact-block">
                                    <ul>
                                        <li><i class="pe-7s-home"></i> Annexe Communal EL BADR, Oran Algérie</li>
                                        <li><i class="pe-7s-mail"></i> <a style="cursor: pointer">Service.client@cosmekarn.dz </a></li>
                                        <li><i class="pe-7s-call"></i> <a style="cursor: pointer">0561 934 266 / 0555 529 444</a></li>
                                    </ul>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Informations</h6>
                            <div class="widget-body">
                                <ul class="info-list">
                                    <li><a style="cursor: pointer">Livraison & Points Relais</a></li>
                                    <li><a style="cursor: pointer">Espace Pro</a></li>
                                    <li><a style="cursor: pointer">Conditions Générales de Ventes</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Suivez-nous</h6>
                            <div class="widget-body social-link">
                                <a style="cursor: pointer"><i class="fa fa-facebook"></i></a>
                                <a style="cursor: pointer"><i class="fa fa-instagram"></i></a>
                                <a style="cursor: pointer"><i class="fa fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-20">
                    <div class="col-md-6">
                        <div class="newsletter-wrapper">
                            <h6 class="widget-title-text">Newsletter</h6>
                            <form class="newsletter-inner" id="mc-form">
                                <input type="email" class="news-field" id="email" autocomplete="off" placeholder="Taper votre email" required>
                                <button class="news-btn btn-newsletter" id="mc-submit">Envoyer</button>
                            </form>
                            <!-- mail-chimp-alerts Start -->
                            <div class="mailchimp-alerts">
                                <div class="mailchimp-submitting"></div><!-- mail-chimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mail-chimp-success end -->
                                <div class="mailchimp-error"></div><!-- mail-chimp-error end -->
                            </div>
                            <!-- mail-chimp-alerts end -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copyright-text text-center">
                            <p>&copy; 2022 <b style="color: #E41F85">Cosmekarn</b> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->
    <!-- offcanvas mini cart start -->
    <div class="offcanvas-minicart-wrapper">
        <div class="minicart-inner">
            <div class="offcanvas-overlay"></div>
            <div class="minicart-inner-content">
                <div class="minicart-close">
                    <i class="pe-7s-close"></i>
                </div>
                @if($cartitems)
                <div class="minicart-content-box">
                    <div class="minicart-item-wrapper">
                        <ul class="cart-list">

                                @foreach($cartitems as $cartitem)
                                <li class="minicart-item" id="list-{{$cartitem->id}}">
                                    <div class="minicart-thumb">
                                        <a href="{{ asset('product/'.$cartitem->productline->product->slug) }}">
                                            <img src="{{asset('storage/images/products/'.$cartitem->productline->product->images[0]->lien)}}" alt="product">
                                        </a>
                                    </div>
                                    <div class="minicart-content">
                                        <h3 class="product-name">
                                            <a href="{{ asset('product/'.$cartitem->productline->product->slug) }}">{{ $cartitem->productline->product->designation }}</a>
                                        </h3>
                                        <p>
                                            <span class="cart-quantity">{{ $cartitem->qte }} <strong>&times;</strong></span>
                                            <span class="cart-price">{{ number_format($cartitem->price) }} Da</span>
                                        </p>
                                    </div>
                                    <button class="delete-item-list" data-id="{{$cartitem->id}}"><i class="pe-7s-close"></i></button>
                                </li>
                                @endforeach

                        </ul>
                    </div>

                        <div class="minicart-pricing-box">
                            <ul>
                                <li >
                                    <span>total</span>
                                    <span class="total"><strong>{{ number_format($total->sum) }} Da</strong></span>
                                </li>
                            </ul>
                        </div>

                        <div class="minicart-button">
                            <a href="{{ asset('/carts') }}"><i class="fa fa-shopping-cart"></i> Voir le panier</a>
                        </div>

                </div>
                @endif

            </div>
        </div>
    </div>
    <!-- offcanvas mini cart end -->

    <!-- JS
============================================ -->

    <!-- Modernizer JS -->
    <script src="{{ asset('front/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <!-- jQuery JS -->
    <script src="{{ asset('front/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('front/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <!-- slick Slider JS -->
    <script src="{{ asset('front/assets/js/plugins/slick.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('front/assets/js/plugins/countdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('front/assets/js/plugins/nice-select.min.js') }}"></script>
    <!-- jquery UI JS -->
    <script src="{{ asset('front/assets/js/plugins/jqueryui.min.js') }}"></script>
    <!-- Image zoom JS -->
    <script src="{{ asset('front/assets/js/plugins/image-zoom.min.js') }}"></script>
    <!-- Images loaded JS -->
    <script src="{{ asset('front/assets/js/plugins/imagesloaded.pkgd.min.js') }}"></script>
    <!-- mail-chimp active js -->
    <script src="{{ asset('front/assets/js/plugins/ajaxchimp.js') }}"></script>
    <!-- contact form dynamic js -->
    <script src="{{ asset('front/assets/js/plugins/ajax-mail.js') }}"></script>
    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
    <!-- google map active js -->
    <script src="{{ asset('front/assets/js/plugins/google-map.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('front/assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"></script>
    <script type="text/javascript" src="{{ asset('plugins/jquery.star-rating-svg.js') }}"></script>
	<script>

		$(document).ready( function () {
         $('#myTable').DataTable({
				language: {
						url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
					}
			});

         });
         $(".my-rating").starRating({
			starSize: 25,
			initialRating: 3.5,
		});

		let rate =$('#rate-result').val();

		$(".rating-result").starRating({
			starSize: 25,
			initialRating: rate,
            readOnly: true
		});
    </script>

    <script>
        $( ".delete-item-list" ).click(function() {
            var id = $(this).attr("data-id");

            var item = $('#list-'+id).val();
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: '/carts/'+id ,
                type: 'DELETE',
                data: {
                "id": id,
                "_token": token,
            },
                success: function (res) {
                    $("#list-"+id).css("display", "none");
                    $(".nbr_product").text(res.nbr_cartitem);
                    $(".total").text(res.total +' Da');


                 }
            });
    });
    </script>

<script>
    $( ".btn-newsletter" ).click(function(e) {

        e.preventDefault();
        let email = $('#email').val();

        $.ajax({
              type:"Post",
              url: '/newsletter',
              data:{
                "_token": "{{ csrf_token() }}",
                email:email,
              },
              success:function(response){
                if(response == true){
                    toastr.success('Inscription réussite!  Vous allez reçevoir toutes nos actualités');
                }
                else{
                    toastr.error('Echec Inscription! Ce email existe déja');
                }
              },

              });
    });

</script>
<script>
    function togglePassword(id, icon) {
        const passwordInput = document.getElementById(id);
        const iconClassList = icon.classList;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            iconClassList.remove('fa-eye-slash');
            iconClassList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            iconClassList.remove('fa-eye');
            iconClassList.add('fa-eye-slash');
        }
    }
</script>
@stack('select-icon-script')
@stack('select-icon-indice')
@stack('add-cart-scripts')
@stack('modal-detail-product-show')
@stack('delete-item')
@stack('shipping-script')
@stack('contact-scripts')
@stack('comment-scripts')
@stack('add-favorite-scripts')
</body>

</html>
