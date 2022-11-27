@extends('layouts.dashboard-admin')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Modifier Attribut</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Modifier attribut</a></li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter attribut</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{url('admin/attributelines/'.$attributeline->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Attribut*:</label>
                                    <input type="text"  class="form-control input-default @error('attr') is-invalid @enderror" value="{{$attributeline->value}}" name="attr" placeholder="Attribut">
                                        @error('attr')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">

                                    <label>Type :</label>

                                    <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="type">
                                        <option value=0>Nothing selected</option>
                                            @foreach($attributes as $attr)
                                            <option value="{{$attr->id}}" @if( $attr->id == $attributeline->attribute_id ) selected @endif >{{$attr->value}}</option>
                                            @endforeach
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
