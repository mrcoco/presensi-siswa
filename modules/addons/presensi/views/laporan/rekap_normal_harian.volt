<style>
    .terlambat {
        color: rgb(255, 0, 0); /* red */
    }
    .cetak{
        margin-top: 30px;
    }
</style>
<div class="cetak">
    <a class="btn btn-primary" href="{{ url("cetak/harian?url=") }}{{ url_print }}" target="_blank"><i class="fa fa-print"></i> Cetak</a>
</div>
<table id="presensi-bulanan" class="table table-condensed table-hover table-striped">
    <thead>
    <tr>
        <th rowspan='2' valign='top'>NAMA</th>
        <th rowspan='2' valign='top'>NIS</th>
        <th rowspan='2' valign='top'>JK</th>
        <th colspan='2'>Tanggal: {{ tanggal }}</th>
        <th colspan='3'>JUMLAH</th>
        <th rowspan='2' valign='top'>KET</th>
    </tr>
    <tr>
        <th valign='top'>Jam Datang</th>
        <th valign='top'>Jam Pulang</th>
        <th>I</th>
        <th>S</th>
        <th>A</th>
    </tr>
    </thead>
    <tbody>
    {% for item in arr %}
    <tr>
        <td>{{ item['nama'] }}</td>
        <td>{{ item['nisn'] }}</td>
        <td>{{ item['sex'] }}</td>
        {% set izin = 0 %}
        {% set sakit= 0 %}
        {% set hadir= 0 %}
        {% set absen= 0 %}
        <?php $presensi = count($item['presensi']); ?>
        {% if presensi !== 0 %}
            {% for pres in item['presensi'] %}
            <td>
                <?php echo date("H:m:s", strtotime($pres->jam_masuk)) ?>
            </td>
            <td>
                <?php echo date("H:m:s", strtotime($pres->jam_keluar)) ?>
            </td>

            {% if pres.status == '3' %}
                {% set izin +=1 %}
            {% endif %}
            {% if pres.status == '4' %}
                {% set sakit +=1 %}
            {% endif %}
            {% set hadir +=1 %}

            {% endfor %}
        {% else %}
            <td>
                -
            </td>
            <td>
                -
            </td>
            {% set absen +=1 %}
        {% endif %}
        <td>{{ izin }}</td>
        <td>{{ sakit }}</td>
        <td>{{ absen }}</td>
        <td>-</td>
    </tr>
    {% endfor %}
    </tbody>
</table>