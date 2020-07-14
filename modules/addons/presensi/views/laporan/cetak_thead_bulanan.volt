<thead >
<tr class="text-center">
    <th rowspan='2' valign='top'>NO</th>
    <th rowspan='2' valign='top'>NAMA</th>
    <th rowspan='2' valign='top'>NIS</th>
    <th rowspan='2' valign='top'>JK</th>
    <th colspan='{{ count_work }}' class="text-center">TANGGAL</th>
    <th colspan='3'>JUMLAH</th>
    <th rowspan='2' valign='top'>KET</th>
</tr>
<tr>
    {% for k,item in work %}
        <?php $d = date('M d',strtotime($item)); ?>
        <th>{{ d }}</th>
    {% endfor %}
    <th rowspan='2'>I</th>
    <th rowspan='2'>S</th>
    <th rowspan='2'>A</th>
</tr>
</thead>