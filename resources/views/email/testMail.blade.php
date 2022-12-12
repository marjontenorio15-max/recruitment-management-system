<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send an Email</title>
</head>
<body>
<h1><a target="_blank" href="http://127.0.0.1:8000/applicant-Jobs">Applied Job</a></h1>

<h3>User Detail:</h3>

<h4>Name: {{ $data['name'] }}</h4>
<h4>Email: {{ $data['email'] }}</h4>

</body>
</html>
