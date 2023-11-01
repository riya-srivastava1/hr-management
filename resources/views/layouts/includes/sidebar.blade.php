<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar app-sidebar-transparent">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-search mb-n3">
                <input type="text" class="form-control" placeholder="Sidebar menu filter..."
                    data-sidebar-search="true" />
            </div>
            <div class="menu-header">Navigation</div>
            @if (Auth::user()->role == '1')
                <div class="menu-item has-sub  {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href={{ route('dashboard') }} class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-chalkboard-user"></i>
                        </div>
                        <div class="menu-text">Dashboard</div>
                    </a>
                </div>

                <div
                    class="menu-item has-sub {{ request()->routeIs('viewdetail') ? 'active' : '' }}{{ request()->routeIs('viewdetail2') ? 'active' : '' }} ">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-tablet-screen-button"></i>
                        </div>
                        <div class="menu-text">Screening</div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ request()->routeIs('viewdetail') ? 'active' : '' }}">
                            <a href="{{ route('viewdetail') }}" class="menu-link">
                                <div class="menu-text">Candidates Details Management</div>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('viewdetail2') ? 'active' : '' }}">
                            <a href="{{ route('viewdetail2') }}" class="menu-link">
                                <div class="menu-text">Post and Department Management</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item has-sub {{ request()->routeIs('templist') ? 'active' : '' }} ">
                    <a href={{ route('templist') }} class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-user-pen"></i>
                        </div>
                        <div class="menu-text">Interview Phase 2</div>
                    </a>
                </div>
                <div class="menu-item has-sub  {{ request()->routeIs('phase3') ? 'active' : '' }} ">
                    <a href="{{ route('phase3') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-user-pen"></i>
                        </div>
                        <div class="menu-text">Interview phase 3</div>
                    </a>
                </div>


                <div class="menu-item has-sub {{ request()->routeIs('employee.index') ? 'active' : '' }} ">
                    <a href="{{ route('employee.index') }}" class="menu-link ">
                        <div class="menu-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="menu-text ">Employee Records</div>
                    </a>
                </div>

                <div class="menu-item has-sub {{ request()->routeIs('date.range') ? 'active' : '' }} ">
                    <a href={{ route('date.range') }} class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-chalkboard-user"></i>
                        </div>
                        <div class="menu-text">Date wise report</div>
                    </a>
                </div>

                <div class="menu-item has-sub {{ request()->routeIs('attendance.month') ? 'active' : '' }}">
                    <a href="{{ route('attendance.month') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="menu-text">Monthly Attendance</div>
                    </a>
                </div>

                <div class="menu-item has-sub {{ request()->routeIs('clock.timesheet') ? 'active' : '' }} ">
                    <a href="{{ route('clock.timesheet') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="menu-text"> Clock-in/out Timesheet</div>
                    </a>
                </div>
                <div class="menu-item has-sub {{ request()->routeIs('holiday.create') ? 'active' : '' }} ">
                    <a href={{ route('holiday.create') }} class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-user-pen"></i>
                        </div>
                        <div class="menu-text">List of Holidays</div>
                    </a>
                </div>
                <div
                    class="menu-item has-sub {{ request()->routeIs('register') ? 'active' : '' }}{{ request()->routeIs('userlist') ? 'active' : '' }}  ">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="far fa-address-book"></i>
                        </div>
                        <div class="menu-text">Admin/Employee</div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item{{ request()->routeIs('register') ? 'active' : '' }} ">
                            <a href="{{ route('register') }}" class="menu-link">
                                <div class="menu-text">Add Admin/Employee</div>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('userlist') ? 'active' : '' }}">
                            <a href="{{ route('userlist') }}" class="menu-link">
                                <div class="menu-text">Admin/Employee List</div>
                            </a>
                        </div>

                    </div>
                </div>
            @elseif (Auth::user()->role == '0')
                <div class="menu-item has-sub  {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href={{ route('dashboard') }} class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-sitemap"></i>
                        </div>
                        <div class="menu-text">Dashboard</div>
                    </a>
                </div>
                <div class="menu-item has-sub {{ request()->routeIs('teamLead') ? 'active' : '' }}">
                    <a href="{{ route('teamLead') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-list-ol"></i>
                        </div>
                        <div class="menu-text">Attendance </div>
                    </a>
                </div>
                <div class="menu-item has-sub  {{ request()->routeIs('holiday') ? 'active' : '' }}">
                    <a href={{ route('holiday.create') }} class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-user-pen"></i>
                        </div>
                        <div class="menu-text">List of Holidays</div>
                    </a>
                </div>
            @else
                <div class="menu-item has-sub  {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href={{ route('dashboard') }} class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-sitemap"></i>
                        </div>
                        <div class="menu-text">Dashboard</div>
                    </a>
                </div>

                <div
                    class="menu-item has-sub {{ request()->routeIs('employee.create') ? 'active' : '' }}{{ Request::is('dashboard/employee/show') ? 'active' : '' }}">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-list-ol"></i>
                        </div>
                        <div class="menu-text">Employee Record</div>
                        <div class="menu-caret"></div>
                    </a>

                    <div class="menu-submenu">
                        @if (empty($employ))
                            <div class="menu-item {{ request()->routeIs('employee.create') ? 'active' : '' }}">
                                <a href="{{ route('employee.create') }}" class="menu-link">
                                    <div class="menu-text">Add Information</div>
                                </a>
                            </div>
                        @endif
                        @if (!empty($employ))
                            <div class="menu-item {{ Request::is('dashboard/employee/show') ? 'active' : '' }}">
                                <a href="{{ url('/dashboard/employee/show') }}" class="menu-link">
                                    <div class="menu-text">Index Employee Info</div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>


                <div
                    class="menu-item has-sub  {{ request()->routeIs('leave.create') ? 'active' : '' }} {{ request()->routeIs('mark.create') ? 'active' : '' }} {{ request()->routeIs('reimbursement.create') ? 'active' : '' }} ">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-list-ol"></i>
                        </div>
                        <div class="menu-text">Request Section</div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item {{ request()->routeIs('leave.create') ? 'active' : '' }}">
                            <a href="{{ route('leave.create') }}" class="menu-link">
                                <div class="menu-text">Leave Request</div>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('mark.create') ? 'active' : '' }}">
                            <a href="{{ route('mark.create') }}" class="menu-link">
                                <div class="menu-text">Mark Attendance</div>
                            </a>
                        </div>
                        <div class="menu-item {{ request()->routeIs('reimbursement.create') ? 'active' : '' }}">
                            <a href="{{ route('reimbursement.create') }}" class="menu-link">
                                <div class="menu-text">Reimbursment Request</div>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="menu-item has-sub  {{ request()->routeIs('holiday.create') ? 'active' : '' }}">
                    <a href={{ route('holiday.create') }} class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-user-pen"></i>
                        </div>
                        <div class="menu-text">List of Holidays</div>
                    </a>
                </div>
            @endIf
            <!-- BEGIN minify-button -->
            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a>
            </div>
            <!-- END minify-button -->
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a></div>
<!-- END #sidebar -->
