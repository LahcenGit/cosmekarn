@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, Bienvenue!</h4>
                    <span>Slider</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/admin/sliders')}}">Slider</a></li>
                </ol>
            </div>
        </div>
        @if($message)
            <div class="container mt-4 ">
                <div class="alert alert-success alert-dismissible fade show flash-alert" style="background-color:#60348B; border-color:#60348B; color:#fff; font-size: 14px;" role="alert">
                <strong> {{ $message }} <i class="fa-solid fa-face-smile"></i></strong>
                </div>
            </div>
        @endif
        <!-- row -->
        <div class="row ">
            <div class="col-xl-5 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter slider</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{url('admin/sliders')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Photo*:</label>
                                    <input type="file"  class="form-control input-default" name="photo" required>
                                </div>
                                <div class="form-group">
                                    <label>Titre*:</label>
                                    <input type="text"  class="form-control input-default" value="{{old('title')}}" name="title" placeholder="titre" required>
                                </div>
                                <div class="form-group">
                                    <label>déscription*:</label>
                                    <textarea type="text"  class="form-control input-default" name="description" placeholder="..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Valeur du bouton*:</label>
                                    <input type="text" class="form-control input-default" name="button_value" placeholder="valeur du bouton" required>
                                </div>
                                <div class="form-group">
                                    <label>Flag*:</label>
                                    <input type="text" class="form-control input-default" name="flag" placeholder="flag" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Emplacement de déscription*:</label>
                                    <label class="radio-inline mr-3"><input type="radio" name="text" value="0"> À droite</label>
                                    <label class="radio-inline mr-3"><input type="radio" name="text" value="1"> À gauche</label>
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
                        <h4 class="card-title">Les marques</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>Déscription</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$slider->title}}</td>
                                            <td>{{$slider->description}}</td>
                                            <td>
                                                <form action="{{url('admin/sliders/'.$slider->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                <div class="d-flex">
                                                    <a href="{{url('admin/sliders/'.$slider->id.'/edit')}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                    <button class="  btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
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
@endsection
