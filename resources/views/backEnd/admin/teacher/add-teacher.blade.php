@extends('backEnd.admin.layout.app')

@section('title')
    Add Teacher
@endsection

@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Add New Teacher</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Teacher</li>
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
                                <h5 class="mb-0">Add New Teacher</h5>
                            </div>
                            <hr>

                            <form class="row g-3" action="{{ route('admin.teacher.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    <label class="form-label">Teacher ID<span class="text-danger">*</span></label>
                                    <input type="text" name="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" placeholder="Enter Teacher ID" value="{{ old('teacher_id') }}">
                                    @error('teacher_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
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
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Phone<span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number" value="{{ old('phone') }}">
                                    @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
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
                                    <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control @error('date_of_birth') is-invalid @enderror">
                                    @error('date_of_birth')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Joining Date</label>
                                    <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Designation<span class="text-danger">*</span></label>
                                    <select name="designation_id" class="form-control @error('designation_id') is-invalid @enderror">
                                        <option value="">Select Designation</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}" {{ old('designation_id') == $designation->id ? 'selected' : '' }}>
                                                {{ $designation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Department<span class="text-danger">*</span></label>
                                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Basic Salary<span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="basic_salary" class="form-control @error('basic_salary') is-invalid @enderror" placeholder="Enter basic salary" value="{{ old('basic_salary') }}" >
                                    @error('basic_salary')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address<span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address" value="{{ old('address') }}" >
                                    @error('address')<span class="invalid-feedback">{{ $message }}</span>@enderror
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
                                    <label class="form-label">Photo (95x95 px)</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary px-5"><i class="bx bx-save"></i> Save</button>
                                    <a href="{{ route('admin.teacher.index') }}" class="btn btn-danger"><i class="bx bx-undo"></i> Back</a>
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
