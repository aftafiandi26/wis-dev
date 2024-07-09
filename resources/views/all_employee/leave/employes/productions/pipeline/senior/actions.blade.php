<a data-role="{{ route('all_employes/leave/transaction/senior-pipeline/detail', $leave->id) }}" data-toggle="modal" data-target="#modalDetail" class="btn btn-sm btn-default" id="detail" title="detail form transaction leave"><i class="glyphicon glyphicon-file"></i></a>
<a href="{{ route('all_employes/leave/transaction/senior-pipeline/pdf', $leave->id) }}" target="_blank" class="btn btn-sm btn-default" id="download" title="download form transaction leave" rel="noopener noreferrer"><i class="glyphicon glyphicon-download-alt"></i></a>
@if ($leave->resendmail != 0)
@if ($leave->ap_hrd == 0)
<a data-role="{{ route('all_employes/leave/transaction/senior-pipeline/mail', $leave->id) }}" data-toggle="modal" data-target="#modalReminder" class="btn btn-sm btn-default" id="reminder" title="detail form transaction leave"><i class="glyphicon glyphicon-send"></i></a>
@endif
@endif
@if ($leave->ap_hd=== 0)
<a data-role="{{ route('all_employes/leave/transaction/hd/delete', $leave->id) }}" data-toggle="modal" data-target="#modalDelete" class="btn btn-sm btn-default" id="delete" title="detail form transaction leave"><i class="glyphicon glyphicon-trash"></i></a>
@endif
