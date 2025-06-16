@extends('backEnd.admin.layout.app')
@section('title')
    Add Subject Assign
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"> Add New Assign</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Add New Assign </li>
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
                                <h5 class="mb-0">Subject Assign</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{ route('admin.academic.subject.assign.create') }}" method="post">
                                @csrf
                           
                                <div class="col-md-6">
                                    <label class="form-label">Class<span class="text-danger">*</span></label>
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
                           
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status<span class="fillable">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-4">
                                    
                                    <div class="d-flex align-items-center gap-4 flex-wrap justify-content-between">
                                        <h5>Subject & Teacher</h5>
                                        <button type="button" class="btn btn-primary add_subject_teacher"><i class="bx bx-plus"></i> Add</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="example" class="table school_borderLess_table table_border_hide2" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Teacher</th>
                                                    <th width="48px"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="subject_teacher_body">
                                                @if (old('subject_id') && old('teacher_id'))
                                                    @foreach (old('subject_id') as $index => $subject)
                                                        <tr>
                                                            <td>
                                                                <select name="subject_id[]" class="form-control @error('subject_id.' . $index) is-invalid @enderror">
                                                                    @foreach($subjects as $item)
                                                                        <option value="{{ $item->id }}" {{ $item->id == $subject ? 'selected' : '' }}>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="teacher_id[]" class="form-control @error('teacher_id.' . $index) is-invalid @enderror">
                                                                    @foreach($teachers as $item)
                                                                        <option value="{{ $item->id }}" {{ $item->id == old('teacher_id')[$index] ? 'selected' : '' }}>
                                                                            {{ $item->first_name . ($item->last_name ? ' ' . $item->last_name : '') }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger remove-row">X</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                
                            

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5"><i class="bx bx-save"></i>Save</button>
                                    <a href="{{ route('admin.academic.subject.assign.index') }}" class="btn btn-danger"><i class="fadeIn animated bx bx-undo"></i>Back</a>
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
<script>
    let subjects = @json($subjects);
    let teachers = @json($teachers);
</script>

@endsection