
<div class="modal fade" id="exampleModal1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $pack->designation }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produit</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($packlines as $packline)
                        <tr>
                        <th scope="row">#</th>
                        <td>{{$packline->product->designation }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Fermer</button>
            </div>
    </div>
</div>
