<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        #emp td,#temp td{
            border: 1px solid #ddd;
            padding: 8px;
        }
        #emp tr:nth-child(even) {
            background-color: #0bfdfd;
        }
        #emp th{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: #fff;
        }
    </style>
</head>
<body>
    <table id='emp'>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Section</th>
                <th>Email</th>
            </tr>
        <tbody>
            @foreach($employees as $emp)
                <tr>
                    <td>{{$emp->name}}</td>
                    <td>{{$emp->department}}</td>
                    <td>{{$emp->section}}</td>
                    <td>{{$emp->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>