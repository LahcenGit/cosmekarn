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
        <form action="{{url('admin/pack-promo/'.$pack_promo->id)}}" method="POST" id="addProduct" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
        <div class="row ">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier pack promo</h4>
                    </div>
                    <div class="card-body">
                               <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Désignation* :</label>
                                        <input type="text"  class="form-control input-default "
                                          value="{{$pack_promo->designation}}" name="designation" id="designation" placeholder="designation" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Produits* :</label>
                                        <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="products[]" multiple>
                                            <option value=0>Nothing selected</option>
                                                @foreach($packlines as $packline)
                                                <option value="{{$packline->product_id}}"  selected  >{{$packline->product->designation}}</option>
                                                @endforeach
                                                @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->designation}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Prix:</label>
                                        <input type="text" class="form-control input-default control-number @error('price') is-invalid @enderror" value="{{$pack_promo->price}}" name="price" placeholder="0.00" required>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Prix promo* :</label>
                                        <input type="text"  class="form-control input-default control-number @error('price_promo') is-invalid @enderror" value="{{$pack_promo->price_promo}}" name="price_promo" placeholder="0.00" required>
                                            @error('price_promo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Qte* :</label>
                                        <input type="number"  class="form-control input-default control-number @error('qte') is-invalid @enderror" value="{{$pack_promo->qte}}" name="qte" placeholder="0">
                                            @error('qte')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Date debut* :</label>
                                        <input type="date" class="form-control input-default control-number @error('date_debut') is-invalid @enderror" value="{{$pack_promo->date_debut}}" name="date_debut" required>
                                            @error('date_debut')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date fin* :</label>
                                        <input type="date"  class="form-control input-default control-number @error('date_fin') is-invalid @enderror" value="{{$pack_promo->date_fin}}" name="date_fin"  required>
                                            @error('date_fin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Photo* :</label>
                                        <input type="file"  class="form-control input-default control-number @error('photo') is-invalid @enderror" value="{{$pack_promo->photo}}" name="photo"  required>
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Déscription* :</label>
                                        <textarea  class="form-control @error('description') is-invalid @enderror"  name="description" required>{{$pack_promo->description}}</textarea>
                                            @error('description')
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










