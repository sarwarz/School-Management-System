@extends('backEnd.admin.layout.app')
@section('title')
Marks Grade
@endsection
@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Marks Grade</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Marks Grade</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Marks Grade</h3>
                        <a href="{{ route('admin.mark.grade.add') }}" class="btn  btn-primary ml-4"><i class="bx bx-plus"></i>Add Mark Grade</a>
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
                                        <th>Point</th>
                                        <th>Percent From</th>
                                        <th>Percent Upto</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($marks_grade)
                                        @php $i=0; @endphp
                                            @foreach ($marks_grade as $item)
                                            @php $i++; @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->point }}</td>
                                                    <td>{{ $item->percent_from }}</td>
                                                    <td>{{ $item->percent_upto }}</td>
                                                    <td>{{ $item->remarks }}</td>
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
                                                                <a class="dropdown-item " href="{{ route('admin.mark.grade.edit',[ 'id'=> $item->id ] ) }}"><i class="fadeIn animated bx bx-edit"></i> Edit</a>
                                                                <a href="#" 
                                                                class="dropdown-item delete-btn" 
                                                                data-id="{{ $item->id }}" 
                                                                data-url="{{ route('admin.mark.grade.destroy', $item->id) }}" 
                                                                data-name="Mark Grade">
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