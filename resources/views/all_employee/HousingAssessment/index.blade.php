@extends('layout')

@section('title')
    (it) Index Voting
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
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Housing Assessment</h1> 
        <h3 class="text-center">Feedback</h3>
    </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <form> 

      <div class="container-fluid">
        <div class="row">
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-lg-2 col-form-label">Name :</label>
            <div class="col-lg-6 col-sm-4">
              <input type="text" class="form-control" id="name" placeholder="name" value="{{ auth::user()->getFullName() }}" readonly="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="nik" class="col-sm-2 col-lg-2 col-form-label">NIK :</label>
            <div class="col-lg-6 col-sm-4">
              <input type="text" class="form-control" id="nik" placeholder="nik" value="{{ auth::user()->nik }}" readonly="true" name="nik">
            </div>
          </div>
          <div class="form-group row">
            <label for="dormAddress" class="col-sm-2 col-lg-2 col-form-label">Dormitory Address :</label>
            <div class="col-lg-2 col-sm-3">
              <select class="form-control custom-select" name="dormAddress" required="true">
                <option>-select TB-</option>
                <option value="TB01">TB01</option>
                <option value="TB02">TB02</option>
                <option value="TB03">TB03</option>
                <option value="TB04">TB04</option>
                <option value="TB05">TB05</option>
                <option value="TB06">TB06</option>
                <option value="TB03">TB07</option>
                <option value="TB03">TB08</option>
                <option value="TB09">TB09</option>
                <option value="TB10">TB10</option>
              </select>
            </div>
            <label for="roomNumber" class="col-sm-2 col-lg-2 col-form-label">Room Number :</label>
            <div class="col-lg-2 col-sm-3">
              <input type="number" class="form-control" id="roomNumber" placeholder="your room" min="1" name="roomNumber" required="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="dormStatus" class="col-sm-2 col-lg-2 col-form-label">Dormitory Status :</label>
            <div class="col-lg-6 col-sm-4">
              <select class="form-control custom-select" name="dormStatus" id="dormStatus" required="">
                <option>-select dormitory status-</option>
                <option value="Sharing">Sharing</option>
                <option value="Single Paid">Single Paid</option>
                <option value="Single Free">Single Free</option>
              </select>
            </div>
          </div>         
        </div>
      </div>
      <hr>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <div class="form-group row">
             <label for="dormStatus" class="col-sm-12 col-lg-4 col-form-label"><span style="color: red;">*</span> Room Facilities <span style="color: red;">(range value 1 - 10)</span> <label>
            </div>
            <div class="form-group row">
              <label for="bed" class="col-sm-2 col-lg-2 col-form-label">Bed :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="bed" placeholder="0" min="1" max="10" required="true" name="bed">
              </div>
            </div>
            <div class="form-group row">
              <label for="pillow" class="col-sm-2 col-lg-2 col-form-label">Pillow :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="pillow" placeholder="0" min="1" max="10" required="true" name="pillow">
              </div>
            </div>
            <div class="form-group row">
              <label for="floor" class="col-sm-2 col-lg-2 col-form-label">Floor :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="floor" placeholder="0" min="1" max="10" required="true" name="floor">
              </div>
            </div>
            <div class="form-group row">
              <label for="wallPaint" class="col-sm-2 col-lg-2 col-form-label">Wall Paint :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="wallPaint" placeholder="0" min="1" max="10" required="true" name="wallPaint">
              </div>
            </div>
            <div class="form-group row">
              <label for="clothesCloset" class="col-sm-2 col-lg-2 col-form-label">Clothes Closet :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="clothesCloset" placeholder="0" min="1" max="10" required="true" name="clothesCloset">
              </div>
            </div>
            <div class="form-group row">
              <label for="ac" class="col-sm-2 col-lg-2 col-form-label">AC :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="ac" placeholder="0" min="1" max="10" required="true" name="ac">
              </div>
            </div>
            <div class="form-group row">
              <label for="fan" class="col-sm-2 col-lg-2 col-form-label">Fan :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="fan" placeholder="0" min="1" max="10" required="true" name="fan">
              </div>
            </div>
            <div class="form-group row">
              <label for="electricity" class="col-sm-2 col-lg-2 col-form-label">Electricity :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="electricity" placeholder="0" min="1" max="10" required="true" name="electricity">
              </div>
            </div>
            <div class="form-group row">
              <label for="water" class="col-sm-2 col-lg-2 col-form-label">Water :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="water" placeholder="0" min="1" max="10" required="true" name="water">
              </div>
            </div>
            <div class="form-group row">
              <label for="restroom" class="col-sm-2 col-lg-2 col-form-label">Restroom :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="restroom" placeholder="0" min="1" max="10" required="true" name="restroom">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-4">
            <div class="form-group row">
             <label for="dormStatus" class="col-sm-12 col-lg-4 col-form-label"><span style="color: red;">*</span> Public Facilities <span style="color: red;">(range value 1 - 10)</span> <label>
            </div>
            <div class="form-group row">
              <label for="building" class="col-sm-2 col-lg-2 col-form-label">Building :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="building" placeholder="0" min="1" max="10" required="true" name="building">
              </div>
            </div>
            <div class="form-group row">
              <label for="securityPost" class="col-sm-2 col-lg-2 col-form-label">Security Post :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="securityPost" placeholder="0" min="1" max="10" required="true" name="securityPost">
              </div>
            </div>
            <div class="form-group row">
              <label for="parkingArea" class="col-sm-2 col-lg-2 col-form-label">Parking Area :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="parkingArea" placeholder="0" min="1" max="10" required="true" name="parkingArea">
              </div>
            </div>
            <div class="form-group row">
              <label for="sportArea" class="col-sm-2 col-lg-2 col-form-label">Sport Area :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="sportArea" placeholder="0" min="1" max="10" required="true" name="sportArea">
              </div>
            </div>
            <div class="form-group row">
              <label for="mosque" class="col-sm-2 col-lg-2 col-form-label">Mosque :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="mosque" placeholder="0" min="1" max="10" required="true" name="mosque">
              </div>
            </div>
            <div class="form-group row">
              <label for="ATM" class="col-sm-2 col-lg-2 col-form-label">ATM Centre :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="ATM" placeholder="0" min="1" max="10" required="true" name="ATM">
              </div>
            </div>
            <div class="form-group row">
              <label for="minimarket" class="col-sm-2 col-lg-2 col-form-label">Minimarket :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="minimarket" placeholder="0" min="1" max="10" required="true" name="minimarket">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-4">
            <div class="form-group row">
             <label for="dormStatus" class="col-sm-12 col-lg-4 col-form-label"><span style="color: red;">*</span> Housing Service <span style="color: red;">(range value 1 - 10)</span> <label>
            </div>
            <div class="form-group row">
              <label for="security" class="col-sm-2 col-lg-2 col-form-label">Security :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="security" placeholder="0" min="1" max="10" required="true" name="security">
              </div>
            </div>
            <div class="form-group row">
              <label for="officeStaff" class="col-sm-2 col-lg-2 col-form-label">Office Staff :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="officeStaff" placeholder="0" min="1" max="10" required="true" name="officeStaff">
              </div>
            </div>
            <div class="form-group row">
              <label for="maintanaceStaff" class="col-sm-2 col-lg-2 col-form-label">Maintanace Staff :</label>
              <div class="col-lg-6 col-sm-4">
                <input type="number" class="form-control" id="maintanaceStaff" placeholder="0" min="1" max="10" required="true" name="maintanaceStaff">
              </div>
            </div>
          </div>
        </div>
      </div>

    </form>
  </div>
</div>
 @stop 

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 

