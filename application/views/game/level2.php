<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg game-card">
                <!-- Header Card dengan Gradient -->
                <div class="card-header game-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-white">Mini Game Level 2</h4>
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
                    <!-- Soal section -->
                    <div class="soal-section mb-4">
                        <div class="soal-header">
                            <i class="fas fa-book-open me-2"></i>
                            <h5 class="mb-0">Soal Level 2:</h5>
                        </div>
                        <div class="description">
                            <?php echo nl2br($game->description); ?>
                        </div>
                    </div>

                    <!-- Gametes Input Section -->
                    <div class="gametes-section mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Gamet 1</h5>
                                <div class="gametes-input-group">
                                    <?php for($i = 1; $i <= 4; $i++): ?>
                                        <input type="text" 
                                               class="gamete-input" 
                                               id="gamete1_<?= $i ?>" 
                                               maxlength="2"
                                               value="<?= isset($saved_gametes['gamete1'][$i-1]) ? $saved_gametes['gamete1'][$i-1] : '' ?>"
                                               <?= isset($saved_gametes) ? 'readonly' : '' ?>>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Gamet 2</h5>
                                <div class="gametes-input-group">
                                    <?php for($i = 1; $i <= 4; $i++): ?>
                                        <input type="text" 
                                               class="gamete-input" 
                                               id="gamete2_<?= $i ?>" 
                                               maxlength="2"
                                               value="<?= isset($saved_gametes['gamete2'][$i-1]) ? $saved_gametes['gamete2'][$i-1] : '' ?>"
                                               <?= isset($saved_gametes) ? 'readonly' : '' ?>>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <button id="verifyGametes" class="btn btn-verify mt-3">Verifikasi Gamet</button>
                    </div>

                    <!-- Punnett Table -->
                    <div class="punnett-section" style="<?= !isset($saved_gametes) ? 'display: none;' : '' ?>">
                        <h5>Tabel Punnett</h5>
                        <table class="punnett-table">
                            <?php for($i = 0; $i <= 4; $i++): ?>
                                <tr>
                                    <?php for($j = 0; $j <= 4; $j++): ?>
                                        <?php if($i == 0 && $j == 0): ?>
                                            <td class="header-cell"></td>
                                        <?php elseif($i == 0): ?>
                                            <td class="header-cell gamete1-label"><?= isset($saved_gametes['gamete1'][$j-1]) ? $saved_gametes['gamete1'][$j-1] : '' ?></td>
                                        <?php elseif($j == 0): ?>
                                            <td class="header-cell gamete2-label"><?= isset($saved_gametes['gamete2'][$i-1]) ? $saved_gametes['gamete2'][$i-1] : '' ?></td>
                                        <?php else: ?>
                                            <td>
                                                <input type="text" 
                                                       class="punnett-input" 
                                                       data-position="<?= ($i-1) . '_' . ($j-1) ?>" 
                                                       maxlength="4"
                                                       value="<?= isset($saved_answers[($i-1).'_'.($j-1)]) ? $saved_answers[($i-1).'_'.($j-1)] : '' ?>">
                                            </td>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                        </table>
                        <button id="verifyButton" class="btn btn-verify mt-3" <?= !isset($saved_gametes) ? 'disabled' : '' ?>>
                            Verifikasi Jawaban
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    const BASE_URL = '<?= base_url() ?>';
    const CURRENT_LEVEL = <?= $current_level ?>;
</script>
<script src="<?= base_url('assets/js/game/level2-init.js') ?>"></script>
<script src="<?= base_url('assets/js/game/level2-validation.js') ?>"></script>
<script src="<?= base_url('assets/js/game/level2-interactions.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/game/level2.css') ?>"> 