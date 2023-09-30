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
                                <li class="breadcrumb-item active" aria-current="page">Favoris</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- wishlist main wrapper start -->
    <div class="wishlist-main-wrapper section-padding">
        <div class="container">
            <!-- Wishlist Page Content Start -->
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Wishlist Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Photo</th>
                                        <th class="pro-title">Produit</th>
                                        <th class="pro-price">Prix</th>
                                        <th class="pro-quantity">État de stock</th>
                                        <th class="pro-subtotal">Ajouter au panier</th>
                                        <th class="pro-remove">Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favoritelines as $favoriteline )
                                        <tr>
                                            <td class="pro-thumbnail"><a href="{{ asset('product/'.$favoriteline->productline->product->slug) }}"><img class="img-fluid" src="{{asset('storage/images/products/'.$favoriteline->productline->product->images[0]->lien)}}" alt="Product" /></a></td>
                                            <td class="pro-title"><a href="{{ asset('product/'.$favoriteline->productline->product->slug) }}">{{ $favoriteline->productline->product->designation }} @if($favoriteline->productline->attributeLine) - {{ $favoriteline->productline->attributeLine->value }}@endif</a></td>
                                            <td class="pro-price"><span>@if($favoriteline->productline->promo_price){{ number_format($favoriteline->productline->promo_price) }} @else{{ number_format($favoriteline->productline->price) }}@endif  Da</span></td>
                                            <td class="pro-quantity">@if($favoriteline->productline->qte > 0)<span class="text-success">En stock</span> @else <span class="text-danger">Repture</span>@endif</td>
                                            <td class="pro-subtotal"><a href="cart.html" class="btn btn-sqr">Ajouter au panier</a></td>
                                            <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Wishlist Page Content End -->
        </div>
    </div>
    <!-- wishlist main wrapper end -->
</main>
@endsection
