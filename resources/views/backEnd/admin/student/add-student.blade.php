@extends('backEnd.admin.layout.app')

@section('title')
    Add Student
@endsection

@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Add New Student</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Student</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user-plus me-1 font-22"></i></div>
                                <h5 class="mb-0">Add New Student</h5>
                            </div>
                            <hr>

                            <form class="row g-3" action="{{ route('admin.student.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    <label class="form-label">Student ID<span class="text-danger">*</span></label>
                                    <input type="text" name="student_id" class="form-control @error('student_id') is-invalid @enderror" placeholder="Enter Student ID" value="{{ old('student_id') }}">
                                    @error('student_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Roll No<span class="text-danger">*</span></label>
                                    <input type="number" name="roll_no" class="form-control @error('roll_no') is-invalid @enderror" placeholder="Enter Roll No" value="{{ old('roll_no') }}">
                                    @error('roll_no')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">First Name<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first name" value="{{ old('first_name') }}">
                                    @error('first_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter last name" value="{{ old('last_name') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Father Name<span class="text-danger">*</span></label>
                                    <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" placeholder="Enter father name" value="{{ old('father_name') }}">
                                    @error('father_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Mother Name<span class="text-danger">*</span></label>
                                    <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" placeholder="Enter mother name" value="{{ old('mother_name') }}">
                                    @error('mother_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number" value="{{ old('phone') }}">
                                    @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control @error('date_of_birth') is-invalid @enderror">
                                    @error('date_of_birth')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Gender<span class="text-danger">*</span></label>
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Religion<span class="text-danger">*</span></label>
                                    <select name="religion" class="form-control @error('religion') is-invalid @enderror">
                                        <option value="">Select Religion</option>
                                        <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('religion')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Department<span class="text-danger">*</span></label>
                                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                                        <option value="">Select Department</option>
                                        <option value="0" {{ old('department_id') == '0' ? 'selected' : '' }}>N/A</option>
                                        <option value="1" {{ old('department_id') == '1' ? 'selected' : '' }}>History</option>
                                        <option value="2" {{ old('department_id') == '2' ? 'selected' : '' }}>Science</option>
                                    </select>
                                    @error('department_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Class<span class="text-danger">*</span></label>
                                        <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                                            <option value="">Select Class</option>
                                            @foreach ($academic_class as $class)
                                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('class_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Photo (100x100 px)</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary px-5"><i class="bx bx-save"></i> Save</button>
                                    <a href="{{ route('admin.student.index') }}" class="btn btn-danger"><i class="bx bx-undo"></i> Back</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--end page-content-wrapper-->
</div>
<!--end page-wrapper-->
@endsection
