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
        {% set arr_libur= search_arr(libur,'tanggal',pres['tanggal']) %}
        {% if arr_libur %}
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>{{ arr_libur['keterangan'] }}</td>
        {% else %}
            {% switch pres['status'] %}
            {% case '1' %}
                <td>-</td>
                <td>-</td>
                <td>-</td>
            {% break %}
            {% case '2' %}
                <td>-</td>
                <td>-</td>
                <td>-</td>
            {% break %}
            {% case '3' %}
                <td>-</td>
                <td>I</td>
                <td>-</td>
            {% break %}
            {% case '4' %}
                <td>-</td>
                <td>S</td>
                <td>-</td>
            {% break %}
            {% default %}
                <td>-</td>
                <td>-</td>
                <td>A</td>
            {% break %}
            {% endswitch %}
            <td></td>
        {% endif %}
    </tr>
{% endfor %}
</tbody>