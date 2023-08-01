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
                    <li class="breadcrumb-item active"><a href="{{url('/admin/categories')}}">Categories</a></li>
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
                        <h4 class="card-title">Les catégorie</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{url('admin/categories')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Désignation*:</label>
                                    <input type="text"  class="form-control input-default @error('designation') is-invalid @enderror" value="{{old('designation')}}" name="designation" placeholder="designation">
                                        @error('designation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">

                                    <label>Liste des catégories :</label>

                                    <select class="form-control  @error('category') is-invalid @enderror" id="sel1"  class="selectpicker" data-live-search="true" name="category">

                                        <option value=0>Nothing selected</option>

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

                                <div class="form-group">
                                    <label >Description : </label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
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
                        <h4 class="card-title">La table des catégories</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example3" class="display" >
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
                                        <form action="{{url('admin/categories/'.$category->id)}}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                        <div class="d-flex">
                                            <a href="{{url('admin/categories/'.$category->id.'/edit')}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
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
