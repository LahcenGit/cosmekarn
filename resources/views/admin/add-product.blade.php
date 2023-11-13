@extends('layouts.dashboard-admin')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Ajouter Produit</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Ajouter produit</a></li>
                </ol>
            </div>
        </div>

        <form action="{{url('admin/products')}}" method="POST" id="addProduct" enctype="multipart/form-data">
        @csrf

        <div class="row ">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter produit</h4>
                    </div>
                    <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Désignation*:</label>
                                        <input type="text"  class="form-control input-default "
                                          value="{{old('designation')}}" name="designation" id="designation" placeholder="designation" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Qte:</label>
                                        <input type="number"  class="form-control input-default control-number @error('qte') is-invalid @enderror" value="{{old('qte')}}" min="0" name="qte" placeholder="0">
                                            @error('qte')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Prix:</label>
                                        <input type="text" class="form-control input-default control-number @error('price') is-invalid @enderror" value="{{old('price')}}" name="price" placeholder="0.00">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Promo:</label>
                                        <input type="text"  class="form-control input-default control-number @error('promo') is-invalid @enderror" value="{{old('promo')}}" name="promo" placeholder="0.00">
                                            @error('promo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Variation :</label>
                                            <select  id="select-content-individuel"  class="default-select form-control wide selectpicker"   name="variation" >
                                                <option value="0"> Sans variation</option>
                                                @foreach($attributes as $a)
                                                <option value="{{$a->id}}">{{$a->value}}</option>
                                                @endforeach
                                            </select>

                                            @error('variation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6" id="variation-value-block">
                                        <label>Valeur :</label>
                                            <select  id="select-value-individuel" class="default-select form-control wide selectpicker" data-live-search="true" name="valeur" disabled >
                                                <option value="" disabled selected>Selectionnez une variation</option>
                                            </select>
                                            @error('valeur')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Statut:</label>
                                        <select id="inputState" class="default-select form-control wide" name="status">
                                            <option value="1">Nouveau</option>
                                            <option value="2">Ancien stock</option>
                                            <option value="3">rupture</option>
                                            <option value="4">Prochainement</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Marque*:</label>
                                        <select id="inputState" class="default-select form-control wide" name="mark">
                                            @foreach($marks as $mark)
                                            <option value="{{ $mark->id }}">{{ $mark->designation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Date:</label>
                                        <input type="date"  class="form-control input-default @error('date') is-invalid @enderror" value="{{old('date')}}" name="date" >
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Catégories</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="mb-3">
                                    <div class="categories overflow-auto" style="max-width: 260px; max-height:300px;">
                                        @include('categories')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row ">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Description Courte: </h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                             <div class="row">
                                    <div class="mb-3 col-md-12">
                                    <textarea  class="form-control" name="short_description"></textarea>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Photo principale</h4>
                    </div>
                    <div class="card-body">
                        <div class="input-photoPrincipale-add">
                        </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Description Longue: </h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                             <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <textarea class="summernote" class="form-control " name="long_description" >{{old('description')}}</textarea>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Photos</h4>
                    </div>
                    <div class="card-body">
                        <div class="input-photos">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <input type="checkbox" class="form-check-input" id="check" value="oui" name="check" >
                        <h4 class="card-title">Variants ?</h4>
                    </div>

                    <div class="card-body " id="variation" style="display: none;">
                        <div class="text-center">
                            <a style="cursor: pointer" class="btn btn-success add-attribute " style=" background-color: #006e40; border-color:#006e40;"> <span style="color:#fff!important;">Gérer les attributs</span> </a>
                        </div>
                        <div class="basic-form d-flex justify-content-center" >
                            <div class="col-md-10">
                                <table id="tblattribute" class="table table-bordered mt-3 ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Attribut</th>
                                            <th scope="col">Valeur</th>
                                            <th scope="col">Qte</th>
                                            <th scope="col">Prix</th>
                                            <th scope="col">Promo</th>
                                            <th scope="col">Icon</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamicAddRemove"  >
                                            <tr>
                                                <td style="width: 15%">
                                                    <select  id="select-content"  class="default-select form-control wide "  name="as[0]"  >
                                                        <option disabled selected>Sélectionner...</option>
                                                        @foreach($attributes as $a)
                                                        <option value="{{$a->id}}">{{$a->value}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>


                                                <td style="width: 15%">
                                                    <select  id="select-value" class="default-select form-control wide " name="values[0]"  >
                                                        <option disabled selected>Sélectionner...</option>
                                                    </select>
                                                </td>
                                                <td style="width:  10%">
                                                    <input type="text" class="form-control" placeholder="0" name="qtes[0]">
                                                </td>
                                                <td  style="width: 15%">
                                                    <input type="text" class="form-control price" placeholder="0.00" name="prices[0]">
                                                </td>
                                                <td style="width: 15%">
                                                    <input type="text" class="form-control price" placeholder="0.00" name="promos[0]">
                                                </td>
                                                <td>
                                                    <label for="icon-0" style="cursor: pointer;">
                                                        <img id="icon-show-0" src="{{asset('image-upload.png')}}" width="50" height="50" alt="" >
                                                    </label>
                                                    <input type="file" class="input-image" id="icon-0" name="icons[]" accept="image/*" style="display: none; visibility:none;">
                                                </td>
                                                <td>
                                                    <label for="image-0" style="cursor: pointer;">
                                                        <img id="image-show-0" src="{{asset('image-upload.png')}}" width="70" height="70" alt="" >
                                                    </label>
                                                    <input type="file" class="input-image" id="image-0" name="images[]" accept="image/*" style="display: none; visibility:none;">
                                                </td>
                                                <td>
                                                    <button type="button" id="add-attribute" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-plus"></i></button>
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
                    <button type="submit" class="btn btn-primary mt-3">Ajouter le produit</button>
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

@push('show-variation-scripts')

<script>
    $('.input-photoPrincipale-add').imageUploader({
		maxFiles: 1,
        imagesInputName: 'photoPrincipale',
	});

    $('.input-photos').imageUploader({
		imagesInputName: "photos",
	});
</script>

<script>
    $(document).ready(function() {
        $("#addProduct").validate({
            rules: {
                designation: "required",
                'categories[]': {
                    required: true,
                    maxlength: 1
                 },

            },
            messages: {
                designation: {
                    required: "La designation est obligatoire",
                },
                'categories[]': {
                    required: "Selectionnez une categorie",
                 },
            },
        });
    });
 </script>

<script>

   $( "#check" ).prop( "checked", false );
   $("#check").on('change',function(){

    if(this.checked) {
        $("#variation").css("display", "block");
        $("#select-content").prop('required',true);
    }
    else{
        $("#select-content").prop('required',false);
        $("#variation").css("display", "none");
        $('.tradded').remove();
        }
    });

 </script>
@endpush

@push('generate-attribute-scripts')

<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });

    //loading page
    $('#select-value-individuel').prop('disabled', true);
    $('#variation-value-block').hide();
    //go
    $("#select-content-individuel").change(function() {

        if($(this).val() != 0){
            $('#variation-value-block').show();
            $('#select-value-individuel').prop('disabled', false);
            var id = $(this).val();
            var data ="";

            $.ajax({
                url: '/get-attribute/' + id,
                type: "GET",

                success: function (res) {
                    $.each(res, function(i, res) {
                    data = data + '<option value="'+ res.id+ '" >'+ res.value + '</option>';
                    });

                    $('#select-value-individuel').html(data);
                    $('#select-value-individuel').selectpicker('refresh');
                    $('#select-value-individuel').selectpicker('refresh');
                }
            });
        }

        else{
            $('#select-value-individuel').prop('disabled', true);
            $('#variation-value-block').hide();
        }
    });
    $("#select-content").change(function() {


        var id = $(this).val();
        var data ="";

        $.ajax({
            url: '/get-attribute/' + id,
            type: "GET",

            success: function (res) {
                $.each(res, function(i, res) {
                data = data + '<option value="'+ res.id+ '" >'+ res.value + '</option>';
                });

                $('#select-value').html(data);
                $('#select-value').selectpicker('refresh');
				$('#select-value').selectpicker('refresh');
            }
        });
    });

    $('body').on('change','#select-attribute',function() {

        var id = $(this).val();
        var indice = $(this).data('id');
		var data ="";
        $.ajax({
			url: '/get-attribute/' + id,
			type: "GET",

			success: function (res) {

                $.each(res, function(i, res) {
				data = data + '<option value="'+ res.id+ '" >'+ res.value + '</option>';
				});

                $('#select-attr'+indice).html(data);
                $('#select-attr'+indice).selectpicker('refresh');
                $('#select-attr'+indice).selectpicker('refresh');

			}
		});

	});

</script>
@endpush


@push('add-attribute-scripts')
<script type="text/javascript">
    var i = 0;
    $("#add-attribute").click(function () {
        var options = $('#select-content').html();
        ++i;
        $html = '<tr class="tradded">'+
                    '<td style="width: 15%">'+
                        '<select  id="select-attribute" data-id="'+ i +'" class="default-select form-control wide " name="as['+i+']" required>'+
                            options +
                        '</select>'+
                    '</td>'+
                    '<td style="width: 15%">'+
                        '<select   id="select-attr'+i+'" class="default-select form-control wide " name="values['+i+']">'+
                            '<option disabled selected>Sélectionner...</option>'+
                        '</select>'+
                    '</td>'+
                    '<td style="width:  10%">'+
                        '<input type="text" class="form-control" placeholder="0" name="qtes['+i+']">'+
                    '</td>'+
                    '<td  style="width: 15%">'+
                        '<input type="text" class="form-control price" placeholder="0.00" name="prices['+i+']">'+
                    '</td>'+
                    '<td style="width: 15%">'+
                        '<input type="text" class="form-control price" placeholder="0.00" name="promos['+i+']">'+
                    '</td>'+
                    '<td>'+
                        '<label for="icon-'+i+'" style="cursor: pointer;">'+
                           '<img id="icon-show-'+i+'" src="{{asset('image-upload.png')}}" width="50" height="50" alt="" >'+
                        '</label>'+
                        '<input type="file" class="input-image" id="icon-'+i+'" name="icons[]" accept="image/*" style="display: none; visibility:none;">'+
                    '</td>'+
                    '<td>'+
                       ' <label for="image-'+i+'" style="cursor: pointer;">'+
                            '<img id="image-show-'+i+'" src="{{asset('image-upload.png')}}" width="70" height="70" alt="" >'+
                       ' </label>'+
                        '<input type="file" class="input-image" id="image-'+i+'" name="images[]" accept="image/*" style="display: none; visibility:none;">'+
                    '</td>'+
                    '<td>'+
                       ' <button type="button" class="btn btn-danger shadow btn-xs sharp delete-attribute"><i class="fa fa-trash"></i></button>'+
                    '</td>'+
                '</tr>'

        $("#dynamicAddRemove").append($html);
        $('select').selectpicker('refresh');

        $(document).on('click', '.delete-attribute', function () {
        $(this).parents('tr').remove();
        });


    });
</script>


@endpush

@push('add-image-icone-scripts')
<script>

    var storedFiles = [];

    $(document).ready(function () {
        $("body").on('change','.input-image',handleFileSelect);

    });

    function handleFileSelect(e) {
      id=  $(this).parent().find('img').attr("id");
      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      filesArr.forEach(function (f) {
        if (!f.type.match("image.*")) {
          return;
        }
        storedFiles.push(f);
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#'+ id).attr('src', e.target.result);
        };
        reader.readAsDataURL(f);
      });
    }

</script>
@endpush
@push('show-modal-scripts')
<script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".add-attribute").on('click',function() {

    $.ajax({
      url: '/show-modal',
      type: "GET",
      success: function (res) {

        $('#modal-add-attribute').html(res);
        $('#modal-add-attribute').find("#type").selectpicker();
        $("#exampleModal").modal('show');
      }
    });

  });

  </script>
@endpush
@push('store-attribute-scripts')
<script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $("#modal-add-attribute").on('click','.storeAttribute',function(e){
          e.preventDefault();
          let attr = $('#attr').val();
          let type = $('#type').val();

          $.ajax({
            type:"Post",
            url: '/add-attribute',
            data:{
              "_token": "{{ csrf_token() }}",
              attr:attr,
              type:type,
            },
            success:function(res){

              $('#exampleModal').modal('hide');
              $("#liveToast").show();

              $.each(res, function(i, res) {
                     data = data + '<option value="'+ res.id+ '" >'+ res.value + '</option>';
                        });

              $('#select-content').selectpicker('refresh');
              $('#select-content').html(data);
              $('#select-content').selectpicker('refresh');
			  $('#select-content').selectpicker('refresh');
            },

            });

     });
  </script>

<script>
    function showAlert() {
        event.preventDefault()
      var myText = "Vous ne pouvez pas ajouter un produit en mode test ! InnoDev";
      alert (myText);
    }
    </script>
@endpush
