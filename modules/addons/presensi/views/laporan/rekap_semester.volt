<style>
    .terlambat {
        color: rgb(255, 0, 0); /* red */
    }
    .cetak{
        margin-top: 30px;
    }
</style>
<div class="cetak">
    <a class="btn btn-primary" href="{{ url("cetak/semester?url=") }}{{ url_print }}" target="_blank"><i class="fa fa-print"></i> Cetak</a>
</div>
<table id="presensi-bulanan" class="table table-condensed table-hover table-striped">
    {% include 'laporan/cetak_thead_semester.volt' %}
    {% include 'laporan/cetak_tbody_semester.volt' %}
</table>