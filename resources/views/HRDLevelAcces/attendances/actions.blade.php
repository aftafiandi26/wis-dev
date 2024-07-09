<a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modalEdit" data-role="{{ route('hr/summary/attendance/edit', $id) }}" title="edit" id="edit"><i class="fa fa-pencil"></i></a>
<a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modalDelete" data-role="{{ route('hr/summary/attendance/delete', $id) }}" title="delete" id="delete"><i class="fa fa-trash"></i></a>
<a class="btn btn-sm btn-default" href="{{ route('hr/summary/attendance/reset', $id) }}" title="reset attendance" id="reset"><i class="fa fa-refresh"></i></a>
