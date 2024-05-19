@foreach($orders as $order)
    <tr>
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
            <td>{{ $order->wilaya }}</td>
            <td>{{ $order->address }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->payment_method }}</td>
            <td>{{ $order->tracking_code }}</td>
            <td>{{ $order->created_at->format('Y-m-d H:m') }}</td>
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
            <td>

                <div class="d-flex">
                    <a href="{{ asset('admin/order-detail/'.$order->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1 order-details"><i class="fas fa-eye"></i></a>
                    @if($order->status == 0)
                    <button data-id="{{ $order->id }}" class="btn btn-success shadow btn-xs sharp mr-1 add-odrer-to-yalidine"><i class="fas fa-plus"></i></button>
                    @endif
                    <a href="#" data-id="{{ $order->id }}" class="btn btn-info shadow btn-xs sharp mr-1 edit-status"><i class="fab fa-digital-ocean"></i></a>
                    <a href="{{url('admin/orders/'.$order->id.'/edit')}}" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>

                    <form action="{{url('admin/orders/'.$order->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
                   </form>
                </div>

            </td>
        </tr>
    </tr>
@endforeach
