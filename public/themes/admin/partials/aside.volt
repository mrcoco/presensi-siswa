<!-- begin .app-side -->
<aside class="app-side">
    <!-- begin .side-content -->
    <div class="side-content">
        <!-- begin user-panel -->
        <div class="user-panel">
            <div class="user-image">
                <a href="#">
                    <img class="img-circle" src="{{ url("themes/admin/") }}assets/img/m1.svg" alt="John Doe">
                </a>
            </div>
            <div class="user-info">
                <h5>{{ auth.getName() }}</h5>
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="text-turquoise small dropdown-toggle bg-transparent" data-toggle="dropdown">
                            <i class="fa fa-fw fa-circle">
                            </i> Online
                        </a>
                        <ul class="dropdown-menu animated flipInY pull-right">
                            <li>
                                {{ link_to('users/changePassword', 'Change Password') }}
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ url("session/logout") }}">
                                    <i class="fa fa-fw fa-sign-out"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: user-panel -->
        <!-- begin .side-nav -->
        <nav class="side-nav">
            <!-- BEGIN: nav-content -->
            <ul class="metismenu nav nav-inverse nav-bordered nav-stacked" data-plugin="metismenu">

                <li class="nav-header">MAIN</li>

                <li>
                    <a class="active" href="{{ url("dashboard") }}">
                    <span class="nav-icon">
                      <i class="fa fa-fw fa-cogs"></i>
                    </span>
                        <span class="nav-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-divider"></li>
                <li class="nav-header">Presensi</li>

                <!-- BEGIN: user -->
                {% if auth.getIdentity()['profile'] == "Users" %}
                    <li>
                        <a href="{{ url("presensi/rekap") }}">Riwayat Presensi</a>
                    </li>

                {% endif %}
                <!-- END: user -->

                {% if auth.getIdentity()['profile'] == "Guru" %}

                {% endif %}

                {% if auth.getIdentity()['profile'] == "Administrators" %}
                <!-- BEGIN: apps -->

                <li>
                    <a href="javascript:;">
                <span class="nav-icon">
                  <i class="fa fa-fw fa-tasks"></i>
                </span>
                        <span class="nav-title">Manajemen</span>
                        <span class="nav-tools">
                  <i class="fa fa-fw arrow"></i>
                </span>
                    </a>
                    <ul class="nav nav-sub nav-stacked">
                        <li><a href="javascript:;">
                            <span class="nav-icon">
                              <i class="fa fa-fw fa-tasks"></i>
                            </span>
                            <span class="nav-title">Siswa</span>
                            <span class="nav-tools">
                              <i class="fa fa-fw arrow"></i>
                            </span></a>
                            <ul class="nav nav-sub nav-stacked">
                                <li>
                                    <a href="{{ url("siswa") }}">Data Siswa</a>
                                </li>
                                <li>
                                    <a href="{{ url("siswa/import") }}">Import Siswa</a>
                                </li>
                            </ul>

                        </li>
                        <li>
                            <a href="javascript:;">
                            <span class="nav-icon">
                              <i class="fa fa-fw fa-tasks"></i>
                            </span>
                                        <span class="nav-title">Presensi</span>
                                        <span class="nav-tools">
                              <i class="fa fa-fw arrow"></i>
                            </span>
                            </a>
                            <ul class="nav nav-sub nav-stacked">
                                <li>
                                    <a href="{{ url("presensi") }}">Presensi Manual</a>
                                </li>
                                <li>
                                    <a href="{{ url("presensi/izin") }}">Izin</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{url("kelas")}}">
                            <span class="nav-icon">
                              <i class="fa fa-fw fa-tasks"></i>
                            </span>
                                <span class="nav-title">Kelas</span>
                            </a></li>
                        <li><a href="{{url('tahunajaran')}}">
                            <span class="nav-icon">
                              <i class="fa fa-fw fa-tasks"></i>
                            </span>
                                <span class="nav-title">Tahun Ajaran</span>
                            </a></li>
                        <li><a href="{{url('libur')}}">
                            <span class="nav-icon">
                              <i class="fa fa-fw fa-tasks"></i>
                            </span>
                                <span class="nav-title">Hari Libur</span>
                            </a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <span class="nav-icon">
                          <i class="fa fa-fw fa-calendar"></i>
                        </span>
                        <span class="nav-title">Laporan</span>
                        <span class="nav-tools">
                          <i class="fa fa-fw arrow"></i>
                        </span>
                    </a>
                    <ul class="nav nav-sub nav-stacked">
                        <li>
                            <a href="{{ url("laporan/presensi/harian") }}">Presensi Harian</a>
                        </li>
                        <li>
                            <a href="{{ url("laporan/presensi/bulanan") }}">Presensi Bulanan</a>
                        </li>
                        <li>
                            <a href="{{ url("laporan/harian") }}">Rekap Harian</a>
                        </li>
                        <li>
                            <a href="{{ url("laporan/bulanan") }}">Rekap Bulanan</a>
                        </li>
                        <li>
                            <a href="{{ url("laporan/semester") }}">Rekap Semester</a>
                        </li>
                    </ul>
                </li>

                <!-- BEGIN: apps -->

                <!-- BEGIN: blank pages -->
                <!-- END: blank pages -->

                <li class="nav-divider"></li>

                <li>
                    <a href="{{ url("pengumuman") }}">
                    <span class="nav-icon">
                      <i class="fa fa-fw fa-newspaper-o"></i>
                    </span>
                        Pengumuman</a>
                </li>
                <li class="nav-divider"></li>

                <!-- BEGIN: utility -->
                <li>
                    <a href="javascript:;">
                    <span class="nav-icon">
                      <i class="fa fa-fw fa-wrench"></i>
                    </span>
                        <span class="nav-title">Setting</span>
                        <span class="nav-tools">
                      <i class="fa fa-fw arrow"></i>
                    </span>
                    </a>
                    <ul class="nav nav-sub nav-stacked">
                        <li>
                            <a href="{{ url("users") }}">Users</a>
                        </li>
                        <li>
                            <a href="{{ url("profiles") }}">Profile</a>
                        </li>
                        <li>
                            <a href="{{ url("permissions") }}">Permissions</a>
                        </li>
                        <li>
                            <a href="{{ url("webconfig") }}">Webconfig</a>
                        </li>
                    </ul>
                </li>
                <!-- BEGIN: utility -->
{#                <li>#}
{#                    <a href="javascript:;">#}
{#                    <span class="nav-icon">#}
{#                      <i class="fa fa-cogs"></i>#}
{#                    </span>#}
{#                        <span class="nav-title">Addon Modules</span>#}
{#                        <span class="nav-tools">#}
{#                      <i class="fa fa-fw arrow"></i>#}
{#                    </span>#}
{#                    </a>#}
{#                    {% if widget.addonmenu() is not empty %}#}
{#                    <ul class="nav nav-sub">#}
{#                        {% for item in widget.addonmenu() %}#}
{#                        <li>#}
{#                            <a href="{{ url(item.slug)}}">#}
{#                                <span class="nav-title">{{item.name}}</span>#}
{#                            </a>#}
{#                        </li>#}
{#                        {% endfor %}#}
{#                        <li></li>#}
{#                    </ul>#}
{#                    {% endif %}#}
{#                    #}
{#                </li>#}
                {% endif %}
            </ul>
            <!-- END: nav-content -->
        </nav>
        <!-- END: .side-nav -->
    </div>
    <!-- END: .side-content -->
    <!-- begin .side-footer -->
    <footer class="side-footer p-h-15 p-t-15 p-b-10">
        <div class="progress is-xs">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                <span class="sr-only">60% Complete</span>
            </div>
        </div>
        <div class="progress is-xs">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                <span class="sr-only">40% Complete</span>
            </div>
        </div>
    </footer>
    <!-- END: .side-footer -->
</aside>
<!-- END: .app-side -->