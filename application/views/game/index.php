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
                                    <h5 class="mb-3">Gametes Induk 1</h5>
                                    <div class="d-flex gap-2 mb-3">
                                        <?php 
                                        $saved_gamete1 = isset($saved_gametes['gamete1']) ? $saved_gametes['gamete1'] : array('', '', '', '');
                                        for($i = 1; $i <= 4; $i++): 
                                        ?>
                                            <input type="text" 
                                                   class="form-control gametes-input <?= !empty($saved_gamete1[$i-1]) ? 'correct' : '' ?>" 
                                                   id="gamete1_<?= $i ?>" 
                                                   placeholder="Gamet <?= $i ?>"
                                                   value="<?= htmlspecialchars($saved_gamete1[$i-1]) ?>"
                                                   <?= !empty($saved_gamete1[$i-1]) ? 'readonly' : '' ?>>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="gametes-input-group">
                                    <h5 class="mb-3">Gametes Induk 2</h5>
                                    <div class="d-flex gap-2 mb-3">
                                        <?php 
                                        $saved_gamete2 = isset($saved_gametes['gamete2']) ? $saved_gametes['gamete2'] : array('', '', '', '');
                                        for($i = 1; $i <= 4; $i++): 
                                        ?>
                                            <input type="text" 
                                                   class="form-control gametes-input <?= !empty($saved_gamete2[$i-1]) ? 'correct' : '' ?>" 
                                                   id="gamete2_<?= $i ?>" 
                                                   placeholder="Gamet <?= $i ?>"
                                                   value="<?= htmlspecialchars($saved_gamete2[$i-1]) ?>"
                                                   <?= !empty($saved_gamete2[$i-1]) ? 'readonly' : '' ?>>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="verifyGametes" class="btn btn-primary mt-3" <?= (isset($saved_gametes) && count(array_filter($saved_gamete1)) === 4 && count(array_filter($saved_gamete2)) === 4) ? 'disabled' : '' ?>>
                            Verifikasi Gametes
                        </button>
                    </div>

                    <!-- Tabel Punnett dengan styling baru -->
                    <div class="punnett-wrapper mb-4">
                        <div class="row">
                            <div class="col-md-8">
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
                            <div class="col-md-4">
                                <div class="realtime-illustration">
                                    <h5 class="text-center mb-3">Visualisasi Jawaban</h5>
                                    <div class="illustration-box">
                                        <div class="pea-illustration-realtime">
                                            <div class="pea-shadow"></div>
                                            <div class="pea-highlight"></div>
                                            <div class="wrinkle-pattern"></div>
                                        </div>
                                        <div class="genotype-text mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tambahkan setelah tabel Punnett dan sebelum tombol verifikasi -->
                    <div class="phenotype-illustrations mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="phenotype-card">
                                    <div class="phenotype-title">Bulat Kuning</div>
                                    <div class="phenotype-examples">BBKK, BBKk, BbKK, BbKk</div>
                                    <div class="pea-illustration round yellow">
                                        <div class="pea-shadow"></div>
                                        <div class="pea-highlight"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="phenotype-card">
                                    <div class="phenotype-title">Bulat Hijau</div>
                                    <div class="phenotype-examples">BBkk, Bbkk</div>
                                    <div class="pea-illustration round green">
                                        <div class="pea-shadow"></div>
                                        <div class="pea-highlight"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="phenotype-card">
                                    <div class="phenotype-title">Keriput Kuning</div>
                                    <div class="phenotype-examples">bbKK, bbKk</div>
                                    <div class="pea-illustration wrinkled yellow">
                                        <div class="pea-shadow"></div>
                                        <div class="pea-highlight"></div>
                                        <div class="wrinkle-pattern"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="phenotype-card">
                                    <div class="phenotype-title">Keriput Hijau</div>
                                    <div class="phenotype-examples">bbkk</div>
                                    <div class="pea-illustration wrinkled green">
                                        <div class="pea-shadow"></div>
                                        <div class="pea-highlight"></div>
                                        <div class="wrinkle-pattern"></div>
                                    </div>
                                </div>
                            </div>
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

