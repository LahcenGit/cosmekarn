@extends('layouts.dashboard-admin')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Pack promo</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Pack promo</a></li>
                </ol>
            </div>
        </div>
        <form action="{{url('admin/cart-promo/'.$cart_promo->id)}}" method="POST" id="addProduct" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="row ">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editer promo panier</h4>
                    </div>
                    <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Type* :</label>
                                    <select class="form-control select-type" id="sel1"  class="selectpicker" data-live-search="true" name="type" >
                                        <option value=0>Nothing selected</option>
                                        <option value="0" @if ($cart_promo->type == 0 ) selected @endif >Implicite</option>
                                        <option value="1" @if ($cart_promo->type == 1  ) selected @endif >Explicite</option>
                                    </select>
                                </div>
                                @if($cart_promo->type == 1)
                                <div class="form-group col-md-6 product" >
                                    <label>Produits* :</label>
                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="product[]" multiple>
                                        <option value="" disabled>Selectionner</option>
                                            @foreach($array as $line)
                                            <option value="{{$line->id}}"  selected >{{$line->designation}}</option>
                                            @endforeach

                                            @foreach($products as $product)
                                            <option value="{{$product->id}}" >{{$product->designation}}</option>
                                            @endforeach
                                    </select>
                                </div>

                                @endif
                                <div class="form-group col-md-6 product" style="display: none">
                                    <label>Produits* :</label>
                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="product[]" multiple>
                                        <option value="" disabled>Selectionner</option>
                                            @foreach($products as $product)
                                            <option value="{{$product->id}}" @if (old('product') == $product->id ) selected @endif >{{$product->designation}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Format:</label>
                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="format">
                                        <option >Nothing selected</option>
                                        <option value="0" @if ($cart_promo->format == 0 ) selected @endif >Fix</option>
                                        <option value="1" @if ($cart_promo->format == 1  ) selected @endif >Pourcentage</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Valeur* :</label>
                                    <input type="text"  class="form-control input-default control-number @error('value') is-invalid @enderror" value="{{$cart_promo->value}}" name="value" placeholder="0" required>
                                        @error('value')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Montant panier* :</label>
                                    <input type="text" id="mt-panier"  class="form-control input-default control-number @error('mt_panier') is-invalid @enderror" value="{{$cart_promo->mt_panier}}" name="mt_panier" placeholder="0" >
                                        @error('mt_panier')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Date debut* :</label>
                                    <input type="date" class="form-control input-default control-number @error('date_debut') is-invalid @enderror" value="{{$cart_promo->date_debut}}" name="date_debut" required>
                                        @error('date_debut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date fin* :</label>
                                    <input type="date"  class="form-control input-default control-number @error('date_fin') is-invalid @enderror" value="{{$cart_promo->date_fin}}" name="date_fin"  required>
                                        @error('date_fin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                            </div>
                             <button type="submit"  class="btn btn-primary mt-3">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection


@push('select-type-scripts')
<script>
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(".select-type").change(function() {

  var type = $(this).val();
  var inputField = $('#mt-panier');
  if(type == 1){
    $(".product").css({display: "block"});

    // Add the "required" attribute
    inputField.prop('required', true);
  }
  else{
    $(".product").css({display: "none"});
    inputField.prop('required', false);
  }


});
</script>
@endpush







