<html>
{% include 'laporan/cetak_header.volt' %}
<body>
<div id="result" class="cont">
    {% include 'laporan/cetak_kop.volt' %}
    <div class="row">
        <div class="col-md-12">
            <table id="presensi-bulanan" class="table-bordered table-condensed">
                {% include 'laporan/cetak_thead_bulanan.volt' %}
                {% include 'laporan/cetak_tbody_sesi_bulanan.volt' %}
            </table>
        </div>
    </div>
</div>
</body>
</html>