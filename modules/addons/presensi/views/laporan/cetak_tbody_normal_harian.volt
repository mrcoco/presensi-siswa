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