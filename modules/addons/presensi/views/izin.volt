<div class="col-md-12 col-sm-12">
    <div class="box">
        <header class="bg-alizarin text-white">
            <h4>Manage Izin Presensi</h4>
            <!-- begin box-tools -->
            <div class="box-tools">
                <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                <a class="fa fa-fw fa-square-o" href="#" data-fullscreen="box"></a>
                <a class="fa fa-fw fa-refresh" href="#" data-box="refresh"></a>
                <a class="fa fa-fw fa-times" href="#" data-box="close"></a>
            </div>
            <!-- END: box-tools -->
        </header>
        <div class="box-body collapse in">
            {{ content() }}
        <table id="grid-izin-presensi" class="table table-condensed table-hover table-striped">
            <thead>
            <tr>
                <th data-column-id="no" data-type="numeric" data-width="5%" data-sortable="false">no</th>
                <th data-column-id="siswa_nama" data-sortable="false">siswa</th>
                <th data-column-id="nisn" data-sortable="false">Nisn</th>
                <th data-column-id="tanggal" data-sortable="false">Tanggal</th>
                <th data-column-id="sesi" data-formatter="sesi" data-sortable="false">Sesi</th>
                <th data-column-id="status" data-formatter="status" data-sortable="false">Status</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
            </tr>
            </thead>
        </table>
        </div>
    </div>
</div>

<div id="mypresensi" class="modal fade modal-wide" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Presensi Izin</h4>
            </div>
            <div class="modal-body">
                <form id="myForm" method="post" enctype="multipart/form-data">
                    <div class="form-group" >
                        <label>Siswa</label>
                    <input type="hidden" class="form-control" name="hidden_id" id="hidden_id" >
                    </div>
                    <div class="form-group" >

                        <input type="hidden" class="form-control" name="siswa_id" id="siswa_id" >
                        <input type="text" class="form-control" name="siswa_nama" id="siswa_nama" >
                    </div>
                    <div class="form-group" >
                    <label>Nisn</label>
                    <input type="text" class="form-control" name="nisn" id="nisn" >
                    </div>
                    <div class="form-group" >
                        <label>Kelas</label>
                        <input type="text" class="form-control" name="kelas" id="kelas" >
                    </div>
                    <div class="form-group" >
                    <label>Tanggal</label>
                    <input type="text" class="form-control" name="tanggal" id="tanggal" >
                    </div>
                    <div class="form-group" >
                    <label>Sesi</label>
                        <select class="form-control" name="sesi" id="sesi">
                            <option value="0">Datang - Pulang</option>
                            <option value="1">Sesi 1</option>
                            <option value="2">Sesi 2</option>
                            <option value="3">Sesi 3</option>
                            <option value="4">Sesi 4</option>
                            <option value="5">Sesi 5</option>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="3">Izin</option>
                            <option value="4">Sakit</option>
                        </select>
                    </div>
	
                    <div class="form-group" >
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  close</button>
                                <button type="submit" name="save" class="btn btn-primary" id="save"><i class="fa fa-save"></i>  Save </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>