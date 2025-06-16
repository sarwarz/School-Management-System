<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="">
            <img src="{{ asset('assets/images/licensesender-icon.png') }}" class="logo-icon-2" alt="" />
        </div>
        <div>
            <h4 class="logo-text">Dashboard</h4>
        </div>
        <a href="javascript:;" class="toggle-btn ms-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin') }}">
                <div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon icon-color-2"><i class="bx bx-group"></i>
                </div>
                <div class="menu-title">Students</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.student.index') }}"><i class="bx bx-right-arrow-alt"></i>All Students</a>
                </li>
                <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Student Migration</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon icon-color-3"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Teachers</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.teacher.index') }}"><i class="bx bx-right-arrow-alt"></i>All Teacher</a>
                </li>
                <li> <a href="{{ route('admin.teacher.department.index') }}"><i class="bx bx-right-arrow-alt"></i>Departments</a>
                </li>
                <li> <a href="{{ route('admin.teacher.designation.index') }}"><i class="bx bx-right-arrow-alt"></i>Designations</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon icon-color-4"><i class="bx bx-book-open"></i>
                </div>
                <div class="menu-title">Academic</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.class.index') }}"><i class="bx bx-right-arrow-alt"></i>Class</a>
                </li>
                </li>
                <li> <a href="{{ route('admin.subject.index') }}"><i class="bx bx-right-arrow-alt"></i>Subject</a>
                </li>
                <li> <a href="{{ route('admin.academic.subject.assign.index') }}"><i class="bx bx-right-arrow-alt"></i>Subject Assign</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon icon-color-5"><i class="bx bx-spreadsheet"></i>
                </div>
                <div class="menu-title">Examination</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.exam.type.index') }}"><i class="bx bx-right-arrow-alt"></i>Exam Type</a>
                </li>
                </li>
                <li> <a href="{{ route('admin.mark.grade.index') }}"><i class="bx bx-right-arrow-alt"></i>Marks Grade</a>
                </li>
                <li> <a href="{{ route('admin.mark.register.index') }}"><i class="bx bx-right-arrow-alt"></i>Marks Register</a>
                </li>
                <li> <a href="{{ route('admin.exam.result.index') }}"><i class="bx bx-right-arrow-alt"></i>Exam Result</a>
                </li>
                <li> <a href="{{ route('admin.exam.marksheet.index') }}"><i class="bx bx-right-arrow-alt"></i>Marksheet</a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>