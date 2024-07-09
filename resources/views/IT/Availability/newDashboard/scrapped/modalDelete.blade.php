<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Verify Deleted</h4>
</div>
<div class="modal-body">
    <h4>Are you sure delete this data <b>{{$workstation->hostname}}</b> ?</h4>
</div>
<div class="modal-footer">
   <div class="row">
    <div class="col-lg-12">
        <form action="{{ route('workstations/availability/scrapped/delete/post', [$workstation->id]) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $workstation->hostname }}" name="hostname">
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>       
            <a type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</a>
        </form>
    </div>
   </div>
</div>
