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
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
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
                                            <input type="text" name="coupon" placeholder="Entrer votre code" />
                                            <button type="button" id="coupon-btn" class="btn btn-sqr">Valider</button>
                                        </div>
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
                                    <select name="country" class="nice-select" id="country">
                                        @foreach ($wilayas as $wilaya)
                                        <option value="{{$wilaya->name}}">{{$wilaya->name}}</option>

                                        @endforeach

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
                        <h5 class="checkout-title">Détails de lacommande</h5>
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
                                            <tr>
                                                <td><a href="product-details.html">{{ $cartitem->productline->product->designation }}<strong> × {{ $cartitem->qte }}</strong></a>
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

                                        @if($type_promo )
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
                                                            <input type="radio" id="bureau" name="shipping" value="400" class="custom-control-input shipping-redio" checked />
                                                            <label class="custom-control-label" for="bureau">bureau : 400 da</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="domicile" value="700" name="shipping" class="custom-control-input shipping-redio" />
                                                            <label class="custom-control-label" for="domicile">à domicile : 700 da</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total </td>
                                            
                                            @if($total_promo)
                                            <td><b class="total-price">{{number_format($total_promo->sum + 400) }} Da</b></td>
                                            @else
                                            <td><b class="total-price">{{number_format($total->sum + 400) }} Da</b></td>
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

    $('.shipping-redio').on('click', function() {
      var value =  $(this).val();
      var total = '{{$total->sum}}';

      total = parseInt(total);
      value = parseInt(value);

      value = value + total;
      $('.total-price').text(value + ' Da');
    });

    $('#coupon-btn').on('click', function() {
        if($('input[name=coupon]').val() == 'cosmekarn100'){
            $('.total-price').text(100 + ' Da');
        }
        else{
            alert('coupon incorrect');
        }

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
