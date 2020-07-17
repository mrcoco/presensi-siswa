<style>
    .cetak{
        margin-top: 30px;
    }
</style>
<div class="cetak">
    <a class="btn btn-primary" href="{{ url("cetak/harian?url=") }}{{ url_print }}" target="_blank"><i class="fa fa-print"></i> Cetak</a>
</div>
<table id="presensi-harian" class="table table-condensed table-hover table-striped">
    {% include 'laporan/cetak_thead_sesi_harian.volt' %}
    {% include 'laporan/cetak_tbody_sesi_harian.volt' %}
</table>