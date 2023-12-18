@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Students Exam</h2>

<table class="table">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Exam</th>
        <th>Status</th>
        <th>Review</th>

    </thead>
    <tbody>

        @if(count($attempts) > 0)
          @php $x=1; @endphp

        @foreach($attempts as $attempt)

           <tr>

               <td>{{ $x++}}</td>
               <td>{{ $attempt->user->name}}</td>
               <td>{{ $attempt->exam->exam_name}}</td>
               <td>
                @if($attempt->status ==0)
                      <span style="color:red">Pending</span>
                   @else
                   <span style="color:green">Approved</span>
                   @endif
               </td>

                  <td>
                @if($attempt->status ==0)
                     <a href="#" class="reviewExam" data-id="{{ $attempt->id }}" data-toggle="modal" data-target="#reviewExamModal">Review & Approved</a>
                   @else
                   Completed
                   @endif
               </td>
           </tr>
        @endforeach
        @else
          <tr>
            <td colspan="5">Students not Attempt Exams! </td>


          </tr>
        @endif

    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="reviewExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Review Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="reviewForm">
        <input type="hidden" name="attempt_id" id = "attempt_id">
        @csrf
      <div class="modal-body review-exam">
        Loading...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Approved</button>
      </div>
     </form>
    </div>
  </div>
</div>

<script>
   $(document).ready(function () {
    $('.reviewExam').click(function () {
        var id = $(this).attr('data-id');
        $('#attempt_id').val(id);
        $.ajax({
            url: "{{ route('reviewQna') }}",
            type: "GET",
            data: { attempt_id: id },
            success: function (data) {
                var html = ``;
                if (data.success == true) {
                    var data = data.data;
                    if (data.length > 0) {


                        for (let i = 0; i < data.length; i++) {
                            let isCorrect = '<span style="color:red;" class="fa fa-close"></span>';
                            if (data[i]['answers']['is_correct'] == 1) {
                                isCorrect = '<span style="color:green;" class="fa fa-check"></span>';
                            }

                            let answer = data[i]['answers']['answer'];

                            html += `
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6>Q(` + (i + 1) + `). ` + data[i]['question']['question'] + `</h6>
                                        <p>Ans:-` + answer + ` ` + isCorrect + `</p>
                                    </div>
                                </div>
                            `;
                        }
                    } else {
                        html += `<h6>Student did not attempt any questions!</h6>
                                 <p>If you approve this exam, the student will fail!</p>`;
                    }
                } else {
                    html += `<p>Having some server issue!</p>`;
                }
                $('.review-exam').html(html);
            }
        });
    });

    // Approved exam
    $('#reviewForm').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('approvedQna') }}",
            type: "POST",
            data: formData,
            success: function (data) {
                if(data.success == true){
                    location.reload();

                }
                else{
                    alert(data.msg);

                }
            }
        });
    });
});



</script>
@endsection