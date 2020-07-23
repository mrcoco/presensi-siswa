<thead >
<tr class="text-center">
    <th rowspan='2' class="text-center">NO</th>
    <th rowspan='2' class="text-center">NAMA</th>
    <th rowspan='2' class="text-center">NIS</th>
    <th rowspan='2' class="text-center">JK</th>
    <th rowspan="2" class="text-center">TANGGAL</th>
    {% for s in 1..5 %}
        <th rowspan="2" class="text-center">SESI {{ s }}</th>
    {% endfor %}
    <th colspan='3'>STATUS</th>
    <th rowspan='2' class="text-center">KET</th>
</tr>
<tr>
    <th>I</th>
    <th>S</th>
    <th>A</th>
</tr>
</thead>