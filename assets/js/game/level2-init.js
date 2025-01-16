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

    function loadSavedAnswers() {
        $.ajax({
            url: BASE_URL + 'game/get_saved_answers',
            type: 'POST',
            data: {
                level: CURRENT_LEVEL
            },
            success: function(response) {
                response = JSON.parse(response);
                if(response.success && response.saved_answers) {
                    Object.keys(response.saved_answers).forEach(position => {
                        const answer = response.saved_answers[position];
                        $(`[data-position="${position}"]`)
                            .val(answer)
                            .addClass('correct')
                            .prop('readonly', true);
                    });
                    
                    // Cek apakah semua jawaban sudah benar
                    const allAnswered = $('.punnett-input.correct').length === $('.punnett-input').length;
                    if(allAnswered) {
                        $('#ratioForm').slideDown();
                    }
                }
            }
        });
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

    loadSavedAnswers();
}); 