<html>
{% include 'laporan/cetak_header.volt' %}
<body>
<div id="result" class="cont">
    {% include 'laporan/cetak_kop.volt' %}
    <div class="row">
        <div class="col-md-12">
            <h4>PRESENSI PESERTA DIDIK SMA NEGERI 2 BANTUL</h4>
            <table>
                <tr><td colspan="2">Rekap Kehadiran Bulanan</td></tr>
                <tr><td>Kelas</td><td> : {{ kelas }}</td></tr>
                <tr><td>Bulan</td><td> : {{ bulan }}</td></tr>
            </table>
            <br>
            <table id="presensi-bulanan" class="table-bordered table-condensed">
                {% include 'laporan/cetak_thead_bulanan.volt' %}
                {% include 'laporan/cetak_tbody_sesi_bulanan.volt' %}
            </table>
            <br>
            {% include 'laporan/cetak_footer.volt' %}
        </div>
    </div>
</div>
</body>
</html>