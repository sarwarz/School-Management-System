@extends('backEnd.admin.layout.app')
@section('title')
    Edit Mark Grade
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"> Edit Mark Grade</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Edit Mark Grade/li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ Session::get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-bx bx-edit me-1 font-22"></i>
                                </div>
                                <h5 class="mb-0"> Edit Mark Grade</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{ route('admin.mark.grade.update',$mark_grade->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name<span class="fillable">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="enter name" value="{{ $mark_grade->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="point" class="form-label">Point<span class="fillable">*</span></label>
                                    <input type="number" step="any" class="form-control @error('point') is-invalid @enderror" id="point" name="point" placeholder="Enter point" value="{{ $mark_grade->point }}">
                                    @error('point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="percent_from" class="form-label">Percent From<span class="fillable">*</span></label>
                                    <input type="number" class="form-control @error('percent_from') is-invalid @enderror" id="percent_from" name="percent_from" placeholder="Enter Percent From" value="{{ $mark_grade->percent_from }}">
                                    @error('percent_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="percent_upto" class="form-label">Percent Upto<span class="fillable">*</span></label>
                                    <input type="number" class="form-control @error('percent_upto') is-invalid @enderror" id="percent_upto" name="percent_upto" placeholder="Enter Percent Upto" value="{{ $mark_grade->percent_upto }}">
                                    @error('percent_upto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="remarks" class="form-label">remarks<span class="fillable">*</span></label>
                                    <input type="text" class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" placeholder="Enter remarks" value="{{ $mark_grade->remarks }}">
                                    @error('remarks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status<span class="fillable">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                        <option @selected( $mark_grade->status == 1 ) value="1">Active</option>
                                        <option @selected( $mark_grade->status == 0 ) value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5"><i class="bx bx-save"></i>Update</button>
                                    <a href="{{ route('admin.mark.grade.index') }}" class="btn btn-danger"><i class="fadeIn animated bx bx-undo"></i>Back</a>
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