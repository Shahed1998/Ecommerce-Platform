<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <center><p>Active customer list {{now()->toDateTimeString()}}</p></center>
  
    <table class="table table-bordered table-hover w-50">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gmail</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Contact No</th>
                    <th>Present Address</th>
                    <th>Permanent Address</th>
                </tr>
            </thead>
            <tbody>
                @if(count($customers)>0)
                    @foreach($customers as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->user_info->name}}</td>
                            <td>{{$c->email}}</td>
                            <td>{{$c->user_info->gender}}</td>
                            <td>{{$c->user_info->dob}}</td>
                            <td>{{$c->user_info->contact_no}}</td>
                            <td>{{$c->user_info->present_address}}</td>
                            <td>{{$c->user_info->permanent_address}}</td>
                        </tr>
                    @endforeach
                @endif    
            </tbody>
    </table>
</body>
</html>