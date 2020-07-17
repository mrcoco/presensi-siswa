<tbody>
{% for pres in arr %}
    {% set st_i = 0 %}
    {% set st_s = 0 %}
    <tr>
        <td>{{ loop.index }}</td>
        {% if pres['data'] is defined %}
            <td>{{ pres['data'][0]['nama'] }}</td>
            <td>{{ pres['data'][0]['nisn'] }}</td>
            <td>{{ pres['data'][0]['sex'] }}</td>
            <td>{{ pres['data'][0]['tanggal'] }}</td>
            {% for presensi in pres['data'] %}
                {% switch(presensi['sesi']) %}
                    {% case '1' %}
                        <td>{{ presensi['presensi']['jam_sesi1'] }}</td>
                    {% break %}
                    {% case '2' %}
                        <td>{{ presensi['presensi']['jam_sesi2'] }}</td>
                    {% break %}
                    {% case '3' %}
                        <td>{{ presensi['presensi']['jam_sesi3'] }}</td>
                    {% break %}
                    {% case '4' %}
                        <td>{{ presensi['presensi']['jam_sesi4'] }}</td>
                    {% break %}
                    {% case '5' %}
                        <td>{{ presensi['presensi']['jam_sesi5'] }}</td>
                    {% break %}
                    {% default %}
                        <td>-</td>
                    {% break %}
                {% endswitch %}
                {% if(presensi['status'] == '3') %}
                    {% set st_i +=1 %}
                {% else %}
                    {% set st_s +=1 %}
                {% endif %}
            {% endfor %}

{#            {% set c_pres = pres['data'] | length %}#}
{#            {% set c_loop = 5 - c_pres %}#}
{#            {% for ind in 1..c_loop %}#}
{#                <td></td>#}
{#            {% endfor %}#}

            {% if(st_i == 0) %}
                {% set set_i = "-" %}
                {% else %}
                    {% set set_i = "I" %}
            {% endif %}
            {% if(st_s == 0) %}
                {% set set_s = "-" %}
            {% else %}
                {% set set_s = "I" %}
            {% endif %}
            <td>{{ set_i }}</td>
            <td>{{ set_s }}</td>
            <td>-</td>

        {% else %}
            <td>{{ pres['nama'] }}</td>
            <td>{{ pres['nisn'] }}</td>
            <td>{{ pres['sex'] }}</td>
            <td>{{ pres['tanggal'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>-</td>
            <td>-</td>
            <td>A</td>
            <td></td>
        {% endif %}
    </tr>

{% endfor %}
</tbody>