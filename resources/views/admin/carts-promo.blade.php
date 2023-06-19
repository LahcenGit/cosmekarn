@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, Bienvenue!</h4>
                    <span>Promos panier</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/admin/cart-promo')}}">Promos panier</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Promos panier</h4>
                        <a href="{{url('/admin/cart-promo/create')}}" type="button"  class="btn btn-primary mt-3">Ajouter</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Format</th>
                                        <th>Valeur</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carts_promo as $cart_promo)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>@if($cart_promo->type == 0) Implicite @else Explicite @endif</td>
                                            <td>@if($cart_promo->format == 0 ) Fix @else Pourcentage @endif</td>
                                            <td>{{$cart_promo->value }} </td>
                                            <td>{{$cart_promo->date_debut }}</td>
                                            <td>{{$cart_promo->date_fin }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @if($cart_promo->type == 1)
                                                    <a href="#" data-id="{{$cart_promo->id}}"class="btn btn-primary shadow btn-xs sharp mr-1 cart-details"><i class="fas fa-eye"></i></a>
                                                    @endif
                                                    <a href="{{url('admin/cart-promo/'.$cart_promo->id.'/edit')}}" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{url('admin/cart-promo/'.$cart_promo->id)}}" method="post">
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

<div id="modal-cart-details">

</div>
@endsection

@push('modal-cart-details-scripts')
<script>
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(".cart-details").click(function() {

  var id = $(this).data('id');
    $.ajax({
        url: '/cart-details/'+id ,
        type: "GET",
        success: function (res) {
        $('#modal-cart-details').html(res);
        $("#exampleModal2").modal('show');
        }
    });

});
</script>
@endpush