/* Phenotype Illustrations */
.phenotype-illustrations {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.phenotype-card {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.phenotype-card:hover {
    transform: translateY(-5px);
}

.phenotype-title {
    font-weight: 600;
    color: #2193b0;
    margin-bottom: 0.5rem;
}

.phenotype-examples {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
}

.pea-illustration {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    position: relative;
    border-radius: 47% 53% 53% 47% / 48% 47% 53% 52%;
    transition: all 0.3s ease;
}

/* Bulat */
.pea-illustration.round {
    animation: float 3s ease-in-out infinite;
}

/* Keriput */
.pea-illustration.wrinkled {
    clip-path: polygon(
        15% 0%, 25% 12%, 35% 3%, 45% 15%, 55% 5%, 65% 12%, 75% 2%, 85% 10%, 95% 25%, 100% 45%,
        98% 60%, 95% 70%, 85% 80%, 75% 95%, 65% 85%, 55% 98%, 45% 88%, 35% 100%, 25% 90%, 15% 95%,
        8% 85%, 2% 70%, 0% 55%, 5% 40%, 2% 25%, 8% 15%
    );
    animation: float 3s ease-in-out infinite;
    position: relative;
    overflow: hidden;
    transform-style: preserve-3d;
    perspective: 1000px;
    border: none;
}

/* Tambahan lapisan keriput luar */
.pea-illustration.wrinkled::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: inherit;
    filter: brightness(0.9);
    clip-path: polygon(
        28% -2%, 72% -2%, 87% 13%, 102% 33%, 102% 67%, 
        87% 87%, 72% 102%, 28% 102%, 13% 87%, -2% 67%, 
        -2% 33%, 13% 13%
    );
    z-index: -1;
}

/* Warna */
.pea-illustration.yellow {
    background: linear-gradient(135deg, #ffd700, #ffa500);
}

.pea-illustration.green {
    background: linear-gradient(135deg, #2e8b57, #166835);
}

/* Efek bayangan */
.pea-shadow {
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 90%;
    height: 15px;
    background: rgba(0,0,0,0.15);
    border-radius: 50%;
    filter: blur(4px);
}

/* Efek highlight */
.pea-highlight {
    position: absolute;
    top: 25%;
    left: 25%;
    width: 30%;
    height: 30%;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    filter: blur(5px);
}

/* Pola keriput */
.wrinkle-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 30% 30%, rgba(255,255,255,0.1) 0%, transparent 10%),
        radial-gradient(circle at 70% 60%, rgba(255,255,255,0.1) 0%, transparent 10%),
        radial-gradient(circle at 40% 80%, rgba(255,255,255,0.1) 0%, transparent 10%),
        repeating-linear-gradient(
            45deg,
            transparent 0px,
            transparent 3px,
            rgba(0,0,0,0.1) 3px,
            rgba(0,0,0,0.1) 6px
        );
    border-radius: inherit;
    opacity: 0.8;
}

/* Tambahan untuk kacang keriput */
.pea-illustration.wrinkled::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 25% 25%, transparent 0%, rgba(0,0,0,0.15) 100%),
        radial-gradient(circle at 75% 75%, transparent 0%, rgba(0,0,0,0.15) 100%),
        repeating-radial-gradient(
            circle at 50% 50%,
            transparent 0%,
            transparent 5%,
            rgba(0,0,0,0.05) 5%,
            rgba(0,0,0,0.05) 10%
        );
    border-radius: inherit;
    z-index: 1;
}

