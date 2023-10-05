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
                    @if($favoritelines !== null)
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
                                            <tr id="item-{{$favoriteline->id}}">
                                                <td class="pro-thumbnail"><a href="{{ asset('product/'.$favoriteline->productline->product->slug) }}"><img class="img-fluid" src="{{asset('storage/images/products/'.$favoriteline->productline->product->images[0]->lien)}}" alt="Product" /></a></td>
                                                <td class="pro-title"><a href="{{ asset('product/'.$favoriteline->productline->product->slug) }}">{{ $favoriteline->productline->product->designation }} @if($favoriteline->productline->attributeLine) - {{ $favoriteline->productline->attributeLine->value }}@endif</a></td>
                                                <td class="pro-price"><span>@if($favoriteline->productline->promo_price){{ number_format($favoriteline->productline->promo_price) }} @else{{ number_format($favoriteline->productline->price) }}@endif  Da</span></td>
                                                <td class="pro-quantity">@if($favoriteline->productline->qte > 0)<span class="text-success">En stock</span> @else <span class="text-danger">Repture</span>@endif</td>
                                                <td class="pro-subtotal"><a href="#" class="btn btn-sqr addToCartBtn"  data-id="{{$favoriteline->productline->id}}">Ajouter au panier</a></td>
                                                <td class="pro-remove"><a href="#"data-id="{{$favoriteline->id}}" class="delete-item"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                    <div class="col-lg-12">
                        <div class="alert alert-success-cosmekarn text-center" role="alert">
                        <p class="mt-3" style="font-size: 15px;">La liste de favoris est vide. Veuillez ajouter des éléments aux favoris. </p>
                            <a  href="{{url('/')}}" type="button" style="margin-top:20px;" class="btn btn-cart2">Page d'acceuil</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Wishlist Page Content End -->
        </div>
    </div>
    <!-- wishlist main wrapper end -->
</main>
@endsection
@push('add-cart-scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    $( ".addToCartBtn" ).click(function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        var qte = 1;

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

            }
            });

});
</script>
@endpush
@push('delete-item')
<script>
    $( ".delete-item" ).click(function() {
        var id = $(this).attr("data-id");
        var item = $('#item-'+id).val();
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
			url: '/favorite/'+id ,
			type: 'DELETE',
            data: {
            "id": id,
            "_token": token,
        },
            success: function (res) {

              $("#item-"+id).css("display", "none");
                    $(".nbr_product_favorite").text(res);

            }
		});
});
</script>
@endpush
