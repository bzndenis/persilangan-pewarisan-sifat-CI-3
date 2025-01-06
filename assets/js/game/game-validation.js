$(document).ready(function() {
    // Fungsi untuk validasi jawaban tunggal
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
                    // Jika benar, simpan ke database
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

    // Fungsi untuk validasi gamet
    function validateGametes() {
        const correctGametes = ['BK', 'Bk', 'bK', 'bk'];
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
            gameProgress.saveGametes();
            
            // Set readonly pada input yang benar
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

    // Fungsi untuk validasi rasio
    function validateRatio() {
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
    }

    // Event handlers
    $('#verifyGametes').click(function() {
        validateGametes();
    });

    $('#verifyRatio').click(function() {
        validateRatio();
    });

    $('.punnett-input').on('change', function() {
        let position = $(this).data('position');
        let answer = $(this).val();
        verifySingleAnswer(position, answer);
    });

    // Export fungsi yang dibutuhkan
    window.gameValidation = {
        verifySingleAnswer: verifySingleAnswer,
        validateGametes: validateGametes,
        validateRatio: validateRatio
    };
}); 