.pea-illustration.wrinkled.green {
    background: linear-gradient(135deg, #2e8b57, #166835);
    box-shadow: 
        inset -3px -3px 10px rgba(0,0,0,0.4),
        inset 3px 3px 10px rgba(255,255,255,0.2),
        -2px -2px 5px rgba(0,0,0,0.2),
        2px 2px 5px rgba(0,0,0,0.3);
    position: relative;
}

/* Tambahan gelombang sisi untuk kacang keriput */
.pea-illustration.wrinkled.green::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(
            circle at 20% 50%,
            rgba(0,0,0,0.2) 0%,
            transparent 50%
        ),
        radial-gradient(
            circle at 80% 50%,
            rgba(0,0,0,0.2) 0%,
            transparent 50%
        ),
        radial-gradient(
            circle at 50% 20%,
            rgba(0,0,0,0.2) 0%,
            transparent 50%
        ),
        radial-gradient(
            circle at 50% 80%,
            rgba(0,0,0,0.2) 0%,
            transparent 50%
        );
    border-radius: inherit;
    z-index: 2;
}

/* Tambahan tekstur keriput */
.pea-illustration.wrinkled.green::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        repeating-radial-gradient(
            circle at 50% 50%,
            transparent 0%,
            transparent 8px,
            rgba(0,0,0,0.1) 9px,
            transparent 10px
        ),
        repeating-linear-gradient(
            45deg,
            transparent 0px,
            transparent 2px,
            rgba(0,0,0,0.1) 2px,
            rgba(0,0,0,0.1) 4px
        ),
        repeating-linear-gradient(
            -45deg,
            transparent 0px,
            transparent 2px,
            rgba(0,0,0,0.1) 2px,
            rgba(0,0,0,0.1) 4px
        );
    border-radius: inherit;
    z-index: 3;
    opacity: 0.7;
}

/* Efek highlight untuk kacang keriput */
.pea-illustration.wrinkled .pea-highlight {
    background: linear-gradient(
        135deg,
        rgba(255,255,255,0.2) 0%,
        transparent 50%
    );
    filter: blur(2px);
    opacity: 0.7;
}

/* Animasi */
@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-5px) rotate(1deg); }
}

@keyframes shadow {
    0%, 100% { transform: translateX(-50%) scale(1); opacity: 0.3; }
    50% { transform: translateX(-50%) scale(0.8); opacity: 0.2; }
}

@keyframes wrinkle {
    0% {
        clip-path: polygon(
            30% 0%, 70% 0%, 85% 15%, 100% 35%, 100% 65%, 
            85% 85%, 70% 100%, 30% 100%, 15% 85%, 0% 65%, 
            0% 35%, 15% 15%
        );
    }
    50% {
        clip-path: polygon(
            35% 0%, 65% 0%, 90% 15%, 100% 30%, 100% 70%, 
            90% 85%, 65% 100%, 35% 100%, 10% 85%, 0% 70%, 
            0% 30%, 10% 15%
        );
    }
    100% {
        clip-path: polygon(
            30% 0%, 70% 0%, 85% 15%, 100% 35%, 100% 65%, 
            85% 85%, 70% 100%, 30% 100%, 15% 85%, 0% 65%, 
            0% 35%, 15% 15%
        );
    }
}

/* Animasi tambahan untuk efek keriput */
@keyframes wrinkleTexture {
    0% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.05) rotate(2deg); }
    100% { transform: scale(1) rotate(0deg); }
}

.pea-illustration.wrinkled {
    animation: 
        float 3s ease-in-out infinite,
        wrinkle 8s linear infinite,
        wrinkleTexture 4s ease-in-out infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .phenotype-card {
        margin-bottom: 1.5rem;
    }
    
    .pea-illustration {
        width: 80px;
        height: 80px;
    }
}

/* Tambahan efek keriput pada tepi */
.pea-illustration.wrinkled::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(
            circle at 20% 20%,
            transparent 5px,
            rgba(0,0,0,0.1) 6px,
            transparent 7px
        ),
        radial-gradient(
            circle at 80% 20%,
            transparent 5px,
            rgba(0,0,0,0.1) 6px,
            transparent 7px
        ),
        radial-gradient(
            circle at 20% 80%,
            transparent 5px,
            rgba(0,0,0,0.1) 6px,
            transparent 7px
        ),
        radial-gradient(
            circle at 80% 80%,
            transparent 5px,
            rgba(0,0,0,0.1) 6px,
            transparent 7px
        );
    z-index: 4;
}

