<div style="background-color:;">
    <div class="row">
       <div class="col-lg-12">
            <img src="{{ $message->embed(base_path().'/assets/giphy.gif') }}">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><i>to:</i></p> 
        </div>
        <?php  $select =  DB::table('users')                        
                         ->whereMONTH('dob', '=', date('m'))
                         ->whereDAY('dob', '=', date('d'))
                          ->where('active', 1)
                         ->get();
        foreach ($select as $u): ?>
        <div class="col-lg-12">
           <b>-- {{ $u->first_name }} {{ $u->last_name }} <i>({{ $u->position }})</i> --</b>
        </div>
        <?php endforeach ?>
        <div class="col-lg-12">
            <p>Happy Birthday! Wishing you lots of beautiful and amazing moments in your life.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p><i>which is birthday on today ({{ date("d M Y") }})!!</i></p>
        </div>
    </div>
</div>
    