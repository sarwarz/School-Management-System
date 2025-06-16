@extends('backEnd.admin.layout.app')
@section('title')
    Students
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Students</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Students</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card p-2">
                <div class="card-body">
                    
                    <form class="row align-items-center justify-content-between" action="{{ route('admin.student.index') }}" method="get">
                       <div class="col-md-4">
                            <h4 class="card-title">Filtering</h4>
                       </div>
                       <div class="col-md-3">
                            <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                                <option value="">Select Class</option>
                                @foreach ($academic_class as $item)
                                <option value="{{ $item->id }}" {{ request('class_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('class_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="search_keyword" class="form-control" placeholder="Enter Keyword" value="{{ request('search_keyword') }}">
                            @error('search_keyword')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary px-5"><i class="fadeIn animated bx bx-search-alt-2"></i>Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Students</h4>
                        <a href="{{ route('admin.student.add') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Students</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Class</th>
                                <th>Father Nanme</th>
                                <th>Gender</th>
                                <th>Date Of Brith</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($students->count())
                                @foreach ($students as $key => $student)
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
                                        <td>
                                            @if ($student->department_id == 0)
                                                N/A
                                            @elseif($student->department_id == 1)
                                                History
                                            @else
                                                Science
                                            @endif
                                        </td>
                                        <td>{{ $student->class->name }}</td>
                                        <td>{{ $student->father_name }}</td>
                                        <td>{{ $student->gender }}</td>
                                        <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') }}</td>
                                        <td>
                                            @if ($student->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right" style="border-radius: 5px;">
                                                    <a class="dropdown-item" href="{{ route('admin.student.edit', $student->id) }}">
                                                        <i class="fadeIn animated bx bx-edit"></i> Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item delete-btn"
                                                        data-id="{{ $student->id }}"
                                                        data-url="{{ route('admin.student.destroy', $student->id) }}"
                                                        data-name="Student">
                                                        <i class="fadeIn animated bx bx-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="9" class="text-center">No student data found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $students->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end page-content-wrapper-->
</div>
<!--end page-wrapper-->
@endsection
