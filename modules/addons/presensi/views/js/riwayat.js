var url_path ="/riwayat/"

$('.date').datepicker({format: "yyyy-mm-dd",
});
$('.bulan').datepicker({
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months"});

$("#RiwayatHarianForm").ajaxForm({
    url: '/search'+url_path+'harian',
    type: 'post',
    success: function(data) {
        $("#RiwayatHarianResult").html(data);
    }
});

$("#RiwayatBulananForm").ajaxForm({
    url: '/search'+url_path+'bulanan',
    type: 'post',
    success: function(data) {
        //const bl = bulanan(data);
        $("#RiwayatBulananResult").html(data);
    }
});