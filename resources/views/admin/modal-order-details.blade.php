<style>
    .total-calculator{
      font-family: 'Orbitron', sans-serif;
      font-size:20px;
      color:#60348B;
      font-weight : bold;
	  pointer-events: none;
	  height: 30px;
      border: none;
    }
</style>
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails commande</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form id="sbmitF">
            <div class="modal-body">
                <div class="card-body">
                    <div class="basic-form">

                     @foreach($orderlines as $orderline)
                     <div class="form-row">
                            <div class="form-group col-md-7">
                                <label> Produit:</label>
                                <input type="text"  class="form-control invalid" value="{{$orderline->productline->product->designation}} {{ $orderline->productline->attributeLine->value }}" disabled>

                              </div>

                            <div class="form-group col-md-2">
                                <label>Qte:</label>
                                <input type="text"  class="form-control invalid"value="{{$orderline->qte}}"disabled >
                            </div>
                            <div class="form-group col-md-3">
                                <label>Total:</label>
                                <input type="text"  class="form-control invalid"value="{{$orderline->total}}" disabled>
                            </div>
                        </div>
                       @endforeach
                      </div>
                      <label>Total :</label>
                      <input  class="total-calculator mt-3"  value="{{ number_format($total, 2) }}  Da"disabled>
                 </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger light" data-dismiss="modal">Fermer</button>

            </div>
        </div>
    </div>
</div>
