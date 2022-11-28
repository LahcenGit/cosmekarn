@extends('layouts.dashboard-admin')
<style>

    .wrapper{
       height: 200px;
       width: 200px;
       position: relative;
       border: 2px solid #fff ;
       background-size: 100% 100%;
       background-repeat: no-repeat;
       overflow: hidden;
       margin: auto;

    }

    .my-file{
        position: absolute;
        bottom:0;
        outline: none;
        color: transparent;
        width: 100%;
        box-sizing: border-box;
        cursor: pointer;
        padding: 5px 80px;
        transition: 0.5s;
        background: rgb(0, 0, 0,0.5);

    }
    .my-file::-webkit-file-upload-button{
        visibility: hidden;
    }
    .my-file::before{
        content: '\f03e';
        font-family: fontAwesome;
        font-size: 35px;
        color: #fff;
        display: inline-block;
    }

    </style>
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
        <div class="row ">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter produit</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{url('admin/products')}}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                    <div class="card-body" id="variation" style="display: ;">
                        <div class="text-center">
                            <button type="submit"  class="btn btn-success ">Gérer les attributs</button>
                        </div>

                        <div id="dynamicAddRemove " class="row d-flex justify-content-center mt-3">
                            <div style="width: 200px; margin-right:50px;">
                                <label >Attribut:</label>
                                <select  id="select-content"  class="selectpicker" data-live-search="true" name="a[0]"  >
                                    <option value="0">Nothing Selected</option>
                                    @foreach($attributes as $a)
                                    <option value="{{$a->id}}">{{$a->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="width: 200px; margin-right:50px;">
                                <label>Valeur:</label>
                                <select  id="select-value" class="selectpicker" data-live-search="true" name="values[0]"  >

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

                            <div class="wrapper user mb-4 mt-2">
                                <label>image:</label>
                                <input type="file" id="input-photo" name="image" class="my-file" >
                            </div>
                            <div style="width: 50px; margin-right:50px;">
                                <button type="button" id="add-attribute" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-plus"></i></button>
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
</script>
@endpush

@push('add-attribute-scripts')
<script type="text/javascript">
		var i = 0;
		$("#add-attribute").click(function () {
			var options = $('#select-content').html();
			++i;
			$html = '<span><div class="row">'+
					'<div class="mb-3 col-md-3">'+
					'<label for="" >Attribute:</label>'+
					'<select  name="a['+i+']" id="select-attribute" class="selectpicker" data-live-search="true"  >'+
					 options +
					'</select>'+
					'</div>'+
                    '<div class="mb-2 col-md-2">'+
					'<label for="">Valeur:</label>'+
					'<select name="values['+i+']" id="select-attr'+i+'" class="selectpicker" data-live-search="true">'+
					'</select>'+
					'</div>'+
                    '<div class="mb-2 col-md-2">'+
						'<label>Qte:</label>'+
						'<input type="number" class="form-control" placeholder="0" name="qtes['+i+']">'+
				    '</div>'+
                    '<div class="mb-2 col-md-2">'+
						'<label>Prix:</label>'+
						'<input type="number" class="form-control " placeholder="0" name="prices['+i+']">'+
				    '</div>'+
                    '<div class="mb-2 col-md-2">'+
						'<label>Promo:</label>'+
						'<input type="number" class="form-control " placeholder="0" name="promos['+i+']">'+
				    '</div>'+
                    '<div class="mb-1 col-md-1">'+
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
    var image = $('#img-profile').attr('src');
    $('.wrapper').css('background','url('+ image + ')');
    $('.wrapper').css('background-size','100% 100%');

    $(function(){
    $('#input-photo').change(function(){
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
        {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('.wrapper').css('background','url('+ e.target.result + ')');
            $('.wrapper').css('background-size','100% 100%');
            }
        reader.readAsDataURL(input.files[0]);
        }

    });

    });

</script>
@endpush
