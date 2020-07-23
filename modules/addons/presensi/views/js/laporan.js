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
    beforeSubmit: function() {
        $("#submit").html("<div class=\"sk-chase\">\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                        </div>");
    },
    success: function(data) {
        $("#LaporanHarianResult").html(data);
        $("#submit").html("<i class=\"fa fa-search\"></i>  Submit");
    }
});

$("#LaporanBulananForm").ajaxForm({
    url: '/search'+url_path+'bulanan',
    type: 'post',
    beforeSubmit: function() {
        $("#submit").html("<div class=\"sk-chase\">\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                        </div>");
    },
    success: function(data) {
        //const bl = bulanan(data);
        $("#LaporanBulananResult").html(data);
        $("#submit").html("<i class=\"fa fa-search\"></i>  Submit");
    }
});

$("#LaporanSemesterForm").ajaxForm({
    url: '/search'+url_path+'semester',
    type: 'post',
    beforeSubmit: function() {
        $("#submit").html("<div class=\"sk-chase\">\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                            <div class=\"sk-chase-dot\"></div>\n" +
            "                        </div>");
    },
    success: function(data) {
        //const bl = bulanan(data);
        $("#LaporanSemesterResult").html(data);
        $("#submit").html("<i class=\"fa fa-search\"></i>  Submit");
    }
});