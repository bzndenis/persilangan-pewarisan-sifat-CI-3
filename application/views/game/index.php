<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Mini Game Persilangan Pewarisan Sifat</h4>
                    </div>
                    <h5 class="mt-2">Level <?= isset($current_level) ? $current_level : 0 ?></h5>
                </div>
                <div class="card-body">

                    <!-- Soal -->
                    <div class="soal-section mb-4">
                        <h5>Soal:</h5>
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

                    <!-- Tabel Punnett -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered punnett-table">
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
                                    <?php for($j = 0; $j < 4; $j++): ?>
                                        <td>
                                            <input type="text" 
                                                   class="form-control punnett-input" 
                                                   data-position="<?= $i ?>_<?= $j ?>">
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tombol Verifikasi -->
                    <div class="text-center mb-4">
                        <button id="verifyButton" class="btn btn-primary">
                            <i class="fas fa-check me-2"></i>Verifikasi Jawaban
                        </button>
                    </div>

                    <!-- Form Rasio Fenotip (awalnya tersembunyi) -->
                    <div id="ratioForm" class="mt-4" style="display: none;">
                        <h5>Masukkan Rasio Fenotip:</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="ratio1" placeholder="Bulat Kuning">
                                    <span class="input-group-text">:</span>
                                    <input type="number" class="form-control" id="ratio2" placeholder="Bulat Hijau">
                                    <span class="input-group-text">:</span>
                                    <input type="number" class="form-control" id="ratio3" placeholder="Keriput Kuning">
                                    <span class="input-group-text">:</span>
                                    <input type="number" class="form-control" id="ratio4" placeholder="Keriput Hijau">
                                </div>
                                <button id="verifyRatio" class="btn btn-success mt-3">
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
.punnett-table th {
    background-color: #f8f9fa;
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
}

.punnett-table td {
    padding: 0;
}

.punnett-input {
    border: none;
    text-align: center;
    height: 40px;
    font-size: 0.9rem;
}

.punnett-input.correct {
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.punnett-input.incorrect {
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.description {
    background-color: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.description p {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.description ul {
    margin-left: 1.5rem;
}

.description li {
    margin-bottom: 0.5rem;
    position: relative;
    padding-left: 1.5rem;
}

.description li:before {
    content: "•";
    position: absolute;
    left: 0;
    color: #0d6efd;
}
</style>

<script>
$(document).ready(function() {
    const correctSound = document.getElementById('correctSound');
    const wrongSound = document.getElementById('wrongSound');
    const applauseSound = document.getElementById('applauseSound');

    // Isi jawaban yang tersimpan jika ada
    <?php if(isset($saved_answers) && $saved_answers): ?>
        $('.punnett-input').each(function(index) {
            $(this).val(<?= json_encode($saved_answers) ?>[index]);
        });
    <?php endif; ?>

    $('#verifyButton').click(function() {
        let answers = {};
        $('.punnett-input').each(function() {
            let position = $(this).data('position');
            answers[position] = $(this).val();
        });

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
});
</script> 