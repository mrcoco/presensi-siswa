<html>
{% include 'laporan/cetak_header.volt' %}
<body>
<div id="result" class="cont">
    {% include 'laporan/cetak_kop.volt' %}
    <div class="row">
        <div class="col-md-12">
            <table id="presensi-harian" class="table-bordered table-condensed">
                {% include 'laporan/cetak_thead_sesi_harian.volt' %}
                {% include 'laporan/cetak_tbody_sesi_harian.volt' %}
            </table>
            <br>
            {% include 'laporan/cetak_footer.volt' %}
        </div>
    </div>
</div>
</body>
</html>