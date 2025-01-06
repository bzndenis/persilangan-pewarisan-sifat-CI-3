$(document).ready(function() {
    // Inisialisasi audio elements
    const correctSound = document.getElementById('correctSound');
    const wrongSound = document.getElementById('wrongSound');
    const applauseSound = document.getElementById('applauseSound');
    let verifyButtonTimeout;

    // Inisialisasi tampilan awal
    function initializeGameDisplay() {
        // Sembunyikan tabel Punnett dan disable tombol verifikasi awal
        $('.punnett-table').hide();
        $('#verifyButton').prop('disabled', true);

        // Inisialisasi progress
        const initialProgress = $('.punnett-input.correct').length;
        const totalInputs = $('.punnett-input').length;
        gameProgress.updateProgress(initialProgress, totalInputs);

        // Cek dan inisialisasi data gamet tersimpan
        if($('.gametes-input.correct').length === 8) {
            $('.punnett-table').show();
            $('#verifyButton').prop('disabled', false);
            $('#verifyGametes').prop('disabled', true);
            $('.gametes-input').prop('readonly', true);
        }
    }

    // Fungsi untuk menonaktifkan tombol verifikasi
    function disableVerifyButton() {
        $('#verifyButton').prop('disabled', true);
        let countdown = 15;
        
        verifyButtonTimeout = setInterval(function() {
            $('#verifyButton').html(`<i class="fas fa-clock me-2"></i>Tunggu ${countdown} detik`);
            countdown--;
            
            if(countdown < 0) {
                clearInterval(verifyButtonTimeout);
                $('#verifyButton').prop('disabled', false)
                    .html('<i class="fas fa-check me-2"></i>Verifikasi Jawaban');
            }
        }, 1000);
    }

    // Event handlers untuk tombol
    $('.verify-btn').hover(
        function() {
            $(this).find('.verify-btn-bg').css('opacity', '0.9');
        },
        function() {
            $(this).find('.verify-btn-bg').css('opacity', '1');
        }
    );

    // Export fungsi yang dibutuhkan
    window.gameInit = {
        disableVerifyButton: disableVerifyButton,
        correctSound: correctSound,
        wrongSound: wrongSound,
        applauseSound: applauseSound
    };

    // Jalankan inisialisasi
    initializeGameDisplay();
}); 