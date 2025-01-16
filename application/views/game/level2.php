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
                            $paragraphs = explode("\n\n", $game->description);
                            foreach($paragraphs as $paragraph) {
                                if (trim($paragraph) !== '') {
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
                                        echo "<p>" . nl2br($paragraph) . "</p>";
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Gametes Section -->
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
                                                   placeholder="RT/Rt/rT/rt"
                                                   value="<?= htmlspecialchars($saved_gamete1[$i-1]) ?>"
                                                   maxlength="2"
                                                   pattern="[RrTt]{2}"
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
                                                   placeholder="RT/Rt/rT/rt"
                                                   value="<?= htmlspecialchars($saved_gamete2[$i-1]) ?>"
                                                   maxlength="2"
                                                   pattern="[RrTt]{2}"
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

                    <!-- Punnett Table -->
                    <div class="punnett-wrapper mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table punnett-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>RT</th>
                                                <th>Rt</th>
                                                <th>rT</th>
                                                <th>rt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $rows = ['RT', 'Rt', 'rT', 'rt'];
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
                                                               value="<?= htmlspecialchars($saved_value) ?>"
                                                               maxlength="4">
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
                                        <div class="flower-illustration-realtime">
                                            <div class="flower-color"></div>
                                        </div>
                                        <div class="genotype-text mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Phenotype Illustrations -->
                    <div class="phenotype-illustrations mb-4">
                        <div class="row">
                            <!-- Ungu Tinggi -->
                            <div class="col-md-3">
                                <div class="phenotype-card">
                                    <div class="phenotype-title">Ungu Tinggi</div>
                                    <div class="phenotype-examples">RRTT, RRTt, RrTT, RrTt</div>
                                    <div class="flower-illustration purple tall">
                                        <div class="glow"></div>
                                        <div class="rose-petals">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="stem-connector"></div>
                                        <div class="stem-height">
                                            <div class="thorns">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                            <div class="leaf leaf-left"></div>
                                            <div class="leaf leaf-right"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ungu Pendek -->
                            <div class="col-md-3">
                                <div class="phenotype-card">
                                    <div class="phenotype-title">Ungu Pendek</div>
                                    <div class="phenotype-examples">RRtt, Rrtt</div>
                                    <div class="flower-illustration purple short">
                                        <div class="glow"></div>
                                        <div class="rose-petals">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="stem-connector"></div>
                                        <div class="stem-height">
                                            <div class="thorns">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                            <div class="leaf leaf-left"></div>
                                            <div class="leaf leaf-right"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Putih Tinggi -->
                            <div class="col-md-3">
                                <div class="phenotype-card">
                                    <div class="phenotype-title">Putih Tinggi</div>
                                    <div class="phenotype-examples">rrTT, rrTt</div>
                                    <div class="flower-illustration white tall">
                                        <div class="glow"></div>
                                        <div class="rose-petals">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="stem-connector"></div>
                                        <div class="stem-height">
                                            <div class="thorns">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                            <div class="leaf leaf-left"></div>
                                            <div class="leaf leaf-right"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Putih Pendek -->
                            <div class="col-md-3">
                                <div class="phenotype-card">
                                    <div class="phenotype-title">Putih Pendek</div>
                                    <div class="phenotype-examples">rrtt</div>
                                    <div class="flower-illustration white short">
                                        <div class="glow"></div>
                                        <div class="rose-petals">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="stem-connector"></div>
                                        <div class="stem-height">
                                            <div class="thorns">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                            <div class="leaf leaf-left"></div>
                                            <div class="leaf leaf-right"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Verify Button -->
                    <div class="text-center mb-4">
                        <button id="verifyButton" class="btn btn-primary btn-lg verify-btn">
                            <i class="fas fa-check me-2"></i>Verifikasi Jawaban
                            <span class="verify-btn-bg"></span>
                        </button>
                    </div>

                    <!-- Ratio Form -->
                    <div id="ratioForm" class="mt-4 ratio-form" style="display: none;">
                        <div class="ratio-header">
                            <i class="fas fa-calculator me-2"></i>
                            <h5 class="mb-0">Masukkan Rasio Fenotip:</h5>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-md-8">
                                <div class="ratio-inputs">
                                    <div class="ratio-input-group">
                                        <label>Merah Tinggi</label>
                                        <input type="number" class="form-control" id="ratio1">
                                    </div>
                                    <div class="ratio-separator">:</div>
                                    <div class="ratio-input-group">
                                        <label>Merah Pendek</label>
                                        <input type="number" class="form-control" id="ratio2">
                                    </div>
                                    <div class="ratio-separator">:</div>
                                    <div class="ratio-input-group">
                                        <label>Putih Tinggi</label>
                                        <input type="number" class="form-control" id="ratio3">
                                    </div>
                                    <div class="ratio-separator">:</div>
                                    <div class="ratio-input-group">
                                        <label>Putih Pendek</label>
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

<!-- Load CSS Files -->
<link rel="stylesheet" href="<?= base_url('assets/css/game/level2-layout.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/game/level2-components.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/game/level2-animations.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/game/level2-responsive.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/game/flower-illustrations.css') ?>">

<!-- Load JavaScript Files -->
<script>
    const BASE_URL = '<?= base_url() ?>';
    const CURRENT_LEVEL = <?= $current_level ?>;
</script>
<script src="<?= base_url('assets/js/game/level2-init.js') ?>"></script>
<script src="<?= base_url('assets/js/game/level2-illustrations.js') ?>"></script>
<script src="<?= base_url('assets/js/game/level2-validation.js') ?>"></script>
<script src="<?= base_url('assets/js/game/level2-interactions.js') ?>"></script> 