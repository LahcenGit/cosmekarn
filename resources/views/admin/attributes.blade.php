@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url('/admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Attributs</a></li>
            </ol>
        </div>
        @if($message)
        <div class="container mt-4 ">
            <div class="alert alert-success alert-dismissible fade show flash-alert" style="background-color:#60348B; border-color:#60348B; color:#fff; font-size: 14px;" role="alert">
            <strong> {{ $message }} <i class="fa-solid fa-face-smile"></i></strong>
            </div>
        </div>
       @endif

        <div class="row">
            <div class="col-xl-5 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter attribut</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{url('admin/attributes')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Attribut*:</label>
                                    <input type="text"  class="form-control input-default @error('attr') is-invalid @enderror" value="{{old('attr')}}" name="attr" placeholder="Attribut">
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
                                            @foreach($attributes as $attribute)
                                            @if($value)
                                            <option value="{{$attribute->id}}" @if ($value == $attribute->id ) selected @endif >{{$attribute->value}}</option>
                                            @else
                                            <option value="{{$attribute->id}}" @if (old('attribute') == $attribute->id ) selected @endif >{{$attribute->value}}</option>
                                            @endif
                                            @endforeach
                                    </select>
                                </div>
                                    <button type="submit"  class="btn btn-primary mt-3">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Table des attributs</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Attribut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attributes as $attr)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$attr->value}}</td>

                                        <td>
                                            <form action="{{url('admin/attributes/'.$attr->id)}}" method="post">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                            <div class="d-flex">
                                                <a href="{{url('admin/attributes/'.$attr->id.'/edit')}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
                                            </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @foreach($attributelines as $attributeline)
                                        @if($attributeline->attribute_id == $attr->id)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>--{{$attributeline->value}}</td>
                                                <td>
                                                    <form action="{{url('admin/attributelines/'.$attributeline->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                    <div class="d-flex">
                                                        <a href="{{url('admin/attributelines/'.$attributeline->id.'/edit')}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
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

@endsection
