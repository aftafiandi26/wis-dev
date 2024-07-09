<form action="{{ route('form/progressing/update', $form->id) }}" method="post">
    {{ csrf_field() }}
    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title text-center' id='showModalLabel2'>Form Remote Access Request Above 23.00</h4>
    </div>
    <div class='modal-body'>
       <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-strip">
                <tr>
                    <td class="col-lg-3">
                        <b>Request Date:</b>
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
                        <label for="startovertime"><b>Start:</b></label>
                        <br>
                        <input type="datetime-local" name="startovertime" id="startovertime" value="{{ $form->startovertime }}" required class="form-control" required>

                    </td>
                    <td class="col-lg-3" colspan="2">
                        <b>Time:</b>
                        <br>
                        {{ $duration['hour'] }} hour, {{ $duration['minute'] }} minute
                    </td>
                    <td class="col-lg-3">
                        <label for="endovertime"><b>End:</b></label>
                        <br>
                        <input type="datetime-local" name="endovertime" id="endovertime" value="{{ $form->endovertime }}" required class="form-control" required>
                    </td>
                </tr>
                <tr>
                    <td class="col-lg-3" style="background-color: aqua" colspan="4"></td>
                </tr>
                <tr>
                    <td class="col-lg-3" colspan="4">
                        <label for="reason"><b>Reason:</b></label>
                        <br>
                        <br>
                        <textarea name="reason" id="reason" class="form-control" cols="30" rows="5">{{ $form->reason }}</textarea>
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
                            <label><input  name="vpn" type="checkbox" @if ($form->vpn == true)
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
                       <label for="coordinator"><b>Coordinator:</b></label>
                        <br>
                        <br>
                        {{ $approvalStatus['coordinator'] }}
                        <br>
                        <br>
                        <select name="coordinator" id="coordinator" class="form-control" required>
                            @foreach ($coordinator as $coor)
                                <option value="{{ $coor->id }}" @if ($coor->id === $form->coor_id)
                                    selected
                                @endif>{{ $coor->getFullName() }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="col-lg-3" colspan="2">
                        
                    </td>
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
        <button type='submit' class='btn btn-success'>Save</button>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
    </div> ";
</form>
