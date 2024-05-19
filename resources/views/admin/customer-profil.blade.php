@extends('layouts.dashboard-admin')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url('/admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Profil Client</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
            <!-- Informations personnelles -->
                <div class="card mt-4">
                    <div class="card-header">
                        Informations personnelles
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Nom: {{ $user->name }}</h5>
                        <p class="card-text">Email: {{ $user->email }}</p>
                        <p class="card-text">Téléphone: {{ $user->phone }}</p>
                        <p class="card-text">Wilaya: {{ $user->wilaya }}</p>
                    </div>
                </div>
            </div>
            <!-- Tableau des commandes -->
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header">
                        Commandes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Wilaya</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Methode de paiement</th>
                                <th scope="col">Date</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $order->wilaya }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d H:m') }}</td>
                                        <td>{{ $order->total }}</td>
                                        @if($order->status == 0)
                                        <td><span class="badge badge-warning">En attente</span></td>
                                        @elseif($order->status == 1)
                                        <td><span class="badge badge-info">Livraison...</span></td>
                                        @elseif($order->status == 2)
                                        <td><span class="badge badge-success">Livré</span></td>
                                        @elseif($order->status == 3)
                                        <td><span class="badge badge-danger">Annulé</span></td>
                                        @else
                                        <td><span class="badge badge-primary">En attente de paiement</span></td>
                                        @endif
                                    </tr>
                                @endforeach
                                <!-- Ajouter d'autres lignes pour chaque commande -->
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