/* Realtime Illustration Styling */
.realtime-illustration {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    position: sticky;
    top: 20px;
}

.illustration-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 200px;
    justify-content: center;
}

.pea-illustration-realtime {
    width: 120px;
    height: 120px;
    position: relative;
    transition: all 0.3s ease;
}

.genotype-text {
    font-size: 1.1rem;
    font-weight: 500;
    color: #2193b0;
    text-align: center;
    margin-top: 1rem;
}

/* Tambahkan style untuk text genotype dan phenotype */
.genotype-text .genotype {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2193b0;
    margin-bottom: 0.3rem;
}

.genotype-text .phenotype {
    font-size: 1rem;
    color: #6c757d;
}

/* Tambahkan style untuk memastikan ilustrasi terlihat */
$('<style>')
    .text(`
        .pea-illustration-realtime {
            width: 120px !important;
            height: 120px !important;
            display: block !important;
            margin: 0 auto !important;
            position: relative !important;
            border-radius: 47% 53% 53% 47% / 48% 47% 53% 52% !important;
            background-color: #f0f0f0;
        }
        
        .pea-illustration-realtime.round {
            border-radius: 50%;
        }
        
        .pea-illustration-realtime.yellow {
            background: linear-gradient(135deg, #ffd700, #ffa500);
        }
        
        .pea-illustration-realtime.green {
            background: linear-gradient(135deg, #2d8c57, #1d5c3a) !important;
            box-shadow: 
                inset -4px -4px 8px rgba(0,0,0,0.3),
                inset 4px 4px 8px rgba(255,255,255,0.1),
                0 2px 4px rgba(0,0,0,0.2) !important;
        }
        
        .pea-illustration-realtime.wrinkled {
            border-radius: 46% 54% 52% 48% / 47% 45% 55% 53% !important;
            clip-path: none !important;
        }
    `)
    .appendTo('head');

/* Efek Keriput Dasar */
.pea-illustration.wrinkled::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        /* Lekukan tambahan */
        radial-gradient(circle at 45% 45%, transparent 15px, rgba(0,0,0,0.1) 16px, transparent 17px),
        radial-gradient(circle at 55% 55%, transparent 15px, rgba(0,0,0,0.1) 16px, transparent 17px),
        /* Tekstur keriput halus */
        repeating-linear-gradient(
            -45deg,
            transparent 0px,
            transparent 3px,
            rgba(0,0,0,0.03) 4px,
            transparent 5px
        );
    border-radius: inherit;
    z-index: 2;
    opacity: 0.8;
}

/* Keriput Kuning */
.pea-illustration.wrinkled.yellow {
    background: linear-gradient(135deg, #ffd700, #ffa500);
    box-shadow: 
        inset -3px -3px 10px rgba(0,0,0,0.3),
        inset 3px 3px 10px rgba(255,255,255,0.2);
}

/* Keriput Hijau */
.pea-illustration.wrinkled.green {
    background: linear-gradient(135deg, #2e8b57, #166835);
    box-shadow: 
        inset -3px -3px 10px rgba(0,0,0,0.4),
        inset 3px 3px 10px rgba(255,255,255,0.2);
}

/* Tambahan efek tekstur untuk kedua variasi */
.pea-illustration.wrinkled::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        /* Lekukan dalam */
        radial-gradient(circle at 30% 30%, rgba(0,0,0,0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 70%, rgba(0,0,0,0.1) 0%, transparent 50%),
        /* Tekstur halus */
        repeating-linear-gradient(
            45deg,
            transparent 0px,
            transparent 2px,
            rgba(0,0,0,0.05) 3px,
            transparent 4px
        );
    border-radius: inherit;
    z-index: 1;
    opacity: 0.9;
}

/* Animasi keriput */
@keyframes wrinkleMove {
    0% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.02) rotate(1deg); }
    100% { transform: scale(1) rotate(0deg); }
}

