<style>
    .terlambat {
        color: rgb(255, 0, 0); /* red */
    }
    .cetak{
        margin-top: 30px;
    }
</style>
<div class="cetak">
    <a class="btn btn-primary" href="{{ url("cetak/bulanan?url=") }}{{ url_print }}" target="_blank"><i class="fa fa-print"></i> Cetak</a>
</div>
<table id="presensi-bulanan" class="table table-condensed table-hover table-striped">
    {% include 'riwayat/thead_sesi_bulanan.volt' %}
    <tbody>

        {% for i,wk in work %}
            {% set sesi=[] %}
            {% set st_i = 0 %}
            {% set st_s = 0 %}
            {% set st_h = 0 %}
            <tr>
                <td>{{ loop.index }}</td>
                <td>{{ arr['nama'] }}</td>
                <td>{{ arr['nisn'] }}</td>
                <td>{{ arr['sex'] }}</td>
                <td>{{ wk }}</td>
                <td>
                {% for pres in arr['presensi'] %}
                    {% if pres['tanggal'] == wk %}
                        Sesi {{ pres['sesi'] }}: {{ pres['jam_masuk'] }} </br>
                        {% if(pres['status'] == '3') %}
                            {% set st_i +=1 %}
                            {% break %}
                        {% elseif(pres['status'] == '4') %}
                            {% set st_s +=1 %}
                            {% break %}
                        {% else %}
                            {% set st_s =0 %}
                            {% break %}
                        {% endif %}
                        {% set st_h +=1 %}
                    {% endif %}
                {% endfor %}
                </td>
                {% if(st_i == 0) %}
                    {% set set_i = "-" %}
                {% else %}
                    {% set set_i = "I" %}
                {% endif %}
                {% if(st_s == 0) %}
                    {% set set_s = "-" %}
                {% else %}
                    {% set set_s = "S" %}
                {% endif %}
                {% if(st_h == 0) %}
                    {% set set_h = "A" %}
                {% else %}
                    {% set set_h = "-" %}
                {% endif %}
                <td>{{ set_i }}</td>
                <td>{{ set_s }}</td>
                <td>{{ set_h }}</td>
                <td>-</td>
            </tr>
        {% endfor %}
    </tbody>
{#    <pre>#}
{#        <?php print_r($arr);?>#}
{#    </pre>#}
{#    {% include 'riwayat/tbody_sesi_bulanan.volt' %}#}
</table>