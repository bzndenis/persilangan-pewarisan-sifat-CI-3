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
        const correctGametes = ['RT', 'Rt', 'rT', 'rt'];
        let allCorrect = true;
        let gamete1Values = [];
        let gamete2Values = [];
        
        // Validasi gamet induk 1
        for(let i = 1; i <= 4; i++) {
            const input = $(`#gamete1_${i}`);
            const value = input.val().trim();
            gamete1Values.push(value);
            
            if(correctGametes.includes(value) && !gamete1Values.slice(0, -1).includes(value)) {
                input.removeClass('incorrect').addClass('correct');
            } else {
                input.removeClass('correct').addClass('incorrect');
                allCorrect = false;
            }
        }
        
        // Validasi gamet induk 2
        for(let i = 1; i <= 4; i++) {
            const input = $(`#gamete2_${i}`);
            const value = input.val().trim();
            gamete2Values.push(value);
            
            if(correctGametes.includes(value) && !gamete2Values.slice(0, -1).includes(value)) {
                input.removeClass('incorrect').addClass('correct');
            } else {
                input.removeClass('correct').addClass('incorrect');
                allCorrect = false;
            }
        }

        // Cek apakah semua gamet yang benar sudah digunakan
        const allGametesUsed = correctGametes.every(g => 
            gamete1Values.includes(g) && gamete2Values.includes(g)
        );
        
        if(allCorrect && allGametesUsed) {
            gameInit.correctSound.play();
            
            // Save gametes
            $.ajax({
                url: BASE_URL + 'game/save_gametes',
                type: 'POST',
                data: {
                    level: CURRENT_LEVEL,
                    gamete1_1: gamete1Values[0],
                    gamete1_2: gamete1Values[1],
                    gamete1_3: gamete1Values[2],
                    gamete1_4: gamete1Values[3],
                    gamete2_1: gamete2Values[0],
                    gamete2_2: gamete2Values[1],
                    gamete2_3: gamete2Values[2],
                    gamete2_4: gamete2Values[3]
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