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
                                <li class="breadcrumb-item active" aria-current="page">Produits</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- shop main wrapper start -->
                @if($count_products > 0)
                    <div class="col-lg-12">
                        <div class="shop-product-wrapper">
                            <!-- shop product top wrap start -->
                            <div class="shop-top-bar">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                        <div class="top-bar-left">
                                            <div class="product-view-mode">
                                                <a class="active" href="#" data-target="grid-view" data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                            </div>
                                            <div class="product-amount">
                                                <p><b>{{ $count_products }}</b> produit(s)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop product top wrap start -->

                            <!-- product item list wrapper start -->
                            <div class="shop-product-wrap grid-view row mbn-30">
                                <!-- product single item start -->
                                @foreach($products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <!-- product grid start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="product-details.html">
                                                    <img class="pri-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
                                                    <img class="sec-img" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}" alt="product">
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
                                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                                </div>
                                                <div class="cart-hover">
                                                    <a href="{{ asset('product/'.$product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <div class="product-identity">
                                                    <p class="manufacturer-name"><a href="product-details.html">Platinum</a></p>
                                                </div>
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
                                        <!-- product grid end -->

                                        <!-- product list item end -->

                                        <!-- product list item end -->
                                    </div>
                                @endforeach

                            </div>
                            <!-- product item list wrapper end -->

                            <!-- start pagination area -->
                            <div class="paginatoin-area text-center">
                                <ul class="pagination-box">
                                    <!-- Lien précédent -->
                                    @if ($products->currentPage() > 1)
                                        <li>
                                            <a class="previous" href="{{ $products->previousPageUrl() }}">
                                                <i class="pe-7s-angle-left"></i>
                                            </a>
                                        </li>
                                    @endif
                                <!-- Liens de pagination numérotés -->
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        <li class="{{ $page == $products->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Lien suivant -->
                                    @if ($products->hasMorePages())
                                        <li>
                                            <a class="next" href="{{ $products->nextPageUrl() }}">
                                                <i class="pe-7s-angle-right"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        <!-- end pagination area -->
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-success-cosmekarn text-center"   role="alert">
                        <p class="mt-3" style="font-size: 15px;"> Aucun produit trouvé pour le moment. </p>
                            <a  href="{{url('/')}}" type="button" style="margin-top:20px;" class="btn btn-cart2">Page d'acceuil</a>
                        </div>
                    </div>
                @endif
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
</main>


@endsection
