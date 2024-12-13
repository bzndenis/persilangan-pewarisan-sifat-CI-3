        </div> <!-- Closing content div -->
        
        <!-- jQuery harus dimuat sebelum Bootstrap dan script lainnya -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/fontawesome.min.js"></script>

        <!-- Custom Scripts -->
        <script>
        $(document).ready(function() {
            // Inisialisasi tooltip Bootstrap
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Event untuk lihat penjelasan
            $('.lihat-penjelasan').click(function() {
                var soalId = $(this).data('soal-id');
                var penjelasanDiv = $('#penjelasan_' + soalId);
                var button = $(this);
                
                if(penjelasanDiv.is(':hidden')) {
                    $('.penjelasan').slideUp();
                    penjelasanDiv.slideDown();
                    button.html('<i class="fas fa-times me-2"></i>Sembunyikan Penjelasan')
                         .removeClass('btn-primary').addClass('btn-danger');
                } else {
                    penjelasanDiv.slideUp();
                    button.html('<i class="fas fa-lightbulb me-2"></i>Lihat Penjelasan')
                         .removeClass('btn-danger').addClass('btn-primary');
                }
            });

            // Event untuk navigasi
            $('#nextBtn').click(function() {
                window.location.href = '<?= base_url("contohsoal/step/2") ?>';
            });

            $('#prevBtn').click(function() {
                window.location.href = '<?= base_url("contohsoal/step/1") ?>';
            });
        });
        </script>
    </body>
</html> 