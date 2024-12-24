<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg game-card">
                <!-- Header Card dengan Gradient -->
                <div class="card-header game-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-white">Mini Game Persilangan Pewarisan Sifat</h4>
                            <div class="level-badge">
                                Level <?= isset($current_level) ? $current_level : 0 ?>
                            </div>
                        </div>
                        <div class="progress-circle">
                            <div class="progress-circle-inner">
                                <span class="progress-text"><?= isset($saved_answers) ? round((count($saved_answers) / 16) * 100) : 0 ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Soal dengan styling baru -->
                    <div class="soal-section mb-4">
                        <div class="soal-header">
                            <i class="fas fa-book-open me-2"></i>
                            <h5 class="mb-0">Soal:</h5>
                        </div>
                        <div class="description">
                            <?php 
                            // Mengkonversi line breaks menjadi paragraf HTML
                            $paragraphs = explode("\n\n", $game->description);
                            foreach($paragraphs as $paragraph) {
                                if (trim($paragraph) !== '') {
                                    // Mengkonversi list items
                                    if (strpos($paragraph, '- ') === 0) {
                                        $items = explode("\n-", $paragraph);
                                        echo "<ul class='list-unstyled'>";
                                        foreach($items as $item) {
                                            if (trim($item) !== '') {
                                                echo "<li>" . ltrim($item, '- ') . "</li>";
                                            }
                                        }
                                        echo "</ul>";
                                    } else {
                                        // Regular paragraphs
                                        echo "<p>" . nl2br($paragraph) . "</p>";
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Tambahkan setelah soal dan sebelum tabel Punnett -->
                    <div class="gametes-section mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gametes-input-group">
                                    <h5 class="mb-3">Gamet Induk 1</h5>
                                    <div class="d-flex gap-2 mb-3">
                                        <input type="text" class="form-control gametes-input" id="gamete1_1" placeholder="Gamet 1">
                                        <input type="text" class="form-control gametes-input" id="gamete1_2" placeholder="Gamet 2">
                                        <input type="text" class="form-control gametes-input" id="gamete1_3" placeholder="Gamet 3">
                                        <input type="text" class="form-control gametes-input" id="gamete1_4" placeholder="Gamet 4">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="gametes-input-group">
                                    <h5 class="mb-3">Gamet Induk 2</h5>
                                    <div class="d-flex gap-2 mb-3">
                                        <input type="text" class="form-control gametes-input" id="gamete2_1" placeholder="Gamet 1">
                                        <input type="text" class="form-control gametes-input" id="gamete2_2" placeholder="Gamet 2">
                                        <input type="text" class="form-control gametes-input" id="gamete2_3" placeholder="Gamet 3">
                                        <input type="text" class="form-control gametes-input" id="gamete2_4" placeholder="Gamet 4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="verifyGametes" class="btn btn-primary">
                                <i class="fas fa-check me-2"></i>Verifikasi Gamet
                            </button>
                        </div>
                    </div>

                    <!-- Tabel Punnett dengan styling baru -->
                    <div class="punnett-wrapper mb-4">
                        <div class="table-responsive">
                            <table class="table punnett-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>BK</th>
                                        <th>Bk</th>
                                        <th>bK</th>
                                        <th>bk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $rows = ['BK', 'Bk', 'bK', 'bk'];
                                    foreach($rows as $i => $row): ?>
                                    <tr>
                                        <th><?= $row ?></th>
                                        <?php for($j = 0; $j < 4; $j++): 
                                            $position = $i . '_' . $j;
                                            $saved_value = isset($saved_answers[$position]) ? $saved_answers[$position] : '';
                                        ?>
                                            <td>
                                                <input type="text" 
                                                       class="form-control punnett-input <?= $saved_value ? 'correct' : '' ?>" 
                                                       data-position="<?= $position ?>"
                                                       value="<?= $saved_value ?>">
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tombol Verifikasi dengan animasi -->
                    <div class="text-center mb-4">
                        <button id="verifyButton" class="btn btn-primary btn-lg verify-btn">
                            <i class="fas fa-check me-2"></i>Verifikasi Jawaban
                            <span class="verify-btn-bg"></span>
                        </button>
                    </div>

                    <!-- Form Rasio dengan styling baru -->
                    <div id="ratioForm" class="mt-4 ratio-form" style="display: none;">
                        <div class="ratio-header">
                            <i class="fas fa-calculator me-2"></i>
                            <h5 class="mb-0">Masukkan Rasio Fenotip:</h5>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-md-8">
                                <div class="ratio-inputs">
                                    <div class="ratio-input-group">
                                        <label>Bulat Kuning</label>
                                        <input type="number" class="form-control" id="ratio1">
                                    </div>
                                    <div class="ratio-separator">:</div>
                                    <div class="ratio-input-group">
                                        <label>Bulat Hijau</label>
                                        <input type="number" class="form-control" id="ratio2">
                                    </div>
                                    <div class="ratio-separator">:</div>
                                    <div class="ratio-input-group">
                                        <label>Keriput Kuning</label>
                                        <input type="number" class="form-control" id="ratio3">
                                    </div>
                                    <div class="ratio-separator">:</div>
                                    <div class="ratio-input-group">
                                        <label>Keriput Hijau</label>
                                        <input type="number" class="form-control" id="ratio4">
                                    </div>
                                </div>
                                <button id="verifyRatio" class="btn btn-success btn-lg mt-4 verify-ratio-btn">
                                    <i class="fas fa-check-double me-2"></i>Verifikasi Rasio
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Audio Elements -->
<audio id="correctSound" src="<?= base_url('assets/audio/correct.mp3') ?>"></audio>
<audio id="wrongSound" src="<?= base_url('assets/audio/wrong.mp3') ?>"></audio>
<audio id="applauseSound" src="<?= base_url('assets/audio/applause.mp3') ?>"></audio>

<style>
/* Styling untuk card game */
.game-card {
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.game-header {
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    padding: 1.5rem;
    border: none;
}

/* Level badge */
.level-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 5px 15px;
    border-radius: 20px;
    color: white;
    font-weight: bold;
    margin-top: 8px;
    display: inline-block;
}

/* Progress circle */
.progress-circle {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    padding: 3px;
}

.progress-circle-inner {
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.progress-text {
    color: #2193b0;
    font-weight: bold;
}

/* Soal section styling */
.soal-header {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 10px 10px 0 0;
    border-bottom: 3px solid #e9ecef;
}

.description {
    background: #ffffff;
    padding: 1.5rem;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

/* Punnett table styling */
.punnett-wrapper {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.punnett-table {
    background: white;
    border-radius: 8px;
    overflow: hidden;
}

.punnett-table th {
    background: #2193b0;
    color: white;
    font-weight: 600;
    padding: 15px;
}

.punnett-input {
    border: 2px solid #e9ecef;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.punnett-input:focus {
    border-color: #2193b0;
    box-shadow: 0 0 0 0.2rem rgba(33, 147, 176, 0.25);
}

.punnett-input.correct {
    background-color: #d4edda;
    border-color: #28a745;
    animation: correctAnswer 0.5s ease;
}

.punnett-input.incorrect {
    background-color: #f8d7da;
    border-color: #dc3545;
    animation: incorrectAnswer 0.5s ease;
}

/* Verify button styling */
.verify-btn {
    position: relative;
    overflow: hidden;
    padding: 12px 35px;
    border-radius: 30px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.verify-btn-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    z-index: -1;
    transition: all 0.3s ease;
}

/* Ratio form styling */
.ratio-form {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.ratio-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.ratio-inputs {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.ratio-input-group {
    flex: 1;
    min-width: 120px;
}

.ratio-input-group label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 5px;
}

.ratio-separator {
    font-weight: bold;
    color: #2193b0;
    padding: 0 5px;
}

/* Animations */
@keyframes correctAnswer {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

@keyframes incorrectAnswer {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
    100% { transform: translateX(0); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .ratio-inputs {
        flex-direction: column;
    }
    
    .ratio-input-group {
        width: 100%;
    }
    
    .ratio-separator {
        transform: rotate(90deg);
    }
}

.gametes-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.gametes-input.correct {
    background-color: #d4edda;
    border-color: #28a745;
    animation: correctAnswer 0.5s ease;
}

.gametes-input.incorrect {
    background-color: #f8d7da;
    border-color: #dc3545;
    animation: incorrectAnswer 0.5s ease;
}
</style>

<script>
$(document).ready(function() {
    const correctSound = document.getElementById('correctSound');
    const wrongSound = document.getElementById('wrongSound');
    const applauseSound = document.getElementById('applauseSound');
    let verifyButtonTimeout;

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

    // Verifikasi jawaban tunggal dan simpan jika benar
    function verifySingleAnswer(position, answer) {
        $.ajax({
            url: '<?= base_url("game/verify_single_answer") ?>',
            type: 'POST',
            data: {
                position: position,
                answer: answer,
                level: <?= $current_level ?>
            },
            success: function(response) {
                if(response.correct) {
                    // Jika benar, simpan ke database
                    $.ajax({
                        url: '<?= base_url("game/save_correct_answer") ?>',
                        type: 'POST',
                        data: {
                            position: position,
                            answer: answer,
                            level: <?= $current_level ?>
                        }
                    });
                }
            }
        });
    }

    // Event handler untuk input
    $('.punnett-input').on('change', function() {
        let position = $(this).data('position');
        let answer = $(this).val();
        verifySingleAnswer(position, answer);
    });

    $('#verifyButton').click(function() {
        let answers = {};
        $('.punnett-input').each(function() {
            let position = $(this).data('position');
            answers[position] = $(this).val();
        });

        disableVerifyButton(); // Nonaktifkan tombol setelah diklik

        $.ajax({
            url: '<?= base_url("game/verify_answer") ?>',
            type: 'POST',
            data: {
                answers: answers,
                level: <?= $current_level ?>
            },
            success: function(response) {
                response = JSON.parse(response);
                let allCorrect = response.success;
                
                $('.punnett-input').each(function() {
                    let position = $(this).data('position');
                    if(response.incorrect.includes(position)) {
                        $(this).removeClass('correct').addClass('incorrect');
                        wrongSound.play();
                    } else {
                        $(this).removeClass('incorrect').addClass('correct');
                        // Simpan jawaban yang benar
                        verifySingleAnswer(position, $(this).val());
                    }
                });

                if(allCorrect) {
                    applauseSound.play();
                    $('#ratioForm').slideDown();
                }
            }
        });
    });

    $('#verifyRatio').click(function() {
        $.ajax({
            url: '<?= base_url("game/verify_ratio") ?>',
            type: 'POST',
            data: {
                ratio1: $('#ratio1').val(),
                ratio2: $('#ratio2').val(),
                ratio3: $('#ratio3').val(),
                ratio4: $('#ratio4').val(),
                level: <?= $current_level ?>
            },
            success: function(response) {
                if(response.success) {
                    applauseSound.play();
                    Swal.fire({
                        title: 'Selamat!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Lanjut ke Level Berikutnya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?= base_url("game/next_level") ?>';
                        }
                    });
                } else {
                    wrongSound.play();
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

    // Fungsi untuk mengupdate progress circle
    function updateProgress(correct, total) {
        const percentage = Math.round((correct / total) * 100);
        $('.progress-text').text(percentage + '%');
        
        // Simpan progress ke database melalui AJAX
        $.ajax({
            url: '<?= base_url("game/verify_answer") ?>',
            type: 'POST',
            data: {
                level: <?= $current_level ?>,
                progress: correct
            },
            success: function(response) {
                // Progress sudah diupdate di database
                console.log('Progress updated');
            }
        });
    }

    // Inisialisasi progress awal
    const initialProgress = <?= isset($saved_answers) ? count($saved_answers) : 0 ?>;
    const totalInputs = $('.punnett-input').length;
    updateProgress(initialProgress, totalInputs);

    // Update progress ketika ada jawaban benar
    $('.punnett-input').on('change', function() {
        const correctAnswers = $('.punnett-input.correct').length;
        const totalInputs = $('.punnett-input').length;
        updateProgress(correctAnswers, totalInputs);
    });
    
    // Tambahkan efek hover pada verify button
    $('.verify-btn').hover(
        function() {
            $(this).find('.verify-btn-bg').css('opacity', '0.9');
        },
        function() {
            $(this).find('.verify-btn-bg').css('opacity', '1');
        }
    );

    // Fungsi untuk memvalidasi gamet
    function validateGametes() {
        const correctGametes = ['BK', 'Bk', 'bK', 'bk'];
        let allCorrect = true;
        
        // Validasi gamet induk 1
        for(let i = 1; i <= 4; i++) {
            const input = $(`#gamete1_${i}`);
            const value = input.val().trim();
            
            if(correctGametes.includes(value)) {
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
            
            if(correctGametes.includes(value)) {
                input.removeClass('incorrect').addClass('correct');
            } else {
                input.removeClass('correct').addClass('incorrect');
                allCorrect = false;
            }
        }

        // Cek duplikasi
        function checkDuplicates(selector) {
            const values = [];
            let hasDuplicates = false;
            
            $(`${selector}`).each(function() {
                const value = $(this).val().trim();
                if(values.includes(value)) {
                    hasDuplicates = true;
                    $(this).removeClass('correct').addClass('incorrect');
                }
                values.push(value);
            });
            
            return !hasDuplicates;
        }

        const noDuplicates1 = checkDuplicates('.gametes-input[id^="gamete1_"]');
        const noDuplicates2 = checkDuplicates('.gametes-input[id^="gamete2_"]');
        
        if(!noDuplicates1 || !noDuplicates2) {
            allCorrect = false;
        }

        if(allCorrect) {
            correctSound.play();
            Swal.fire({
                title: 'Selamat!',
                text: 'Gamet yang Anda masukkan benar!',
                icon: 'success',
                confirmButtonText: 'Lanjutkan'
            }).then(() => {
                $('.punnett-table').slideDown();
                $('#verifyButton').prop('disabled', false);
            });
        } else {
            wrongSound.play();
            Swal.fire({
                title: 'Oops!',
                text: 'Periksa kembali gamet yang Anda masukkan. Pastikan tidak ada duplikasi dan sesuai dengan kemungkinan gamet yang dapat terbentuk.',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        }
    }

    // Event handler untuk tombol verifikasi gamet
    $('#verifyGametes').click(function() {
        validateGametes();
    });

    // Sembunyikan tabel Punnett dan disable tombol verifikasi awal
    $('.punnett-table').hide();
    $('#verifyButton').prop('disabled', true);
});
</script> 