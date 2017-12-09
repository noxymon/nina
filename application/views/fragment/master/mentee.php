<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">List {fragment.title}</h5>
        <div class="heading-elements">
            <a href="index.php/master/mentee/form" type="button" class="btn btn-danger btn-raised btn-sm legitRipple">
                <i class="icon-plus3 position-left"></i> Add New
            </a>
        </div>
    </div>

    <table class="table datatable-basic">
        <thead>
            <tr>
                <th>Nama Anggota</th>
                <th>Tanggal Daftar</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {data.content}
        </tbody>
    </table>
</div>
<!-- /basic datatable -->

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

    $(document).ready(function() {
        {hook.finishload}
    });
</script>