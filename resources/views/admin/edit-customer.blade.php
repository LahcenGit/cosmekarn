@extends('layouts.dashboard-admin')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Client</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Client</a></li>
                </ol>
            </div>
        </div>
        <form action="{{url('admin/customers/'.$user->id)}}" method="POST" id="addProduct" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
        <div class="row ">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier client</h4>
                    </div>
                    <div class="card-body">
                               <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nom complet* :</label>
                                        <input type="text"  class="form-control input-default "
                                          value="{{$user->name}}" name="name" id="name" placeholder="designation" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Email:</label>
                                        <input type="text" class="form-control input-default" value="{{$user->email}}" name="email"  required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Téléphone* :</label>
                                        <input type="text"  class="form-control input-default control-number" value="{{$user->phone}}" name="phone"  required>

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Wilaya :</label>
                                        <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="wilaya" >
                                            <option  disabled selected>selectionner...</option>
                                            @foreach($wilayas as $wilaya)
                                            <option value="{{$wilaya->name}}"@if($user->wilaya == $wilaya->name) selected @endif>{{$wilaya->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Adresse :</label>
                                        <input type="text"  class="form-control input-default control-number" value="{{$user->address}}" name="address">
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










