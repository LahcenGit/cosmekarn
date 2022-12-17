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
        <form action="{{url('carts/'.$cart_id)}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Cart Table Area -->
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
                            <div class="apply-coupon-wrapper">
                                <form action="#" method="post" class=" d-block d-md-flex">
                                    <input type="text" placeholder="Enter Your Coupon Code"  />
                                    <button class="btn btn-sqr">Apply Coupon</button>
                                </form>
                            </div>
                            <div class="cart-update">
                                <button type="submit" class="btn btn-sqr">Mettre à jour le panier</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Sub Total</td>
                                            <td>$230</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td>$70</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount">$300</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="checkout.html" class="btn btn-sqr d-block">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
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
