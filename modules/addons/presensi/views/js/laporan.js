var url_path = "/laporan/";
$('.date').datepicker({format: "yyyy-mm-dd",
});
$('.bulan').datepicker({
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months"});
$("#LaporanHarianForm").ajaxForm({
    url: url_path+'search/harian',
    type: 'post',
    success: function(data) {
        $("#LaporanHarianResult").html(data);
    }
});

$("#LaporanBulananForm").ajaxForm({
    url: url_path+'search/bulanan',
    type: 'post',
    success: function(data) {
        //const bl = bulanan(data);
        $("#LaporanBulananResult").html(data);
    }
});

function bulanan(data) {
    var html ="<table id=\"grid-izin-presensi\" class=\"table table-condensed table-hover table-striped\">\n" +
        "            <thead>\n" +
        "            <tr>\n" +
        "                <th data-column-id=\"no\" data-type=\"numeric\" data-width=\"5%\" data-sortable=\"false\">no</th>\n" +
        "                <th data-column-id=\"siswa_nama\" data-sortable=\"false\">siswa</th>\n" +
        "                <th data-column-id=\"nisn\" data-sortable=\"false\">Nisn</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"tanggal\" data-sortable=\"false\">Tanggal</th>\n" +
        "                <th data-column-id=\"sesi\" data-formatter=\"sesi\" data-sortable=\"false\">Sesi</th>\n" +
        "                <th data-column-id=\"status\" data-formatter=\"status\" data-sortable=\"false\">Status</th>\n" +
        "                <th data-column-id=\"commands\" data-formatter=\"commands\" data-sortable=\"false\">Action</th>\n" +
        "            </tr>\n" +
        "            </thead>\n" +
        "        </table>";
    return html;

}