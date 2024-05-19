@foreach($products as $product)
    <tr>
        <td>{{$loop->iteration}}</td>
        @if(optional($product->images->first())->lien)
            <td><img  width="35" src="{{asset('storage/images/products/'.$product->images[0]->lien)}}"/></td>
        @else
            <td><img  width="35" src="{{asset('/product-cosmekarn.jpg')}}"/></td>
        @endif
        <td>{{$product->designation}}</td>
        @if($product->status == 1)
            <td><span class="badge badge-success">Nouveau</span></td>
            @elseif($product->status == 2)
            <td><span class="badge badge-info">Ancien stock</span></td>
            @elseif($product->status == 3)
            <td><span class="badge badge-danger">Rupture</span></td>
            @else
            <td><span class="badge badge-warning">Prochainement</span></td>
            @endif
        <td>
            <div class="d-flex">
                <a  href="{{url('product/'.$product->slug)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fas fa-eye"></i></a>
                <a  href="{{url('admin/products/'.$product->id.'/edit')}}" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fas fa-pencil-alt"></i></a>
                <form action="{{url('admin/products/'.$product->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
            </form>

            </div>
        </td>
    </tr>
@endforeach
