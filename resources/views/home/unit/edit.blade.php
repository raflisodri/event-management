<form action="{{ route('unit.update', $unit->id) }}" method="POST">
    @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label for="nameBackdrop" class="form-label">Nama</label>
                    <input type="text" id="nameBackdrop" class="form-control" placeholder="Enter Name" name="nama" value="{{$unit->nama}}">
                </div>
            </div>    
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
        </div>
</form>
