<!-- General JS Scripts -->
<script src="{{ url('backend/assets/modules/jquery.min.js') }}"></script>
<script src="{{ url('backend/assets/modules/popper.js') }}"></script>
<script src="{{ url('backend/assets/modules/tooltip.js') }}"></script>
<script src="{{ url('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ url('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ url('backend/assets/modules/moment.min.js') }}"></script>
<script src="{{ url('backend/assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ url('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ url('backend/assets/modules/chart.min.js') }}"></script>
<script src="{{ url('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ url('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ url('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ url('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ url('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ url('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- datatables -->
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>

<!-- sweet alert cdn -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Page Specific JS File -->
<script src="{{ url('backend/assets/js/custom.js') }}"></script>
<script src="{{ url('backend/assets/js/page/index-0.js') }}"></script>

<!-- Template JS File -->
<script src="{{ url('backend/assets/js/scripts.js') }}"></script>

<!-- custom file script -->
@stack('js')

<!--  Set an error toast, with a title -->
@if ($errors->any())
    @foreach ($errors->all() as $error)
        @php
            toastr()->error($error, 'Oops!');
        @endphp
    @endforeach
@endif

<!-- dynamic delete -->
<script>
    $(() => {

        $("body").on('click', '.delete-btn', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url,
                        type: 'delete',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Set the CSRF token in the request headers
                        },
                        success(response, status, xhr) {
                            if (xhr.status >= 200 && xhr.status < 300 && response
                                .success == 'ok') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });

                                window.location.reload();

                            } else if (response.status == 'error') {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status == 409) {
                                error = xhr.responseJSON.msg;
                            }

                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: error,
                                // footer: 'Conflict'
                            });
                        }
                    })

                }
            });
        })
    })
</script>
</body>

</html>
