@extends('layout')

@section('title')
    Leave
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
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Applying Leave</h1>           
        </div>  
        <div class="col-lg-6 pull-right">
           
            <a class="btn btn-sm page-header pull-right" style="color: green;" title="Leave Guide" href="https://drive.google.com/file/d/1cqhqETMRXBZB2aBCcZ8CCYtjjaXAldLr/view?usp=sharing" target="_blank"> <i class="material-icons">&#xe63a;</i></a>
         
        </div>     
    </div>
    <div class="row">
        <div class="col-lg-4">                           
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed" id="tables">
                        <thead>
                            <tr style="white-space:nowrap">
                                <th>Leave Category</th>
                                <th>Available</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                         <tbody>
                            <tr style="white-space:nowrap">
                                <td>Available <sup>(ongoing month)</sup></td>
                                <td>
                                    <?php if (auth::user()->emp_status === "Permanent"): ?>                                        
                                        <?php if (auth::user()->forfeitcase === 1): ?> 
                                         {{ $totalAnnualPermanent1 }}    
                                        <?php else: ?>
                                         {{ $renewPermanet }}
                                        <?php endif ?>
                                    <?php else: ?>                                       
                                        <?php if (auth::user()->forfeitcase === 1): ?>                                            
                                        {{ $totalAnnual }}                            
                                        <?php else: ?>
                                        {{ $renewContract }} 
                                        <?php endif ?>
                                    <?php endif ?>
                                </td>
                                <td>
                                <?php if (auth::user()->emp_status === "Permanent"): ?>
                                            @if($totalAnnualPermanent1 > 0) 
                                                <a href="{!! URL::route('leave/create') !!}" class="btn btn-primary btn-xs" role="button">Apply</a>
                                            @endif
                                <?php elseif (auth::user()->emp_status === "Contract"): ?>
                                                    @if($totalAnnual > 0) 
                                                        <a href="{!! URL::route('leave/create') !!}" class="btn btn-primary btn-xs" role="button">Apply</a>
                                                    @endif
                                 <?php endif ?>
                                </td>                                
                            </tr>
                            
                            <tr style="white-space:nowrap">
                                <td>Exdo</td>
                                <td>{{ $remainExdo }}</td>
                                <td>
                                        @if($remainExdo > 0 )                                   
                                        <a href="{!! URL::route('leave/createExdo') !!}" class="btn btn-primary btn-xs" role="button">Apply</a>                                  
                                        @endif
                                </td>
                                <td></td>
                            </tr>
                            <tr style="white-space:nowrap">
                                <td>Etc</td>
                                <td>-</td>
                                <td>
                                    <a href="{!! URL::route('leave/createEtc') !!}" class="btn btn-primary btn-xs" role="button">Apply</a></td>
                                   
                                <td></td>
                            </tr>
                            <tr style="white-space:nowrap">
                                <td>Total Annual Leave <sup>(until EOC)</sup></td>
                                <td><span>
                                    <?php if (auth::user()->forfeitcase === 1): ?>
                                         {{ $user->initial_annual - $annual->transactionAnnual }}
                                    <?php else: ?>
                                          {{ $user->initial_annual - $annual->transactionAnnual - $bla }}
                                    <?php endif ?>
                                    </span>
                                    <?php if (auth::user()->forfeitcase === 1): ?>
                                        <?php if (auth::user()->emp_status === "Permanent"): ?>
                                            ( <span style="color: green;">{{ $totalAnnualPermanent1 }}</span> + {{ $user->initial_annual - $annual->transactionAnnual - $totalAnnualPermanent1 }} )
                                        <?php else: ?>
                                            ( <span style="color: green;">{{ $totalAnnual }}</span> + {{ $user->initial_annual - $annual->transactionAnnual - $totalAnnual }} )                              
                                        <?php endif ?> 
                                    <?php else: ?>
                                        <?php if (auth::user()->emp_status === "Permanent"): ?>
                                            ( <span style="color: green;">{{ $renewPermanet }}</span> + {{ $user->initial_annual - $annual->transactionAnnual - $totalAnnualPermanent1 }} )
                                        <?php else: ?>
                                            ( <span style="color: green;">{{ $renewContract }}</span> + {{ $user->initial_annual - $annual->transactionAnnual - $totalAnnual }} )                              
                                        <?php endif ?> 
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if (auth::user()->emp_status === "Contract"): ?>
                                        @if($user->initial_annual - $annual->transactionAnnual > 0)
                                             <a href="{!! URL::route('createAdvanceLeave') !!}" class="btn btn-danger btn-xs" role="button">Apply</a>
                                        @endif
                                    <?php endif ?> 
                                </td>

                                <td></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div> 
            <p style="font-size: 11px;"><i>Note : Please check the balance of your leave, Should any dispute , please contact the Receptionist </i></p>
        </div>
        <div class="col-lg-8">
            <h4>Index Annual</h4>
            <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed" id="indexAnnual">
                <thead>
                    <tr style="white-space:nowrap">
                       <th>Year</th>
                       <th>Balance</th>
                       <th>Taken</th>
                       <th>Remains</th>
                       <th>Available</th>
                    </tr>                    
                </thead>
                <tbody>
                    <tr>
                        <td>{{ date('Y') }}</td>
                        <td>{{ $user->initial_annual }}</td>
                        <td>{{ $annual->transactionAnnual }}</td>
                        <td>{{ $user->initial_annual - $annual->transactionAnnual }}</td>
                        <td>
                            <?php if (auth::user()->emp_status === "Permanent"): ?>
                                 {{ $totalAnnualPermanent1 }}
                            <?php else: ?>
                                 {{ $totalAnnual }}
                            <?php endif ?>
                        </td>
                    </tr>      
                </tbody>              
            </table>
        <br>
            <?php if (auth::user()->forfeitcase === 1): ?>
                 <h4>Index will be Forfeit</h4>  
            <?php else: ?>
                 <h4 style="color: red;">Index Forfeited (<sup style="color: grey;"><small>oops! sorry, forfeited leave is non-refundable</small></sup>)</h4>
            <?php endif ?>
           
            <table class="table table-striped table-hover table-condensed" id="indexForfeited">
                <thead>
                    <tr>
                        <th>Total Amount Forfeit <a href="{{ route('employee/forfeited/index') }}" class="btn btn-primary btn-xs">Check</a></th>                        
                    </tr>
                    <tr>
                        <th class="pull-left">
                            <?php if ($countAmount >= 0): ?>
                                {{ $countAmount }}
                            <?php else: ?>
                                 0
                            <?php endif ?>
                        </th>
                    </tr>       
                    <tr>
                        <td></td>
                    </tr>            
                </thead>               
            </table>                
           
        </div>
        </div>
    </div>
