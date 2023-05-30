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
        <form action="{{url('admin/pack-promo')}}" method="POST" id="addProduct" enctype="multipart/form-data">
        @csrf
        <div class="row ">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter pack promo</h4>
                    </div>
                    <div class="card-body">
                               <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Désignation* :</label>
                                        <input type="text"  class="form-control input-default "
                                          value="{{old('designation')}}" name="designation" id="designation" placeholder="designation" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Produits* :</label>
                                        <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="products[]" multiple>
                                            <option value=0>Nothing selected</option>
                                                @foreach($products as $product)
                                                <option value="{{$product->id}}" @if (old('product') == $product->id ) selected @endif >{{$product->designation}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Prix:</label>
                                        <input type="text" class="form-control input-default control-number @error('price') is-invalid @enderror" value="{{old('price')}}" name="price" placeholder="0.00" required>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Prix promo* :</label>
                                        <input type="text"  class="form-control input-default control-number @error('price_promo') is-invalid @enderror" value="{{old('price_promo')}}" name="price_promo" placeholder="0.00" required>
                                            @error('price_promo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Qte* :</label>
                                        <input type="number"  class="form-control input-default control-number @error('qte') is-invalid @enderror" value="{{old('qte')}}" name="qte" placeholder="0">
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
                                        <input type="date" class="form-control input-default control-number @error('date_debut') is-invalid @enderror" value="{{old('date_debut')}}" name="date_debut" required>
                                            @error('date_debut')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date fin* :</label>
                                        <input type="date"  class="form-control input-default control-number @error('date_fin') is-invalid @enderror" value="{{old('date_fin')}}" name="date_fin"  required>
                                            @error('date_fin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Photo* :</label>
                                        <input type="file"  class="form-control input-default control-number @error('photo') is-invalid @enderror" value="{{old('photo')}}" name="photo"  required>
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Déscription courte :</label>
                                        <textarea  class="form-control @error('short_description') is-invalid @enderror" value="{{old('short_description')}}" name="short_description" ></textarea>
                                            @error('short_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Déscription* :</label>
                                        <textarea  class="summernote form-control @error('description') is-invalid @enderror" value="{{old('description')}}" name="description" ></textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>

                                <button type="submit"  class="btn btn-primary mt-3">Ajouter</button>

                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>



@endsection










