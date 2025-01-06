$(document).ready(function() {
    // Event handler untuk verifikasi jawaban
    $('#verifyButton').click(function() {
        let answers = {};
        $('.punnett-input').each(function() {
            let position = $(this).data('position');
            answers[position] = $(this).val();
        });

        gameInit.disableVerifyButton(); // Nonaktifkan tombol setelah diklik

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
                    if(response.incorrect.includes(position)) {
                        $(this).removeClass('correct').addClass('incorrect');
                        gameInit.wrongSound.play();
                    } else {
                        $(this).removeClass('incorrect').addClass('correct');
                        // Simpan jawaban yang benar
                        gameValidation.verifySingleAnswer(position, $(this).val());
                    }
                });

                if(allCorrect) {
                    gameInit.applauseSound.play();
                    $('#ratioForm').slideDown();
                }
            }
        });
    });

    // Event handler untuk input gamet
    $('.gametes-input').on('input', function() {
        // Validasi panjang input
        if($(this).val().length > 2) {
            $(this).val($(this).val().substring(0, 2));
        }
        
        // Validasi format input (B/b dan K/k)
        let value = $(this).val();
        value = value.replace(/[^BbKk]/g, '');
        $(this).val(value);
    });

    // Event handler untuk input Punnett
    $('.punnett-input').on('input', function() {
        // Validasi panjang input
        if($(this).val().length > 4) {
            $(this).val($(this).val().substring(0, 4));
        }
        
        // Validasi format input (B/b dan K/k)
        let value = $(this).val();
        value = value.replace(/[^BbKk]/g, '');
        $(this).val(value);
    });

    // Event handler untuk input rasio
    $('.ratio-input-group input').on('input', function() {
        // Hanya terima angka
        let value = $(this).val().replace(/[^0-9]/g, '');
        $(this).val(value);
    });

    // Event handler untuk keyboard navigation
    $('.punnett-input, .gametes-input').on('keydown', function(e) {
        const inputs = $(this).closest('table').find('input');
        const index = inputs.index(this);
        
        switch(e.which) {
            case 37: // left
                if(index > 0) inputs.eq(index - 1).focus();
                break;
            case 38: // up
                if(index >= 4) inputs.eq(index - 4).focus();
                break;
            case 39: // right
                if(index < inputs.length - 1) inputs.eq(index + 1).focus();
                break;
            case 40: // down
                if(index < inputs.length - 4) inputs.eq(index + 4).focus();
                break;
            case 13: // enter
                if(index < inputs.length - 1) {
                    inputs.eq(index + 1).focus();
                } else {
                    inputs.first().focus();
                }
                break;
        }
    });

    // Event handler untuk touch events pada mobile
    if('ontouchstart' in window) {
        $('.punnett-input, .gametes-input').on('focus', function() {
            $(this).addClass('touch-focus');
        }).on('blur', function() {
            $(this).removeClass('touch-focus');
        });
    }

    // Export fungsi yang dibutuhkan
    window.gameInteractions = {
        initializeEventHandlers: function() {
            // Fungsi ini bisa digunakan untuk menginisialisasi ulang event handlers
            // jika ada elemen yang ditambahkan secara dinamis
        }
    };
}); 