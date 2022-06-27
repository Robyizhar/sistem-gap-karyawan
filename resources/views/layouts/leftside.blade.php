<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ url('/') }}/assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Dashboard']))
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Dashboards </span>
                        </a>
                    </li>
                @endif

                @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Jabatan', 'View-Pangkat', 'View-Level', 'View-Unit', 'View-Karyawan', 'View-Karyawan PKWT']))
                    <li class="menu-title mt-2">Master Data</li>

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Jabatan']))
                    <li>
                        <a href="{{ route('jabatan.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Jabatan </span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Pangkat']))
                    <li>
                        <a href="{{ route('pangkat.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Pangkat </span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Level']))
                    <li>
                        <a href="{{ route('level.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Level </span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Unit']))
                    <li>
                        <a href="{{ route('unit.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Unit </span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Karyawan']))
                    <li>
                        <a href="{{ route('karyawan.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Karyawan </span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Karyawan PKWT']))
                    <li>
                        <a href="{{ route('karyawan-pkwt.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Karyawan PKWT </span>
                        </a>
                    </li>
                    @endif

                @endif

                @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Promosi', 'View-Penilaian']))
                    <li class="menu-title mt-2">Promosi dan Penilaian</li>

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Penilaian']))
                    <li>
                        <a href="{{ route('penilaian.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Penilaian </span>
                        </a>
                    </li>
                    @endif
                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Promosi']))
                    <li>
                        <a href="{{ route('promosi.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Promosi </span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Penilaian NKI']))
                    <li>
                        <a href="{{ route('penilaian-nki.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Penilaian NKI (PKWT) </span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Promosi']))
                    <li>
                        <a href="{{ route('kontrak.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Kontrak Perpanjangan (PKWT) </span>
                        </a>
                    </li>
                    @endif

                @endif

                @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-Rekapitulasi']))

                    <li class="menu-title mt-2">Rekapitulasi Data</li>

                    <li>
                        <a href="{{ route('rekapitulasi.pensiun') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Karyawan Pensiun </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rekapitulasi.level') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Rekapitulasi Level </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rekapitulasi.pangkat') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Rekapitulasi Pangkat </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rekapitulasi.pkwt') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> Rekapitulasi (PKWT) </span>
                        </a>
                    </li>

                @endif

                @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-User Group', 'View-User']))
                    <li class="menu-title mt-2">Management User</li>

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-User Group']))
                    <li>
                        <a href="{{ route('role.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> User Group </span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-User']))
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="mdi mdi-calendar"></i>
                            <span> User </span>
                        </a>
                    </li>
                    @endif
                @endif

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