.pea-illustration.wrinkled {
    animation: 
        float 3s ease-in-out infinite,
        wrinkleMove 4s ease-in-out infinite;
}

/* Responsive adjustments untuk mobile */
@media (max-width: 768px) {
    /* Card dan header adjustments */
    .game-card {
        margin: 0 -15px;
        border-radius: 0;
    }
    
    .game-header {
        padding: 1rem;
    }
    
    .game-header h4 {
        font-size: 1.1rem;
    }
    
    .level-badge {
        font-size: 0.9rem;
        padding: 3px 10px;
    }
    
    .progress-circle {
        width: 45px;
        height: 45px;
    }
    
    /* Gametes section adjustments */
    .gametes-input-group {
        margin-bottom: 1.5rem;
    }
    
    .gametes-input-group h5 {
        font-size: 1rem;
    }
    
    .d-flex.gap-2 {
        flex-wrap: wrap;
    }
    
    .gametes-input {
        width: calc(50% - 5px);
        margin-bottom: 10px;
    }
    
    /* Punnett table adjustments */
    .punnett-table {
        font-size: 0.9rem;
    }
    
    .punnett-table th,
    .punnett-table td {
        padding: 8px 4px;
    }
    
    .punnett-input {
        width: 100%;
        min-width: 60px;
        font-size: 0.9rem;
    }
    
    /* Phenotype illustrations adjustments */
    .phenotype-illustrations {
        padding: 1rem;
    }
    
    .phenotype-card {
        margin-bottom: 1rem;
        padding: 1rem;
    }
    
    .phenotype-title {
        font-size: 0.9rem;
    }
    
    .phenotype-examples {
        font-size: 0.8rem;
    }
    
    .pea-illustration {
        width: 80px;
        height: 80px;
    }
    
    /* Ratio form adjustments */
    .ratio-form {
        padding: 1rem;
    }
    
    .ratio-inputs {
        flex-direction: column;
    }
    
    .ratio-input-group {
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .ratio-separator {
        display: none;
    }
    
    /* Button adjustments */
    .verify-btn {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
    }
    
    /* Realtime illustration adjustments */
    .realtime-illustration {
        position: relative;
        top: 0;
        margin-top: 1rem;
    }
    
    .illustration-box {
        min-height: 150px;
    }
    
    .pea-illustration-realtime {
        width: 100px;
        height: 100px;
    }
    
    .genotype-text {
        font-size: 1rem;
    }
}

/* Tambahan untuk layar sangat kecil */
@media (max-width: 320px) {
    .game-header h4 {
        font-size: 1rem;
    }
    
    .punnett-input {
        min-width: 50px;
        font-size: 0.8rem;
    }
    
    .pea-illustration {
        width: 60px;
        height: 60px;
    }
}

/* Perbaikan layout container */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    .col-12 {
        padding-left: 10px;
        padding-right: 10px;
    }
}

/* Perbaikan scrolling horizontal */
.table-responsive {
    -webkit-overflow-scrolling: touch;
    margin-bottom: 1rem;
}

