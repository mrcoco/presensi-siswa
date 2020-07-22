<thead >
<tr class="text-center">
    <th rowspan='2' valign='top'>NO</th>
    <th rowspan='2' valign='top'>NAMA</th>
    <th rowspan='2' valign='top'>NIS</th>
    <th rowspan='2' valign='top'>JK</th>
    <th rowspan="2" class="text-center">TANGGAL</th>
    {% for s in 1..5 %}
        <th rowspan="2" class="text-center">SESI {{ s }}</th>
    {% endfor %}
    <th colspan='3'>JUMLAH</th>
    <th rowspan='2' valign='top'>KET</th>
</tr>
<tr>
    <th rowspan='2'>I</th>
    <th rowspan='2'>S</th>
    <th rowspan='2'>A</th>
</tr>
</thead>