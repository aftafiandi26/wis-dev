<form action="{{ route('all_employes/leave/transaction/hd/delete/post', $id) }}" method="post">
    {{ csrf_field() }}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <h4 class="text-center text-bold">Are you sure delete this form ?</h4>
    </div>
    <div class="modal-footer" id="deleteFooter">
        <button type="submit" class="btn btn-sm btn-default" id="yes">Yes</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" id="no">No</button>
    </div>
</form>