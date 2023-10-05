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
                                <li class="breadcrumb-item active" aria-current="page">checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->

    <form action="{{asset('/redirection')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Login Coupon Accordion Start -->
                    <div class="checkoutaccordion" id="checkOutAccordion">

                        <div class="card">
                            <h6>Avez-vous un coupon? <span data-bs-toggle="collapse" data-bs-target="#couponaccordion">
                                        cliquez-ici</span></h6>
                            <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <div class="cart-update-option">
                                        <div class="apply-coupon-wrapper">
                                            <input type="text" name="coupon" placeholder="Entrer votre code" id="coupon-input" />
                                            <button type="button" id="coupon-btn" class="btn btn-sqr">Valider</button>
                                        </div>
                                    </div>
                                    <div id="show_error_msg" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout Login Coupon Accordion End -->
                </div>
            </div>



            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">

                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Détails de la facturation</h5>
                        <div class="billing-form-wrap">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">Nom</label>
                                            <input type="text" id="f_name" placeholder="Nom" name="first_name" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="l_name" class="required">Prenom</label>
                                            <input type="text" id="l_name" placeholder="Prenom" name="last_name" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="single-input-item">
                                    <label for="email" class="required">Email </label>
                                    <input type="email" id="email" placeholder="Email" name="email" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="country" class="required">Wilayas</label>
                                    <select name="country" class="nice-select" id="wilayas">
                                        @foreach ($wilayas as $wilaya)
                                        <option value="{{$wilaya->wilaya}}">{{$wilaya->wilaya}}</option>

                                        @endforeach

                                    </select>
                                </div>

                                <div class="single-input-item">
                                    <label for="commune" class="required">Communes</label>
                                    <select name="commune" class="nice-select" id="communes">
                                         <option value="select">selectionner...</option>
                                    </select>
                                </div>


                                <div class="single-input-item">
                                    <label for="centers" class="required">centres</label>
                                    <select name="center" class="nice-select" id="centers">
                                         <option value="select">selectionner...</option>
                                    </select>
                                </div>

                                <div class="single-input-item">
                                    <label for="street-address" class="required mt-20">Adresse</label>
                                    <input type="text" id="street-address" placeholder="Yaghmoracen Benziane N°981" name="address" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="phone" class="required">Téléphone </label>
                                    <input type="text" name="phone" id="phone" placeholder="Phone" />
                                </div>

                                <div class="single-input-item">
                                    <label for="ordernote">Ajouter une remarque</label>
                                    <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="une note a propos votre commande !"></textarea>
                                </div>

                        </div>
                    </div>
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Détails de la commande</h5>
                        <div class="order-summary-content">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartitems as $cartitem)
                                            <tr data-cart-id="{{ $cartitem->cart_id }}">
                                                <td><a href="{{ asset('product/'. $cartitem->productline->product->slug) }}">{{ $cartitem->productline->product->designation }}<strong> × {{ $cartitem->qte }}</strong></a>
                                                </td>
                                                <td>{{ number_format($cartitem->total) }} Da</td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td><b>{{ number_format($total->sum) }}</b>  Da</td>
                                        </tr>
                                        @if($has_promo)
                                            <tr>
                                                <td>Promo :</td>
                                                <td> <b> @if($type_promo == 1) {{$value_promo}} % @else {{$value_promo}} Da @endif</b></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Livraison</td>
                                            <td class="d-flex justify-content-center">
                                                <ul class="shipping-type">
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="bureau" value="bureau" name="shipping"  class="custom-control-input shipping-redio" checked />
                                                            <label class="custom-control-label" for="bureau">bureau : <span id="bureau-cost" >0</span> da</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="domicile" value="domicile" name="shipping" class="custom-control-input shipping-redio" />
                                                            <label class="custom-control-label"  for="domicile">à domicile : <span id="domicile-cost" >0</span>  da</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total </td>

                                            @if($total_promo)
                                            <td><b class="total-price">{{number_format($total_promo ) }} Da</b></td>
                                            @else
                                            <td><b class="total-price">{{number_format($total->sum ) }} Da</b></td>
                                            @endif
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <div class="single-payment-method show">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cashon" name="paymentmethod" value="cash" class="custom-control-input" checked />
                                            <label class="custom-control-label" for="cashon">Paiement à la livraison</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="cash">
                                        <p>Vous effectuez le paiement des produits au moment de la livraison. </p>
                                    </div>
                                </div>
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="directbank" name="paymentmethod" value="EDAHABIA" class="custom-control-input" />
                                            <label class="custom-control-label" for="directbank">EDAHABIA</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="bank">
                                        <p>Effectuez un paiement en ligne avec votre carte EDAHABIA (Algerie poste)</p>
                                    </div>
                                </div>
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="checkpayment" name="paymentmethod" value="CIB" class="custom-control-input" />
                                            <label class="custom-control-label" for="checkpayment">CIB</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="check">
                                        <p>Effectuez un paiement en ligne avec votre carte bancaire CIB</p>
                                    </div>
                                </div>

                                <div class="summary-footer-area">
                                    <div class="custom-control custom-checkbox mb-20">
                                        <input type="checkbox" class="custom-control-input" id="terms" />
                                        <label class="custom-control-label" for="terms">j'ai lu et j'accepte  <a href="#">les conditions générales d'utilisation.</a></label>
                                    </div>
                                    <div class="alert alert-danger mt-3 alert-condition" role="alert" style="display: none;">
                                        <span style="font-size: 15px;">Veuillez confirmer votre acceptation des conditions générales d'utilisation.  </span>
                                    </div>
                                    <button  class="btn btn-sqr btn-submit">Commander</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <!-- checkout main wrapper end -->
