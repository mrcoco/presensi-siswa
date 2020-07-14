<tbody>
{% for item in arr %}
    <tr>
        <td>{{ loop.index }}</td>
        <td>{{ item['nama'] }}</td>
        <td>{{ item['nisn'] }}</td>
        <td>{{ item['sex'] }}</td>
        {% set izin = 0 %}
        {% set sakit= 0 %}
        {% set hadir= 0 %}
        {% for k,wk in work %}

            <td>
                {% for pres in item['presensi'] %}
                    {% if pres.tanggal == wk %}
                        {% if pres.status == '1' OR pres.status =='2' %}
                            <?php list($tg,$jam) = explode(" ",$pres->jam_masuk); ?>
                            {{ jam }}<br>
                        {% endif %}
                        {% if pres.status == '3' %}
                            I
                            {% set izin +=1 %}
                        {% endif %}

                        {% if pres.status == '4' %}
                            S
                            {% set sakit +=1 %}
                        {% endif %}
                        {% set hadir +=1 %}
                    {% endif %}

                {% endfor %}
            </td>
        {% endfor %}

        <td>{{ izin }}</td>
        <td>{{ sakit }}</td>
        <td>{{ count_work - hadir }}</td>
        <td></td>
    </tr>
{% endfor %}
</tbody>