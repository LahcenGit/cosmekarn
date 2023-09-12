@extends('layouts.dashboard-admin')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, Bienvenue!</h4>
                    <span>Codes coupons</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/admin/coupons')}}">Codes coupons</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Les codes coupons</h4>
                            <a href="{{url('/admin/coupons/create')}}" type="button"  class="btn btn-primary mt-3">Ajouter</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Valeur</th>
                                            <th>Date d'éxpiration</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coupons as $coupon)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$coupon->code}}</td>
                                                <td>@if($coupon->type == 0) Fix @else pourcentage @endif</td>
                                                <td>{{$coupon->value}}</td>
                                                <td>{{$coupon->expiration_date}}</td>
                                                <td>
                                                    <form action="" method="post">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                    <div class="d-flex">
                                                        <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


