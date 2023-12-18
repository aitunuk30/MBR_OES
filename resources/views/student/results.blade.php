@extends('layout/student-layout')
@section('space-work')

          <h2>Results</h2>
          <table class="table">
          	  <thead>
          	  	<tr>
          	  		<th>#</th>
          	  		<th>Exam</th>
          	  		<th>Result</th>
          	  		<th>Status</th>
          	  	</tr>
          	  </thead>
          	  <tbody>
          	  	@if(count($attempts) > 0 )
          	  	  @php $x=1; @endphp
          	  	      @foreach($attempts as $attempt)
          	  	        <tr>
          	  	        	<td>{{ $x++}}</td>
          	  	        	<td>{{ $attempt->exam->exam_name}}</td>
          	  	        	<td>
          	  	        		@if($attempt->status ==0)
          	  	        		   Not Declared
          	  	        		@else
          	  	        		 @if($attempt->marks >= $attempt ->exam->pass_marks)
          	  	        		     <span style="color:green;">Passed</span>

          	  	        		 @else
          	  	        		     <span style="color:red;">Failed</span>
          	  	        		 @endif

          	  	        		@endif
          	  	        	</td>
          	  	        	<td>
          	  	        		@if($attempt->status ==0)
          	  	        		  <span style="color:red;">Pending</span>

          	  	        		@else
          	  	        		<a href="#" data-id="{{ $attempt->id}}">Review Q&A</a>

          	  	        		@endif
          	  	        	</td>
          	  	        </tr>
          	  	      @endforeach
          	  	@else
          	  	     <tr>
          	  	     	<td colspan="4">You not attempted any Exam!</td>
          	  	     </tr>
          	  	@endif
          	  </tbody>
          </table>
@endsection