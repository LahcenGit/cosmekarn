@extends('layouts.dashboard-admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <form action="{{url('admin/store-order')}}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="row mt-3">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body print-section" id="printable">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Produit</th>
                                        <th scope="col">P.U</th>
                                        <th scope="col">Qte</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$product->product->designation}} {{ $product->attributeLine->value }}</td>
                                            @if(!is_null($product->promo_price))
                                            <td>{{$product->promo_price}}</td>
                                            @else
                                            <td>{{$product->price}}</td>
                                            @endif
                                            <td>{{$qte[$loop->iteration - 1]}}</td>
                                            @if(!is_null($product->promo_price))
                                            <td>{{$qte[$loop->iteration - 1] * $product->promo_price}} Da</td>
                                            @else
                                            <td>{{$qte[$loop->iteration - 1] * $product->price}} Da</td>
                                            @endif
                                        </tr>
                                        <input type="hidden" value="{{ $product->id }}" name="product[]">
                                        <input type="hidden" value="{{ $qte[$loop->iteration - 1]}}" name="qte[]">
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align:right;"><b>Total</b> </td>
                                        <td > <b >{{ number_format($total, 2) }}  Da</b> </td>

                                    </tr>
                                    <tr>
                                        @if($total_promo)
                                        <td colspan="4" style="text-align:right;"><b>Promo</b> </td>
                                        <td> {{ $value_promo}} Da</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:right;"><b>Livraison</b> </td>
                                        <td >  {{ $delivery_cost }} Da</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:right;"><b>Total</b> </td>
                                        <td > <b style="font-size: 17px">{{ number_format($total_f, 2) }}  Da</b> </td>
                                    </tr>
                                </tbody>
                                <input type="hidden" value="{{ $customer['first_name']}}" name="first_name">
                                <input type="hidden" value="{{ $customer['last_name']}}" name="last_name">
                                <input type="hidden" value="{{ $customer['address']}}" name="address">
                                <input type="hidden" value="{{ $customer['wilaya']}}" name="wilaya">
                                <input type="hidden" value="{{ $customer['commune']}}" name="commune">
                                <input type="hidden" value="{{ $customer['center']}}" name="center">
                                <input type="hidden" value="{{ $shipping}}" name="shipping">
                            </table>


                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-success mt-3">Valider la vente</button>
                        </form>
                    </div>
                   </div>
                </div>
            </div>
        </form>
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
