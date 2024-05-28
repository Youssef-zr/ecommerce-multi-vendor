<!--============================
      SCROLL BUTTON START
    ==============================-->
<div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
</div>
<!--============================
    SCROLL BUTTON  END
  ==============================-->


<!--jquery library js-->
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<!--bootstrap js-->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<!--font-awesome js-->
<script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
<!--select2 js-->
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<!--slick slider js-->
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<!--simplyCountdown js-->
<script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
<!--product zoomer js-->
<script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>
<!--nice-number js-->
<script src="{{ asset('frontend/js/jquery.nice-number.min.js') }}"></script>
<!--counter js-->
<script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
<!--add row js-->
<script src="{{ asset('frontend/js/add_row_custon.js') }}"></script>
<!--multiple-image-video js-->
<script src="{{ asset('frontend/js/multiple-image-video.js') }}"></script>
<!--sticky sidebar js-->
<script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
<!--price ranger js-->
<script src="{{ asset('frontend/js/ranger_jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/ranger_slider.js') }}"></script>
<!--isotope js-->
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<!--venobox js-->
<script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
<!--classycountdown js-->
<script src="{{ asset('frontend/js/jquery.classycountdown.js') }}"></script>
<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- sweet alert cdn -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--main/custom js-->
<script src="{{ asset('frontend/js/main.js') }}"></script>

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
                        type: 'DELETE',
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
