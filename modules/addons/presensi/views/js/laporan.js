var url_path = "/laporan/";
$('.date').datepicker({format: "yyyy-mm-dd",
});
$('.bulan').datepicker({
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months"});
$("#LaporanHarianForm").ajaxForm({
    url: '/search'+url_path+'harian',
    type: 'post',
    success: function(data) {
        $("#LaporanHarianResult").html(data);
    }
});

$("#LaporanBulananForm").ajaxForm({
    url: '/search'+url_path+'bulanan',
    type: 'post',
    success: function(data) {
        //const bl = bulanan(data);
        $("#LaporanBulananResult").html(data);
    }
});

$("#LaporanSemesterForm").ajaxForm({
    url: '/search'+url_path+'semester',
    type: 'post',
    success: function(data) {
        //const bl = bulanan(data);
        $("#LaporanSemesterResult").html(data);
    }
});