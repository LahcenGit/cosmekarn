@extends('layouts.dashboard-admin')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, bienvenue!</h4>
                    <span>Générer rapport</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Générer rapport</a></li>
                </ol>
            </div>
        </div>
        <form action="{{url('admin/generate-report')}}" method="POST" id="addProduct" enctype="multipart/form-data">
        @csrf
        <div class="row ">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Générer rapport </h4>
                    </div>
                    <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Date* :</label>
                                    <select class="form-control select-date" id="sel1"  class="selectpicker" data-live-search="true" name="type" required>
                                        <option value="" disabled selected>Selectionner...</option>
                                        <option value="A">Aujord'hui</option>
                                        <option value="M">Moi Actuel</option>
                                        <option value="S">Semaine Actuelle</option>
                                        <option value="P">Personnalisé</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3 date-section" style="display:none">
                                <div class="form-group col-md-3">
                                    <input type="date" class="form-control input-default date" value="{{$date}}" name="datedebut" >
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="date" class="form-control input-default date" value="{{$date}}" name="datefin" >
                                </div>
                            </div>
                             <button type="submit"  class="btn btn-primary mt-3">Générer rapport</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection

@push('report-scripts')
<script>

    if($('.select-date').val() == 'P'){
		$('.date-section').show();
	}
	$('.select-date').on('change', function() {
		if(this.value == 'P'){
			$('.date-section').show();
			$('.date').prop('required',true);
		}
		else{
			$('.date-section').attr('style', 'display: none !important');
			$('.date').prop('required',false);
		}
	});
</script>
@endpush




