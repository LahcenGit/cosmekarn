@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, Bienvenue!</h4>
                    <span>Packs promo</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/admin/pack-promo')}}">Packs promo</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Table des packs promo</h4>
                        <a href="{{url('/admin/pack-promo/create')}}" type="button"  class="btn btn-primary mt-3">Ajouter</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Designation</th>
                                        <th>Prix</th>
                                        <th>Prix promo</th>
                                        <th>Qte</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packs_promo as $pack_promo)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$pack_promo->designation}}</td>
                                            <td>{{$pack_promo->price }} Da</td>
                                            <td>{{$pack_promo->price_promo }} Da</td>
                                            <td>{{$pack_promo->qte }}</td>
                                            <td>{{$pack_promo->date_debut }}</td>
                                            <td>{{$pack_promo->date_fin }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" data-id="{{$pack_promo->id}}"class="btn btn-primary shadow btn-xs sharp mr-1 pack-details"><i class="fas fa-eye"></i></a>
                                                    <a href="{{url('admin/pack-promo/'.$pack_promo->id.'/edit')}}" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{url('admin/pack-promo/'.$pack_promo->id)}}" method="post">
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

<div id="modal-pack-details">

</div>
@endsection

@push('modal-pack-details-scripts')
<script>
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(".pack-details").click(function() {

  var id = $(this).data('id');
    $.ajax({
        url: '/pack-details/'+id ,
        type: "GET",
        success: function (res) {
        $('#modal-pack-details').html(res);
        $("#exampleModal1").modal('show');
        }
    });

});
</script>
@endpush
