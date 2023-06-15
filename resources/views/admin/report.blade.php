@extends('layouts.dashboard-admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
              <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0  printMe">
                <i class="btn-icon-prepend " data-feather="printer"></i>
                Imprimer
              </button>
            </div>
        </div>
    <div class="row mt-3">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body print-section" id="printable">

                    <div class="d-flex justify-content-between" >
                        <div >
                            <img src="{{asset('assets/images/logo-report.png')}}"> <br>
                            <p> <b>Site Web :</b>  www.cosmekarn.dz <br>
                                  <b>  Tél :</b> 0560 09 90 33
                                </p>

                        </div>

                        <div class="infos-client" style="width: 350px;">
                           Mois: <b>Juin</b> </p><br>
                        </div>

                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produit</th>
                                <th scope="col">Qte</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($report as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->designation}} {{ $item->value }}</td>
                                    <td>{{$item->total_qte}}</td>
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
@endsection
@push('order-detail-scripts')

<script>
$('.printMe').click(function(){
    $('#printable').printThis();
});
</script>

@endpush
