<!DOCTYPE html>
<html>
<head>
    <title>Data - Canteen</title>
</head>
<body>
<table id="1" border="1">
   <thead>
    <tr>
        <th style="text-align: center;">Summary Canteen </th>       
    </tr>
    <tr>
         <td style="text-align: center;"><small>{{ $started }} ~ {{ $ended }}</small></td>
    </tr>
       <tr>                            
            <th style="text-align: center;">No</th>                                            
            <th style="text-align: center;">NIK</th>
            <th style="text-align: center;">Name Employee</th>
            <th style="text-align: center;">Department</th>                           
            <th style="text-align: center;">Total Point</th>
            <th style="text-align: center;">Rating</th>
            <th style="text-align: center;">Prefer</th>
            <th style="text-align: center;">Vegetarian</th>
            <th style="text-align: center;">Date Entry</th>
            <th style="text-align: center;">Comment</th>   
        </tr>                      
    </thead> 
    <tbody>
       <?php foreach ($data as $value): ?>
         <tr>
            <td> {{ $page++ }} </td>
            <td> <?php 
                 $query = App\NewUser::find($value->id_userss);
                 echo $query->nik;
                  ?>
            </td>
            <td> <?php 
                  $query = App\NewUser::find($value->id_userss);
                    echo $query->first_name.' '.$query->last_name;
                 ?>
            </td>                           
            <td>
                <?php 
                  $query_dept = App\Dept_Category::find($query->dept_category_id);
                  echo $query_dept->dept_category_name;
                ?>
            </td>
            <td> {{ $value->total_point }} </td>
            <td> {{ $value->averange }} </td>
            <td>
                @if ($value->prefer === 1)
                Rice + Main Dish + Vegetables
                @else
                Rice + Main Dish + Side Dish + Vegetable
                @endif
            </td>
            <td>
                @if ($value->vegetarian === 1)
                Yes
                @else
                No
                @endif
            </td>
            <td> {{ $value->date_entry }} </td>
            <td> {{ $value->comment }}</td>
         </tr>
       <?php endforeach ?>
    </tbody> 
</table>
</body>
</html>