<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

{{--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script>

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        $('#example').DataTable({
            "paging": false,
            "responsive": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "pageLength": 7,
            "autoWidth": false,
        });
    });
</script>