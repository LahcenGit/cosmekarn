@extends('layouts.dashboard-admin')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Modifier Commande</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Modifier commande</a></li>
                </ol>
            </div>
        </div>
        <form action="{{url('admin/orders/'.$order->id)}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
        <div class="row ">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Détail client</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">


                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Nom*:</label>
                                        <input type="text"  class="form-control input-default " value="{{ $order->first_name }}" name="first_name"  >
                                    </div>
                                    <div class="col-md-6">
                                        <label>Prenom*:</label>
                                        <input type="text"  class="form-control input-default " value="{{ $order->last_name }}" name="last_name" >
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="col-md-6 mt-2">
                                        <label>Téléphone*:</label>
                                        <input type="text"  class="form-control input-default " value="{{ $order->phone }}" name="phone" >
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label>Adresse*:</label>
                                        <input type="text"  class="form-control input-default " value="{{ $order->address }}" name="address" >
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="col-md-6 mt-2">
                                        <label>Wilaya*:</label>
                                        <select class="form-control" id="wilayas"  class="selectpicker" data-live-search="true" name="wilaya">
                                            @foreach($wilayas as $wilaya)
                                            <option value="{{ $wilaya->wilaya }}" @if($order->wilaya == $wilaya->wilaya) selected @endif>{{ $wilaya->wilaya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label>Commune*:</label>
                                        <select class="form-control" id="commune"  class="selectpicker" data-live-search="true" name="commune">
                                            @foreach($communes as $commune)
                                            <option value="{{ $commune }}" @if($order->wilaya == $commune) selected @endif>{{ $commune }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                  </div>


                                  <div class="form-row">
                                    <div class="col-md-6 mt-2">
                                        <label>Centres *:</label>
                                        <select class="form-control"  class="selectpicker" data-live-search="true" id="center" name="center" >
                                            @foreach($centers  as $center)
                                            <option value="{{ $center->center_id }}" @if($center->center_id == $order->stopdesk_id) selected @endif>{{ $center->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label>Livraison :</label> <br>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shipping" id="inlineRadio1" value="bureau" @if($order->is_stopdesk) checked  @endif>
                                            <label class="form-check-label" for="inlineRadio1">Au bureau</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shipping" id="inlineRadio2" value="domicile" @if($order->is_stopdesk == NULL)  checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">A domicile</label>
                                          </div>
                                    </div>
                                 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Détail commande </h4>
                    </div>

                    <div class="card-body " id="variation" >
                       <div class="basic-form d-flex justify-content-center" >
                            <div class="col-md-8">
                                <table id="tblattribute" class="table table-bordered mt-3 ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Produit - attribut   </th>
                                            <th scope="col">Qte</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamicAddRemove" >
                                        @foreach($orderlines as $orderline)
                                            <tr>
                                                <td style="width: 30%">
                                                    <div class="input-group">
                                                        <select name="products[]" id="select-product" title="produit..."  data-size="5" data-live-search="true"  class="selectpicker form-control">
                                                            @foreach ($products as $line)
                                                            <option value="{{$line->id}}" @if($orderline->productline_id == $line->id) selected @endif>{{$line->product->designation }} &nbsp; - &nbsp; @if($line->attributeLine){{ $line->attributeLine->value }} @endif</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </td>

                                                <td  style="width: 10%">
                                                    <div class="input-group">
                                                       <input type="number" value="{{ $orderline->qte }}" class="form-control" name='qte[]'>
                                                    </div>
                                                </td >
                                                @if($loop->first)
                                                <td style="width: 5%">
                                                    <button type="button" id="add-product" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-plus"></i></button>
                                                </td>

                                                @else
                                                <td>
                                                    <button type="button" class="btn btn-danger shadow btn-xs sharp delete-line"><i class="fa fa-trash"></i></button>
                                                 </td>
                                                @endif
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
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                    </form>
                </div>
               </div>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
@push('get-commune-script')
<script>
    $("#wilayas").on('change',function(e){
        var name = $(this).val();
        var data ="";
        var datacenter ="";
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
        $.ajax({
			url: '/get-centers/'+name ,
			type: 'GET',

        success: function (center) {
                $.each(center, function(i, center) {
                    datacenter = datacenter + '<option value="'+ center.center_id+ '" >'+ center.name+ '</option>';
                });
                $('#center').html(datacenter);
                $('#center').selectpicker('refresh');
            }

        });
    });
</script>

<script type="text/javascript">

$(document).on('click', '#add-product', function (){

        var data = $('#select-product').html();
        $html = '<tr class="tradded">'+
                 '<td style="width: 30%">'+
                    '<div class="input-group">'+
                       ' <select name="products[]" title="produit..."  data-live-search="true"  class="selectpicker form-control">'+
                           data +
                        '</select>'+
                    '</div>'+
                '</td>'+

               ' <td  style="width: 10%">'+
                    '<div class="input-group">'+
                        '<input type="number" value="1" class="form-control" name="qte[]">'+
                    '</div>'+
                '</td >'+
                    '<td>'+
                       ' <button type="button" class="btn btn-danger shadow btn-xs sharp delete-line"><i class="fa fa-trash"></i></button>'+
                    '</td>'+
                '</tr>';

        $("#dynamicAddRemove").append($html);


        $('.selectpicker').selectpicker('refresh');

        $(document).on('click', '.delete-line', function () {
        $(this).parents('tr').remove();
        });
    });
    $(document).on('click', '.delete-line', function () {
        $(this).parents('tr').remove();
        });
</script>
@endpush
