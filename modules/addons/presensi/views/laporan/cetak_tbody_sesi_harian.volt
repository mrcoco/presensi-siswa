<tbody>
{% for item in arr %}
    <tr>
        <td>{{ loop.index }}</td>
        <td>{{ item['nama'] }}</td>
        <td>{{ item['nisn'] }}</td>
        <td>{{ item['sex'] }}</td>
        {% set izin = 0 %}
        {% set sakit = 0 %}
        {% set hadir = 0 %}
        {% set sesi = [1,2,3,4,5] %}
        {% set arr_sesi = [] %}
        {% for i in 1..sesi|length %}
        <td>
            <?php $presensi = count($item['presensi']); ?>
            {% if(presensi !== 0) %}
                {% for pres in item['presensi'] %}
                    {% if (pres.status == '1' or pres.status == '2') %}
                        {% if (pres.sesi == i) %}
                            <?php echo date('H:m:s',strtotime($pres->jam_masuk)) ?>
                        {% endif %}
                    {% endif %}
                    {% if (pres.status == '3') %}
                        I
                        {% set izin +=1 %}
                    {% endif %}
                    {% if (pres.status == '4') %}
                        S
                        {% set sakit +=1 %}
                    {% endif %}
                    {% set hadir +=1 %}
                {% endfor %}
            {% else %}
                -
            {% endif %}
        </td>
        {% endfor %}
        {% if (hadir == 0) %}
            {% set alpha = "A" %}
        {% else %}
            {% set alpha = "-" %}
        {% endif %}
        {% if (izin !== 0) %}
            {% set iz = "I" %}
        {% else %}
            {% set iz = "-" %}
        {% endif %}
        {% if (sakit !== 0) %}
            {% set sk = "S" %}
        {% else %}
            {% set sk = "-" %}
        {% endif %}
        <?php
        $diff = array_diff($sesi,$arr_sesi);

        if(count($diff) !== 5){
            $kt = implode(",",$diff);
            $ket = "Tidak ikut sesi ".$kt;
        }else{
            $ket = "";
        }
        ?>
        <td>{{ iz }}</td>
        <td>{{ sk }}</td>
        <td>{{ alpha }}</td>
        <td>{{ ket }}</td>
    </tr>
{% endfor %}