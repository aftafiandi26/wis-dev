
<div class="row">
    <div class="col-lg-12">
        Dear All, <br><br>
        Please find this workstation availability summary :
        <br>
        <br>     
        <table>
            <tr>
                <td>Generic PC</td>
                <td>:</td>
                <td><?php echo ($Generic);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>HP z200 i7</td>
                <td>:</td>
                <td><?php echo ($z200i7);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>HP z200 i5</td>
                <td>:</td>
                <td><?php echo ($z200i5);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>HP z210</td>
                <td>:</td>
                <td><?php echo ($z210);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>HP z400</td>
                <td>:</td>
                <td><?php echo ($z400);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>HP z600</td>
                <td>:</td>
                <td><?php echo ($z600);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>Dell T3620</td>
                <td>:</td>
                <td><?php echo ($T3620);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>Dell T7910</td>
                <td>:</td>
                <td><?php echo ($T7910);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>HP z240</td>
                <td>:</td>
                <td><?php echo ($z240);  ?> Units ready to use </td>
            </tr>
            <tr>
                <td>HP z640</td>
                <td>:</td>
                <td><?php echo ($z640);  ?> Units ready to use </td>
            </tr>

             <tr>
                <td><strong>Total</td>
                <td>:</td>
                <td><strong><?php echo count($total);  ?> Units ready to use</td>
            </tr>            
        </table> 
           
       <br>
       <br>
       For the complete information of workstation availability, please check the link below:
       <br>
       <a href="{!! route('index') !!}">click here to login</a><br><br>
       Thanks.
        <br>
        <br>
       --
       <br>
       <br>
      {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
      <br>
      {{ Auth::user()->position }}
    </div>
</div>