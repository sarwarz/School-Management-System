
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>@yield('title') | {{ config('app.name') }}</title>
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/licensesender-icon.png') }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!--Data Tables -->
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}" />
	<!-- App CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--sidebar-wrapper-->
		@include('backEnd.admin.include.sidebar')
		<!--end sidebar-wrapper-->
		<!--header-->
		@include('backEnd.admin.include.header')
		<!--end header-->
		@yield('content')
		@include('backEnd.admin.include.footer')
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<!-- App JS -->
	<script src="{{ asset('assets/js/app.js') }}"></script>
	<!-- <script src="https://cdn.tiny.cloud/1/mdwgeejct2iaj1ccimkrzs077hvd5b3cew86w2sekzinerro/tinymce/6/tinymce.min.js"></script> -->
	<script src="{{ asset('assets/js/datatable.js') }}"></script>
	<!-- <script>
		tinymce.init({
		  selector: '#mytextarea',
		  menubar: false,
		  branding: false,
		  plugins: 'link',
		  toolbar: 'undo redo | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat '
		});
	</script> -->
<script>
$(document).ready(function () {
    $('.delete-btn').click(function (e) {
        e.preventDefault();

        var url = $(this).data('url');
        var name = $(this).data('name') || 'Item';

        Swal.fire({
            title: `Are you sure you want to delete this ${name}?`,
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            `${name} has been deleted.`,
                            'success'
                        ).then(() => {
                            location.reload(); // or use $(this).closest('tr').remove();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire(
                            'Error!',
                            'Something went wrong.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
<script>
    @if (session('message'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        Toast.fire({
            icon: '{{ session("status") ?? "success" }}', // success, error, warning
            title: '{{ session("message") }}'
        });
    @endif
</script>
<script>
$(document).ready(function() {
    $('.add_subject_teacher').on('click', function() {
        let subjectOptions = '';
        subjects.forEach(subject => {
            subjectOptions += `<option value="${subject.id}">${subject.name}</option>`;
        });

        let teacherOptions = '';
        teachers.forEach(teacher => {
			const fullName = teacher.first_name + (teacher.last_name ? ' ' + teacher.last_name : '');
			teacherOptions += `<option value="${teacher.id}">${fullName}</option>`;
		});


        let newRow = `
            <tr>
                <td>
                    <select name="subject_id[]" class="form-control">${subjectOptions}</select>
                </td>
                <td>
                    <select name="teacher_id[]" class="form-control">${teacherOptions}</select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row">X</button>
                </td>
            </tr>
        `;

        $('#subject_teacher_body').append(newRow);
    });

    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });
});
</script>
<script>
    $(document).ready(function () {
        const oldClassId = "{{ old('class_id') }}";
        const oldSubjectId = "{{ old('subject_id') }}";

        // Load subjects if there's old class/subject after validation error
        if (oldClassId) {
            $('#class_id').val(oldClassId);
            $('#subject_id').empty().append('<option value="">Loading...</option>');

            $.ajax({
                url: '/admin/get-subjects-by-class/' + oldClassId,
                type: 'GET',
                success: function (data) {
                    $('#subject_id').empty().append('<option value="">Select Subject</option>');
                    $.each(data, function (key, subject) {
                        const selected = subject.id == oldSubjectId ? 'selected' : '';
                        $('#subject_id').append('<option value="' + subject.id + '" ' + selected + '>' + subject.name + '</option>');
                    });
                }
            });
        }

        // Normal loading on class change
        $('#class_id').on('change', function () {
            var classId = $(this).val();
            if (classId) {
                $('#subject_id').empty().append('<option value="">Loading...</option>');
                $.ajax({
                    url: '/admin/get-subjects-by-class/' + classId,
                    type: 'GET',
                    success: function (data) {
                        $('#subject_id').empty().append('<option value="">Select Subject</option>');
                        $.each(data, function (key, subject) {
                            $('#subject_id').append('<option value="' + subject.id + '">' + subject.name + '</option>');
                        });
                    }
                });
            } else {
                $('#subject_id').empty().append('<option value="">Select Subject</option>');
            }
        });
    });
</script>

<script>
$(document).ready(function () {
    $('#class_id').on('change', function () {
        let classId = $(this).val();

        if (classId) {
            $.ajax({
                url: '/admin/get-students-by-class/' + classId,
                type: 'GET',
                success: function (students) {
                    let rows = '';
                    $.each(students, function (index, student) {
                        rows += `<tr>
                            <td>${student.first_name} ${student.last_name ?? ''}</td>
                            <td>${student.roll_no}</td>
                            <td>
                                <input type="hidden" name="student_id[]" value="${student.id}">
                                <input type="number" class="form-control @error('mark') is-invalid @enderror" name="mark[]" placeholder="Enter Mark Out Of 100">
                            </td>
                        </tr>`;
                    });

                    $('#student_mark_body').html(rows);
                },
                error: function () {
                    $('#student_mark_body').html('<tr><td colspan="3">Error fetching students</td></tr>');
                }
            });
        } else {
            $('#student_mark_body').html('');
        }
    });
});
</script>



	

</body>

</html>