@extends('layouts.front')
@section('content')
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Mon compte</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- my account wrapper start -->
    <div class="my-account-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                       <h5 >Détail commande {{ $code }}</h5>
                                        <div class="table-responsive " style="margin-top: 10px;">
                                            <table class="table table-bordered" >
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Produit</th>
                                                        <th>Qte</th>
                                                        <th>Prix</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderlines as $orderline)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$orderline->productline->product->designation}} {{ $orderline->productline->attributeLine->value }}</td>
                                                            <td>{{ $orderline->qte }}</td>
                                                            <td>{{ $orderline->price }}</td>
                                                            <td>{{number_format($orderline->total)}}</td>
                                                        </tr>
                                                     @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-3 col-md-offset-9">
                                             Total : <b>{{ number_format($total_order,2) }} Da</b>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->


@endsection

