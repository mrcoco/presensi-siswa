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
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
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
</div>
<div id="result" class="cont">
    <div class="row">

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
                    <th colspan='{{ count_work }}'>TANGGAL</th>
                    <th colspan='3'>JUMLAH</th>
                    <th rowspan='2' valign='top'>KET</th>
                </tr>
                <tr>
                    {% for k,item in work %}
                        <?php list($y,$m,$d) = explode("-",$item); ?>
                        <th>{{ d }}</th>
                    {% endfor %}
                    <th rowspan='2'>I</th>
                    <th rowspan='2'>S</th>
                    <th rowspan='2'>A</th>
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
                        {% for k,wk in work %}

                            <td>
                                {% for pres in item['presensi'] %}
                                    {% if pres.tanggal == wk %}
                                        {% if pres.status == '1' OR pres.status =='2' %}
                                            <?php list($tg,$jam_masuk) = explode(" ",$pres->jam_masuk); ?>
                                            <?php
                        date_default_timezone_set('Asia/Jakarta');
                        if (isset($pres->jam_keluar)){
                                            list($tg,$jam_keluar) = explode(" ",$pres->jam_keluar);
                                            $time_jam_keluar = new DateTime($pres->jam_keluar);
                                            }else{
                                            $jam_keluar = '00:00:00';
                                            $time_jam_keluar = new DateTime($pres->tanggal." ".$jam_keluar);
                                            }
                                            $time_jam_masuk = new DateTime($pres->jam_masuk);

                                            $time_terlambat = new DateTime($pres->tanggal." ".$terlambat);
                                            if(date('l',strtotime($pres->tanggal)) == 'Friday'){
                                            $time_awal = new DateTime($pres->tanggal." ".$pulangawal_jumat);
                                            }else{
                                            $time_awal = new DateTime($pres->tanggal." ".$pulangawal_normal);
                                            }
                                            ?>
                                            {% if(time_jam_masuk) > time_terlambat %}
                                                <b class="terlambat">{{ jam_masuk }}</b>
                                            {% else %}
                                                {{ jam_masuk }}
                                            {% endif %}
                                            <br>
                                            {% if(time_jam_keluar) < time_awal %}
                                                <b class="terlambat">{{ jam_keluar }}</b>
                                            {% else %}
                                                {{ jam_keluar }}
                                            {% endif %}

                                        {% endif %}

                                        {% if pres.status == '3' %}
                                            I
                                            {% set izin +=1 %}
                                        {% endif %}

                                        {% if pres.status == '4' %}
                                            S
                                            {% set sakit +=1 %}
                                        {% endif %}
                                        {% set hadir +=1 %}
                                    {% endif %}

                                {% endfor %}
                            </td>
                        {% endfor %}

                        <td>{{ izin }}</td>
                        <td>{{ sakit }}</td>
                        <td>{{ count_work - hadir }}</td>
                        <td></td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>