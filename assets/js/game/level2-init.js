$(document).ready(function() {
    // Initialize audio elements
    const correctSound = document.getElementById('correctSound');
    const wrongSound = document.getElementById('wrongSound');
    const applauseSound = document.getElementById('applauseSound');
    let verifyButtonTimeout;

    function initializeGameDisplay() {
        $('.punnett-table').hide();
        $('#verifyButton').prop('disabled', true);

        const initialProgress = $('.punnett-input.correct').length;
        const totalInputs = $('.punnett-input').length;
        updateProgress(initialProgress, totalInputs);

        if($('.gametes-input.correct').length === 8) {
            $('.punnett-table').show();
            $('#verifyButton').prop('disabled', false);
            $('#verifyGametes').prop('disabled', true);
            $('.gametes-input').prop('readonly', true);
        }
    }

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

    function updateProgress(correct, total) {
        const percentage = Math.round((correct / total) * 100);
        $('.progress-text').text(percentage + '%');
    }

    // Initialize game display
    initializeGameDisplay();

    // Export functions and variables
    window.gameInit = {
        correctSound,
        wrongSound,
        applauseSound,
        disableVerifyButton,
        updateProgress
    };
}); 