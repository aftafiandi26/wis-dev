<form action="{{ route('hr/management/dorm/update/delete', $data->id) }}" method="post">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dormitory {{ $data->getUser()->getFullName() }}</h4>
    </div>
    <div class="modal-body">     
        <h3>Are you sure delete this data?</h3>        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</form>