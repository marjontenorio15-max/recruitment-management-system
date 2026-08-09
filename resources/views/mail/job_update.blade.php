<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>Hi {{ $to_name }}!</p>
	<br>
	<p>Here's the status update of your job application.</p>
	<br>
	<p>Job Title: {{ $applicants->title }}</p>
	<p>Company: {{ $applicants->company_name }}</p>
	<p>Status: {{ $applicants->remarks }}</p>
	<p>Description: {{ $applicants->description }}</p>
	<br>
	<p>Thank you!</p>
</body>
</html>