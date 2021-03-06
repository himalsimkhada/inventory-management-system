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

<!-- Sweet Alert -->
<script src="{{ asset('public/js/sweetalert2.all.min.js') }}"></script>

<!-- ckeditor -->
<script src="{{ asset('public/backend/assets/js/ckeditor/ckeditor.js') }}"></script>

<!-- dropzone -->
<script src="{{ asset('public/js/dropzone.js') }}"></script>

<!-- datatable button -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<!-- only Number -->
<script>
    $(document).on('keypress', '.onlyNumber', function(e) {
        if ($.isNumeric(e.key) == false) {
            e.preventDefault();
        }
    });

    $(document).on('change', 'decimals2', function(){
        $(this).val(Number($(this).val()).toFixed(2));
    });
</script>


@yield('js')

</body>

</html>
