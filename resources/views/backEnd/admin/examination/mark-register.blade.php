@extends('backEnd.admin.layout.app')
@section('title')
Marks Register
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Marks Register</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Marks Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Marks Register</h3>
                        <a href="{{ route('admin.mark.register.add') }}" class="btn  btn-primary ml-4"><i class="bx bx-plus"></i>Add Mark</a>
                    </div>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Exam Type</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Student & Mark</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($marksGrouped)
                                        @php $i=0; @endphp
                                            @foreach ($marksGrouped as $groupKey => $marks)
                                            @php
                                                $i++;
                                                $first = $marks->first();
                                            @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $first->examType->name ?? 'N/A' }}</td>
                                                    <td>{{ $first->class->name ?? 'N/A' }}</td>
                                                    <td>{{ $first->subject->name ?? 'N/A' }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#classModal{{ $i }}"><i class="fadeIn animated bx bx-show"></i></button>
                                                        <div class="modal fade" id="classModal{{ $i }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Student & Mark</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Student</th>
                                                                                <th>Mark</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($marks as $mark)
                                                                                <tr>
                                                                                    <td>{{ $mark->student->first_name ?? '' }} {{ $mark->student->last_name ?? '' }}</td>
                                                                                    <td>{{ $mark->mark ?? 'N/A' }}</td>
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
                                                    </td>
                                                    <td>
                                                        <div class="dropdown ms-auto">
                                                            <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" ><i class="bx bx-dots-horizontal-rounded"></i>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right" style="border-radius: 5px;">
                                                                <a class="dropdown-item " href="{{ route('admin.mark.register.edit',[ 'id'=> $first->id ] ) }}"><i class="fadeIn animated bx bx-edit"></i> Edit</a>
                                                                <a href="#" 
                                                                class="dropdown-item delete-btn" 
                                                                data-id="{{ $first->id }}" 
                                                                data-url="{{ route('admin.mark.register.destroy', $first->id) }}" 
                                                                data-name="Mark Register">
                                                                <i class="fadeIn animated bx bx-trash"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end page-content-wrapper-->
</div>
<!--end page-wrapper-->


@endsection