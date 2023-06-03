<div class="modal fade" id="orderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter Un Variant</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <div class="basic-form">
                      <div class="form-row">
                        <div class="col-md-12">
                            <label>Client*:</label>
                            <input type="text"  class="form-control input-default " value="{{ $order->name }}" id="name" >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mt-2">
                            <label>Téléphone*:</label>
                            <input type="text"  class="form-control input-default " value="{{ $order->phone }}" id="phone" >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mt-2">
                            <label>Wilaya*:</label>
                            <select class="form-control" id="wilaya"  class="selectpicker" data-live-search="true" >
                                @foreach ($wilayas as $wilaya)
                                <option value="{{ $wilaya->wilaya }}" @if( $order->wilaya == $wilaya->wilaya ) selected @endif >{{ $wilaya->wilaya }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mt-2">
                            <label>Commune*:</label>
                            <select class="form-control" id="commune"  class="selectpicker" data-live-search="true" >
                               <option value="{{ $order->commune }}" selected  >{{ $order->commune }}</option>

                            </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mt-2">
                            <label>Adresse*:</label>
                            <input type="text"  class="form-control input-default " value="{{ $order->address }}" id="address" >
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12 mt-2">
                           <label>Statut :</label>
                           <select class="form-control" id="status"  class="selectpicker" data-live-search="true" name="status">
                            <option value="0" @if( $order->status == 0 ) selected @endif >En attente</option>
                            <option value="1" @if( $order->status == 1 ) selected @endif >En cours de livraison</option>
                            <option value="2" @if( $order->status == 2 ) selected @endif >Livré</option>
                            <option value="3" @if( $order->status == 3 ) selected @endif >Annuler</option>
                            <option value="4" @if( $order->status == 4 ) selected @endif >En attente de paiement</option>
                         </select>
                        </div>
                     </div>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Fermer</button>
                <button type="button"  class="btn btn-primary storeAttribute">Envoyer</button>
            </div>
        </div>
    </div>
</div>
