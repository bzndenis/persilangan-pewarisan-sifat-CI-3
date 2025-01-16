$(document).ready(function() {
    function verifySingleAnswer(position, answer) {
        $.ajax({
            url: BASE_URL + 'game/verify_single_answer',
            type: 'POST',
            data: {
                position: position,
                answer: answer,
                level: CURRENT_LEVEL
            },
            success: function(response) {
                if(response.correct) {
                    $.ajax({
                        url: BASE_URL + 'game/save_correct_answer',
                        type: 'POST',
                        data: {
                            position: position,
                            answer: answer,
                            level: CURRENT_LEVEL
                        }
                    });
                }
            }
        });
    }

    function validateGametes() {
        const gamete1Values = [];
        const gamete2Values = [];
        let allCorrect = true;

        // Collect gamete values
        for(let i = 1; i <= 4; i++) {
            const gamete1 = $('#gamete1_' + i).val().toUpperCase();
            const gamete2 = $('#gamete2_' + i).val().toUpperCase();
            
            if(gamete1) gamete1Values.push(gamete1);
            if(gamete2) gamete2Values.push(gamete2);
        }

        // Validate gametes
        const correctGametes = ['RT', 'Rt', 'rT', 'rt'];
        
        // Check if all required gametes are present
        allCorrect = correctGametes.every(g => 
            gamete1Values.includes(g) && gamete2Values.includes(g)
        );

        if(allCorrect) {
            gameInit.correctSound.play();
            
            // Save gametes
            $.ajax({
                url: BASE_URL + 'game/save_gametes',
                type: 'POST',
                data: {
                    level: CURRENT_LEVEL,
                    gamete1: gamete1Values,
                    gamete2: gamete2Values
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if(response.success) {
                        // Set readonly on correct inputs
                        $('.gametes-input').prop('readonly', true);
                        
                        Swal.fire({
                            title: 'Selamat!',
                            text: 'Gamet yang Anda masukkan benar!',
                            icon: 'success',
                            confirmButtonText: 'Lanjutkan'
                        }).then(() => {
                            $('.punnett-table').slideDown();
                            $('#verifyButton').prop('disabled', false);
                            $('#verifyGametes').prop('disabled', true);
                        });
                    }
                }
            });
        } else {
            gameInit.wrongSound.play();
            Swal.fire({
                title: 'Oops!',
                text: 'Periksa kembali gamet yang Anda masukkan. Pastikan tidak ada duplikasi dan sesuai dengan kemungkinan gamet yang dapat terbentuk.',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        }
    }

    // Export functions
    window.gameValidation = {
        verifySingleAnswer,
        validateGametes
    };
}); 