<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Ex-Employee.</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-8">
            <table class="table table-condensed table-bordered table-hover table-striped">
                <tbody>
                  <tr>
                    <td>First Name</td>
                    <td>:</td>
                    <td>{{ $user->first_name }}</td>
                  </tr>
                  <tr>
                    <td>Last Name</td>
                    <td>:</td>
                    <td>{{ $user->last_name }}</td>
                  </tr>
                  <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $user->nik }}</td>
                  </tr>
                  <tr>
                    <td>Department</td>
                    <td>:</td>
                    <td>{{ $user->getDepartment() }}</td>
                  </tr>
                  <tr>
                    <td>Position</td>
                    <td>:</td>
                    <td>{{ $user->position }}</td>
                  </tr>
                  <tr>
                    <td>Emp. Status</td>
                    <td>:</td>
                    <td>{{ $user->emp_status }}</td>
                  </tr>
                  <tr>
                    <td>Join Date</td>
                    <td>:</td>
                    <td>{{ $user->converDate($user->join_date) }}</td>
                  </tr>
                  <tr>
                    <td>End Date</td>
                    <td>:</td>
                    <td>{{ $user->converDate($user->end_date) }}</td>
                  </tr>
                  <tr>
                    <td>Projects</td>
                    <td>:</td>
                    <td>
                        {{ $user->getProjectName($user->project_category_id_1) }}
                        @if ($user->project_category_id_2 != null)
                            - {{ $user->getProjectName($user->project_category_id_2) }}
                        @endif
                        @if ($user->project_category_id_3 != null)
                            - {{ $user->getProjectName($user->project_category_id_3) }}
                        @endif
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <img src="{{ asset('storage/app/prof_pict/'.$user->prof_pict.'') }}" class="img-fluid img img-circle" alt="img" height="250px" width="250px">
        </div>
       </div>
       <hr>
       <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-hover table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>ID Card</td>
                        <td>:</td>
                        <td>{{ $user->id_card }}</td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td>:</td>
                        <td>{{ $user->getFullName() }}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td>{{ $user->gender }}</td>
                    </tr>
                    <tr>
                        <td>Place of Birth</td>
                        <td>:</td>
                        <td>{{ $user->pob }}</td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>:</td>
                        <td>{{ $user->converBirthDate($user->dob) }}</td>
                    </tr>
                    <tr>
                        <td>Province</td>
                        <td>:</td>
                        <td>{{ $user->province }}</td>
                    </tr>
                    <tr>
                        <td>Religion</td>
                        <td>:</td>
                        <td>{{ $user->religion}}</td>
                    </tr>
                    <tr>
                        <td>Maiden Name</td>
                        <td>:</td>
                        <td>{{ $user->maiden_name }}</td>
                    </tr>
                    <tr>
                        <td>Marital Staus</td>
                        <td>:</td>
                        <td>{{ $user->marital_status }}</td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>:</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <td>Area</td>
                        <td>:</td>
                        <td>{{ $user->area }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td>{{ $user->city }}</td>
                    </tr>
                    <tr>
                        <td>Education</td>
                        <td>:</td>
                        <td>{{ $user->education }}</td>
                    </tr>
                    <tr>
                        <td>Education Instutition</td>
                        <td>:</td>
                        <td>{{ $user->education_instutition }}</td>
                    </tr>
                    <tr>
                        <td>NPWP</td>
                        <td>:</td>
                        <td>{{ $user->npwp }}</td>
                    </tr>
                    <tr>
                        <td>KK</td>
                        <td>:</td>
                        <td>{{ $user->kk }}</td>
                    </tr>
                    <tr>
                        <td>BPJS Ketenagakerjaan</td>
                        <td>:</td>
                        <td>{{ $user->bpjs_ketenagakerjaan }}</td>
                    </tr>
                    <tr>
                        <td>BPJS Kesehatan</td>
                        <td>:</td>
                        <td>{{ $user->bpjs_kesehatan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
       </div>
</div>
<div class="modal-footer">
    {{-- <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button> --}}
</div>
