@extends('layouts.dashboard-admin')
@section('content')
  <!--**********************************
            Content body start
        ***********************************-->

		<div class="temp-body">

        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="row mb-3">
							<span class="col"><b style="color: #6c2d6e">Statistiques mensuelles</b>  pour le mois : <b> {{$month}} </b></span>
						</div>
						<div class="row">
							<div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
								<div class="card overflow-hidden">
									<div class="card-body pt-4">
										<div class="row">
											<div class="col">
												<h3 class="mb-1">{{number_format($revenu->s)}} Da</h3>
												<span class="text-cosmekarn">Total ventes</span>
											</div>
										</div>
									</div>

								</div>
							</div>
						
							<div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
								<div class="card overflow-hidden">
									<div class="card-body pt-4">
										<div class="row">
											<div class="col">
												<h3 class="mb-1">{{$nbr_orders}}</h3>
												<span class="text-cosmekarn">Commande(s)</span>
											</div>
										</div>
									</div>

								</div>
							</div>
						
							<div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
								<div class="card overflow-hidden">
									<div class="card-body pt-4">
										<div class="row">
											<div class="col">
												<h3 class="mb-1"></h3>
												<span class="text-cosmekarn">Total livraisons</span>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6 ">
								<div class="card overflow-hidden ">
									<div class="card-body  pt-4">
										<div class="row">
											<div class="col">
												<h3 class="mb-1">{{$nbr_customers}}</h3>
												<span class="text-cosmekarn">Client(s)</span>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-xxl-6 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Dernières commandes</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-responsive-sm mb-0">
												<thead>
												<tr>
													<th>#</th>
													<th>Client</th>
													<th>Wilaya</th>
													<th>Adresse</th>
													<th>Date</th>
                                                </tr>
												</thead>
												<tbody>
												  @foreach($orders as $order)
													<tr >
													<td>{{$loop->iteration}}</td>
														<td>{{$order->name}}</td>
														<td>{{$order->wilaya}}</td>
														<td>{{$order->address}}</td>
														<td>{{$order->created_at}}</td>
													</tr>
												  @endforeach
												</tbody>

											</table>

										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-xxl-6 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Dernières inscriptions</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-responsive-sm mb-0">
												<thead>
													<tr>
														<th>#</th>
														<th>Nom</th>
                                                        <th>Email</th>
														<th>Téléphone</th>
                                                    </tr>
												</thead>
												<tbody>

													@foreach($users as $user)
													 <tr >
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->phone}}</td>
													 </tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-xl-3 col-xxl-4 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">infos commandes</h4>
									</div>
									<div class="card-body">
										<div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1" style="height:250px;">
											<ul class="timeline">
												@if($order_waiting!=0)
												<li>
													<div class="timeline-badge primary"></div>
													<a class="timeline-panel text-muted" href="#">

														<h6 class="mb-0"><strong class="text-primary">{{$order_waiting}} </strong> en attente(s)</h6>
													</a>
												</li>
												@endif
												@if($order_in_delivering !=0 )
												<li>
													<div class="timeline-badge info">
													</div>
													<a class="timeline-panel text-muted" href="#">

														<h6 class="mb-0"> <strong class="text-info">{{$order_in_delivering}}</strong> en cours de livraison</h6>

													</a>
												</li>
												@endif
												@if($order_delivered!= 0)
												<li>
													<div class="timeline-badge warning">
													</div>
													<a class="timeline-panel text-muted" href="#">

														<h6 class="mb-0"><strong class="text-warning">{{$order_delivered}}</strong>  livrée(s)</h6>
													</a>
												</li>
												@endif
												@if($order_canceled != 0)
												<li>
													<div class="timeline-badge success">
													</div>
													<a class="timeline-panel text-muted" href="#">

														<h6 class="mb-0"> <strong class="text-success">{{$order_canceled}}</strong>  annulée(s)</h6>
													</a>
												</li>
												@endif
                                                @if($order_waiting_payment != 0)
												<li>
													<div class="timeline-badge danger">
													</div>
													<a class="timeline-panel text-muted" href="#">

														<h6 class="mb-0"> <strong class="text-danger">{{$order_waiting_payment}}</strong>  en attente de paiement</h6>
													</a>
												</li>
												@endif
											</ul>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xl-3 col-xxl-4 col-lg-12 col-md-12">
						<div class="card bg-primary text-white">
                            <div class="card-header pb-0 border-0">
                                <h4 class="card-title text-white">TOP CLIENTS</h4>
                            </div>
                            <div class="card-body">
                                <div class="widget-media">
                                    <ul class="timeline">
										@foreach($top_customers as $top_customer)
                                        <li>
                                            <div class="timeline-panel">
												<div class="media mr-2">
													<img alt="image" width="50" src="{{asset('Dashboard/images/avatar/1.jpg')}}">
												</div>
                                                <div class="media-body">
													<h5 class="mb-1 text-white">{{$top_customer->user->name}}</h5>
													<small class="d-block">{{$top_customer->s}} Commande(s)</small>
												</div>

											</div>
                                        </li>
										@endforeach
                                     </ul>
                                </div>
                            </div>

                        </div>


					</div>
						</div>
					</div>




			   </div>
            </div>
        </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
