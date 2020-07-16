<tbody>
{%  for i,wk in work %}

    <tr>
        <td>{{ loop.index }}</td>
        <td>{{ arr['nama'] }}</td>
        <td>{{ arr['nisn'] }}</td>
        <td>{{ arr['sex'] }}</td>
        <td>{{ wk }}</td>
        {% for pres in arr['presensi'] %}
            {% if( pres.tanggal == wk ) %}
                <?php $jammasuk = new DateTime($pres->jam_masuk);
                      $jamkeluar = new DateTime($pres->jam_keluar);
                      $jam_masuk = $jammasuk->format('H:m:s');
                      $jam_keluar = $jamkeluar->format('H:m:s');?>
                <td>{{ jam_masuk }}</td>
                <td>{{ jam_keluar }}</td>
                <td><img src='/upload/presensi/{{ pres.foto_masuk }}' height='75px'></td>
                <td><img src='/upload/presensi/{{ pres.foto_keluar }}' height='75px'></td>
                {% if(pres.status == '3') %}
                    <td>I</td>
                {% else %}
                    <td>-</td>
                {% endif %}
                {% if(pres.status == '3') %}
                    <td>I</td>
                {% else %}
                    <td>-</td>
                {% endif %}
                <td>-</td>
            {% else %}
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>-</td>
                <td>-</td>
                <td>A</td>
            {% endif %}
            <td></td>
        {% endfor %}
    </tr>

{%  endfor %}
</tbody>