<!-- Toolbar -->
<div class="navbar navbar-default navbar-component navbar-xs">
    <ul class="nav navbar-nav visible-xs-block">
        <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-filter">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#schedule" data-toggle="tab"><i class="icon-home2 position-left"></i> General</a></li>
            <li><a href="#settings" data-toggle="tab"><i class="icon-grid position-left"></i> Classes</a></li>
        </ul>
    </div>
</div>
<!-- /toolbar -->

<div class="tabbable">
    <div class="tab-content">
        <div class="tab-pane active" id="schedule">
            <!-- Available hours -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Lokasi Sekolah</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <iframe id="mapInfo" style="width: 100%;height: 30em;" src="{detail.location}"></iframe>
                </div>
            </div>
            <!-- /available hours -->
        </div>

        <div class="tab-pane fade" id="settings">
            <!-- Profile info -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Informasi Kelas</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table datatable-basic">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Jenis</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diupdate</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {detail.kelas}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /profile info -->
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

<script>
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 4 ]
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    // Basic datatable
    $('.datatable-basic').DataTable();

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');
    
    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: '75px'
    });
</script>