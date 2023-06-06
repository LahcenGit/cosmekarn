@extends('layouts.dashboard-admin')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Ajouter une commande</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Ajouter commande</a></li>
                </ol>
            </div>
        </div>
       <form action="{{url('/admin/add-order-step-two')}}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="row ">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter commande</h4>
                    </div>
                    <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select name="professional" id="select-pro" title="selectionner un client..."  data-live-search="true"  class="selectpicker form-control">
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}"> {{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                       <a href="#" class="btn btn-primary btn-sm"> Ajouter client </a>
                                    </div>
                                    <div class="form-group col-md-4">
                                       <b> Information sur le client :</b> <br>
                                       <span id="pro-entreprise">... </span> ,  <span id="pro-type">...</span>
                                    </div>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-4">
                                        <select name="wilaya" id="wilaya" title="selectionner la wilaya..."  data-live-search="true"  class="selectpicker form-control">
                                            @foreach($wilayas as $wilaya)
                                                <option value="{{$wilaya->wilaya}}"> {{$wilaya->wilaya}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="commune" id="commune" title="selectionner la commune..."  data-live-search="true"  class="selectpicker form-control">

                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="center" id="center" title="selectionner le centre de livraison..."  data-live-search="true"  class="selectpicker form-control">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="col-md-6 mt-2">
                                        <label>Livraison :</label> <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shipping" id="inlineRadio1" value="bureau" checked  >
                                            <label class="form-check-label" for="inlineRadio1">Au bureau</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="shipping" id="inlineRadio2" value="domicile" >
                                            <label class="form-check-label" for="inlineRadio2">A domicile</label>
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
                        <h4 class="card-title">Détails de commande </h4>
                    </div>

                    <div class="card-body " id="variation" >
                       <div class="basic-form d-flex justify-content-center" >
                            <div class="col-md-8">
                                <table id="tblattribute" class="table table-bordered mt-3 ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Produit - attribut</th>
                                            <th scope="col">Qte</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamicAddRemove" >
                                            <tr>
                                                <td style="width: 30%">
                                                    <div class="input-group">
                                                        <select name="product[]" id="select-product" title="produit..."  data-size="5" data-live-search="true"  class="selectpicker form-control">
                                                            @foreach ($productlines as $line)
                                                              <option value="{{$line->id}}">{{$line->product->designation }}  &nbsp;&nbsp;   @if($line->attributeLine){{$line->attributeLine->value}}@endif </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </td>

                                                <td  style="width: 10%">
                                                    <div class="input-group">
                                                       <input type="number" value="1" class="form-control" name='qte[]'>
                                                    </div>
                                                </td >

                                                <td style="width: 5%">
                                                    <button type="button" id="add-productline" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-plus"></i></button>
                                                </td>
                                            </tr>
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
                    <button type="submit" class="btn btn-primary mt-3">Voir Détails</button>
                    </form>
                </div>
               </div>
            </div>
        </div>
        </form>
    </div>
</div>

<div id="modal-add-attribute">
</div>

@endsection

@push('add-order-script')

<script>
    $( "#wilaya" ).change(function() {

        var name = $(this).val();
        var data ="";
        var datacenter ="";
        $.ajax({
			url: '/get-communes/'+name ,
			type: 'GET',

        success: function (res) {

                $.each(res, function(i, res) {
                    data = data + '<option value="'+ res.commune+ '" >'+ res.commune+ '</option>';
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
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });


	$("#select-product").change(function() {

		var id = $(this).val();
		var data ="";

		$.ajax({
			url: '/get-dimension/' + id,
			type: "GET",

			success: function (res) {

				$.each(res, function(i, res) {
				data = data + '<option value="'+ res.id+ '" >'+ res.value + '</option>';
				});

				$('#select-value').html(data);
				$('#select-value').niceSelect('update');
				$('#select-value').niceSelect('update');

			}
		});

	});
  $("#select-pro").change(function() {

		var id = $(this).val();

		$.ajax({
			url: '/admin/get-pro-info/' + id,
			type: "GET",

			success: function (res) {

				$('#pro-entreprise').html(res.entreprise);
				$('#pro-type').html("prix : " + res.price_type);

			}
		});

	});


</script>


<script type="text/javascript">
   $(document).on('click', '#add-productline', function (){

        var data = $('#select-product').html();
        $html = '<tr class="tradded">'+
                 '<td style="width: 30%">'+
                    '<div class="input-group">'+
                       ' <select name="product[]" title="produit..."  data-live-search="true"  class="selectpicker form-control">'+
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
                       ' <button type="button" class="btn btn-danger shadow btn-xs sharp delete-product"><i class="fa fa-trash"></i></button>'+
                    '</td>'+
                '</tr>';

        $("#dynamicAddRemove").append($html);


        $('.selectpicker').selectpicker('refresh');

        $(document).on('click', '.delete-product', function () {
        $(this).parents('tr').remove();
        });
    });
</script>
@endpush



