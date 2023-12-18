@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Q&A</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
    Add Q&A
</button>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#importQnaModal">
    Import Q&A
</button>
<table class="table">
    <thead>
        <th>#</th>
        <th>Question</th>
        <th>Answers</th>
        <th>Edit</th>
        <th>Delete</th>

    </thead>
    <tbody>
        @if(count($questions) > 0)
        @foreach($questions as $question)
        <tr>
            <td>{{ $question->id }}</td>
            <td>{{ $question->question }}</td>
            <td>
                <a href="#" class="ansButton" data-id="{{ $question->id }}" data-toggle="modal" data-target="#showAnsModal">See Answers</a>
            </td>
            <td>
                 <button class ="btn btn-info editButton" data-id ="{{ $question->id}}"data-toggle="modal" data-target="#editQnaModal">Edit</button>
            </td>
            <td>
                 <button class ="btn btn-danger deleteButton" data-id ="{{ $question->id}}"data-toggle="modal" data-target="#deleteQnaModal">Delete</button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="3">Questions & Answers not Found!</td>
        </tr>
        @endif
    </tbody>
</table>

<!-- Modal for adding Q&A -->
<div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="addQnaModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQnaModalTitle">Add Q&A</h5>
                <button id="addAnswer" class="ml-5 btn btn-info">Add Answer</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addQna">
                @csrf
                <div class="modal-body addModalAnswers">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="w-100" name="question" placeholder="Enter Question" required>
                        </div>
                    </div>
                    <div class="row mt-2 answers">
                        <input type="radio" name="is_correct" class="is_correct">
                        <div class="col">
                            <input type="text" class="w-100" name="answers[]" placeholder="Enter Answer" required>
                        </div>
                        <button class="btn btn-danger removeButton">Remove</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="error" style="color:red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit  Q&A Modal -->
<div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog" aria-labelledby="editQnaModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQnaModalTitle">Update Q&A</h5>

                <button id="addEditAnswer" class="ml-5 btn btn-info">Add Answer</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editQna">
                @csrf
                <div class="modal-body editModalAnswers">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="question_id" id="question_id">
                            <input type="text" class="w-100" name="question" id = "question"placeholder="Enter Question" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="editError" style="color:red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for showing answers -->
<div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="showAnsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showAnsModalTitle">Show Answers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Answer</th>
                        <th>Is Correct</th>
                    </thead>
                    <tbody class="showAnswers">
                        <!-- Place here your code for displaying answers -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <span class="error" style="color:red;"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Qna Modal -->
<div class="modal fade" id="deleteQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

       <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Q$A</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form id="deleteQna">
       @csrf
            <div class="modal-body">
                 <input type="hidden"name="id" id = "delete_qna_id">
                 <p>Are you sure want to Delete Q&A?</p>
            </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
       </div>
    </form>
    </div>

  </div>
</div>


<!-- Import Qna Modal -->
<div class="modal fade" id="importQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

       <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import Q$A</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form id="importQna" enctype="multipart/form-data">
       @csrf
            <div class="modal-body">
                <div class="modal-body">
               <input type="file" name="file" id="fileupload" required accept=".csv, .xlsx, .xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">


            </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Import Q&A</button>
       </div>
    </form>
    </div>

  </div>
</div>

