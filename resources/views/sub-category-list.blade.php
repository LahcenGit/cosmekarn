<?php $dash.='--'; ?>
@foreach($subcategories as $subcategory)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
    <tr id= "{{$subcategory->id}}">
        <td>{{$_SESSION['i']}}</td>
        <td>{{$dash}}{{$subcategory->designation}}</td>
        <td>{{$subcategory->parent->designation}}</td>
        <td>
            <form action="{{url('admin/category/'.$subcategory->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
            <div class="d-flex">
                <a href="{{url('admin/category/'.$subcategory->id.'/edit')}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                <button class="  btn btn-danger shadow btn-xs sharp" onclick="return confirm('Vous voulez vraiment supprimer?')"><i class="fa fa-trash"></i></button>
            </div>
            </form>
        </td>
    </tr>
    @if(count($subcategory->childCategories))
        @include('sub-category-list',['subcategories' => $subcategory->childCategories])
    @endif
@endforeach
