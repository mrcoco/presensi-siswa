<table class="table-bordered table-condensed">
    <tr><td colspan="2">Keterangan</td></tr>
    <tr><td>S</td><td>Sakit</td></tr>
    <tr><td>I</td><td>Izin</td></tr>
    <tr><td>A</td><td>Alpa</td></tr>
</table>
<br>
{% set ll = 0 %}
            {% set lp = 0 %}
            {% for pres in arr %}
                {% if pres['sex'] == 'P' %}
                    {% set lp +=1 %}
                {% endif %}
                {% if pres['sex'] == 'L' %}
                    {% set ll +=1 %}
                {% endif %}
            {% endfor %}
<table>
    <tr><td>Laki-Laki</td><td>: {{ ll }} Orang</td></tr>
    <tr><td>Perempuan</td><td>: {{ lp }} Orang</td></tr>
    <tr><td>Jumlah</td><td>: {{ arr|length }} Orang</td></tr>
</table>

<table id="presensi-foot">
    <tr><td>Kepala Sekolah</td></tr>
    <tr><td height="50px"></td></tr>
    <tr><td>{{ kepsek }}</td></tr>
    <tr><td>{{ nip }}</td></tr>
</table>