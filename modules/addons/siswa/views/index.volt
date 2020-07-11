<div class="col-md-12 col-sm-12">
    <div class="box">
        <header class="bg-alizarin text-white">
            <h4>Manage Siswa</h4>
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
        <table id="grid-siswa" class="table table-condensed table-hover table-striped">
            <thead>
            <tr>
                <th data-column-id="no" data-type="numeric" data-width="5%" data-sortable="false">no</th>
                <th data-column-id="nama" data-sortable="false">Nama</th>
                <th data-column-id="nisn" data-sortable="false">Nisn</th>
                <th data-column-id="kelas" data-sortable="false">Kelas</th>
                <th data-column-id="sex" data-sortable="false">Jenis Kelamin</th>
	
                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
            </tr>
            </thead>
        </table>
        </div>
    </div>
</div>

<div id="mysiswa" class="modal fade modal-wide" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Siswa</h4>
            </div>
            <div class="modal-body">
                <form id="myForm" method="post" enctype="multipart/form-data">
                    <div class="form-group" >
                    <input type="hidden" class="form-control" name="hidden_id" id="hidden_id" >
                    </div>
                    <div class="form-group" >
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" >
                    </div>
                    <div class="form-group" >
                    <label>Nisn</label>
                    <input type="text" class="form-control" name="nisn" id="nisn" >
                    </div>
                    <div class="form-group" >
                    <label>Kelas </label>
                        <select class="form-control" name="kelas" id="kelas">
                        {% for item in kelas %}
                            <option value="{{ item.nama }}">{{ item.nama }}</option>
                        {% endfor %}
                        </select>
                    </div>
                    <div class="form-group" >
                    <label>Jenis Kelamin</label>
                        <select class="form-control" name="sex" id="sex">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group" >
                    <label>Pass</label>
                    <input type="text" class="form-control" name="pass" id="pass" >
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