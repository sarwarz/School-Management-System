@extends('backEnd.admin.layout.app')
@section('title')
    Edit Register Mark
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"> Edit Register Mark</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Edit Register Mark </li>
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
                                <h5 class="mb-0">Edit Register Mark</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{ route('admin.mark.register.update',$mark_register->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="col-md-4">
                                    <label class="form-label">Exam Type<span class="text-danger">*</span></label>
                                    <select name="exam_type_id" class="form-control @error('exam_type_id') is-invalid @enderror">
                                        <option value="">Select Exam Type</option>
                                        @foreach ($exam_types as $item)
                                            <option value="{{ $item->id }}" @selected( $mark_register->exam_type_id == $item->id  ) {{ old('exam_type_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('exam_type_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Class<span class="text-danger">*</span></label>
                                    <select name="class_id" id="class_id" class="form-control @error('class_id') is-invalid @enderror">
                                        <option value="">Select Class</option>
                                        @foreach ($academic_class as $item)
                                            <option value="{{ $item->id }}" @selected( $mark_register->class_id == $item->id  ) {{ old('class_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Subject<span class="text-danger">*</span></label>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                    @foreach ($subjects as $item)
                                        <option value="{{ $item->id }}" {{ $mark_register->subject_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            
                                <div class="col-md-12 mt-4">
                                    <div class="table-responsive">
                                        <table id="example" class="table school_borderLess_table table_border_hide2" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Roll NO</th>
                                                    <th>Mark Distribution</th>
                                                </tr>
                                            </thead>
                                            <tbody id="student_mark_body">
                                                @foreach ($students as $item)
                                                <tr>
                                                    <td>{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                                                    <td>{{ $item->student->roll_no }}</td>
                                                    <td>
                                                        <input type="hidden" name="student_id[]" value="{{ $item->student_id }}">
                                                        <input type="number" name="mark[]" class="form-control"
                                                            value="{{ $item->mark }}"
                                                            placeholder="Enter Mark Out Of 100">
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>

                                        </table>
                                    </div>
                                </div>
                                
                            

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5"><i class="bx bx-save"></i>Update</button>
                                    <a href="{{ route('admin.mark.register.index') }}" class="btn btn-danger"><i class="fadeIn animated bx bx-undo"></i>Back</a>
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