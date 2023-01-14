@extends('layouts.dashboard-admin')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Modifier Commande</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Modifier commande</a></li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier commande</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{url('admin/orders/'.$order->id)}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                @csrf
                                <div class="form-group">
                                    <label>Client:</label>
                                    <input type="text"  class="form-control input-default " value="{{$order->name}}" name="name" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Wilaya:</label>
                                    <input type="text"  class="form-control input-default " value="{{$order->wilaya}}" name="wilaya" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Adresse:</label>
                                    <input type="text"  class="form-control input-default " value="{{$order->address}}" name="address" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Téléphone:</label>
                                    <input type="text"  class="form-control input-default " value="{{$order->phone}}" name="phone" disabled>
                                </div>
                                <div class="form-group">
                                 <label>Statut :</label>
                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="status">
                                       <option value="0" @if( $order->status == 0 ) selected @endif >En attente</option>
                                       <option value="1" @if( $order->status == 1 ) selected @endif >En cours de livraison</option>
                                       <option value="2" @if( $order->status == 2 ) selected @endif >Livré</option>
                                       <option value="3" @if( $order->status == 3 ) selected @endif >Annuler</option>
                                       <option value="4" @if( $order->status == 4 ) selected @endif >En attente de paiement</option>
                                    </select>
                                </div>
                                    <button type="submit"  class="btn btn-primary mt-3">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
