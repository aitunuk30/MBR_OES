@extends('layout/layout-common')

@section('space-work')

<div class = "container">
	<div class="text-center">
		<h2>Thank for submit your Exam, {{Auth::user()->name }}</h2>
		<p>We will review your Exam, and update you soon by mail.</p>
		<a href="/dashboard" class= "btn btn-info">Go back</a>


	</div>


</div>
 @endsection