<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

@livewireScripts


<!-- Bootstrap 4 -->
{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" ></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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