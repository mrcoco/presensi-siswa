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
        {% set absen= 0 %}
        <?php $presensi = count($item['presensi']); ?>
        {% if presensi !== 0 %}
            {% for pres in item['presensi'] %}
                <?php
                $time_jam_masuk = new DateTime($pres->jam_masuk);
                $time_terlambat = new DateTime($pres->tanggal." ".$terlambat);
                if (isset($pres->jam_keluar)){
                  $time_jam_keluar = new DateTime($pres->jam_keluar);
                }else{
                  $jam_keluar = '00:00:00';
                  $time_jam_keluar = new DateTime($pres->tanggal." ".$jam_keluar);
                }
                if(date('l',strtotime($pres->tanggal)) == 'Friday'){
                    $time_awal = new DateTime($pres->tanggal." ".$pulangawal_jumat);
                }else{
                    $time_awal = new DateTime($pres->tanggal." ".$pulangawal_normal);
                }
                ?>
                <td>
                    {% if(time_jam_masuk) > time_terlambat %}
                        <b class="terlambat"><?php echo date("H:m:s", strtotime($pres->jam_masuk)) ?></b>
                    {% else %}
                        <?php echo date("H:m:s", strtotime($pres->jam_masuk)) ?>
                    {% endif %}

                </td>
                <td>
                    <?php if (isset($pres->jam_keluar)){ ?>
                        {% if(time_jam_keluar) < time_awal %}
                            <b class="terlambat"><?php echo date("H:m:s", strtotime($pres->jam_keluar)); ?></b>
                        {% else %}
                            <?php echo date("H:m:s", strtotime($pres->jam_keluar)); ?>
                        {% endif %}
                    <?php
                    }else{
                    echo "-"; } ?>
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