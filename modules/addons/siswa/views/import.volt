<div class="col-md-12 col-sm-12">
    <div class="box">
        <header class="bg-alizarin text-white">
            <h4>Import Data Siswa</h4>
            <!-- begin box-tools -->
            <div class="box-tools">
                <a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
                <a class="fa fa-fw fa-square-o" href="#" data-fullscreen="box"></a>
                <a class="fa fa-fw fa-refresh" href="#" data-box="refresh"></a>
                <a class="fa fa-fw fa-times" href="#" data-box="close"></a>
            </div>
            <!-- END: box-tools -->
        </header>
        <div class="box-body collapse in">
            {{ content() }}
            <form id="importForm" class="form-inline" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                    <input type="file" class="form-control" name="myfile" id="myfile" >
                </div>
                <div class="form-group" >
                        <button type="submit" name="import" class="btn btn-primary" id="import"><i class="fa fa-upload"></i>  Import </button>
                </div>
                <div class="form-group" >
                    <a class="btn btn-primary" href="{{ url("/upload/siswa/") }}data.xlsx"><i class="fa fa-download"></i>  format excel</a>
                </div>
            </form>
        </div>
    </div>
</div>