<tbody>

{% for pres in arr %}
        <?php $jammasuk = new DateTime($pres['jam_masuk']);
              $jamkeluar = new DateTime($pres['jam_keluar']);
              $jam_masuk = $jammasuk->format('H:m:s');
              $jam_keluar = $jamkeluar->format('H:m:s');?>
    <tr>
        <td>{{ loop.index }}</td>
        <td>{{ pres['nama'] }}</td>
        <td>{{ pres['nisn'] }}</td>
        <td>{{ pres['sex'] }}</td>
        <td>{{ pres['tanggal'] }}</td>
        <td>{{ pres['jam_masuk'] }}</td>
        <td>{{ pres['jam_keluar'] }}</td>
        <td><img src='{{ pres['foto_masuk'] }}' height='75px'></td>
        <td><img src='{{ pres['foto_keluar'] }}' height='75px'></td>
        {% switch pres['status'] %}
        {% case '3' %}
            <td>-</td>
            <td>I</td>
            <td>-</td>
            <td></td>
        {% break %}
        {% case '4' %}
            <td>-</td>
            <td>S</td>
            <td>-</td>
            <td></td>
        {% break %}
        {% default %}
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td></td>
        {% break %}
        {% endswitch %}
    </tr>
{% endfor %}
</tbody>