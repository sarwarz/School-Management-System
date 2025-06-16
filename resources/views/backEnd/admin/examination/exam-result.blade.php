@extends('backEnd.admin.layout.app')
@section('title')
    Exam Result
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Exam Result</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Exam Result</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Filtering</h4>

                    <form class="row g-3" action="{{ route('admin.subject.create') }}" method="post">
                        @csrf
                    
                       <div class="col-md-3">
                            <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                                <option value="">Select Class</option>
                                @foreach ($academic_class as $item)
                                    <option value="{{ $item->id }}" {{ old('class_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <select name="exam_type_id" class="form-control @error('exam_type_id') is-invalid @enderror">
                                <option value="">Select Exam Type</option>
                                @foreach ($exam_types as $item)
                                    <option value="{{ $item->id }}" {{ old('exam_type_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('exam_type_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary px-5"><i class="fadeIn animated bx bx-search-alt-2"></i>Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Exam Result</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Exam Type</th>
                                <th>Class</th>
                                <th>Total Mark</th>
                                <th>Grade Point</th>
                                <th>GPA</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($studentsWithMarks->count())
                                @foreach ($studentsWithMarks as $key => $student)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $student->student_id }}</td>
                                        <td>                                                
                                            <div class="d-flex align-items-center">
                                                <div class="table_row_img">
                                                    @if($student->image)
                                                        <img class="rounded" src="{{ asset($student->image) }}" alt="student Photo" width="40" height="40">
                                                    @else
                                                        <img class="rounded" src="{{ asset('assets/images/avatars/defualt_avatar.png') }}" alt="student Photo" width="40" height="40">
                                                    @endif
                                                </div>
                                                <div class="table_row_info">
                                                    <p>{{ $student->first_name }} {{ $student->last_name }}</p>
                                                    <p>Roll No:{{ $student->roll_no }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $mark->examType->name ?? 'N/A' }}</td>
                                        <td>{{ $student->class->name }}</td>
                                        <td>{{ $student->marks->sum('mark') }}</td>
                                        <td>{{ $student->gpa }}</td>
                                        <td>{{ $student->grade_data->name ?? 'N/A' }}</td>
                                        <td>{{ $student->grade_data->remarks ?? '' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#classModal{{ $student->id }}"><i class="fadeIn animated bx bx-show"></i></button>
                                            <div class="modal fade" id="classModal{{ $student->id  }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Subject & Mark</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sl No</th>
                                                                        <th>Subject</th>
                                                                        <th>Mark</th>
                                                                        <th>Letter Grade</th>
                                                                        <th>Grade Point</th>
                                                                        <th>GPA</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($student->marks as $key => $mark)
                                                                    <tr>
                                                                        <td>{{ $key+1 }}</td>
                                                                        <td>{{ $mark->subject->name ?? 'N/A' }}</td>
                                                                        <td>{{ $mark->mark }}</td>
                                                                        <td>{{ $mark->grade }}</td>
                                                                        <td>{{ $mark->point }}</td>
                                                                        @if ($loop->first)
                                                                        <td rowspan="9">{{ $student->gpa }}</td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('examResult.downloadTranscript', $student->id) }}" class="btn btn-success btn-sm download-transcript"><i class="fadeIn animated bx bx-download"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="9" class="text-center">No result data found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end page-content-wrapper-->
</div>
<!--end page-wrapper-->
@endsection
