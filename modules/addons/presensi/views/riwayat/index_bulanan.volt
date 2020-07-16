<div class="col-md-12 col-sm-12">
    <div class="box">
        <header class="bg-alizarin text-white">
            <h4>Riwayat Bulanan</h4>
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
            <form class="form-inline" id="RiwayatBulananForm" method="post">
                <div class="form-group" >
                    <label>Nama</label>
                    <input type="text" class="form-control" name="siswa_nama" id="siswa_nama" >
                    <input type="hidden" name="siswa_id" id="siswa_id">
                    <input type="hidden" name="siswa_nisn" id="siswa_nisn">
                </div>

                <div class="form-group" >
                    <label>Bulan</label>
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

            <div id="RiwayatBulananResult"></div>
        </div>
    </div>
</div>