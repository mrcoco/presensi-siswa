<html>
{% include 'laporan/cetak_header.volt' %}
<body>
<div id="result" class="cont">
    {% include 'laporan/cetak_kop.volt' %}
    <div class="row">
        <div class="col-md-12">
            <h4>PRESENSI PESERTA DIDIK SMA NEGERI 2 BANTUL</h4>
            <table>
                <tr><td colspan="2">Rekap Kehadiran Semester</td></tr>
                <tr><td>Kelas</td><td> : {{ kelas }}</td></tr>
                <tr><td>Semester</td><td> : {% if semester == "1" %} Gasal {% else %} Genap{% endif %}</td></tr>
                <tr><td>Tahun Ajaran</td><td> : {{ tahun }}</td></tr>
            </table>
            <br>
            <table id="presensi-bulanan" class="table-bordered table-condensed">
                {% include 'laporan/cetak_thead_semester.volt' %}
                {% include 'laporan/cetak_tbody_semester.volt' %}
            </table>
            <br>
            {% include 'laporan/cetak_foot_semester.volt' %}
        </div>
    </div>
</div>

</body>
</html>