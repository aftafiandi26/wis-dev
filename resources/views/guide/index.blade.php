@extends('layout')

@section('title')
    Guide WIS
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')
<style type="text/css">
.gadang {
  background-color: transparent;
  transition: transform .2s;
 
  margin: 0 auto;
}

.gadang:hover {
  -ms-transform: scale(2.0); /* IE 9 */
  -webkit-transform: scale(2.0); /* Safari 3-8 */
  transform: scale(2.0); 
}
</style>
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">How To?</h1> 
        </div>
</div> 
<div class="row"> 
<div class="col-lg-4">
    <ul class="nav nav-pills nav-stacked">          
       <li><button type="button" class="btn btn-link" data-toggle="modal" data-target="#password">How to change password?</button></li>
       <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">How to apply for leave?<span class="caret pull-right"></span></a>
            <ul class="dropdown-menu">
                <li><button type="button" class="btn btn-link" data-toggle="modal" data-target="#annual">Annual</button></li>
                <li><button type="button" class="btn btn-link" data-toggle="modal" data-target="#exdo">Exdo</button></li>
                <li><button type="button" class="btn btn-link" data-toggle="modal" data-target="#etc">Etc</button></li>                        
            </ul>
        </li>        
        <li><button type="button" class="btn btn-link" data-toggle="modal" data-target="#approve">How to approve or disapprove for leave?</button></li>
        <li><button type="button" class="btn btn-link" data-toggle="modal" data-target="#tracking">How to tracking for leave form?</button></li>
        <li>
          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#attendance">How to use attendance?</button>
        </li>
         <li><form method="POST" action="{{route('getGUuide')}}">
              {{ csrf_field() }}
                <button type="submit" class="btn btn-link">Download Booklet</button>
                </form>
        </li>
    </ul>
</div>
</div> 
<div class="row">
    <hr class="my-5">
    <small>
    <font color="red">**</font><font class="grey">Note:</font>
    <ul><li style="color: grey;">If you have questions?<br>Please send an email to administrator@wis.frameworks-studios.com</li></ul>
    </small>    
</div> 

