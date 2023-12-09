@extends('layouts.front')
@section('content')

<style>
    .disabled{
        color: #8b8b8b;
        background-color: #d3d3d3;
    }
</style>
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
                                @if(optional($first_image)->lien)
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{asset('storage/images/products/'.$first_image->lien)}}" alt="product-details" />
                                    </div>
                                @else
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{asset('/product-cosmekarn.jpg')}}" alt="product-details" />
                                    </div>
                                @endif
                                @if($images_attributes)
                                    @foreach($images_attributes as $image_attribute)
                                        @if($image_attribute->attribute_image != null)
                                            <div class="pro-large-img img-zoom">
                                                <img src="{{asset('storage/images/productlines/'.$image_attribute->attribute_image)}}"  alt="{{ $image_attribute->attributeLine->value }} 5866" />
                                            </div>
                                        @endif
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
                                    @if(optional($first_image)->lien)
                                    <img src="{{asset('storage/images/products/'.$first_image->lien)}}" alt="product-details" />
                                    @else
                                    <img src="{{asset('/product-cosmekarn.jpg')}}" alt="product-details" />
                                    @endif
                                </div>
                                    @foreach($images_attributes as $image_attribute)
                                        @if($image_attribute->attribute_image != null)
                                            <div class="pro-nav-thumb" id="{{'related-img-'.$image_attribute->id}}">
                                                <img src="{{asset('storage/images/productlines/'.$image_attribute->attribute_image)}}" alt="{{ $image_attribute->attributeLine->value }}" />
                                            </div>
                                        @endif
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
                                @if($product->mark)
                                <div class="manufacturer-name">
                                    <a href="product-details.html">{{ $product->mark->designation }}</a>
                                </div>
                                @endif
                                <h3 class="product-name">{{ $product->designation }}</h3>
                                <div class="ratings d-flex">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <div class="pro-review">
                                        <span>{{  $count_comment }} Commentaire(s)</span>
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
                                        @if($productLine->promo_price)
                                        <span class="price-regular">{{number_format($productLine->promo_price)}} Da</span>
                                        <span class="price-old"><del>{{number_format($productLine->price)}} Da</del></span>
                                        @else
                                        <span class="price-regular">{{number_format($productLine->price)}} Da</span>
                                        @endif
                                    @endif
                                </div>

                                {{--<h5 class="offer-text"><strong>Dépêchez-vous</strong>! l'offre se termine dans:</h5>
                                <div class="product-countdown" data-countdown="2022/12/30"></div>--}}

                                <div class="availability">
                                    @if($productLine->qte >0)
                                    <i id="availability-icon" class="fa fa-check-circle"></i>
                                    @else
                                    <i id="availability-icon" class="fa fa-times-circle" style="color:red"></i>
                                    @endif
                                    <span id="qte">@if($productLine->qte >0) <b> {{ $productLine->qte }} </b> dans le stock @else <b style="color: red"> Rupture de stock </b> @endif</span>
                                </div>
                                <p class="pro-desc">{{$product->short_description}}</p>


                                @if($product_lines)
                                    @foreach($product_lines as $product_line)
                                        <div class="pro-size" id="list-attr">
                                          @foreach($product_line as $item)
                                                @if($loop->iteration == 1 && $item->attribute->value != 'Couleur')
                                                <h6 class="option-title">{{$item->attribute->value}}:</h6>
                                                @endif
                                                @if($item->attribute->value != 'Couleur')
                                                        @if ($loop->first)
                                                            <a class="btn btn-attribute  selected-attribute attribute-text mr-2"  data-id="{{$item->id}}" id="{{'a-'.$item->id}}">{{$item->attributeLine->value}}</a>
                                                        @else
                                                             <a class="btn btn-attribute  attribute-text mr-2" data-id="{{$item->id}}" id="{{'a-'.$item->id}}">{{$item->attributeLine->value}}</a>

                                                        @endif
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
                                                        @if($loop->iteration == 1)
                                                            <li value-id="{{$item->id}}" class="selected-icon" id="{{'li-'.$item->id}}" >
                                                                <a title="{{$item->attributeLine->value}}" id="{{$item->id}}" style="cursor: pointer"  class="select-icon"><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone)}}" alt="{{ $item->attributeLine->value }}"/></a>
                                                            </li>
                                                        @else
                                                            <li value-id="{{$item->id}}"  id="{{'li-'.$item->id}}" >
                                                                <a title="{{$item->attributeLine->value}}" id="{{$item->id}}" style="cursor: pointer"  class="select-icon"><img src="{{ asset('storage/icones/productlines/'.$item->attribute_icone)}}" alt="{{ $item->attributeLine->value }}"/></a>
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach

                                @endif
                                <div class="qte-product">
                                   <div class="quantity-cart-box d-flex align-items-center">
                                        <input type="hidden" value="{{$product->id}}" class="product_id">

                                        <h6 class="option-title">Qte:</h6>
                                        <div class="quantity">
                                            <div class="pro-qty"><input id="monChamp" type="text" class="qty-val" max="{{ $productLine->qte }}" min="1" value="1"></div>
                                        </div>
                                        <div class="action_link">
                                            <a class="btn btn-cart2 addToCartBtn @if($productLine->qte == 0) disabled @endif"  href="JavaScript:void(0);">Ajouter au panier</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="useful-links">

                                    <a style="cursor: pointer" class="addToFavoriteBtn" data-bs-toggle="tooltip" title="Wishlist"><i
                                            class="pe-7s-like"></i>Favoris</a>
                                </div>
                                 <!--
                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                -->
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
                                        <a data-bs-toggle="tab" href="#tab_three">Commentaire(s) ({{ $count_comment }})</a>
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
                                                @if($product_lines)
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
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab_three">
                                          <h5>{{ $count_comment }}  avis pour <span>{{ $product->designation }}</span></h5>
                                            <div class="total-reviews mt-4 " style="display: block;padding-bottom: 20px;" id="add-comment">
                                                @foreach($comments as $comment)
                                                <div class="review-box mb-3">
                                                    <div class="post-author">
                                                        <p><b>{{ $comment->user->name }} </b> {{$comment->created_at->format('Y-m-d H:m')}} | (<b>{{$comment->rating }}/5</b>)</p>
                                                    </div>
                                                    <p>{{ $comment->comment }}.</p>
                                                </div>
                                                @endforeach
                                            </div>
                                            @Auth
                                                @if($nbr_comment == 0)
                                                    <div class="comment-section">
                                                        <form >
                                                            @csrf
                                                            <div class="form-group row">
                                                                <div class="col">
                                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                                        Commentaire</label>
                                                                    <textarea class="form-control" id="comment" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col">
                                                                    <label class="col-form-label"> Votre note </label>
                                                                    <div class="my-rating"></div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="product" value="{{ $product->id }}">
                                                            <button type="button"  class="btn btn-sqr add-comment" >Envoyer</button>
                                                        </form> <!-- end of review-form -->
                                                    </div>
                                                    <div id="show_comment_msg">
                                                    </div>
                                                    @else
                                                    <h6 style="color: #E41F85">Vous avez déja donné un avis sur ce produit !</h6>
                                                @endif
                                        @else
                                        <p>Veuillez vous authentifier pour pouvoir poster un commentaire.</p>
                                        <a href="{{asset('/login-register')}}"class="btn btn-sqr">Se connecter</a>
                                        @endauth
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
@if($related_products != NULL)
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
                                        @if(optional($related_product->product->images->first())->lien)
                                            <img class="pri-img" src="{{asset('storage/images/products/'.$related_product->product->images[0]->lien)}}" alt="product">
                                            <img class="sec-img" src="{{asset('storage/images/products/'.$related_product->product->images[0]->lien)}}" alt="product">
                                        @else
                                            <img class="pri-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                            <img class="sec-img" src="{{asset('/product-cosmekarn.jpg')}}" alt="product">
                                        @endif
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        @if(optional($related_product->product->productlines->first())->promo_price)
                                            <div class="product-label discount">
                                                <span>{{ number_format((($related_product->product->productlines[0]->price - $related_product->product->productlines[0]->promo_price) / $related_product->product->productlines[0]->price) * 100) }}%</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="cart-hover">
                                        <a href="{{ asset('product/'.$related_product->product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        @if(optional($related_product->product->mark)->designation)
                                         <p class="manufacturer-name"><a href="{{ asset('product/'.$related_product->product->slug) }}">{{ $related_product->product->mark->designation }}</a></p>
                                        @endif
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
                                        <a href="{{ asset('product/'.$related_product->product->slug) }}">{{ $related_product->product->designation }}</a>
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
@endif
<!-- related products area end -->

@if(isset($packsContainingProduct))
<section class="related-products section-padding">
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
                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                    <!-- product item start -->

                    @foreach($packsContainingProduct as $packContainingProduct)
                        <div class="product-item">
                            <figure class="product-thumb">
                                <a href="{{ asset('product/'.$packContainingProduct->product->slug) }}">
                                    @if($first_image)
                                    <img class="pri-img" src="{{asset('storage/images/products/'.$packContainingProduct->product->images[0]->lien)}}" alt="product">
                                    <img class="sec-img" src="{{asset('storage/images/products/'.$packContainingProduct->product->images[0]->lien)}}" alt="product">
                                    @endif
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>new</span>
                                    </div>
                                    @if($packContainingProduct->product->productlines[0]->promo_price)
                                        <div class="product-label discount">
                                            <span>{{ number_format((($packContainingProduct->product->productlines[0]->price - $packContainingProduct->product->productlines[0]->promo_price) / $packContainingProduct->product->productlines[0]->price) * 100) }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="cart-hover">
                                    <a href="{{ asset('product/'.$packContainingProduct->product->slug) }}" class="btn btn-cart">Voir le produit</a>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <h6 class="product-name">
                                    <a href="{{ asset('product/'.$packContainingProduct->product->slug) }}">{{ $packContainingProduct->product->designation }}</a>
                                </h6>

                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>

    </div>
</section>
@endif
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
<i class="fa fa-angle-up"></i>
</div>



@endsection

@push('select-icon-indice')



<script>
    $(".attribute-text").click(function() {
        $('.selected-attribute').removeClass("selected-attribute");
        id = $(this).data('id');
        $("#a-"+id).addClass("selected-attribute");
        $('#related-img-'+id).trigger('click');
    });
</script>


<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $(".select-icon").click(function() {
        $('.color-categories li').removeAttr('class');
        var title = $(this).attr('title');
        $('.color-title b').html(title);
        id = $(this).attr('id');
        $("#li-"+id).addClass("selected-icon");
        $('#related-img-'+id).trigger('click');

        $.ajax({
            url: '/get-qte/'+id,
            type: "GET",
            success: function (res) {
                if (res.qte > 0) {
                    $("#availability-icon").removeClass("fa-times-circle").addClass("fa-check-circle");
                    $("#qte").text(res.qte  + " dans le stock");
                    $(".addToCartBtn").removeClass("disabled");

                    // Réactiver l'événement "click" du bouton
                    $(".addToCartBtn").on("click", addToCartFunction);
                } else {
                    $("#availability-icon").removeClass("fa-check-circle").addClass("fa-times-circle");
                    $("#qte").text("Rupture de stock");
                    $(".addToCartBtn").addClass("disabled");

                    // Désactiver l'événement "click" du bouton
                    $(".addToCartBtn").off("click");
                }
            }
        });
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
        var product_id = $('.product_id').val();
        var qte = $('.qty-val').val();

        $.ajax({
                url: '/get-product/' + product_id ,
                type: "GET",
                success: function (res) {

                if(res.countproductlines > 1){
                    var id = $('#list-line li.selected-icon').attr('value-id');
                    if(!id){
                        var id = $('#list-attr a.selected-attribute').data('id');

                    }

                    $.ajax({
                            url: '/carts',
                            type: "POST",
                            data:{
                                'id' : id,
                                'qte' :qte,
                            },
                            success: function (res) {
                               $(".nbr_product").text(res.nbr_cart);

                                if(res.qtes == 0){
                                    toastr.success('Produit ajouté avec success');
                                    var $path = '{{asset("storage/images/products/")}}';

                                    $data = '<li class="minicart-item" id="list-'+id+'">'+
                                            '<div class="minicart-thumb">'+
                                                '<a style="cursor: pointer">'+
                                                    '<img src="'+ $path + '/'+res.image + '" alt="product">' +
                                                '</a>'+
                                            '</div>'+
                                            '<div class="minicart-content">'+
                                               '<h3 class="product-name">'+
                                                    '<a style="cursor: pointer">'+res.name+'</a>'+
                                                '</h3>'+
                                                '<p>'+
                                                    '<span class="cart-quantity">'+res.qte+' <strong>&times;</strong></span>'+
                                                    '<span class="cart-price">'+res.price+' Da</span>'+
                                                '</p>'+
                                            '</div>'+
                                            '<button class="delete-item-list" data-id="'+id+'"><i class="pe-7s-close"></i></button>'+
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
                               $(".nbr_product").text(res.nbr_cart);

                                if(res.qtes == 0){
                                    toastr.success('Produit ajouté avec success');
                                    var $path = '{{asset("storage/images/products/")}}';

                                    $data = '<li class="minicart-item" id="list-'+id+'">'+
                                            '<div class="minicart-thumb">'+
                                                '<a style="cursor: pointer">'+
                                                    '<img src="'+ $path + '/'+res.image + '" alt="product">' +
                                                '</a>'+
                                            '</div>'+
                                            '<div class="minicart-content">'+
                                               '<h3 class="product-name">'+
                                                    '<a style="cursor: pointer">'+res.name+'</a>'+
                                                '</h3>'+
                                                '<p>'+
                                                    '<span class="cart-quantity">'+res.qte+' <strong>&times;</strong></span>'+
                                                    '<span class="cart-price">'+res.price+' Da</span>'+
                                                '</p>'+
                                            '</div>'+
                                            '<button class="delete-item-list" data-id="'+id+'"><i class="pe-7s-close"></i></button>'+
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

@push('add-favorite-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    $( ".addToFavoriteBtn" ).click(function(e) {
        e.preventDefault();
        var product_id = $('.product_id').val();
        $.ajax({
                url: '/get-product/' + product_id ,
                type: "GET",
                success: function (res) {

                if(res.countproductlines > 1){
                    var id = $('#list-line li.selected-icon').attr('value-id');
                    if(!id){
                        var id = $('#list-attr a.selected-attribute').data('id');
                   }

                    $.ajax({
                            url: '/favorite',
                            type: "POST",
                            data:{
                                'id' : id,
                            },
                            success: function (res) {

                               if(res.qtes > 0){
                                    alert("Le produit existe déja dans votre panier");
                                }
                                else{
                                    toastr.success('Produit ajouté avec success');
                                    $(".nbr_product_favorite").text(res.nbr_favorite);
                                }
                            }
                    });
                         }
                    else{
                        var id = res.productlines.id;

                        $.ajax({
                        url: '/favorite',
                        type: "POST",
                        data:{
                            'id' : id,

                        },
                        success: function (res) {
                            if(res.qtes > 0){
                                alert("Le produit existe déja dans votre panier");
                            }
                            else{
                                toastr.success('Produit ajouté avec success');
                                $(".nbr_product_favorite").text(res.nbr_favorite);
                            }
                        }
                        });
                         }
               }
            });

});
</script>
@endpush

@push('comment-scripts')
<script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $(".add-comment").on("click", function (e)
    {
        $('#show_comment_msg').html('<div >En cours....</div>');
        var comment = $('#comment').val();
        var product = $('#product').val();
        var rating = $('.my-rating').starRating('getRating');
        var data = {
            "_token": "{{ csrf_token() }}",
            comment: comment,
            product: product,
            rating: rating
        };
        $.ajax(
                {
                    url: "/comment",
                    type: "POST",
                    data: data,
                    success: function (res) {


                        $('#add-comment').append('<div class="review-box mb-3">'+'<div class="post-author">'+'<p>'+'<b>'+res.name + '</b>' + res.date +' | '+'('+'<b>'+res.rating+'/'+'5'+'</b>'+')'+'<p>'+'</div>'+'<p>'+res.comment+'</p>'+'</div>');
                        $('#show_comment_msg').html('<div class="alert alert-success mt-2 flash-alert" id="form-success" role="alert" style="color:#fff; background-color:#E41F85; border-color:#E41F85;"> Merci pour votre commentaire !</div>');
                        $(".flash-alert").slideDown(200).delay(3500).slideUp(200);
                        $(".comment-section").hide();


                    }
                });
                e.preventDefault();

    });

</script>
@endpush

