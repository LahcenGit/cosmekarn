@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, Bienvenue!</h4>
                    <span>Commandes</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/admin/orders')}}">Commandes</a></li>
                </ol>
            </div>
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
                                        <th>Méthode de paiement</th>
                                        <th>Code Tracking</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$order->first_name}} {{ $order->last_name }}</td>
                                            <td>{{ $order->wilaya }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->tracking_code }}</td>
                                            @if($order->status == 0)
                                            <td><span class="badge badge-warning">En attente</span></td>
                                            @elseif($order->status == 1)
                                            <td><span class="badge badge-info">Livraison...</span></td>
                                            @elseif($order->status == 2)
                                            <td><span class="badge badge-success">Livré</span></td>
                                            @elseif($order->status == 3)
                                            <td><span class="badge badge-danger">Annulé</span></td>
                                            @else
                                            <td><span class="badge badge-primary">En attente de paiement</span></td>
                                            @endif
                                            <td>

                                                <div class="d-flex">
                                                    <a href="{{ asset('admin/order-detail/'.$order->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1 order-details"><i class="fas fa-eye"></i></a>
                                                    <button data-id="{{ $order->id }}" class="btn btn-success shadow btn-xs sharp mr-1 add-odrer-to-yalidine"><i class="fas fa-plus"></i></button>
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

<div id="modal-add-order">

</div>
@endsection

@push('modal-add-order-scripts')
<script>
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(".add-odrer-to-yalidine").click(function() {
  var id = $(this).data('id');
 $.ajax({
        url: '/add-order-to-yalidine/'+id ,
        type: "GET",
        success: function (res) {
        $('#modal-add-order').html(res);
        $("#orderModal").modal('show');
        }
    });

});

$("#modal-add-order").on('change','#wilaya',function(e){
        var name = $(this).val();
        var data ="";
        $.ajax({
			url: '/admin/get-communes/'+name ,
			type: 'GET',

        success: function (res) {

                $.each(res, function(i, res) {
                    data = data + '<option value="'+ res+ '" >'+ res+ '</option>';
                });
                $('#commune').html(data);
                $('#commune').selectpicker('refresh');
            }

        });
    });




$("#modal-add-order").on('click','.storeOrder',function(e){
   e.preventDefault();
   var id = $('#order').val();
   alert(id);
   $.ajax({
     url: '/store-parcel/'+id,
     type:"GET",
     success:function(response){

       $('#orderModal').modal('hide');

       console.log(response);
       location.reload();
     }

     });

});
</script>
@endpush
