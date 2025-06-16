@extends('backEnd.admin.layout.app')
@section('title')
Designation
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Designation</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Designation</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Designation</h3>
                        <a href="{{ route('admin.teacher.designation.add') }}" class="btn  btn-primary ml-4"><i class="bx bx-plus"></i>Add Designation</a>
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
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($teacherDesignation)
                                        @php $i=0; @endphp
                                            @foreach ($teacherDesignation as $item)
                                            @php $i++; @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $item->name }}</td>
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
                                                                <a class="dropdown-item " href="{{ route('admin.teacher.designation.edit',[ 'id'=> $item->id ] ) }}"><i class="fadeIn animated bx bx-edit"></i> Edit</a>
                                                                <a href="#" 
                                                                class="dropdown-item delete-btn" 
                                                                data-id="{{ $item->id }}" 
                                                                data-url="{{ route('admin.teacher.designation.destroy', $item->id) }}" 
                                                                data-name="Designation">
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