<!-- jQuery -->
<script src="{{ url('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ url('backend/dist/script/jquery.dataTables.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('backend/dist/js/demo.js') }}"></script>
<!-- Select2 -->
<script src="{{ url('backend/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- page script -->
{{-- <script>
    // $(function () {
    //     //Initialize Select2 Elements
    //     $('.select2').select2()

    //     //Initialize Select2 Elements
    //     $('.select2bs4').select2({
    //         theme: 'bootstrap4'
    //     })
    //     // $("#example1").DataTable({
    //     //     "responsive": true,
    //     //     "autoWidth": false,
    //     // });
    //     // $('#example2').DataTable({
    //     //     "paging": true,
    //     //     "lengthChange": false,
    //     //     "searching": false,
    //     //     "ordering": true,
    //     //     "info": true,
    //     //     "autoWidth": false,
    //     //     "responsive": true,
    //     // });
    //     //DTTBSS

    //     $(document).ready( function () {
    //     $('#myTable').DataTable();
    // } );
    // });
    <script> --}}
{{-- <script rel="stylesheet" href="cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        //get data from datatables
        var table = $('masterStaff-datatables').DataTable({
            // processing: true,
            // serverSide: true,
            processing: true,
            serverSide: true,
            deferRender: true,
            responsive: true,
            ajax: {
                url: "{{ route('get_masterstaff_datatables') }}",
            },
            // order: [
            // [0, 'desc']
            // ],
            // responsive: true,
            language: {
                // <i class="fa-duotone fa-spinner-third"></i>
                // <i class="fa-regular fa-loader"></i>
                processing: '<i class="fa fa-duotone fa-spinner fa-spin fa-4x"></i> Loading...' // menampilkan spinner berupa ikon
                // FontAwesome
            },
            columns: [{
                    data: 'name',
                    name: 'Name',
                    className: "text-center",
                },
                {
                    data: 'Ktp',
                    name: 'Ktp',
                    className: "text-left",
                },
                {
                    data: 'birthdate',
                    name: 'Birth',
                    className: "text-center",
                },

            ]
        });

    });
</script> --}}

{{-- </script> --}}