</main>

@endsection

@push('shipping-script')


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $( "#wilayas" ).change(function() {
        var name = $(this).val();
        var data ="";
        var datacenter ="";
        $.ajax({
			url: '/get-communes/'+name ,
			type: 'GET',

        success: function (res) {
                $.each(res, function(i, res) {
                    data = data + '<option value="'+ res.commune+ '" >'+ res.commune+ '</option>';
                });
                $('#communes').html(data);
                $('#communes').niceSelect('update');
            }

        });

        $.ajax({
			url: '/get-centers/'+name ,
			type: 'GET',

        success: function (center) {
                $.each(center, function(i, center) {
                    datacenter = datacenter + '<option value="'+ center.center_id+ '" >'+ center.name+ '</option>';
                });
                $('#centers').html(datacenter);
                $('#centers').niceSelect('update');
            }

        });
    });



    $( "#communes" ).change(function() {
        var wilaya = $('#wilayas').val();
        var commune = $(this).val();
        check = $('input[name="shipping"]:checked', '.shipping-type').val();
        /*
        var total_promo = '{{$total_promo}}';
         if(total_promo){
            var total = total_promo;
        }
        else{
            var total = '{{$total->sum}}';
        }*/
        var totalText = $('.total-price').text();
        var total = parseFloat(totalText.match(/[0-9,]+/)[0].replace(',', ''));

        var total_final;
       $.ajax({
			url: '/get-cost/'+wilaya+'/'+ commune ,
			type: 'GET',

        success: function (res) {
                $('#bureau-cost').html(res.price_b);
                $('#domicile-cost').html(res.price_a + res.supp);
                if(check == 'bureau'){
                    total_final = total + parseFloat(res.price_b);
                    $('.total-price').html(total_final +'Da');
                }
                if(check == 'domicile'){
                    total_final = total + parseFloat(res.price_a) + parseFloat(res.supp) ;
                    $('.total-price').html(total_final +'Da');
                }

            }

        });
    });

</script>
<script>



    $('.shipping-redio').on('click', function() {
      var wilaya = $('#wilayas').val();
      var commune = $('#communes').val();
      var totalText = $('.total-price').text();
      var total = parseFloat(totalText.match(/[0-9,]+/)[0].replace(',', ''));
      check = $('input[name="shipping"]:checked', '.shipping-type').val();
       /*
        var total_promo = '{{$total_promo}}';
         if(total_promo){
            var total = total_promo;
        }
        else{
            var total = '{{$total->sum}}';
        }*/
     $.ajax({
			url: '/get-cost/'+wilaya+'/'+ commune ,
			type: 'GET',

        success: function (res) {

                if(check == "bureau"){
                    total = total + res.price_b;
                    $('.total-price').text(total + ' Da');
                }
                if(check == "domicile"){
                    total = total + res.price_a + res.supp;
                    $('.total-price').text(total + ' Da');
                }

            }

        });

    });

    $('#coupon-btn').on('click', function() {
        var code_coupon = $('input[name=coupon]').val();
        var totalText = $('.total-price').text();
        var total_value = parseFloat(totalText.match(/[0-9,]+/)[0].replace(',', ''));
        var cart_id = $("tbody tr:first").data("cart-id");

        $.ajax({
			url: '/code-coupon/'+code_coupon +'/'+total_value+'/'+cart_id,
			type: 'GET',

        success: function (res) {
             if(res == 'error'){
                $('#show_error_msg').html('<div class="alert alert-danger flash-alert mt-2" id="form-danger" role="alert"> Code coupon invalide !</div>');
             }
             else{
                $('.total-price').text(res + ' Da');
             }
           }

        });

    });
    $( ".btn-submit" ).click(function(e) {
    if(terms.checked) {
     $(this).parents("form:first").submit();
    }
    else{
        e.preventDefault();
        $(".alert-condition").css("display", "block");
    }
});
</script>
@endpush
