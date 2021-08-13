<footer class="iq-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                </ul>
            </div>
            <div class="col-lg-6 text-right">
                <span class="mr-1">
                    Copyright
                    <script>
                        document.write(new Date().getFullYear())
                    </script>© <a href="index.html#" class="">Datum</a>
                    All Rights Reserved.
                </span>
            </div>
        </div>
    </div>
</footer>
<!-- Backend Bundle JavaScript -->
<!-- Backend Bundle JavaScript -->
<script src="{{ asset('public/backend/assets/js/backend-bundle.min.js') }} "></script>
<!-- Chart Custom JavaScript -->
<script src="{{ asset('public/backend/assets/js/customizer.js') }} ">
    < /sc>

    <
    script src = "{{ asset('public/backend/assets/js/sidebar.js') }} " >
</script>

<!-- Flextree Javascript-->
<script src="{{ asset('public/backend/assets/js/flex-tree.min.js') }} "></script>
<script src="{{ asset('public/backend/assets/js/tree.js') }} "></script>

<!-- Table Treeview JavaScript -->
<script src="{{ asset('public/backend/assets/js/table-treeview.js') }} "></script>

<!-- SweetAlert JavaScript -->
<script src="{{ asset('public/backend/assets/js/sweetalert.js') }} "></script>

<!-- Vectoe Map JavaScript -->
<script src="{{ asset('public/backend/assets/js/vector-map-custom.js') }} "></script>

<!-- Chart Custom JavaScript -->
<script src="{{ asset('public/backend/assets/js/chart-custom.js') }} "></script>
<script src="{{ asset('public/backend/assets/js/charts/01.js') }} "></script>
<script src="{{ asset('public/backend/assets/js/charts/02.js') }} "></script>

<!-- slider JavaScript -->
<script src="{{ asset('public/backend/assets/js/slider.js') }} "></script>


<!-- app JavaScript -->
<script src="{{ asset('public/backend/assets/js/app.js') }} "></script>

{{-- Sweet Alert --}}
<script src="{{ asset('public/js/sweetalert2.all.min.js') }}"></script>

{{-- ckeditor --}}
<script src="{{ asset('public/backend/assets/js/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('public/js/dropzone.js') }}"></script>

{{-- only Number --}}
<script>
    $('.onlyNumber').on('keypress', function(e) {
        if ($.isNumeric(e.key) == false) {
            e.preventDefault();
        }
    })
</script>


@yield('js')

</body>

</html>
