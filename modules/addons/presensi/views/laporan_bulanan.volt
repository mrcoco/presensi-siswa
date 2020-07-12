<div class="col-md-12 col-sm-12">
    <div class="box">
        <header class="bg-alizarin text-white">
            <h4>Laporan Bulanan</h4>
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
            <form class="form-inline" id="LaporanBulananForm" method="post">
                <div class="form-group" >
                    <label>Kelas</label>
                    <select class="form-control" name="kelas" id="kelas" >
                        {% for item in kelas %}
                            <option value="{{ item.nama }}">{{ item.nama }}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="form-group" >
                    <label>Tahun Ajaran</label>
                    <select class="form-control" name="tahun_ajaran" id="tahun_ajaran" >
                        {% for item in tahun %}
                            <option value="{{ item.tahun }}">{{ item.tahun }}</option>
                        {% endfor %}
                    </select>
                </div>

                <div class="form-group" >
                    <label>Tanggal</label>
                    <input autocomplete="off"  type="text" name="bulan" class="form-control bulan" placeholder="yyyy-mm">
                </div>
                <div class="form-group" >
                    <label>Mode Presensi</label>
                    <select class="form-control" name="mode" id="mode" >
                        <option value="0">Datang Pulang</option>
                        <option value="1">Sesi</option>
                    </select>
                </div>
                <div class="form-group" >
                    <button type="submit" name="submit" class="btn btn-primary" id="submit"><i class="fa fa-search"></i>  Submit </button>
                </div>
            </form>

            <div id="LaporanBulananResult"></div>
        </div>
    </div>
</div>