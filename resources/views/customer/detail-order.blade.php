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
                            <div class="row">

                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Dashboard</h5>
                                                <div class="welcome">
                                                    <p>Bonjour, <strong>{{Auth::user()->name}}</strong>
                                                </div>
                                                <p class="mb-0">
                                                    Depuis le tableau de bord de votre compte. vous pouvez facilement vérifier et afficher vos commandes récentes, gérer vos adresses de livraison et de facturation et modifier votre mot de passe et les détails de votre compte.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Commandes</h5>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Produit</th>
                                                                <th>Qte</th>
                                                                <th>Prix</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td>{{$order->created_at->format('Y-m-d H:i')}}</td>
                                                                    @if($order->payment_method == 'CASH')
                                                                    <td>Paiement à la livraison</td>
                                                                    @elseif($order->epayInvoice->paid == 1)
                                                                    <td>Payé</td>
                                                                    @else
                                                                    <td>Echec de paiement</td>
                                                                    @endif
                                                                    @if($order->status == 0)
                                                                    <td>En attente</td>
                                                                    @elseif($order->status == 1)
                                                                    <td>En cours de livraison</td>
                                                                    @elseif($order->status == 2)
                                                                    <td>Livré</td>
                                                                    @elseif($order->status == 3)
                                                                    <td>Annulé</td>
                                                                    @else
                                                                    <td>En attente de paiement</td>
                                                                    @endif
                                                                    <td> <b>{{number_format($order->total)}}</b>  Da</td>
                                                                    <td><a href="#" class="btn btn-sqr">Détails</a>
                                                                    </td>
                                                                </tr>

                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                         <!-- Single Tab Content Start -->
                                         <!-- Single Tab Content End -->
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