<div class="modal" id="password">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">How to change password?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <img src="{{asset('storage/app/booklet/Change_Password.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang"><br>
       If you want to change password, <br>
       Menu for password change is in the upper right corner of the WIS screen session,
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="annual">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">How to apply annual leave?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         You can apply for annual leave by filling out the annual leave form.
        <br>
      <img src="{{asset('storage/app/booklet/form annual.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
      <br>
      <font color="red">*</font><b>Understanding of columns:</b>
      <br>
      <ul>
          <li><u>Select Your Coordinator</u> => Select email coordinator you’r headed?</li>
          <li><u>Select Your PM</u> => Select email PM you’r headed?</li>
          <li><u>Start Leave Date</u> => When to start leave</li>
          <li><u>End Leave Date</u>  => When to end leave</li>
          <li><u>Back to Work</u> => When to back work</li>
          <li><u>Total Day</u>   => How many days off work.</li>
      </ul>
      <br>
      <font color="red">*</font><b>Tracking form:</b>
      <ul>
          <li>If you department production:
              <ul>
                  <li>Employee => Coordinator -> PM => Head of Department => HR Receptionist => HR Manager</li>
              </ul>
          </li>
          <li>If you not department production:
              <ul>
                  <li>Employee => Head of Department => HR Receptionist => HR Manager</li>
              </ul>
          </li>
           <li>If you manager:
              <ul>
                  <li>Manager => HR Receptionist => HR Manager => COO Infinite Studios</li>
              </ul>
          </li>
      </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exdo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">How to apply exdo leave?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         You can apply for exdo leave by filling out the exdo leave form.
        <br>
      <img src="{{asset('storage/app/booklet/form exdo.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
      <br>
      <font color="red">*</font><b>Understanding of columns:</b>
      <br>
      <ul>
          <li><u>Select Your Coordinator</u> => Select email coordinator you’r headed?</li>
          <li><u>Select Your PM</u> => Select email PM you’r headed?</li>
          <li><u>Start Leave Date</u> => When to start leave</li>
          <li><u>End Leave Date</u>  => When to end leave</li>
          <li><u>Back to Work</u> => When to back work</li>
          <li><u>Total Day</u>   => How many days off work.</li>
      </ul>
      <br>
      <font color="red">*</font><b>Tracking form:</b>
      <ul>
          <li>If you department production:
              <ul>
                  <li>Employee => Coordinator -> PM => Head of Department => HR Receptionist => HR Manager</li>
              </ul>
          </li>
          <li>If you not department production:
              <ul>
                  <li>Employee => Head of Department => HR Receptionist => HR Manager</li>
              </ul>
          </li>
           <li>If you manager:
              <ul>
                  <li>Manager => HR Receptionist => HR Manager => COO Infinite Studios</li>
              </ul>
          </li>
      </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="etc">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">How to apply for leave with different categories?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         You can apply for leave by filling in the leave form and can choose the category of leave you need.
        <br>
      <img src="{{asset('storage/app/booklet/form etc.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
      <br>
      <font color="red">*</font><b>Understanding of columns:</b>
      <br>
      <ul>
          <li><u>Select Your Coordinator</u> => Select email coordinator you’r headed.</li>
          <li><u>Select Your PM</u> => Select email PM you’r headed.</li>
          <li><u>Start Leave Date</u> => When to start leave.</li>
          <li><u>End Leave Date</u>  => When to end leave.</li>
          <li><u>Back to Work</u> => When to back work.</li>
          <li><u>Total Day</u>   => How many days off work.</li>
          <li><u>Leave Category</u> => Select the leave category you'r needed to apply for leave</li>
      </ul>
      <br>
      <font color="red">*</font><b>Tracking form:</b>
      <ul>
          <li>If you department production:
              <ul>
                  <li>Employee => Coordinator => PM => Head of Department => HR Receptionist => HR Manager</li>
              </ul>
          </li>
          <li>If you not department production:
              <ul>
                  <li>Employee => Head of Department => HR Receptionist => HR Manager</li>
              </ul>
          </li>
           <li>If you manager:
              <ul>
                  <li>Manager => HR Receptionist => HR Manager => COO Infinite Studios</li>
              </ul>
          </li>
      </ul>
      <br>
      <font color="red">**</font>Note:
      <ul><li>If you submit this form, you must attach a statement to HR Department.</li></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="approve">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">How to approve or disapprove leave?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       Every member who submits leave, the leader will receive an email notification to approve and disapprove applications for members leave.
        <br>
      <img src="{{asset('storage/app/booklet/aprove_disapprove.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
      <br>     
      <img src="{{asset('storage/app/booklet/seleted_approve.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="tracking">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">How to approve or disapprove leave?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
     Leave transaction are used to see the results of filing leave, with an action column to see details of the leave.
        <br>
      <img src="{{asset('storage/app/booklet/tracking.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
      <br>
      <font color="red">**</font>Note:
      <br>
      <ul><li>Select action column for view transaction.</li></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="attendance">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">How to use attendance?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul>
          <li>You can choose attendance menu</li>
          <img src="{{asset('storage/app/booklet/attendance/menu.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
          <li>Click button check in for your attendance</li>
          <img src="{{asset('storage/app/booklet/attendance/form_attendance.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
          <img src="{{asset('storage/app/booklet/attendance/form_out_attendance.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
          <li>Attendance verification will appear you check in and check out to indicates your presence has been inputted to the system</li>
          <img src="{{asset('storage/app/booklet/attendance/verify_check_in.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
          <img src="{{asset('storage/app/booklet/attendance/feedback_in.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
          <li>You can check your attendance data records</li>
          <img src="{{asset('storage/app/booklet/attendance/record_data_attendance.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
        </ul>
        <br>
      <br>
      <font color="red">**</font>Note:
      <br>
      <ul>
        <li>For attendance can only be done once a day.</li>
        <li>The check out button will appear when you check in on the same day, if the day changes you cannot check out.</li>
      </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@stop 
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop