@extends('layout')

@section('title')
    (hr) Forfeited leave
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop
@section('body')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forfeited leave {{ $user->first_name.' '.$user->last_name }}</h1> 
    </div>
</div>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-6">
        <a href="{{ route('forfeited/index') }}" class="btn btn-default btn-sm">back</a>
        <a class="btn btn-sm btn-primary pull-right" href="{{ route('forfeited/add', $user->id) }}" title="Add forfeited {{ $user->first_name.' '.$user->last_name }}"><span class="fas fa fa-plus"></span></a>
    </div>
</div>
<div class="row">
    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade in">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('danger') }}
        </div>
    @endif
</div>
<div class="row">
    <div class="col-lg-6">         
           <div class="table-sm">
                <table id="example"  class="table table-bordered table-hover text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Period</th>      
                            <th>Amount</th>  
                            <th>Action</th>                          
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach ($forfeited as $value): ?>
                        <tr>
                            <td>{{ $no++}}</td>
                            <td>{{ $value->year }}</td>
                            <td>{{ $value->countAnnual }}</td>
                            <td>
                                <a href="{{ route('forfeited/delete', $value->id) }}" class="btn btn-sm btn-danger" title="Delete this period {{ $value->year }}"><span class="fas fa fa-trash"></span></a> 
                                <a href="{{ route('forfeited/cutOff', [$value->user_id, $value->id]) }}" class="btn btn-sm btn-success"><span class="fas fa fa-pencil"></span></a>                              
                            </td>                          
                        </tr>
                        <?php endforeach ?>
                    </tbody>           
            </table>       
           </div> 
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')  
    @include('assets_script_7')
@stop

@section('script')

$(document).ready(function() {
    $('#example').DataTable();
} );
@endsection