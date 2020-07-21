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
        {% set alpa = 0 %}
        {% set alpha= 0 %}

        {% for k,wk in work %}
            <td>
                {% for lb in libur %}
                    {% if lb['tanggal'] == wk %}
                    <b class="terlambat">L</b>
                    {% else %}
                        <?php $arr_pres = array(); ?>
                        {% for i in 1..5 %}
                            {% for pres in item['presensi'] %}
                                {% if pres.tanggal == wk %}
                                    {% if pres.sesi == i %}
                                        <?php $arr_pres[$wk]['sesi'][$i] = $pres->tanggal; ?>
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
                                {% else %}
                                    {% set alpa +=1 %}
                                {% endif %}
                            {% endfor %}
                            {% if(alpa == 1) %}
                                {% set alpha +=1 %}
                            {% endif %}
                        {% endfor %}
                        {% if (arr_pres|length == 0) %}
                            {% set alpha +=1 %}
                        {% endif %}
                    {% endif %}
                {% endfor %} {# end presensi #}
            </td>
        {% endfor %} {# end work #}

        <td>{{ izin }}</td>
        <td>{{ sakit }}</td>
        <td>{{ alpha}}</td>
        <td></td>
    </tr>
{% endfor %}{# end arr #}
</tbody>