<script>
    $(document).ready(function() {
        // form submittion
        $("#addQna").submit(function(e) {
            e.preventDefault();
            if ($(".answers").length < 2) {
                $(".error").text("Please add minimum 2 answers.")
                setTimeout(function() {
                    $(".error").text("");
                }, 2000);

            } else {
                var checkIsCorrect = false;

                for (let i = 0; i < $(".is_correct").length; i++) {
                    if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                        checkIsCorrect = true;
                        $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find('input').val());
                    }
                }
                if (checkIsCorrect) {

                    var formData = $(this).serialize();
                    $.ajax({
                        url: "{{ route('addQna')}}",
                        type: "POST",
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                        }

                    });

                } else {
                    $(".error").text("Please select 1 correct answer.")
                    setTimeout(function() {
                        $(".error").text("");
                    }, 2000);
                }
            }

        });

        // add answer
        $("#addAnswer").click(function() {

            if ($(".answers").length >= 6) {
                $(".error").text("You can add maximum 6 answers.");
                setTimeout(function() {
                    $(".error").text("");

                }, 2000);
            } else {
                var html = `
                    <div class="row mt-2 answers">
                        <input type="radio" name="is_correct" class="is_correct">
                        <div class="col">
                            <input type="text" class="w-100" name="answers[]" placeholder="Enter Answer" required>
                        </div>
                        <button class="btn btn-danger removeButton">Remove</button>
                    </div>
                `;

                $(".addModalAnswers").append(html);
            }

        });

        $(document).on("click", ".removeButton", function() {
            $(this).parent().remove();

        });


        //show answers code
         $(".ansButton").click(function(){
          var questions = @json($questions);
          var qid = $(this).attr('data-id');
          var html = '';



          for(let i=0; i<  questions.length; i++){
            if (questions[i]['id'] == qid){
                 var answersLength = questions[i]['answers'].length;
                 for(let j=0; j< answersLength; j++){
                    let is_correct = 'No';
                    if(questions[i]['answers'][j]['is_correct']==1){
                        is_correct='Yes';
                    }
                    html += `
                        <tr>
                         <td>`+(j+1)+`</td>
                         <td>`+questions[i]['answers'][j]['answer'] +`</td>
                         <td>`+is_correct +`</td>
                        </tr>
                    `;
                }
                break;
            }
        }
        $('.showAnswers').html(html);

      });



           // edit or update  q&a
        $("#addEditAnswer").click(function() {

            if ($(".editAnswers").length >= 6) {
                $(".editError").text("You can add maximum 6 answers.");
                setTimeout(function() {
                    $(".editError").text("");

                }, 2000);
            } else {
                var html = `
                    <div class="row mt-2 editAnswers">
                        <input type="radio" name="is_correct" class="edit_is_correct">
                        <div class="col">
                            <input type="text" class="w-100" name="new_answers[]" placeholder="Enter Answer" required>
                        </div>
                        <button class="btn btn-danger removeButton">Remove</button>
                    </div>
                `;

                $(".editModalAnswers").append(html);
            }

        });

        $(".editButton").click(function() {
            var qid = $(this).attr('data-id');
            $.ajax({
                url:"{{ route('getQnaDetails') }}",
                type: "GET",
                data: {qid:qid},
                success:function(data){
                    console.log(data);
                    var qna = data.data[0];
                    $("#question_id").val(qna['id']);
                    $("#question").val(qna['question']);
                    $(".editAnswers").remove();


                    var html = ``;
                    for(let i=0; i< qna['answers'].length; i++){
                           var checked = '';
                           if(qna['answers'][i]['is_correct']==1){
                            var checked = 'checked';

                           }
                            html += `
                               <div class="row mt-2 editAnswers">
                                   <input type="radio" name="is_correct" class="edit_is_correct" `+checked+`>
                                   <div class="col">
                                       <input type="text" class="w-100" name="answers[`+qna['answers'][i]['id']+`]" placeholder="Enter Answer" value ="`+qna['answers'][i]['answer']+`" required>
                                   </div>
                                   <button class="btn btn-danger removeButton removeAnswer" data-id ="`+qna['answers'][i]['id']+`">Remove</button>
                               </div>
                            `;
                        }
                         $(".editModalAnswers").append(html);
                    }
            });

        });


        // updated Qna submittion
        $("#editQna").submit(function(e) {
            e.preventDefault();
            if ($(".editAnswers").length < 2) {
                $(".editError").text("Please add minimum 2 answers.")
                setTimeout(function() {
                    $(".editError").text("");
                }, 2000);

            } else {
                var checkIsCorrect = false;

                for (let i = 0; i < $(".edit_is_correct").length; i++) {
                    if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
                        checkIsCorrect = true;
                        $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")").next().find('input').val());
                    }
                }
                if (checkIsCorrect) {
                     var formData = $(this).serialize();
                         $.ajax({
                              url:"{{ route('updateQna') }}",
                              type:"POST",
                              data:formData,
                              success:function(data){
                              if(data.success == true){
                              location.reload();

                              }
                              else{
                              alert(data.msg);
                              }
                        }

                      });


                } else {
                    $(".editError").text("Please select 1 correct answer.")
                    setTimeout(function() {
                        $(".editError").text("");
                    }, 2000);
                }
            }

        });
     //remove Answers
     $(document).on('click','.removeAnswer',function(){

        var ansId= $(this).attr('data-id');
        $.ajax({
            url:"{{ route('deleteAns') }}",
            type:"GET",
            data:{ id:ansId},
            success:function(data){
                if(data.success == true){
                    console.log(data.msg);

                }
                 else{
                    alert(data.msg);
                 }
            }

        });

     });
     //delete Q&a
     $(".deleteButton").click(function(){
       var id =  $(this).attr('data-id');

       $("#delete_qna_id").val(id);

     });

     $("#deleteQna").submit(function(e){
       e.preventDefault();
       var formData = $(this).serialize();

       $.ajax({
          url:"{{ route('deleteQna')}}",
          type:"POST",
          data:formData,
          success:function(data){
                if(data.success==true)
                {
                   location.reload();
                }
                else{
                    alert(data.msg);
                 }
            }

        });
     });

     //import QnA
      $("#importQna").submit(function(e){
       e.preventDefault();
       let formData = new FormData();
       formData.append("file",fileupload.files[0]);

       $.ajaxSetup({
        headers:{
            "X-CSRF-TOKEN":"{{ csrf_token() }}"
        }

       });

       $.ajax({
          url:"{{ route('importQna')}}",
          type:"POST",
          data:formData,
          processData:false,
          contentType:false,
          success:function(data){
               console.log(data);
                if(data.success == true)
                {
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
