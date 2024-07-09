@extends('layout')

@section('title')
    (it) Change WS MAP
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
<style>
    .scroll{
  width: auto; 
  padding: 0px;
  overflow-x: scroll;
  height: 750px;
}
</style>
@section('body')

<div class="row">
        <div class="col-sm-12">
            <h1 class="page-header">Edit - WS MAP - 3D Animation</h1>                   
        </div>
    </div> 
<div class="row" style=" margin-bottom: 10px;">
        <div class="col-sm-12">
           <a href="{{route('indexMAP')}}" class="btn btn-sm btn-primary" target="">Back</a>    
           <a href="{{route('PDF-3D')}}" class="btn btn-sm btn-warning">Edit</a>             
        </div>
    </div> 
<div class="container-fluid"><div class="scroll"> 
<div class="btn-sm" style="width: 3500px;">   
    <div class="row">

        <!-- Page 1 -->
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">1</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">2</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">3</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">4</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">5</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">6</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">7</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">8</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 1 -->
    <!-- Page 2 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">9</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">10</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">11</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">12</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">13</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">14</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">15</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">16</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 2 -->

    <!-- Page 3  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">17</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">18</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">19</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">20</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">21</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">22</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">23</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">24</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 3 -->
    <!-- Page 4 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">25</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">26</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">27</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">28</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">29</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">30</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">31</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">32</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 4 -->

     <!-- Page 5  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">33</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">34</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">35</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">36</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">37</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">38</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">39</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">40</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 5 -->
    <!-- Page 6 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">41</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">42</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">43</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">44</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">45</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">46</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">47</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">48</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 6 -->

    <!-- Page 7  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 75px;">
              <div class="panel-heading">156</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>           
            <div class="panel panel-default" style="margin-top: 75px;">
              <div class="panel-heading">49</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">50</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">51</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">52</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">53</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">54</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 7 -->
    <!-- Page 8  -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 75px;">
              <div class="panel-heading">157</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>           
            <div class="panel panel-default" style="margin-top: 75px;">
              <div class="panel-heading">55</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">56</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">57</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">58</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">59</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">60</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 8 -->

    <!-- Page 9  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 75px;">
              <div class="panel-heading">158</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>           
            <div class="panel panel-default" style="margin-top: 75px;">
              <div class="panel-heading">61</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">62</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">63</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">64</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">65</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">66</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 9 -->
    <!-- Page 10  -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 75px;">
              <div class="panel-heading">159</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>           
            <div class="panel panel-default" style="margin-top: 75px;">
              <div class="panel-heading">67</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">68</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">69</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">70</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">71</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">72</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 10 -->

     <!-- Page 11  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 145px;">
              <div class="panel-heading">73</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">74</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">75</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">76</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">77</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">78</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">79</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 11 -->
    <!-- Page 12 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default"  style="margin-top: 145px;">
              <div class="panel-heading">80</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">81</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">82</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">83</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">84</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">85</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">86</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>

    <!-- Page 12 -->
 <!-- Page 13  -->
     <div style="width: 180px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default" style="margin-top: 145px;">
              <div class="panel-heading">87</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">88</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">89</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">90</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">91</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">92</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">93</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 13 -->
    <!-- Page 14 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default"  style="margin-top: 145px;">
              <div class="panel-heading">94</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">95</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">96</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">97</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">98</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">99</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">100</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 14 -->

      <!-- Page 15 -->
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">101</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">102</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">103</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">104</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">105</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">106</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">107</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">108</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 15 -->
    <!-- Page 16 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">109</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">110</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">111</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">112</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">113</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">114</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">115</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">116</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 16 -->

      <!-- Page 17 -->
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">117</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">118</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">119</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">120</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">121</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">122</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">123</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">124</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 1 -->
    <!-- Page 2 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">125</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">126</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">127</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">128</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">129</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">130</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">131</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">132</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 18 -->

      <!-- Page 19 -->
      <div style="width: 180px; margin-left: 0px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">133</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">134</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">135</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">136</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">137</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">138</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">139</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">140</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 19 -->
    <!-- Page 20 -->
     <div style="width: 180px; margin-left: -30px; position: relative;" class="col-sm-1">
         <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">141</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">142</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">143</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">144</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">145</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">146</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">147</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">148</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 20 -->


    <!-- Page 21 -->
        <div style="width: 180px; margin-top: 75px; position: relative;" class="col-sm-1">
         <div class="panel-group">
           
            <div class="panel panel-default">
              <div class="panel-heading">149</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">150</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">151</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">152</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">153</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>           
          </div>
          <div class="panel panel-default">
              <div class="panel-heading">154</div>
              <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">155</div>
               <div class="panel-body">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
                  <input type="text" name="" class="form-control" placeholder="{{auth::user()->username}}" readonly="true">
              </div>
            </div>            
        </div>
      </div>
    <!-- Page 21 -->

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

