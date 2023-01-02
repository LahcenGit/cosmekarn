@extends('layouts.front')
@section('content')
<!-- page main wrapper start -->
<div class="shop-main-wrapper section-padding pb-0">
    <div class="container">
        <div class="row">
            <!-- product details wrapper start -->
            <div class="col-lg-12 order-1 order-lg-2">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row product-data">
                        <div class="col-lg-5">
                            <div class="product-large-slider">
                                @if($first_image)
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{asset('storage/images/products/'.$first_image->lien)}}" alt="product-details" />
                                    </div>
                                @endif
                                @if($images_attributes)
                                    @foreach($images_attributes as $image_attribute)
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{asset('storage/images/productlines/'.$image_attribute->attribute_image)}}"  alt="{{ $image_attribute->attributeLine->value }}" />
                                    </div>
                                    @endforeach
                                @else
                                    @foreach($secondary_images as $secondary_image)
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{asset('storage/images/products/'.$secondary_image->lien)}}" alt="" />
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="pro-nav slick-row-10 slick-arrow-style">
                                @if($images_attributes)
                                <div class="pro-nav-thumb">
                                    <img src="{{asset('storage/images/products/'.$first_image->lien)}}" alt="product-details" />
                                </div>
                                    @foreach($images_attributes as $image_attribute)
                                    <div class="pro-nav-thumb" id="{{'related-img-'.$image_attribute->id}}">
                                        <img src="{{asset('storage/images/productlines/'.$image_attribute->attribute_image)}}" alt="{{ $image_attribute->attributeLine->value }}" />
                                    </div>
                                    @endforeach
                                @else
                                    @foreach($images as $image)
                                    <div class="pro-nav-thumb">
                                        <img src="{{asset('storage/images/products/'.$image->lien)}}" alt="product-details" />
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-details-des">
                                <div class="manufacturer-name">
                                    <a href="product-details.html">Eclipse</a>
                                </div>
                                <h3 class="product-name">{{ $product->designation }}</h3>
                                <div class="ratings d-flex">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <div class="pro-review">
                                        <span>1 Commentaire(s)</span>
                                    </div>
                                </div>
                                <div class="price-box">
                                    @if($min_price)
                                        @if($min_price_promo)
                                        <span class="price-regular">{{number_format($min_price_promo)}} Da</span>
                                        <span class="price-old"><del>{{number_format($min_price)}} Da</del></span>
                                        @else
                                        <span class="price-regular">{{number_format($min_price)}} Da</span>
                                        @endif
                                    @else
                                        @if($product_line->promo_price)
                                        <span class="price-regular">{{number_format($product_line->promo_price)}} Da</span>
                                        <span class="price-old"><del>{{number_format($product_line->price)}} Da</del></span>
                                        @else
                                        <span class="price-regular">{{number_format($product_line->price)}} Da</span>
                                        @endif
                                    @endif
                                </div>
                                @if($product->id != 59)
                                <h5 class="offer-text"><strong>Dépêchez-vous</strong>! l'offre se termine dans:</h5>
                                <div class="product-countdown" data-countdown="2022/12/30"></div>

                                @endif
                                <div class="availability">
                                    <i class="fa fa-check-circle"></i>
                                    <span>200 dans le stock</span>
                                </div>
                                <p class="pro-desc">{{$product->short_description}}</p>

                                @if($product_lines)
                                    @foreach($product_lines as $product_line)
                                        <div class="pro-size">
                                          @foreach($product_line as $item)
                                                @if($loop->iteration == 1 && $item->attribute->value != 'Couleur')
                                                <h6 class="option-title">{{$item->attribute->value}}:</h6>
                                                @endif
                                                @if($item->attribute->value != 'Couleur')
                                                <div class="action_link">
                                                    <a class="btn btn-cart2 ml-2" href="#">{{$item->attributeLine->value}}</a>
                                                </div>
                                                @endif
                                          @endforeach
                                        </div>
                                    @endforeach
                                @endif

                                @if($product_lines)
                                    @foreach($product_lines as $product_line)
                                        <div class="color-option">
                                            <ul class="color-categories" id="list-line" >
                                                @foreach($product_line as $item)
                                                    @if($loop->iteration == 1 && $item->attribute->value == 'Couleur')
                                                    <h6 class="option-title">Couleur : <span class="color-title"> <b>{{ $item->attributeLine->value }} </b> </span></h6><br>
                                                    @endif
                                                    @if($item->attribute->value == 'Couleur')
                                                        <li value-id="{{$item->id}}"  id="{{'li-'.$item->id}}" >
                                                            <a title="{{$item->attributeLine->value}}" id="{{$item->id}}" style="cursor: pointer"  class="select-icon"><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone)}}" alt="{{ $item->attributeLine->value }}"/></a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="quantity-cart-box d-flex align-items-center">
                                    <input type="hidden" value="{{$product->id}}" class="product_id">

                                    <h6 class="option-title">Qte:</h6>
                                    <div class="quantity">
                                        <div class="pro-qty"><input type="text" class="qty-val" value="1"></div>
                                    </div>
                                    <div class="action_link">
                                        <a class="btn btn-cart2 addToCartBtn" style="cursor: pointer">Ajouter au panier</a>
                                    </div>
                                </div>
                                <div class="useful-links">

                                    <a style="cursor: pointer" data-bs-toggle="tooltip" title="Wishlist"><i
                                            class="pe-7s-like"></i>Favoris</a>
                                </div>
                                <div class="like-icon">
                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                    <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details inner end -->

                <!-- product details reviews start -->
                <div class="product-details-reviews section-padding pb-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-review-info">
                                <ul class="nav review-tab">
                                    <li>
                                        <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tab" href="#tab_two">information</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tab" href="#tab_three">Commentaire(s) (1)</a>
                                    </li>
                                </ul>
                                <div class="tab-content reviews-tab">
                                    <div class="tab-pane fade show active" id="tab_one">
                                        <div class="tab-one">
                                            <p>{!! $product->long_description !!}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_two">
                                        <table class="table table-bordered">
                                            <tbody>
                                                @foreach($product_lines as $product_line)
                                                   <tr>
                                                        <td>
                                                            {{ $product_line[$loop->iteration]->attribute->value }}
                                                        </td>
                                                        <td>
                                                            @foreach($product_line as $item)
                                                                {{$item->attributeLine->value}},
                                                            @endforeach
                                                        </td>
                                                   </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab_three">
                                        <form action="#" class="review-form">
                                            <h5>1  avis pou <span>{{ $product->designation }}</span></h5>
                                            <div class="total-reviews">
                                                <div class="rev-avatar">
                                                    <img src="assets/img/about/avatar.jpg" alt="">
                                                </div>
                                                <div class="review-box">
                                                    <div class="ratings">
                                                        <span class="good"><i class="fa fa-star"></i></span>
                                                        <span class="good"><i class="fa fa-star"></i></span>
                                                        <span class="good"><i class="fa fa-star"></i></span>
                                                        <span class="good"><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                    </div>
                                                    <div class="post-author">
                                                        <p><span>Hind Benosman</span> 03 dec, 2022</p>
                                                    </div>
                                                    <p>J'aime beaucoup les produits, la description correspond totalement au produit. Concernant, le fond de teint, le choix des teintes est très variées, il y en a pour toutes les carnations. De plus la livraison est rapide.</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Nom</label>
                                                    <input type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                         Email</label>
                                                    <input type="email" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Commentaire</label>
                                                    <textarea class="form-control" required></textarea>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Évaluation</label>
                                                    &nbsp;&nbsp;&nbsp; Mauvais &nbsp;
                                                    <input type="radio" value="1" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="2" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="3" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="4" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="5" name="rating" checked>
                                                    &nbsp;Excellent
                                                </div>
                                            </div>
                                            <div class="buttons">
                                                <button class="btn btn-sqr" type="submit">Envoyer</button>
                                            </div>
                                        </form> <!-- end of review-form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details reviews end -->
            </div>
            <!-- product details wrapper end -->
        </div>
    </div>
</div>
<!-- page main wrapper end -->

<!-- related products area start -->
<section class="related-products section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Produits similaires</h2>
                    <p class="sub-title">Une variété de produits qui vous attend !</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                    <!-- product item start -->
                    @foreach($related_products as $related_product)
                        <div class="product-item">
                            <figure class="product-thumb">
                                <a href="{{ asset('product/'.$related_product->product->slug) }}">
                                    @if($first_image)
                                    <img class="pri-img" src="{{asset('storage/images/products/'.$related_product->product->images[0]->lien)}}" alt="product">
                                    <img class="sec-img" src="{{asset('storage/images/products/'.$related_product->product->images[0]->lien)}}" alt="product">
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
                                    <button class="btn btn-cart">Ajouter au panier</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                    <p class="manufacturer-name"><a href="product-details.html">Eclipse</a></p>
                                </div>
                                <ul class="color-categories">
                                    @foreach($related_product->product->productlines as $item)
                                      @if($item->attribute_id)
                                        <li>
                                            <a style="cursor: pointer" title=" {{$item->attributeLine->value}} "><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone) }}" alt="" /></a>
                                        </li>
                                      @endif
                                    @endforeach
                                </ul>
                                <h6 class="product-name">
                                    <a href="product-details.html">{{ $related_product->product->designation }}</a>
                                </h6>
                                <div class="price-box">
                                    @if($related_product->getPricePromo())
                                        <span class="price-regular">{{number_format($related_product->getPricePromo())}} Da</span>
                                        <span class="price-old"><del>{{number_format($related_product->getPrice())}} Da</del></span>
                                    @else
                                        <span class="price-regular">{{number_format($related_product->getPrice())}} Da</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- related products area end -->
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
<i class="fa fa-angle-up"></i>
</div>


@endsection

@push('select-icon-indice')
<script>
    $(".select-icon").click(function() {
        $('.color-categories li').removeAttr('class');
        var title = $(this).attr('title');
        $('.color-title b').html(title);
        id = $(this).attr('id');
        $("#li-"+id).addClass("selected-icon");
        $('#related-img-'+id).trigger('click');
    });
</script>
@endpush

@push('add-cart-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    $( ".addToCartBtn" ).click(function(e) {
        e.preventDefault();
        var product_id = $(this).closest('.product-data').find('.product_id').val();
        var qte = $(this).closest('.product-data').find('.qty-val').val();

        $.ajax({
                url: '/get-product/' + product_id ,
                type: "GET",
                success: function (res) {

                if(res.countproductlines > 1){
                    var id = $('#list-line li.selected-icon').attr('value-id');
                    $.ajax({
                            url: '/carts',
                            type: "POST",
                            data:{
                                'id' : id,
                                'qte' :qte,
                            },
                            success: function (res) {
                                $("#liveToast").show();
                                $(".nbr_product").text(res.nbr_cart);

                                if(res.qtes == 0){
                                    $data = '<li class="minicart-item">'+
                                            '<div class="minicart-thumb">'+
                                                '<a href="product-details.html">'+
                                                    '<img src="{{asset('storage/images/products/res.image')}}" alt="product">'+
                                                '</a>'+
                                            '</div>'+
                                            '<div class="minicart-content">'+
                                               '<h3 class="product-name">'+
                                                    '<a href="product-details.html">'+res.name+'</a>'+
                                                '</h3>'+
                                                '<p>'+
                                                    '<span class="cart-quantity">'+res.qte+' <strong>&times;</strong></span>'+
                                                    '<span class="cart-price">'+res.price+' Da</span>'+
                                                '</p>'+
                                            '</div>'+
                                            '<button class="minicart-remove"><i class="pe-7s-close"></i></button>'+
                                        '</li>';
                                $('.cart-list').append($data);
                                }
                                else{
                                    alert("Le produit existe déja dans votre panier");
                                }
                                $(".total").text(res.total +' Da');
                               }

                            });
                         }
                         else{
                            var id = res.productlines.id;

                            $.ajax({
                            url: '/carts',
                            type: "POST",
                            data:{
                                'id' : id,
                                'qte' :qte,
                            },
                            success: function (res) {

                                $("#liveToast").show();
                                $(".nbr_product").text(res.nbr_cart);
                                if(res.qtes == 0){
                                    $data =  '<li>'+
                                                '<div class="shopping-cart-img">'+
                                                    '<a href="shop-product-right.html"><img alt="Nest" src="{{asset('storage/images/products/'.'+res.image')}}" /></a>'+
                                                '</div>'+
                                                '<div class="shopping-cart-title">'+
                                                    '<h4><a href="shop-product-right.html">'+res.name+'</a></h4>'+
                                                    '<h4><span>'+res.qte+' × </span>'+res.price+' Da</h4>'+
                                                '</div>'+
                                                '<div class="shopping-cart-delete">'+
                                                    '<a href="#"><i class="fi-rs-cross-small"></i></a>'+
                                                '</div>'+
                                             '</li>';

                                    $('.cart-list').append($data);
                                }
                                else{
                                    alert("Le produit existe déja dans votre panier");
                                }
                                $(".total").text(res.total +' Da');

                            }
                            });
                         }


                }
            });

});
</script>
@endpush

