<button href="{{ route('indexALLUSER/show', $id) }}" type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#showEmployes" id="show">Show</button>
<script>
     $('button#show').on('click', function(a){
        a.preventDefault();
        var href = $(this).attr('href');    

        $.ajax({
            url: href,
            data: 'get',
            success: function(b){           
                $("#contentModal").html(b);             
            }
        });
    });

</script>