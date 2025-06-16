@extends('backEnd.admin.layout.app')
@section('title')
    Teachers
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Teachers</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Teachers</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Teachers</h3>
                        <a href="{{ route('admin.teacher.add') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Teacher</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Teacher ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($teachers->count())
                                @foreach ($teachers as $key => $teacher)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $teacher->teacher_id }}</td>
                                        <td>
                                            @if($teacher->image)
                                                <img class="rounded" src="{{ asset($teacher->image) }}" alt="Teacher Photo" width="30" height="30">
                                            @endif
                                            {{ $teacher->first_name }} {{ $teacher->last_name }}
                                        </td>
                                        <td>{{ $teacher->email }}</td>
                                        <td>{{ $teacher->phone }}</td>
                                        <td>{{ $teacher->department->name }}</td>
                                        <td>{{ $teacher->designation->name }}</td>
                                        <td>
                                            @if ($teacher->status == 1)
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
                                                    <a class="dropdown-item" href="{{ route('admin.teacher.edit', $teacher->id) }}">
                                                        <i class="fadeIn animated bx bx-edit"></i> Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item delete-btn"
                                                        data-id="{{ $teacher->id }}"
                                                        data-url="{{ route('admin.teacher.destroy', $teacher->id) }}"
                                                        data-name="Teacher">
                                                        <i class="fadeIn animated bx bx-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="7" class="text-center">No teacher data found.</td></tr>
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
