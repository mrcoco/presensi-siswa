<style>
    .terlambat {
        color: rgb(255, 0, 0); /* red */
    }
    .cetak{
        margin-top: 30px;
    }
</style>
<div class="cetak">
    <a class="btn btn-primary" href="{{ url("cetak/presensi/harian?url=") }}{{ url_print }}" target="_blank"><i class="fa fa-print"></i> Cetak</a>
</div>
<table id="presensi-bulanan" class="table table-condensed table-hover table-striped">
    {% include 'riwayat/thead_sesi_bulanan.volt' %}
    {% include 'riwayat/tbody_sesi_bulanan.volt' %}
</table>