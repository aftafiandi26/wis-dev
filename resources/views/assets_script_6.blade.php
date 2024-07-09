<script src="{!! URL::route('assets/js/jquery') !!}"></script>

<script>
function hitung2() {
    var a = $("#entitlement").val();
    var b = $("#total_day").val();
    c = a - b; //a min b
    $("#remain").val(c);
}
</script>
