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
                            <?php list($tg,$jam_masuk) = explode(" ",$pres->jam_masuk); ?>
                            <?php
                        date_default_timezone_set('Asia/Jakarta');
                        if (isset($pres->jam_keluar)){
                            list($tg,$jam_keluar) = explode(" ",$pres->jam_keluar);
                            $time_jam_keluar = new DateTime($pres->jam_keluar);
                            }else{
                            $jam_keluar = '00:00:00';
                            $time_jam_keluar = new DateTime($pres->tanggal." ".$jam_keluar);
                            }
                            $time_jam_masuk = new DateTime($pres->jam_masuk);

                            $time_terlambat = new DateTime($pres->tanggal." ".$terlambat);
                            if(date('l',strtotime($pres->tanggal)) == 'Friday'){
                            $time_awal = new DateTime($pres->tanggal." ".$pulangawal_jumat);
                            }else{
                            $time_awal = new DateTime($pres->tanggal." ".$pulangawal_normal);
                            }
                            ?>
                            {% if(time_jam_masuk) > time_terlambat %}
                                <b class="terlambat">{{ jam_masuk }}</b>
                            {% else %}
                                {{ jam_masuk }}
                            {% endif %}
                            <br>
                            {% if(time_jam_keluar) < time_awal %}
                                <b class="terlambat">{{ jam_keluar }}</b>
                            {% else %}
                                {{ jam_keluar }}
                            {% endif %}

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