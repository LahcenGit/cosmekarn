<div class="modal fade" id="exampleModal">
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
                        <div class="form-group">
                            <label>Attribut*:</label>
                            <input type="text"  class="form-control input-default @error('attr') is-invalid @enderror" value="{{old('attr')}}" name="attr" placeholder="Attribut">
                                @error('attr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">

                            <label>Type :</label>

                            <select class="form-control" id="sel1"  class="selectpicker" data-live-search="true" name="type">
                                <option value=0>Nothing selected</option>
                                    @foreach($attributes as $attribute)
                                    <option value="{{$attribute->id}}" @if (old('attribute') == $attribute->id ) selected @endif >{{$attribute->value}}</option>
                                    @endforeach
                            </select>
                        </div>
                     </div>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Fermer</button>
                <button type="button" id="storeVersment"  class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
