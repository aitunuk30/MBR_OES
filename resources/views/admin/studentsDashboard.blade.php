@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Students</h2>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
    Add Student
</button>

<table class="table">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>

    </thead>
    <tbody>
        @if(count($students) > 0)
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">Students not Found!</td>
            </tr>
        @endif
    </tbody>
</table>




<!-- Modal for adding Student -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addQnaModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQnaModalTitle">Add Student</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addStudent">
                @csrf
                <div class="modal-body ">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="w-100" name="name" placeholder="Enter Student Name" required>
                        </div>
                    </div>

                     <div class="row mt-3">
                        <div class="col">
                            <input type="email" class="w-100" name="email" placeholder="Enter Student Email" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <span class="error" style="color:red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </div>
            </form>
        </div>
    </div>
</div>


  <script>
    $(document).ready(function() {
        $("#addStudent").submit(function(e) {

            e.preventDefault();

            var formData=$(this).serialize();

            $.ajax({
                url:"{{route('addStudent')}}",
                type:"POST",
                data:formData,
                success:function(data){

                    if (data.success == true) {
                         location.reload();
                    } else {
                     alert(data.msg);
                    }
                }
            });
        });
    });


 </script>
@endsection
