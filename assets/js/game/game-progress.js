$(document).ready(function() {
    // Fungsi untuk mengupdate progress circle
    function updateProgress(correct, total) {
        const percentage = Math.round((correct / total) * 100);
        $('.progress-text').text(percentage + '%');
        
        // Simpan progress ke database melalui AJAX
        $.ajax({
            url: BASE_URL + 'game/verify_answer',
            type: 'POST',
            data: {
                level: CURRENT_LEVEL,
                progress: correct
            },
            success: function(response) {
                console.log('Progress updated');
            }
        });
    }

    // Fungsi untuk menyimpan gamet
    function saveGametes() {
        const gameteData = {
            level: CURRENT_LEVEL,
            gamete1_1: $('#gamete1_1').val(),
            gamete1_2: $('#gamete1_2').val(),
            gamete1_3: $('#gamete1_3').val(),
            gamete1_4: $('#gamete1_4').val(),
            gamete2_1: $('#gamete2_1').val(),
            gamete2_2: $('#gamete2_2').val(),
            gamete2_3: $('#gamete2_3').val(),
            gamete2_4: $('#gamete2_4').val()
        };

        $.ajax({
            url: BASE_URL + 'game/save_gametes',
            type: 'POST',
            data: gameteData,
            success: function(response) {
                response = JSON.parse(response);
                if(response.success) {
                    console.log('Gametes saved successfully');
                    location.reload();
                }
            }
        });
    }

    // Fungsi untuk mengambil jawaban tersimpan
    function getSavedAnswers() {
        $.ajax({
            url: BASE_URL + 'game/get_saved_answers',
            type: 'POST',
            data: {
                level: CURRENT_LEVEL
            },
            success: function(response) {
                response = JSON.parse(response);
                if(response.success && response.saved_answers) {
                    // Isi input dengan jawaban tersimpan
                    Object.entries(response.saved_answers).forEach(([position, answer]) => {
                        const input = $(`.punnett-input[data-position="${position}"]`);
                        input.val(answer).addClass('correct');
                    });
                    
                    // Update progress
                    const correctAnswers = $('.punnett-input.correct').length;
                    const totalInputs = $('.punnett-input').length;
                    updateProgress(correctAnswers, totalInputs);
                }
            }
        });
    }

    // Event handler untuk update progress saat jawaban berubah
    $('.punnett-input').on('change', function() {
        const correctAnswers = $('.punnett-input.correct').length;
        const totalInputs = $('.punnett-input').length;
        updateProgress(correctAnswers, totalInputs);
    });

    // Export fungsi yang dibutuhkan
    window.gameProgress = {
        updateProgress: updateProgress,
        saveGametes: saveGametes,
        getSavedAnswers: getSavedAnswers
    };

    // Load saved answers saat halaman dimuat
    getSavedAnswers();
}); 