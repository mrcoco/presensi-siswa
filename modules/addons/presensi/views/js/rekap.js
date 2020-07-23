var url_path ="/presensi/"
$('input[name="siswa_nama"]').autoComplete({
    source: function(term, response){
        $.getJSON('/siswa/search/',{q:term}, function(data){ response(data); });
    },
    renderItem: function (item, search){
        return '<div class="autocomplete-suggestion" data-nisn="'+item.nisn+'" data-kelas="'+item.kelas+'" data-siswa="'+item.id+'" data-val="' + item.name + '">'+item.nama+ '</div>';
    },
    onSelect: function(e, term, item){
        $("#siswa_id").val(item.data('siswa'));
        $("#siswa_nisn").val(item.data("nisn"));
        $("#siswa_kelas").val(item.data("kelas"));

    }
});

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