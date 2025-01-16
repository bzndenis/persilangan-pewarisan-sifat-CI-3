$(document).ready(function() {
    // Tambahkan validasi khusus untuk level 2
    function validateLevel2Input(input) {
        let value = input.val().toUpperCase();
        // Sesuaikan regex dengan pola yang diinginkan untuk level 2
        if(/^[BbKk]{4}$/.test(value)) {
            input.removeClass('invalid');
            $('#verifyButton').prop('disabled', false);
        } else {
            input.addClass('invalid');
            $('#verifyButton').prop('disabled', true);
        }
    }

    // Override event handler untuk input di level 2
    $('.punnett-input').on('input', function() {
        validateLevel2Input($(this));
    });

    // Tambahkan animasi feedback
    function showFeedback(element, isCorrect) {
        element.addClass('shake');
        setTimeout(() => {
            element.removeClass('shake');
        }, 500);
        
        if(isCorrect) {
            playCorrectSound();
        } else {
            playWrongSound();
        }
    }

    // Update fungsi verifikasi untuk level 2
    $('#verifyButton').click(function() {
        let answers = {};
        $('.punnett-input').each(function() {
            let position = $(this).data('position');
            answers[position] = $(this).val().toUpperCase();
        });

        $(this).prop('disabled', true);

        $.ajax({
            url: BASE_URL + 'game/verify_answer',
            type: 'POST',
            data: {
                answers: answers,
                level: CURRENT_LEVEL
            },
            success: function(response) {
                response = JSON.parse(response);
                handleLevel2Response(response);
            }
        });
    });

    function handleLevel2Response(response) {
        if(response.success) {
            showSuccessMessage();
            setTimeout(() => {
                window.location.href = BASE_URL + 'game/next_level';
            }, 2000);
        } else {
            $('#verifyButton').prop('disabled', false);
            showErrorMessage();
        }
    }
}); 