@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, Bienvenue!</h4>
                    <span>Categories</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/admin/category')}}">Categories</a></li>
                </ol>
            </div>
        </div>



        <!-- row -->
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">La table des catégories</h4>
                        <a href="{{url('/admin/categories/create')}}" type="button"  class="btn btn-primary mt-3">Ajouter</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Désignation</th>
                                    <th>Parent Categorie</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            @if(isset($categories))
                            <?php $_SESSION['i'] = 0; ?>
                            @foreach($categories as $category)
                                <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                                <tr id="{{$category->id}}">
                                    <?php $dash=''; ?>
                                    <td>{{$_SESSION['i']}}</td>
                                    <td>{{$category->designation}}</td>
                                    <td>
                                        @if(isset($category->parent_id))
                                            {{$category->childCategories->designation}}
                                        @else
                                        <i class="fa-solid fa-minus"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{url('admin/category/'.$category->id)}}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                        <div class="d-flex">
                                            <a href="{{url('admin/category/'.$category->id.'/edit')}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <button class="  btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
                                        </div>
                                        </form>
                                    </td>
                                 </tr>
                                 @if(count($category->childCategories))
                                     @include('sub-category-list',['subcategories' => $category->childCategories])
                                 @endif

                            @endforeach
                            <?php unset($_SESSION['i']); ?>
                             @endif
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
