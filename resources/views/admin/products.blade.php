@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, Bienvenue!</h4>
                    <span>Produits</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/admin/orders')}}">Produits</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Les produits</h4>
                        <a href="{{url('/admin/products/create')}}" type="button"  class="btn btn-primary mt-3">Ajouter</a>

                    </div>
                    <div class="card-body">
                        <div style="margin-bottom: 20px;">

                            <label> Statut :</label>
                                <select id="statusFilter">
                                    <option value="" disabled selected>Séléctionnez...</option>
                                    <option value="4">Tous</option>
                                    <option value="1">Nouveau</option>
                                    <option value="2">Ancien stock</option>
                                    <option value="3">rupture</option>
                                    <option value="4">Prochainement</option>
                                </select>
                        </div>
                       <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Désignation</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        @if(optional($product->images->first())->lien)
                                            <td><img  width="35" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}"/></td>
                                        @else
                                            <td><img  width="35" src="{{asset('/product-cosmekarn.jpg')}}"/></td>
                                        @endif
                                        <td>{{$product->designation}}</td>
                                        @if($product->status == 1)
                                            <td><span class="badge badge-success">Nouveau</span></td>
                                            @elseif($product->status == 2)
                                            <td><span class="badge badge-info">Ancien stock</span></td>
                                            @elseif($product->status == 3)
                                            <td><span class="badge badge-danger">Rupture</span></td>
                                            @else
                                            <td><span class="badge badge-warning">Prochainement</span></td>
                                            @endif
                                        <td>
                                            <div class="d-flex">
                                                <a  href="{{url('product/'.$product->slug)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fas fa-eye"></i></a>
                                                <a  href="{{url('admin/products/'.$product->id.'/edit')}}" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{url('admin/products/'.$product->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
                                            </form>

                                            </div>
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

@push('filter-status')
<script>
    $(document).ready(function() {
        $('#statusFilter').change(function() {
            var status = $(this).val(); // Récupérer la valeur du statut sélectionné

            // Faire une requête Ajax pour récupérer les commandes filtrées
            $.ajax({
                url: '/products-filter',
                type: 'GET',
                data: { status: status },
                success: function(response) {
                    // Mettre à jour le contenu du tableau avec les nouvelles données
                    $('#example3 tbody').html(response);
                }
            });
        });
    });
</script>
@endpush
