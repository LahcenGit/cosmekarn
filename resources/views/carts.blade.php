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
                                <li class="breadcrumb-item active" aria-current="page">panier</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">

        <div class="container">
            @if(!$cartitems->isEmpty())
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <form action="{{url('carts/'.$cart_id)}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                @csrf
                                <div class="cart-table table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="pro-thumbnail">Photo</th>
                                                <th class="pro-title">Produit</th>
                                                <th class="pro-price">Prix</th>
                                                <th class="pro-quantity">Qte</th>
                                                <th class="pro-subtotal">Total</th>
                                                <th class="pro-remove">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartitems as $cartitem)
                                                <tr id="item-{{$cartitem->id}}">
                                                    <td class="pro-thumbnail"><a href="{{ asset('product/'.$cartitem->productline->product->slug) }}"><img class="img-fluid" src="{{asset('storage/images/products/'.$cartitem->productline->product->images[0]->lien)}}" alt="Product" /></a></td>
                                                    <td class="pro-title"><a href="{{ asset('product/'.$cartitem->productline->product->slug) }}">{{ $cartitem->productline->product->designation }} @if($cartitem->productline->attributeLine) - {{ $cartitem->productline->attributeLine->value }}@endif</a></td>
                                                    <td class="pro-price"><span>{{ number_format($cartitem->price) }} Da</span></td>
                                                    <td class="pro-quantity">
                                                        <div class="pro-qty"><input type="text" value="{{ $cartitem->qte }}" name="qtes[]" min="1"></div>
                                                        <input type="hidden" name="cartitem[]" value="{{$cartitem->id}}">
                                                    </td>
                                                    <td class="pro-subtotal"><span>{{ number_format($cartitem->total) }} Da</span></td>
                                                    <td class="pro-remove"><a class="delete-item" data-id="{{$cartitem->id}}"><i class="fa fa-trash-o"></i></a></td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Cart Update Option -->
                                <div class="cart-update-option d-block d-md-flex justify-content-between">
                                    <div class="cart-update">
                                        <button type="submit" class="btn btn-sqr">Mettre à jour le panier</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <form action="{{url('checkout')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Cart Calculation Area -->
                                <div class="cart-calculator-wrapper">
                                    <div class="cart-calculate-items">
                                        <h6>Total panier</h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <td>Total</td>
                                                    <td>{{ number_format($total->sum) }} Da</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>

                                    <input type="hidden" name="cart_id" value="{{$cart_id}}">

                                    <button type="submit" class="btn btn-sqr d-block">Procéder au paiement</button>
                                {{--<a href="{{ asset('checkout/'.$cart_id) }}" class="btn btn-sqr d-block">Procéder au paiement</a>--}}
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            @else
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-success-cosmekarn text-center" role="alert">
                        <p class="mt-3" style="font-size: 15px;">Votre panier est actuellement vide. </p>
                            <a  href="{{url('/')}}" type="button" style="margin-top:20px;" class="btn btn-cart2">Page d'acceuil</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        </form>
    </div>
    <!-- cart main wrapper end -->
</main>

@endsection

@push('delete-item')
<script>
    $( ".delete-item" ).click(function() {
        var id = $(this).attr("data-id");
        var item = $('#item-'+id).val();
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
			url: '/carts/'+id ,
			type: 'DELETE',
            data: {
            "id": id,
            "_token": token,
        },
            success: function (res) {

              $("#item-"+id).css("display", "none");

                    $("#list-"+id).css("display", "none");
                    $(".nbr_product").text(res.nbr_cartitem);
                    $(".total").text(res.total +' Da');


             }
		});
});
</script>
@endpush
