<div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
    <h4 class='modal-title text-center' id='showModalLabel'>Form Remote Access</h4>
</div>
<div class='modal-body'>
   <div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-strip">
            <tr>
                <td class="col-lg-3">
                    <b>Request Date: sd</b>
                    <br>
                    {{ $form->created_at }}
                </td>
                <td class="col-lg-3" colspan="2"></td>
                <td class="col-lg-3">
                    <b>Request By: </b>
                    {{ $form->user->getFullName() }}
                    <br>
                    <b>Project:</b>
                    {{ $form->user->getProjectName($form->user->project_category_id_1) }}
                </td>
            </tr>
            <tr>
                <td class="col-lg-3" style="background-color: aqua" colspan="4"></td>
            </tr>
            <tr>
                <td class="col-lg-3">
                    <b>Start Overtime:</b>
                    <br>
                    {{ $form->startovertime }}

                </td>
                <td class="col-lg-3" colspan="2">
                    <b>Working Time:</b>
                    <br>
                    {{ $duration['hour'] }} hour, {{ $duration['minute'] }} minute
                </td>
                <td class="col-lg-3">
                    <b>End Overtime:</b>
                    <br>
                    {{ $form->endovertime }}
                </td>
            </tr>
            <tr>
                <td class="col-lg-3" style="background-color: aqua" colspan="4"></td>
            </tr>
            <tr>
                <td class="col-lg-3" colspan="4">
                    <b>Reason:</b>
                    <br>
                    <br>
                    <p>{{ $form->reason }}</p>
                </td>
            </tr>
            <tr>
                <td class="col-lg-3" style="background-color: aqua" colspan="4"></td>
            </tr>
            <tr>
                <td class="col-lg-3" >
                    <b>Open Access:</b>
                </td>
                <td class="col-lg-3" colspan="3">
                    <div class="checkbox">
                        <label><input type="checkbox" @if ($form->vpn == true)
                            checked
                        @endif>VPN</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-lg-3" style="background-color: aqua" colspan="4"></td>
            </tr>
            <tr>
                <td class="col-lg-3" colspan="4"><b>Acknowledged By:</b></td>
            </tr>
            <tr class="text-center">
                <td class="col-lg-3">
                    <b>Coordinator:</b>
                    <br>
                    <br>
                    {{ $approvalStatus['coordinator'] }}
                    <br>
                    <br>
                    {{ $form->coordinator->getFullName() }}
                </td>   
                <td class="col-lg-3" colspan="2"></td>           
                <td class="col-lg-3">
                    <b>Head of Department:</b>
                    <br><br>
                    {{ $approvalStatus['generalManager'] }}
                    <br><br>
                    {{ $form->generalManager->getFullName() }}
                </td>
            </tr>
            <tr>
                <td class="col-lg-3" style="background-color: aqua" colspan="4"></td>
            </tr>
        </table>
    </div>
   </div>
</div>
<div class='modal-footer'>
    <button class="btn btn-primary" data-role="{{ route('it/registration/form/overtimes/verified', $form->id) }}" title="approved" id="approved">Verify</button>
    <button class="btn btn-danger" data-role="{{ route('it/registration/form/overtimes/unverified', $form->id) }}" title="disapproved" id="disapproved">Unverify</button>
    <button class="btn btn-default" data-dismiss="modal">Close</button>
</div> ";

<script>
$(document).on('click','#approved',function(e) {
    e.preventDefault();
    var id = $(this).attr('data-role');
    document.getElementById('postApproval').action = id;
    document.getElementById('postApproval').submit();

});

$(document).on('click','#disapproved',function(e) {
    e.preventDefault();
    var id = $(this).attr('data-role');
    document.getElementById('postApproval').action = id;
    document.getElementById('postApproval').submit();

});
</script>