/* Perbaikan touch interactions */
@media (hover: none) and (pointer: coarse) {
    .punnett-input,
    .gametes-input,
    .verify-btn {
        -webkit-tap-highlight-color: transparent;
    }
    
    .verify-btn:active {
        transform: scale(0.98);
    }
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
            correctSound.play();
            saveGametes();
            
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

    function saveGametes() {
        const gameteData = {
            level: <?= $current_level ?>,
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
            url: '<?= base_url("game/save_gametes") ?>',
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

    // Inisialisasi tampilan berdasarkan data tersimpan
    if($('.gametes-input.correct').length === 8) {
        $('.punnett-table').show();
        $('#verifyButton').prop('disabled', false);
        $('#verifyGametes').prop('disabled', true);
        $('.gametes-input').prop('readonly', true);
    } else {
        $('.punnett-table').hide();
        $('#verifyButton').prop('disabled', true);
    }

    // Cek dan inisialisasi data gamet tersimpan
    <?php if(isset($saved_gametes) && !empty($saved_gametes)): ?>
        console.log('Loading saved gametes:', <?= json_encode($saved_gametes) ?>);
        
        // Isi input dengan data tersimpan
        const savedGamete1 = <?= json_encode($saved_gametes['gamete1']) ?>;
        const savedGamete2 = <?= json_encode($saved_gametes['gamete2']) ?>;
        
        savedGamete1.forEach((value, index) => {
            if(value) {
                $(`#gamete1_${index + 1}`)
                    .val(value)
                    .addClass('correct')
                    .prop('readonly', true);
            }
        });
        
        savedGamete2.forEach((value, index) => {
            if(value) {
                $(`#gamete2_${index + 1}`)
                    .val(value)
                    .addClass('correct')
                    .prop('readonly', true);
            }
        });
        
        // Jika semua gamet sudah benar
        if($('.gametes-input.correct').length === 8) {
            $('.punnett-table').show();
            $('#verifyButton').prop('disabled', false);
            $('#verifyGametes').prop('disabled', true);
        }
    <?php endif; ?>

    // Fungsi untuk mengupdate ilustrasi
    function updateIllustration(genotype) {
        const illustration = $('.pea-illustration-realtime');
        const genotypeText = $('.genotype-text');
        
        // Reset classes
        illustration.removeClass('round wrinkled yellow green');
        illustration.find('.wrinkle-pattern').remove();
        
        if (genotype) {
            // Validasi format genotype
            if (genotype.length !== 4) {
                genotypeText.text('Format tidak valid');
                return;
            }

            let phenotype = '';
            
            // Tentukan fenotipe
            if (['BBKK', 'BBKk', 'BbKK', 'BbKk'].includes(genotype)) {
                illustration.addClass('round yellow');
                phenotype = 'Bulat Kuning';
            } else if (['BBkk', 'Bbkk'].includes(genotype)) {
                illustration.addClass('round green');
                phenotype = 'Bulat Hijau';
            } else if (['bbKK', 'bbKk'].includes(genotype)) {
                illustration.addClass('wrinkled yellow');
                illustration.append('<div class="wrinkle-pattern"></div>');
                phenotype = 'Keriput Kuning';
            } else if (genotype === 'bbkk') {
                illustration.addClass('wrinkled green');
                illustration.append('<div class="wrinkle-pattern"></div>');
                phenotype = 'Keriput Hijau';
            }

            // Tambahkan kelas dan style yang diperlukan
            illustration.addClass('pea-illustration');
            illustration.css({
                'width': '120px',
                'height': '120px',
                'display': 'block',
                'margin': '0 auto',
                'position': 'relative'
            });
            
            // Update text
            genotypeText.html(`
                <div class="genotype">${genotype}</div>
                <div class="phenotype">${phenotype}</div>
            `);
            
            // Tambahkan animasi
            illustration.css('transform', 'scale(1.05)');
            setTimeout(() => {
                illustration.css('transform', 'scale(1)');
            }, 200);
        } else {
            genotypeText.html(`
                <div class="genotype">____</div>
                <div class="phenotype">Masukkan genotype</div>
            `);
        }
    }

    // Event handler untuk input Punnett
    $('.punnett-input').on('input', function() {
        const value = $(this).val().trim();
        
        if (value.length === 4) {
            updateIllustration(value);
            $('.punnett-input').removeClass('active-input');
            $(this).addClass('active-input');
        } else {
            updateIllustration(null);
        }
    });
    
    // Event handler untuk focus pada input
    $('.punnett-input').on('focus', function() {
        const value = $(this).val().trim();
        $('.punnett-input').removeClass('active-input');
        $(this).addClass('active-input');
        if (value.length === 4) {
            updateIllustration(value);
        }
    });

    // Tambahkan style untuk input yang aktif
    $('<style>')
        .text(`
            .punnett-input.active-input {
                border-color: #2193b0;
                box-shadow: 0 0 0 0.2rem rgba(33, 147, 176, 0.25);
            }
        `)
        .appendTo('head');
});
</script> 