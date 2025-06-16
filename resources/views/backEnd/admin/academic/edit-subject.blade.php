@extends('backEnd.admin.layout.app')
@section('title')
    Edit Subject
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"> Edit Subject</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Edit Subject</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-bx bx-edit me-1 font-22"></i>
                                </div>
                                <h5 class="mb-0">Edit Subject</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{ route('admin.subject.update',$subject->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name<span class="fillable">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="enter subject name" value="{{ $subject->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="code" class="form-label">Code<span class="fillable">*</span></label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="enter subject code" value="{{ $subject->code }}">
                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="type" class="form-label">Type<span class="fillable">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                        <option @selected( $subject->type == 1 ) value="1">Theory</option>
                                        <option @selected( $subject->type == 0 ) value="0">Parctical</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status<span class="fillable">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                        <option @selected( $subject->status == 1 ) value="1">Active</option>
                                        <option @selected( $subject->status == 0 ) value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5"><i class="bx bx-save"></i>Update</button>
                                    <a href="{{ route('admin.subject.index') }}" class="btn btn-danger"><i class="fadeIn animated bx bx-undo"></i>Back</a>
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