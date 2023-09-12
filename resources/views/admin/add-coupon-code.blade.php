@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Ajouter Code Coupon</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Ajouter code coupon</a></li>
                </ol>
            </div>
        </div>
        <form action="{{url('admin/coupons')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row ">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ajouter un nouveau code coupon</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                               <div class="form-group">
                                    <label>Code coupon*:</label>
                                    <input type="text"  class="form-control input-default @error('code') is-invalid @enderror" value="{{old('code')}}" name="code" placeholder="code coupon">
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-block">
                            <h4 class="card-title">Données du code coupon</h4>
                        </div>
                        <div class="card-body">
                            <div id="accordion-four" class="accordion accordion-no-gutter accordion-bordered">
                                <div class="accordion__item">
                                    <div class="accordion__header" data-toggle="collapse" data-target="#bordered_no-gutter_collapseOne">
                                        <span class="accordion__header--text">Général</span>
                                        <span class="accordion__header--indicator style_two"></span>
                                    </div>
                                    <div id="bordered_no-gutter_collapseOne" class="collapse accordion__body show" data-parent="#accordion-four">
                                        <div class="accordion__body--text">

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Type de remise</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="type" required>
                                                        <option value="" disabled selected>Selectionner...</option>
                                                        <option value="0" @if (old('type') == 0 ) selected @endif >Fix</option>
                                                        <option value="1" @if (old('type') == 1  ) selected @endif >Pourcentage</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Valeur du code coupon</label>
                                                <div class="col-sm-9">
                                                    <input type="text"  class="form-control input-default @error('value') is-invalid @enderror" value="{{old('value')}}" name="value" placeholder="0">
                                                        @error('value')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">Autoriser la livraison gratuite</div>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="free_delivery" value="1">
                                                        <label class="form-check-label">
                                                            Cocher cette case si le code promo inclut la livraison gratuite.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date d'éxpiration du code</label>
                                                <div class="col-sm-9">
                                                    <input type="date"  class="form-control input-default @error('expiration_date') is-invalid @enderror" value="{{old('expiration_date')}}" name="expiration_date" >
                                                        @error('expiration_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion__item">
                                    <div class="accordion__header collapsed" data-toggle="collapse" data-target="#bordered_no-gutter_collapseTwo">
                                        <span class="accordion__header--text">Restriction d'usage</span>
                                        <span class="accordion__header--indicator style_two"></span>
                                    </div>
                                    <div id="bordered_no-gutter_collapseTwo" class="collapse accordion__body" data-parent="#accordion-four">
                                        <div class="accordion__body--text">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Dépense minimale </label>
                                                <div class="col-sm-9">
                                                    <input type="text"  class="form-control input-default @error('minimum_spend') is-invalid @enderror" value="{{old('minimum_spend')}}" name="minimum_spend" placeholder="dépense minimale">
                                                        @error('minimum_spend')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Dépense maximum </label>
                                                <div class="col-sm-9">
                                                    <input type="text"  class="form-control input-default @error('maximum_spend') is-invalid @enderror" value="{{old('maximum_spend')}}" name="maximum_spend" placeholder="dépense maximum">
                                                        @error('maximum_spend')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Produits</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="products[]" multiple>
                                                        <option value="" disabled >Selectionner...</option>
                                                        @foreach($products as $product)
                                                         <option value={{ $product->id }}>{{ $product->designation }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Exclure le produits</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="exclude_products[]" multiple>
                                                        <option value="" disabled >Selectionner...</option>
                                                        @foreach($products as $product)
                                                         <option value={{ $product->id }}>{{ $product->designation }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Catégories</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="categories[]" multiple>
                                                        <option value="" disabled >Selectionner...</option>
                                                        @foreach($categories as $category)
                                                            @if($value)
                                                                <option value="{{$category->id}}" @if ($value == $category->id ) selected @endif >{{$category->designation}}</option>
                                                                @foreach($category->childCategories as $sub)

                                                                <option  value="{{$sub->id}}" @if ($value == $sub->id ) selected @endif> &nbsp &nbsp{{$sub->designation}}</option>
                                                                @foreach($sub->childCategories as $subsub)
                                                                    <option value="{{$subsub->id}}"  @if ($value == $subsub->id ) selected @endif>  &nbsp  &nbsp  &nbsp &nbsp{{$subsub->designation}}</option>


                                                                @foreach($subsub->childCategories as $subsubsub)
                                                                <option value="{{$subsubsub->id}}"  @if ($value == $subsubsub->id ) selected @endif>  &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp{{$subsubsub->designation}}</option>
                                                                @endforeach
                                                                @endforeach
                                                                @endforeach
                                                            @else
                                                                <option value="{{$category->id}}" @if (old('category') == $category->id ) selected @endif >{{$category->designation}}</option>
                                                                @foreach($category->childCategories as $sub)

                                                                <option  value="{{$sub->id}}" @if (old('category') == $sub->id ) selected @endif> &nbsp &nbsp{{$sub->designation}}</option>
                                                                @foreach($sub->childCategories as $subsub)
                                                                    <option value="{{$subsub->id}}"  @if (old('category') == $subsub->id ) selected @endif>  &nbsp  &nbsp  &nbsp &nbsp{{$subsub->designation}}</option>
                                                                @foreach($subsub->childCategories as $subsubsub)
                                                                <option value="{{$subsubsub->id}}"  @if (old('category') == $subsubsub->id ) selected @endif>  &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp{{$subsubsub->designation}}</option>
                                                                @endforeach
                                                                @endforeach
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Exclure le catégories</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="exclude_categories[]" multiple>
                                                        <option value="" disabled >Selectionner...</option>
                                                        @foreach($categories as $category)
                                                            @if($value)
                                                                <option value="{{$category->id}}" @if ($value == $category->id ) selected @endif >{{$category->designation}}</option>
                                                                @foreach($category->childCategories as $sub)

                                                                <option  value="{{$sub->id}}" @if ($value == $sub->id ) selected @endif> &nbsp &nbsp{{$sub->designation}}</option>
                                                                @foreach($sub->childCategories as $subsub)
                                                                    <option value="{{$subsub->id}}"  @if ($value == $subsub->id ) selected @endif>  &nbsp  &nbsp  &nbsp &nbsp{{$subsub->designation}}</option>


                                                                @foreach($subsub->childCategories as $subsubsub)
                                                                <option value="{{$subsubsub->id}}"  @if ($value == $subsubsub->id ) selected @endif>  &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp{{$subsubsub->designation}}</option>
                                                                @endforeach
                                                                @endforeach
                                                                @endforeach
                                                            @else
                                                                <option value="{{$category->id}}" @if (old('category') == $category->id ) selected @endif >{{$category->designation}}</option>
                                                                @foreach($category->childCategories as $sub)

                                                                <option  value="{{$sub->id}}" @if (old('category') == $sub->id ) selected @endif> &nbsp &nbsp{{$sub->designation}}</option>
                                                                @foreach($sub->childCategories as $subsub)
                                                                    <option value="{{$subsub->id}}"  @if (old('category') == $subsub->id ) selected @endif>  &nbsp  &nbsp  &nbsp &nbsp{{$subsub->designation}}</option>
                                                                @foreach($subsub->childCategories as $subsubsub)
                                                                <option value="{{$subsubsub->id}}"  @if (old('category') == $subsubsub->id ) selected @endif>  &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp{{$subsubsub->designation}}</option>
                                                                @endforeach
                                                                @endforeach
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion__item">
                                    <div class="accordion__header collapsed" data-toggle="collapse" data-target="#bordered_no-gutter_collapseThree">
                                        <span class="accordion__header--text">Limite d'utilisation</span>
                                        <span class="accordion__header--indicator style_two"></span>
                                    </div>
                                    <div id="bordered_no-gutter_collapseThree" class="collapse accordion__body" data-parent="#accordion-four">
                                        <div class="accordion__body--text">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Limite d'utilisation par code </label>
                                                <div class="col-sm-9">
                                                    <input type="number"  class="form-control input-default @error('usage_limit_code') is-invalid @enderror" value="{{old('usage_limit_code')}}" name="usage_limit_code" placeholder="Utilisation ilimitée">
                                                        @error('usage_limit_code')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-primary mt-3">Ajouter le code coupon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
