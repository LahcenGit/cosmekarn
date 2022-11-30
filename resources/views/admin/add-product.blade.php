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

        <form action="{{url('admin/products')}}" method="POST" enctype="multipart/form-data">
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
                                        <input type="text"  class="form-control input-default @error('designation') is-invalid @enderror" value="{{old('designation')}}" name="designation" placeholder="designation">
                                            @error('designation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Qte*:</label>
                                        <input type="number"  class="form-control input-default @error('qte') is-invalid @enderror" value="{{old('qte')}}" name="qte" placeholder="0">
                                            @error('qte')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Prix*:</label>
                                        <input type="number"  class="form-control input-default @error('price') is-invalid @enderror" value="{{old('price')}}" name="price" placeholder="0.00">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Promo:</label>
                                        <input type="number"  class="form-control input-default @error('price_promo') is-invalid @enderror" value="{{old('price_promo')}}" name="price_promo" placeholder="0.00">
                                            @error('price_promo')
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
                                            <option>Nothing selected</option>
                                            <option>Nouveau</option>
                                            <option>Non</option>
                                        </select>
                                    </div>
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
                            <h4 class="card-title">Les Catégories</h4>
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
                        <h4 class="card-title">Photos</h4>
                    </div>
                    <div class="card-body">
                    <label>L'image principale du produit :</label>
                        <div class="basic-form custom_file_input">
                                <div class="input-group mb-3">
                                        <input type="file" class="file"  name="photoPrincipale" accept="image/*"  >
                                </div>
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
                        <label>L'image principale du produit :</label>
                            <div class="basic-form custom_file_input">
                                    <div class="input-group mb-3">
                                            <input type="file" class="file" name="photos[]" accept="image/*" multiple >
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
                        <input type="checkbox" class="form-check-input" id="check" value="oui" name="check" >
                        <h4 class="card-title">Variants ?</h4>
                    </div>
                    <div class="card-body" id="variation" style="display:none ;">
                        <div class="text-center">
                            <a href="#"  class="btn btn-success add-attribute ">Gérer les attributs</a>
                        </div>
                        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
                            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                <i class="fa-solid fa-check-to-slot mr-2" style="color: #4DAA7F"></i>
                                <strong class="me-auto ml-2">Inscription réussite</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                Vous allez reçevoir toutes nos actualités
                                </div>
                            </div>
                        </div>
                        <div id="dynamicAddRemove">
                        <div  class="row d-flex justify-content-center mt-3">
                            <div style="width: 200px; margin-right:50px;">
                                <label >Attribut:</label>
                                <select  id="select-attributes"  class="selectpicker select-attributes" data-live-search="true" name="a[0]"  >
                                    <option value="0">Nothing Selected</option>
                                    @foreach($attributes as $a)
                                    <option value="{{$a->id}}">{{$a->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="width: 200px; margin-right:50px;">
                                <label>Valeur:</label>
                                <select id="select-value" class="selectpicker" data-live-search="true" name="values[]"  >

                                </select>
                            </div>
                            <div style="width: 100px; margin-right:50px;">
                                <label>Qte:</label>
                                <input type="number" class="form-control" placeholder="0" name="qtes[0]">
                            </div>
                            <div style="width: 150px; margin-right:50px;">
                                <label>Prix:</label>
                                <input type="number" class="form-control" placeholder="0" name="prices[0]">
                            </div>
                            <div style="width: 150px; margin-right:50px;">
                                <label>Promo:</label>
                                <input type="number" class="form-control" placeholder="0" name="promos[0]">
                            </div>
                            <div style="width: 100px; ">
                                <label >icon : </label> <br>
                                <label for="icon-0" style="cursor: pointer;">
                                    <img id="icon-show-0" src="{{asset('image-upload.png')}}" width="50" height="50" alt="" >
                                </label>
                                <input type="file" class="input-image" id="icon-0" name="icons[]" accept="image/png, image/jpeg" style="display: none; visibility:none;">
                            </div>
                            <div style="width: 100px; margin-right:50px;">
                                <label >image : </label> <br>
                                <label for="image-0" style="cursor: pointer;">
                                    <img id="image-show-0" src="{{asset('image-upload.png')}}" width="100" height="100" alt="" >
                                </label>
                                <input type="file" class="input-image" id="image-0" name="images[]" accept="image/png, image/jpeg" style="display: none; visibility:none;">
                            </div>

                            <div style="width: 50px; margin-right:50px;">
                                <button type="button" id="add-attribute" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-plus"></i></button>
                            </div>
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
                    <button type="submit"  class="btn btn-primary mt-3">Ajouter le produit</button>
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

   $("#check").on('change',function(){
    if(this.checked) {
        $("#variation").css("display", "block");
    }
    else{
        $("#variation").css("display", "none");
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


	$("body").on('change','.select-attributes',function() {

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
</script>
@endpush

@push('add-attribute-scripts')
<script type="text/javascript">
		var i = 0;
		$("#add-attribute").click(function () {

			var options = $('#select-attributes').html();
			++i;
			$html = '<span><div class="row d-flex justify-content-center mt-3">'+
					'<div style="width: 200px; margin-right:50px;">'+
					'<label for="" >Attribute:</label>'+
					'<select  name="a['+i+']" id="select-attribute" class="selectpicker" data-live-search="true"  >'+
					 options +
					'</select>'+
					'</div>'+

                    '<div style="width: 200px; margin-right:50px;">'+
                    '<label>Valeur:</label>'+
                    '<select  id="select-attr'+i+'" class="selectpicker" data-live-search="true" name="values['+i+']"  >'+
                    '</select>'+
                    '</div>'+

                    ' <div style="width: 100px; margin-right:50px;">'+
                    '<label>Qte:</label>'+
                    '<input type="number" class="form-control" placeholder="0" name="qtes['+i+']">'+
                     '</div>'+

                    '<div style="width: 150px; margin-right:50px;">'+
                    '<label>Prix:</label>'+
                    '<input type="number" class="form-control" placeholder="0" name="prices['+i+']">'+
                    '</div>'+

                    ' <div style="width: 150px; margin-right:50px;">'+
                    '<label>Promo:</label>'+
                    '<input type="number" class="form-control" placeholder="0" name="promos['+i+']">'+
                    '</div>'+
                    '<div style="width: 100px; ">'+
                    '<label >icon : </label> <br>'+
                    '<label for="icon-'+i+'" style="cursor: pointer;">'+
                    '<img id="icon-show-'+i+'" src="{{asset('image-upload.png')}}" width="50" height="50" alt="" >'+
                    '</label>'+
                    '<input type="file" class="input-image" id="icon-'+i+'" name="icons['+i+']" accept="image/png, image/jpeg" style="display: none; visibility:none;">'+
                    '</div>'+
                    '<div style="width: 100px; margin-right:50px;">'+
                    '<label >image : </label> <br>'+
                    '<label for="image-'+i+'" style="cursor: pointer;">'+
                    '<img id="image-show-'+i+'" src="{{asset('image-upload.png')}}" width="100" height="100" alt="" >'+
                    '</label>'+
                    '<input type="file" class="input-image" id="image-'+i+'" name="images['+i+']" accept="image/png, image/jpeg" style="display: none; visibility:none;">'+
                    '</div>'+
                    '<div style="width: 50px; margin-right:50px;">'+
                    ' <button type="button" id="delete-attribute" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>'+
                    '</div>	</div><span>';

			$("#dynamicAddRemove").append($html);
			$('select').selectpicker();

		$(document).on('click', '#delete-attribute', function () {
                $(this).parents('span').remove();
            });

        $(document).on('change', '#select-attribute', function () {
                var id = $(this).val();
                var data ="";

                $.ajax({
                    url: '/get-attribute/' + id,
                    type: "GET",

                    success: function (res) {

                        $.each(res, function(i, res) {
                        data = data + '<option value="'+ res.id+ '" >'+ res.value + '</option>';
                        });

                        $('#select-attr'+i).html(data);
                        $('#select-attr'+i).selectpicker('refresh');
                        $('#select-attr'+i).selectpicker('refresh');

                    }
                });
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
@endpush
