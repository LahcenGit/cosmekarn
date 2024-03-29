@extends('layouts.front')
@section('content')

<style>
    .banner-text3 a {
        background-color: #60348B;
        color: white!important;
        padding: 10px;
        font-weight: 200;
    }
</style>

<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
        <!-- single slider item start -->
            @foreach($sliders as $slider)
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="{{ asset('storage/uploads/sliders/'.$slider->image) }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @if($slider->text == 0)
                                    <div class="hero-slider-content slide-3">
                                    @else
                                    <div class="hero-slider-content slide-2 float-md-end float-none pl-4">
                                    @endif
                                    <h2 class="slide-title">{{ $slider->title }}</h2>
                                    <h4 class="slide-desc">{{ $slider->description }}</h4>
                                    <a style="cursor: pointer" class="btn btn-hero">{{ $slider->button_value }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- single slider item end -->
        </div>
    </section>
    <!-- hero slider area end -->



    <!-- service policy area start -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Livraison gratuite</h6>
                            <p>En point relais</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Service Client</h6>
                            <p>7j/7j</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-star"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Produits certifiés</h6>
                            <p>100% originaux</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>100% Paiement sécurisé</h6>
                            <p>CIB & Edahabia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->

    <!-- banner statistics area start -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a style="cursor: pointer">
                            <img src="{{ asset('front/assets/img/banner/img1-top.jpg') }}" alt="product banner">
                        </a>
                        <div class="banner-content text-right">
                            <h5 class="banner-text1">Eclipse</h5>
                            <h2 class="banner-text2">FOND <span>DE TEINT</span></h2>
                            <a href= "{{ asset('/category-products/2') }}" class="btn btn-text">Acheter</a>
                        </div>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a style="cursor: pointer">
                            <img src="{{ asset('front/assets/img/banner/img2-top.jpg') }}" alt="product banner">
                        </a>
                        <div class="banner-content text-center">
                            <h5 class="banner-text1">SCHWARZKOPF</h5>
                            <h2 class="banner-text2">Crème<span>à nuancer</span></h2>
                            <a href= "{{ asset('/category-products/2') }}" class="btn btn-text">Acheter</a>
                        </div>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a style="cursor: pointer">
                            <img src="{{ asset('front/assets/img/banner/img3-top.jpg') }}" alt="product banner">
                        </a>
                        <div class="banner-content text-center">
                            <h5 class="banner-text1">EVOLUDERM</h5>
                            <h2 class="banner-text2">Gèl<span>Douche</span></h2>
                            <a href= "{{ asset('/category-products/10') }}" class="btn btn-text">Acheter</a>
                        </div>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a style="cursor: pointer">
                            <img src="{{ asset('front/assets/img/banner/img4-top.jpg') }}" alt="product banner">
                        </a>
                        <div class="banner-content text-right">
                            <h5 class="banner-text1">UDV</h5>
                            <h2 class="banner-text2">Coffret<span>UDV Star</span></h2>
                            <a href= "{{ asset('/category-products/3') }}" class="btn btn-text">Acheter</a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- banner statistics area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Nos produits</h2>
                        <p class="sub-title">Une variété de produits qui vous attend !</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">
                        <!-- product tab menu start -->
                        <div class="product-tab-menu">
                            <ul class="nav justify-content-center">
                                <li><a href="#tab1" class="active" data-bs-toggle="tab">Maquillage</a></li>
                                <li><a href="#tab2" data-bs-toggle="tab">Corps & Bain </a></li>
                                <li><a href="#tab3" data-bs-toggle="tab">Cheveux</a></li>
                                <li><a href="#tab4" data-bs-toggle="tab">Parfum</a></li>
                            </ul>
                        </div>
                        <!-- product tab menu end -->

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    @foreach($products as $product)
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="{{ asset('product/'.$product->slug) }}">
                                                    @if(optional($product->images->first())->lien)
                                                        <img class="pri-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                        <img class="sec-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                    @else
                                                        <img class="pri-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                        <img class="sec-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                    @endif
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    @if($product->productlines[0]->promo_price)
                                                        <div class="product-label discount">
                                                            <span>{{ number_format((($product->productlines[0]->price - $product->productlines[0]->promo_price) / $product->productlines[0]->price) * 100) }}%</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="cart-hover">
                                                    <a href="{{ asset('product/'.$product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                @if($product->mark)
                                                    <div class="product-identity">
                                                        <p class="manufacturer-name"><a href="{{ asset('product/'.$product->slug) }}">{{ $product->mark->designation }}</a></p>
                                                    </div>
                                                @endif
                                                <ul class="color-categories">
                                                    @foreach($product->productlines as $item)
                                                        @if($item->attribute_id)
                                                             @if($item->attribute_icone)
                                                                <li>
                                                                    <a  width="30px" height="30px"  style="cursor: pointer" title="{{$item->attributeLine->value}}"><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone) }}" alt="" /></a>
                                                                </li>
                                                            @else

                                                            @endif

                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <h6 class="product-name">
                                                    <a href="{{ asset('product/'.$product->slug) }}">{{ $product->designation }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    @if($product->getPricePromo())
                                                    <span class="price-regular">{{number_format($product->getPricePromo())}} Da</span>
                                                    <span class="price-old"><del>{{number_format($product->getPrice())}} Da</del></span>
                                                    @else
                                                    <span class="price-regular">{{number_format($product->getPrice())}} Da</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <!-- product item end -->

                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    @foreach($products as $product)
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="{{ asset('product/'.$product->slug) }}">
                                                    @if(optional($product->images->first())->lien)
                                                        <img class="pri-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                        <img class="sec-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                    @else
                                                        <img class="pri-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                        <img class="sec-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                    @endif
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    <div class="product-label discount">
                                                        <span>10%</span>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    <a style="cursor: pointer" data-bs-toggle="tooltip" data-bs-placement="left" title="Ajouter au favoris"><i class="pe-7s-like"></i></a>


                                                </div>
                                                <div class="cart-hover">
                                                    <a href="{{ asset('product/'.$product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                @if($product->mark)
                                                    <div class="product-identity">
                                                        <p class="manufacturer-name"><a href="{{ asset('product/'.$product->slug) }}">{{ $product->mark->designation }}</a></p>
                                                    </div>
                                                @endif
                                                <ul class="color-categories">
                                                    @foreach($product->productlines as $item)
                                                        @if($item->attribute_id)
                                                            <li>
                                                                <a  style="cursor: pointer" title="{{$item->attributeLine->value}}"><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone) }}" alt="" /></a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <h6 class="product-name">
                                                    <a href="{{ asset('product/'.$product->slug) }}">{{ $product->designation }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    @if($product->getPricePromo())
                                                    <span class="price-regular">{{number_format($product->getPricePromo())}} Da</span>
                                                    <span class="price-old"><del>{{number_format($product->getPrice())}} Da</del></span>
                                                    @else
                                                    <span class="price-regular">{{number_format($product->getPrice())}} Da</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <!-- product item end -->
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab3">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    @foreach($products as $product)
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="{{ asset('product/'.$product->slug) }}">
                                                    @if(optional($product->images->first())->lien)
                                                        <img class="pri-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                        <img class="sec-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                    @else
                                                        <img class="pri-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                        <img class="sec-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                    @endif
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    @if($product->productlines[0]->promo_price)
                                                        <div class="product-label discount">
                                                            <span>{{ number_format((($product->productlines[0]->price - $product->productlines[0]->promo_price) / $product->productlines[0]->price) * 100) }}%</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="cart-hover">
                                                    <a href="{{ asset('product/'.$product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                @if($product->mark)
                                                    <div class="product-identity">
                                                        <p class="manufacturer-name"><a href="{{ asset('product/'.$product->slug) }}">{{ $product->mark->designation }}</a></p>
                                                    </div>
                                                @endif
                                                <ul class="color-categories">
                                                    @foreach($product->productlines as $item)
                                                        @if($item->attribute_id)
                                                            <li>
                                                                <a style="cursor: pointer" title="{{$item->attributeLine->value}}"><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone) }}" alt="" /></a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <h6 class="product-name">
                                                    <a href="{{ asset('product/'.$product->slug) }}">{{ $product->designation }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    @if($product->getPricePromo())
                                                    <span class="price-regular">{{number_format($product->getPricePromo())}} Da</span>
                                                    <span class="price-old"><del>{{number_format($product->getPrice())}} Da</del></span>
                                                    @else
                                                    <span class="price-regular">{{number_format($product->getPrice())}} Da</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <!-- product item end -->
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab4">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    @foreach($products as $product)
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="{{ asset('product/'.$product->slug) }}">
                                                    @if(optional($product->images->first())->lien)
                                                        <img class="pri-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                        <img class="sec-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                    @else
                                                        <img class="pri-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                        <img class="sec-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                    @endif
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    @if($product->productlines[0]->promo_price)
                                                        <div class="product-label discount">
                                                            <span>{{ number_format((($product->productlines[0]->price - $product->productlines[0]->promo_price) / $product->productlines[0]->price) * 100) }}%</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="cart-hover">
                                                    <a href="{{ asset('product/'.$product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                @if($product->mark)
                                                    <div class="product-identity">
                                                        <p class="manufacturer-name"><a href="{{ asset('product/'.$product->slug) }}">{{ $product->mark->designation }}</a></p>
                                                    </div>
                                                @endif
                                                <ul class="color-categories">
                                                    @foreach($product->productlines as $item)
                                                        @if($item->attribute_id)
                                                            <li>
                                                                <a  style="cursor: pointer" title="{{$item->attributeLine->value}}"><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone) }}" alt="" /></a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <h6 class="product-name">
                                                    <a href="{{ asset('product/'.$product->slug) }}">{{ $product->designation }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    @if($product->getPricePromo())
                                                    <span class="price-regular">{{number_format($product->getPricePromo())}} Da</span>
                                                    <span class="price-old"><del>{{number_format($product->getPrice())}} Da</del></span>
                                                    @else
                                                    <span class="price-regular">{{number_format($product->getPrice())}} Da</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <!-- product item end -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->
    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Promotion</h2>
                        <p class="sub-title">Une variété de packs promotionnels vous attend !</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">


                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    @foreach($promopacks as $promopack)
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="{{ asset('product/'.$promopack->product->slug) }}">
                                                    @if(optional($promopack->product->images->first())->lien)
                                                        <img class="pri-img" src="{{asset('storage/images/products/'.$promopack->product->images[0]->lien)}}" alt="product">
                                                        <img class="sec-img" src="{{asset('storage/images/products/'.$promopack->product->images[0]->lien)}}" alt="product">
                                                    @else
                                                        <img class="pri-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                        <img class="sec-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                                    @endif
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    @if($promopack->price_promo)
                                                        <div class="product-label discount">
                                                            <span>{{ number_format((($promopack->price - $promopack->price_promo) / $promopack->price) * 100) }}%</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="cart-hover">
                                                    <a href="{{ asset('product/'.$promopack->product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">

                                                <h6 class="product-name">
                                                    <a href="{{ asset('product/'.$promopack->product->slug) }}">{{ $promopack->designation }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    @if($promopack->price_promo)
                                                    <span class="price-regular">{{number_format($promopack->price_promo)}} Da</span>
                                                    <span class="price-old"><del>{{number_format($promopack->price)}} Da</del></span>
                                                    @else
                                                    <span class="price-regular">{{number_format($promopack->price)}} Da</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <!-- product item end -->

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- product banner statistics area start -->
    <section class="product-banner-statistics">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="product-banner-carousel slick-row-10">
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a style="cursor: pointer">
                                    <img src="{{ asset('images/img1.png') }}" alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href="{{ asset('/category-products/1') }}">Maquillage</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a style="cursor: pointer">
                                    <img src="{{ asset('images/img2.png') }}" alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href="{{ asset('/category-products/7') }}">Cheveux</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a style="cursor: pointer">
                                    <img src="{{ asset('images/img3.png') }}" alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href= "{{ asset('/category-products/3') }}">Parfums</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a style="cursor: pointer">
                                    <img src="{{ asset('images/img4.png') }}" alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a style="cursor: pointer">Homme</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        <!-- banner single slide start -->

                        <!-- banner single slide start -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product banner statistics area end -->

    <!-- featured product area start -->
    <section class="feature-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">produits populaires</h2>
                        <p class="sub-title">Une variété de produits qui vous attend !</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                        @foreach($random_popular_products as $random_popular_product)
                        <div class="product-item">
                            <figure class="product-thumb">
                                <a href="{{ asset('product/'.$random_popular_product->slug) }}">
                                    @if(optional($random_popular_product->images->first())->lien)
                                    <img class="pri-img" src="{{asset('storage/images/products/'.$random_popular_product->images[0]->lien)}}" alt="product">
                                    <img class="sec-img" src="{{asset('storage/images/products/'.$random_popular_product->images[0]->lien)}}" alt="product">
                                    @else
                                    <img class="pri-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                    <img class="sec-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                    @endif
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>new</span>
                                    </div>
                                    @if($random_popular_product->productlines[0]->promo_price)
                                        <div class="product-label discount">
                                            <span>{{ number_format((($random_popular_product->productlines[0]->price - $random_popular_product->productlines[0]->promo_price) / $random_popular_product->productlines[0]->price) * 100) }}%</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="cart-hover">
                                    <a href="{{ asset('product/'.$random_popular_product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                @if($random_popular_product->mark)
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="{{ asset('product/'.$random_popular_product->slug) }}">{{ $random_popular_product->mark->designation }}</a></p>
                                    </div>
                                @endif
                                <ul class="color-categories">
                                    @foreach($random_popular_product->productlines as $item)
                                        @if($item->attribute_id)
                                            <li>
                                                <a  style="cursor: pointer" title="{{$item->attributeLine->value}}"><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone) }}" alt="" /></a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <h6 class="product-name">
                                    <a href="{{ asset('product/'.$random_popular_product->slug) }}">{{ $random_popular_product->designation }}</a>
                                </h6>
                                <div class="price-box">
                                    @if($product->getPricePromo())
                                    <span class="price-regular">{{number_format($random_popular_product->getPricePromo())}} Da</span>
                                    <span class="price-old"><del>{{number_format($random_popular_product->getPrice())}} Da</del></span>
                                    @else
                                    <span class="price-regular">{{number_format($random_popular_product->getPrice())}} Da</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    <!-- product item end -->
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured product area end -->

    <!-- testimonial area start -->
    <section class="testimonial-area section-padding bg-img" data-bg="{{ asset('front/assets/img/testimonial/testimonials-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Témoignages</h2>
                        <p class="sub-title">Ce qu'ils disent de nous !</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-thumb-wrapper">
                        <div class="testimonial-thumb-carousel">
                            <div class="testimonial-thumb">
                                <img src="{{ asset('front/assets/img/testimonial/testimonial-1.png') }}" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="{{ asset('front/assets/img/testimonial/testimonial-2.png') }}" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="{{ asset('front/assets/img/testimonial/testimonial-3.png') }}" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="{{ asset('front/assets/img/testimonial/testimonial-2.png') }}" alt="testimonial-thumb">
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-content-wrapper">
                        <div class="testimonial-content-carousel">
                            <div class="testimonial-content">
                                <p>J'aime beaucoup les produits, la description correspond totalement au produit. Concernant, le fond de teint, le choix des teintes est très variées, il y en a pour toutes les carnations. De plus la livraison est rapide.</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">Hind Benosman</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial area end -->

    <!-- group product start -->
    <section class="group-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="group-product-banner">
                        <figure class="banner-statistics">
                            <a style="cursor: pointer">
                                <img src="{{ asset('front/assets/img/banner/img-bottom-banner.jpg') }}" alt="product banner">
                            </a>
                            <div class="banner-content banner-content_style3 text-center">
                                <h6 class="banner-text1">BOURJOIS</h6>
                                <h2 class="banner-text2">ROUGE À LÈVRES</h2>
                                <a style="cursor: pointer" class="btn btn-text">Acheter</a>
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Produits les plus vendus</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title start -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">
                                <!-- group list item start -->
                            @foreach($random_best_selling_products as $random_best_selling_product)
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            <a href="{{ asset('product/'.$random_best_selling_product->slug) }}">
                                                @if(optional($random_best_selling_product->images->first())->lien)
                                                <img src="{{asset('storage/images/products/'.$random_best_selling_product->images[0]->lien)}}" alt="">
                                                @else
                                                <img src="{{asset('/product-cosmekarn.jpg')}}" alt="">
                                                @endif

                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name"><a href="{{ asset('product/'.$random_best_selling_product->slug) }}">
                                                    {{ $random_best_selling_product->designation }}</a></h5>
                                            <div class="price-box">
                                                @if($random_best_selling_product->getPricePromo())
                                                <span class="price-regular">{{number_format($random_best_selling_product->getPricePromo())}} Da</span>
                                                <span class="price-old"><del>{{number_format($random_best_selling_product->getPrice())}} Da</del></span>
                                                @else
                                                <span class="price-regular">{{number_format($random_best_selling_product->getPrice())}} Da</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->
                            @endforeach

                            </div>
                        </div>
                        <!-- group list carousel start -->
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Produits en vente</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title start -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">
                                <!-- group list item start -->
                                @foreach($random_products_on_sale as $random_product_on_sale)
                                    <div class="group-slide-item">
                                        <div class="group-item">
                                            <div class="group-item-thumb">
                                                <a href="{{ asset('product/'.$random_product_on_sale->slug) }}">
                                                    @if(optional($random_product_on_sale->first())->lien)
                                                       <img src="{{asset('storage/images/products/'.$random_product_on_sale->images[0]->lien)}}" alt="">
                                                    @else
                                                        <img src="{{asset('/product-cosmekarn.jpg')}}" alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="group-item-desc">
                                                <h5 class="group-product-name"><a href="{{ asset('product/'.$random_product_on_sale->slug) }}">
                                                        {{ $random_product_on_sale->designation }}</a></h5>
                                                <div class="price-box">
                                                    @if($random_product_on_sale->getPricePromo())
                                                    <span class="price-regular">{{number_format($random_product_on_sale->getPricePromo())}} Da</span>
                                                    <span class="price-old"><del>{{number_format($random_product_on_sale->getPrice())}} Da</del></span>
                                                    @else
                                                    <span class="price-regular">{{number_format($random_product_on_sale->getPrice())}} Da</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- group list item end -->
                                @endforeach
                            </div>
                        </div>
                        <!-- group list carousel start -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- group product end -->



    <!-- brand logo area start -->
    <div class="brand-logo section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('front/assets/img/brand/1.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('front/assets/img/brand/2.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('front/assets/img/brand/3.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('front/assets/img/brand/4.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('front/assets/img/brand/5.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('front/assets/img/brand/6.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand logo area end -->
</main>

@endsection

