<html>
<head>
    <link rel="stylesheet" href="{{ url("themes/admin/") }}assets/css/vendor.css">
    <style>
        .terlambat {
            color: rgb(255, 0, 0); /* red */
        }
        .table-bordered>tbody>tr>td,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>td,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border: 1px solid #999 !important;
        }
        .list_auto {
            margin-top: 0;
            margin-bottom: 0;
            padding-left: 15px;
        }
        .table th {
            text-align: center !important;
        }
        .table > tbody > tr > td {
            border-top: none;
        }
        .imgg {
            width: 100px;
            float: left;
        }
        .kop-header,
        .kop-subheader,
        p {
            margin-left: 120px;
        }
        .kop-subheader {
            margin-top: 10px;
            margin-bottom: 0px;
        }
        .kop-header {
            margin-bottom: 0px;
            margin-top: 0px;
        }
        #result .hrr {
            border-bottom: 1px solid #999;
            height: 1px;
            clear: both;
            margin: 20px 0 19px 0;
        }
        .cont{
            padding-right:20px;
            padding-left:20px;
            margin-right:auto;
            margin-left:auto
        }
    </style>
</head>
<body>

<div id="result" class="container">
    <div class="row">
        <div class="col-md-12">
            <img src="{{ url('themes/frontend/images/sma.png') }}" class="imgg">
            <h4 class="kop-subheader">PEMERINTAH KABUPATEN BANTUL</h4>
            <h4 class="kop-subheader">DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA</h4>
            <h3 class="kop-header">SMA NEGERI 2 BANTUL</h3>
            <p style="margin-bottom: 0px;">
                Alamat : Jl RA Kartini, Trirenggo, Bantul 55714, Yogyakarta<br>
                Telp. 0274 367 309<br>
            </p>
        </div>
    </div>
    <div class="hrr"></div>
    <div class="row">
        <div class="col-md-12">
            <table id="presensi-bulanan" class="table-bordered table-condensed">
            <thead>
            <tr>
                <th rowspan='2' valign='top'>NAMA</th>
                <th rowspan='2' valign='top'>NIS</th>
                <th rowspan='2' valign='top'>JK</th>
                <th colspan='2'>Tanggal: {{ tanggal }}</th>
                <th colspan='3'>JUMLAH</th>
                <th rowspan='2' valign='top'>KET</th>
            </tr>
            <tr>
                <th valign='top'>Jam Datang</th>
                <th valign='top'>Jam Pulang</th>
                <th>I</th>
                <th>S</th>
                <th>A</th>
            </tr>
            </thead>
            <tbody>
            {% for item in arr %}
                <tr>
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
                            <td>
                                <?php echo date("H:m:s", strtotime($pres->jam_masuk)) ?>
                            </td>
                            <td>
                                <?php echo date("H:m:s", strtotime($pres->jam_keluar)) ?>
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
        </table>
        </div>
    </div>
</div>