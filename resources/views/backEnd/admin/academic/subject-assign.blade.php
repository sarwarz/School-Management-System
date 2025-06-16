@extends('backEnd.admin.layout.app')
@section('title')
Subject Assign
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Subject Assign</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Subject Assign</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Subject Assign</h3>
                        <a href="{{ route('admin.academic.subject.assign.add') }}" class="btn  btn-primary ml-4"><i class="bx bx-plus"></i>Assign Subject</a>
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
                                        <th>Class</th>
                                        <th>Subject & Teacher</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($classes)
                                        @php $i=0; @endphp
                                            @foreach ($classes as $item)
                                            @php $i++; @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $item->academicClass->name ?? 'N/A' }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#classModal{{ $item->id }}"><i class="fadeIn animated bx bx-show"></i></button>
                                                        <div class="modal fade" id="classModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Subject & Teacher</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Subject</th>
                                                                                <th>Teacher</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @if ($item->details)
                                                                                @foreach ($item->details as $detail)
                                                                                <tr>
                                                                                    <td>{{ $detail->subject->name ?? 'N/A' }}</td>
                                                                                    <td>{{ $detail->teacher->first_name ?? '' }}{{ $detail->teacher->last_name ? ' ' . $detail->teacher->last_name : '' }}</td>  
                                                                                </tr>
                                                                                @endforeach
                                                                            @endif
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
                                                    @if ( $item->status == 1)
                                                        <span class="badge bg-success">Active</span> 
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span> 
                                                    @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown ms-auto">
                                                            <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" ><i class="bx bx-dots-horizontal-rounded"></i>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right" style="border-radius: 5px;">
                                                                <a class="dropdown-item " href="{{ route('admin.academic.subject.assign.edit',[ 'id'=> $item->id ] ) }}"><i class="fadeIn animated bx bx-edit"></i> Edit</a>
                                                                <a href="#" 
                                                                class="dropdown-item delete-btn" 
                                                                data-id="{{ $item->id }}" 
                                                                data-url="{{ route('admin.academic.subject.assign.destroy', $item->id) }}" 
                                                                data-name="Subject Assign">
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