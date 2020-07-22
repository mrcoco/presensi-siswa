<tbody>
{% for pres in presensi %}
    {% set sesi = [1,2,3,4,5] %}
    {% set arr_sesi = [] %}
    {% set izin = "-" %}
    {% set sakit= "-" %}
    {% set alpha= "A" %}
    <tr>
        <td>{{ loop.index }}</td>
        <td>{{ pres['nama'] }}</td>
        <td>{{ pres['nisn'] }}</td>
        <td>{{ pres['sex'] }}</td>
        <td>{{ pres['tanggal'] }}</td>
        {% for s_in,s_val in pres['sesi'] %}
            <?php
            if(isset($pres['status']))
            {
                if($pres['status'] == "1")
                {
                    if($s_val !== "")
                    {
                        $arr_sesi[] = $s_in;
                    }

                }
            }

            ?>
            <td>{{ s_val }}</td>
        {% endfor %}
        {% if pres['status'] is defined %}
            {% switch(pres['status']) %}
            {% case '1' %}
                {% set izin = "-" %}
                {% set sakit= "-" %}
                {% set alpha= "-" %}
            {% break %}
            {% case '3' %}
                {% set izin = "I" %}
                {% set sakit= "-" %}
                {% set alpha= "-" %}
            {% break %}
            {% case '4' %}
                {% set izin = "-" %}
                {% set sakit= "S" %}
                {% set alpha= "-" %}
            {% break %}
            {% default %}
                {% set izin = "-" %}
                {% set sakit= "-" %}
                {% set alpha= "A" %}
            {% break %}
            {% endswitch %}
        {% endif %}
        <td>{{ izin }}</td>
        <td>{{ sakit }}</td>
        <td>{{ alpha }}</td>
        <?php
        $diff = array_diff($sesi,$arr_sesi);

            if(count($diff) !== 5){
                $kt = implode(",",$diff);
                $ket = "Tidak ikut sesi ".$kt;
            }else{
                $ket = "";
            }
        ?>
        <td>{{ ket }}</td>
    </tr>
{% endfor %}
</tbody>