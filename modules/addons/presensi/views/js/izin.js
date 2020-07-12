$(document).ready(function(){
    var url_path = "/presensi/izin/";
    var presensi_grid = $("#grid-izin-presensi").bootgrid({
        ajax: true,
        url: url_path+"list",
        selection: true,
        multiSelect: true,
        templates: {
            header:"<div id=\"{{ctx.id}}\" class=\"{{css.header}}\"><div class=\"row\"><div class=\"col-sm-6 actionBar\"><div class=\"{{css.search}}\"></div></div><div class=\"col-sm-6\"><div class=\"{{css.actions}}\"></div> <div class='btn btn-primary' id='create' class='command-add'> <span class=\"fa fa-plus-square-o\"></span> New Izin</div></div></div></div>",
        },
        formatters: {
            "sesi": function(column, row)
            {
                switch(row.sesi) {
                    case '1':
                        var res = "Sesi 1";
                        break;
                    case '2':
                        var res = "Sesi 2";
                        break;
                    case '3':
                        var res = "Sesi 3";
                        break;
                    case '4':
                        var res = "Sesi 4";
                        break;
                    case '5':
                        var res = "Sesi 5";
                        break;
                    default:
                        var res = "datang - pulang";
                }
                return res;
            },
            "status": function(column, row)
            {
                switch(row.status) {
                    case '3':
                        var res = "Izin";
                        break;
                    case '4':
                        var res = "Sakit";
                        break;
                    default:
                        var res = "-";
                }
                return res;
            },
            "commands": function(column, row)
            {
                return "<button type=\"button\" class=\"btn btn-sm btn-primary command-edit\" data-row-title=\""+row.title+"\" data-row-category=\""+row.category+"\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-sm btn-primary command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
            }
        }
    }).on("loaded.rs.jquery.bootgrid", function()
    {
        $(this).find(".command-edit").off();
        $(this).find(".command-delete").off();
        $(this).find(".command-add").off();

        $(this).find(".command-edit").on("click", function(e)
        {
            myForm('edit',$(this));
            $("#myForm").ajaxForm({
                url: url_path+'edit',
                type: 'post',
                success: function(data) {
                    myAlert(data);
                    $("#grid-presensi").bootgrid("reload");
                    setTimeout(function(){
                        $('#myModal').modal('hide')
                    }, 10000);
                }
            });

        }).end().find(".command-delete").on("click", function(e)
        {
            $.get( url_path+"delete/"+ $(this).data("row-id"), function( data ) {
                //myAlert(data);
                toastr.success(data.msg, data.title);
                toastr.options.timeOut = 15;
                toastr.options.extendedTimeOut = 30;
                $("#grid-presensi").bootgrid("reload");
            });

        });

        $("#create").on("click",function(e)
        {
            myForm('create',e);
            $("#myForm").ajaxForm({
                url: url_path+'create',
                type: 'post',
                success: function(data) {
                    myAlert(data);
                    presensi_grid.bootgrid("reload");
                    setTimeout(function(){
                        $('#mypresensi').modal('hide');
                    }, 10000);
                }
            });
        });
    });


    function myForm(status,e) {
        $('#myForm')[0].reset();
        if(status == 'edit') {

            $('#mypresensi .modal-title').html('Edit presensi '+e.data("row-id"));
            $.getJSON(url_path+"get/?id=" + e.data("row-id"), function (data) {
                $('#hidden_id').val(data.id);
                $('#siswa_id').val(data.siswa_id);
                $('#siswa_nama').val(data.siswa_nama);
                $('#nisn').val(data.nisn);
                $('#kelas').val(data.kelas);
                $('#tanggal').val(data.tanggal);
                //$('#sesi').val(data.sesi).change();
                $('#sesi option').each(function() {
                    if($(this).val() == data.sesi) {
                        $(this).prop("selected", true);
                    }
                });
	
            });
        }else{
            $('#mypresensi .modal-title').html('Create New presensi ');
            
        }

        $('#mypresensi').modal('show');

    }

    function myAlert(e)
    {
        var mesg= [];
        mesg["alert"] = e.alert;
        mesg["title"] = e.msg;
        mesg["msg"] = "#presensi "+e._id+" "+e.msg;
        notif_show(mesg);
    }

    $('.date').mask('0000-00-00');
    $('.date_time').mask('0000-00-00 00:00:00');

    $('input[name="siswa_nama"]').autoComplete({
        source: function(term, response){
            $.getJSON('/siswa/search/',{q:term}, function(data){ response(data); });
        },
        renderItem: function (item, search){
            return '<div class="autocomplete-suggestion" data-nisn="'+item.nisn+'" data-kelas="'+item.kelas+'" data-siswa="'+item.id+'" data-val="' + item.name + '">'+item.nama+ '</div>';
        },
        onSelect: function(e, term, item){
            $("#siswa_id").val(item.data('siswa'));
            $("#nisn").val(item.data("nisn"));
            $("#kelas").val(item.data("kelas"));

        }
    });


});