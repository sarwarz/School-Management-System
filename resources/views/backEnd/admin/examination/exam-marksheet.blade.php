@extends('backEnd.admin.layout.app')
@section('title')
    Marksheet
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Marksheet</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Marksheet</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Filtering</h4>

                    <form class="row g-3" action="{{ route('admin.downloadAllMarksheet') }}" method="post">
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
                            <select name="session_number" class="form-control @error('session_number') is-invalid @enderror">
                                <option value="">Select Session</option>
                                <option value="2025">2025</option>
                                <option value="2025">2026</option>
                            </select>
                            @error('session_number')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary px-5"><i class="fadeIn animated bx bx-download"></i> Download</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end page-content-wrapper-->
</div>
<!--end page-wrapper-->
@endsection
