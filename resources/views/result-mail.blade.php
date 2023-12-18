<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $data['title'] }}</title>
</head>
<body>
	<p>
		<b>Hi, {{$data['name']}}, </b> Your Exam({{ $data['exam_name']}}) review passed,
		So now you can check your marks.


	</p>
	<a href="{{$data['url'] }}">Click here to go on Results Page.</a>
	<p>Thank You!</p>

</body>
</html>