<div class="row">       
        <div class="col-lg-12">
            <h4 class="page-header">Index Exdo</h4>
        </div>
    </div>
<div class="row">   
    <div class="col-lg-6">      
         <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed" id="indexExdo">
                <thead>
                    <tr style="white-space:nowrap">
                       <th>No</th>
                       <th>Expired</th>
                       <th>Initial</th>
                       <th>Limit</th>  
                       <th>Note</th>
                    </tr>                    
                </thead>               
            </table>
        </div>
    </div>
    <!-- <hr> -->
    <div class="col-lg-4">
         <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed" id="indexstatExdo">
                <thead>
                    <tr style="white-space:nowrap">
                       <th>Total Initial</th>
                       <th>Taken</th>
                       <th>Remains</th>  
                       <th>Available</th> 
                    </tr>                    
                </thead> 
                <tbody>
                    <tr>
                        <td>{{ $exdo->sum() }}</td>
                        <td> {{ $minusExdo->sum() }} </td>
                        <td>{{ $remainExdo }}</td>
                        <td>{{ $remainExdo }}</td>
                    </tr>
                </tbody>              
            </table>
        </div>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();
   
       $('#indexExdo').DataTable({
                    processing: true,
                    ajax: '{{ route('indexDataExdo') }}',
                    columns: [
                        { data: 'DT_Row_Index', orderable: false, searchable : false}, 
                        { data: 'expired'},
                        { data: 'initial'},
                        { data: 'difforHumans'},
                        { data: 'note'}
                          
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                         'excel'
                    ]                 
            });

    $(document).on('click','#indexExdo tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop