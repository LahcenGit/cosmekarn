@extends('layouts.dashboard-admin')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Bonjour, Bienvenue!</h4>
                    <span>Frais de livraison</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/admin/delivery-costs')}}">Frais de livraison</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Frais de livraison</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Wilaya</th>
                                        <th>Commune</th>
                                        <th>Extention</th>
                                        <th>Prix bureau</th>
                                        <th>Prix a domicile</th>
                                        <th>Supp</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($delivery_costs as $delivery_cost)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$delivery_cost->wilaya}}</td>
                                        <td>{{$delivery_cost->commune}}</td>
                                        <td>{{$delivery_cost->extention}}</td>
                                        <td  style="width: 10%">
                                            <div class="input-group">
                                               <input type="text"  value="{{ $delivery_cost->price_b }}" class="form-control" id="price_b_{{ $delivery_cost->id }}" name='price_b' >
                                            </div>
                                        </td >
                                        <td  style="width: 10%">
                                            <div class="input-group">
                                               <input type="text" value="{{ $delivery_cost->price_a }}" class="form-control" id="price_a_{{ $delivery_cost->id }}" name='price_a'>
                                            </div>
                                        </td >
                                        <td>{{$delivery_cost->supp}}</td>

                                        <td>

                                            <div class="d-flex">
                                                <button data-id="{{ $delivery_cost->id }}" class="btn btn-success shadow btn-xs sharp check-price" ><i class="fa fa-check"></i></button>
                                            </div>
                                            </form>
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

@endsection


@push('check-delivery-cost-script')

<script>
 $("body").on('click','.check-price',function() {

        var id = $(this).data('id');
        var price_b = $('#price_b_'+id).val();
        var price_a = $('#price_a_'+id).val();
        $.ajax({
			url: '/update-delivery-cost/'+id+'/'+price_b+'/'+price_a ,
			type: 'GET',

        success: function (res) {
            toastr.success("Prix modifié avec succès", "Succès", {
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1

            })
            $('#price_b_'+id).val(price_b);
            $('#price_a_'+id).val(price_a);
            }

        });
    });
</script>
@endpush
