@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url('/admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Commandes</a></li>
            </ol>
        </div>

        <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Table des commandes</h4>
                        <a href="{{url('/admin/orders/create')}}" type="button"  class="btn btn-primary mt-3">Ajouter</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Wilaya</th>
                                        <th>Adresse</th>
                                        <th>Téléphone</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$order->name}}</td>
                                            <td>{{ $order->wilaya }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->phone }}</td>
                                            @if($order->status == 0)
                                            <td><span class="badge badge-warning">En attente</span></td>
                                            @elseif($order->status == 1)
                                            <td><span class="badge badge-info">En cours de livraison</span></td>
                                            @elseif($order->status == 2)
                                            <td><span class="badge badge-success">Livré</span></td>
                                            @elseif($order->status == 3)
                                            <td><span class="badge badge-danger">Annulé</span></td>
                                            @else
                                            <td><span class="badge badge-primary">En attente de paiement</span></td>
                                            @endif
                                            <td>

                                                <div class="d-flex">
                                                    <button data-id="{{$order->id}}"class="btn btn-primary shadow btn-xs sharp mr-1 order-details"><i class="fas fa-eye"></i></button>
                                                    <a href="{{url('admin/orders/'.$order->id.'/edit')}}" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{url('admin/orders/'.$order->id)}}" method="post">
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

<div id="modal-order-details">

</div>
@endsection

@push('modal-order-details-scripts')
<script>
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(".order-details").click(function() {
  var id = $(this).data('id');
    $.ajax({
        url: '/order-details/'+id ,
        type: "GET",
        success: function (res) {
        $('#modal-order-details').html(res);
        $("#exampleModal").modal('show');
        }
    });

});
</script>
@endpush
