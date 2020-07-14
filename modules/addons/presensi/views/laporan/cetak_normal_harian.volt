<html>
{% include 'laporan/cetak_header.volt' %}
<body>
<div id="result" class="container">
    {% include 'laporan/cetak_kop.volt' %}
    <div class="row">
        <div class="col-md-12">
            <table id="presensi-bulanan" class="table-bordered table-condensed">
            {% include 'laporan/cetak_thead_harian.volt' %}
            {% include 'laporan/cetak_tbody_normal_harian.volt' %}
        </table>
        </div>
    </div>
</div>