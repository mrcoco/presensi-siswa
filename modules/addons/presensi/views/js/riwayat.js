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
        $("#RiwayatHarianResult").html(data);
        $("#submit").html("<i class=\"fa fa-search\"></i>  Submit");
    }
});

$("#RiwayatBulananForm").ajaxForm({
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
        $("#RiwayatBulananResult").html(data);
        $("#submit").html("<i class=\"fa fa-search\"></i>  Submit");
    }
});