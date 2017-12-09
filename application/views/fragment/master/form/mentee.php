<!-- Registration form -->
<form action="index.php/mentee/save" method="post">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel registration-form">
                <div class="panel-heading">
                    <h5 class="panel-title">{fragment.title}</h5>
                    <div class="text-right">
                        <a type="button" href="index.php/master/mentee" class="btn bg-warning legitRipple">Cancel</a>
                        <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-floppy-disk"></i></b> Save</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group has-feedback">
                        <input name="nama" type="text" class="form-control" placeholder="Type Fullname">
                        <div class="form-control-feedback">
                            <i class="icon-user-plus text-muted"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <select id="cboSekolah" data-placeholder="Pilih asal sekolah ..." class="select">
                                    <option></option>
                                    {mentee.sekolah}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <select name="kelas" id="cboKelas" data-placeholder="Pilih kelas mentee ..." class="select">
                                    <option></option>
                                    {mentee.kelas}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <input name="telpon" type="text" class="form-control" placeholder="Telepon">
                                <div class="form-control-feedback">
                                    <i class="icon-phone2 text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <input name="email" type="email" class="form-control" placeholder="Email">
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <input name="line_acc" type="text" class="form-control" placeholder="LINE">
                                <div class="form-control-feedback">
                                    <i class="icon-mention text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <input name="ig_acc" type="text" class="form-control" placeholder="Instagram">
                                <div class="form-control-feedback">
                                    <i class="icon-mention text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /registration form -->

<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.select').select2();

        $("#cboSekolah").change(function () {
            $.ajax({
                method: "POST",
                url: "index.php/ajax/get-class-from-school/"+$("#cboSekolah").val(),
                dataType:'json'
            })
            .done(function( msg ) {
                var kelas = null;
                $("#cboKelas").empty();
                msg.forEach(function(kelas){
                  $("#cboKelas").append(new Option(kelas.tbmk_nama, kelas.tbmk_id));
                });
            });
        });
    })
</script>
