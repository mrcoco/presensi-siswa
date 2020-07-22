<tbody>
{% for item in arr %}
<tr>
    <td>{{ loop.index }}</td>
    <td>{{ item['nama'] }}</td>
    <td>{{ item['nisn'] }}</td>
    <td>{{ item['sex'] }}</td>
    <td>{{ item['izin'] }}</td>
    <td>{{ item['sakit'] }}</td>
    {% set alpha = jml_hari - (item['izin'] + item['sakit'] + item['hadir']) %}
    <td>{{ alpha }}</td>
    <td>{{ item['hadir'] }}</td>
    <td></td>
</tr>
{% endfor %}
</tbody>