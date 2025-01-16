$(document).ready(function() {
    // Event handler untuk verifikasi jawaban
    $('#verifyButton').click(function() {
        let answers = {};
        $('.punnett-input').each(function() {
            let position = $(this).data('position');
            answers[position] = $(this).val();
        });

        gameInit.disableVerifyButton();

        $.ajax({
            url: BASE_URL + 'game/verify_answer',
            type: 'POST',
            data: {
                answers: answers,
                level: CURRENT_LEVEL
            },
            success: function(response) {
                response = JSON.parse(response);
                let allCorrect = response.success;
                
                $('.punnett-input').each(function() {
                    let position = $(this).data('position');
                    let value = $(this).val();
                    
                    if(response.incorrect.includes(position)) {
                        $(this).removeClass('correct').addClass('incorrect');
                        gameInit.wrongSound.play();
                    } else {
                        $(this).removeClass('incorrect').addClass('correct');
                        gameValidation.verifySingleAnswer(position, value);
                    }
                });

                if(allCorrect) {
                    gameInit.applauseSound.play();
                    $('#ratioForm').slideDown();
                    
                    $.ajax({
                        url: BASE_URL + 'game/save_progress',
                        type: 'POST',
                        data: {
                            level: CURRENT_LEVEL,
                            progress: 'punnett_complete'
                        }
                    });
                }
            }
        });
    });

    // Event handler untuk verifikasi gamet
    $('#verifyGametes').click(function() {
        gameValidation.validateGametes();
    });

    // Event handler untuk verifikasi rasio
    $('#verifyRatio').click(function() {
        $.ajax({
            url: BASE_URL + 'game/verify_ratio',
            type: 'POST',
            data: {
                ratio1: $('#ratio1').val(),
                ratio2: $('#ratio2').val(),
                ratio3: $('#ratio3').val(),
                ratio4: $('#ratio4').val(),
                level: CURRENT_LEVEL
            },
            success: function(response) {
                if(response.success) {
                    gameInit.applauseSound.play();
                    Swal.fire({
                        title: 'Selamat!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Lanjut ke Level Berikutnya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = BASE_URL + 'game/next_level';
                        }
                    });
                } else {
                    gameInit.wrongSound.play();
                    Swal.fire({
                        title: 'Oops!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            }
        });
    });

    // Event handler untuk input punnett
    $('.punnett-input').on('input', function() {
        if($(this).val().length === 4) {
            $(this).blur();
        }
    });

    // Event handler untuk input gamet
    $('.gametes-input').on('input', function() {
        if($(this).val().length === 2) {
            $(this).blur();
            let nextInput = $(this).next('.gametes-input');
            if(nextInput.length) {
                nextInput.focus();
            }
        }
    });
}); 