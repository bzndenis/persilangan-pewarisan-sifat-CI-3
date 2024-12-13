<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4">Selamat Datang, <?= $user['nama_lengkap']; ?>!</h1>
        </div>
    </div>

    <!-- Menu Utama -->
    <div class="row g-4">
        <!-- Materi -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="feature-icon bg-primary bg-gradient text-white mb-3">
                        <i class="fas fa-book fa-3x"></i>
                    </div>
                    <h5 class="card-title">Materi Pembelajaran</h5>
                    <p class="card-text">Pelajari materi tentang persilangan dan pewarisan sifat genetika.</p>
                    <a href="<?= base_url('materi'); ?>" class="btn btn-primary">Mulai Belajar</a>
                </div>
            </div>
        </div>

        <!-- Latihan Soal -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="feature-icon bg-success bg-gradient text-white mb-3">
                        <i class="fas fa-tasks fa-3x"></i>
                    </div>
                    <h5 class="card-title">Contoh Soal</h5>
                    <p class="card-text">Uji pemahaman Anda dengan mengerjakan soal-soal latihan.</p>
                    <a href="<?= base_url('latihan'); ?>" class="btn btn-success">Lihat Contoh Soal</a>
                </div>
            </div>
        </div>

        <!-- Mini Game -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="feature-icon bg-warning bg-gradient text-white mb-3">
                        <i class="fas fa-gamepad fa-3x"></i>
                    </div>
                    <h5 class="card-title">Mini Game</h5>
                    <p class="card-text">Bermain sambil belajar dengan game persilangan genetika.</p>
                    <a href="<?= base_url('game'); ?>" class="btn btn-warning">Main Game</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Belajar -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Progress Belajar</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Progress Materi -->
                        <div class="col-md-4">
                            <div class="progress-info">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0">Materi Selesai</h6>
                                    <span class="text-sm"><?= round(($user['materi_selesai']/3)*100) ?>%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" 
                                         style="width: <?= round(($user['materi_selesai']/3)*100) ?>%" 
                                         aria-valuenow="<?= round(($user['materi_selesai']/3)*100) ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">
                                    <?= $user['materi_selesai'] ?> dari 3 materi selesai
                                </small>
                            </div>
                        </div>

                        <!-- Progress Latihan -->
                        <div class="col-md-4">
                            <div class="progress-info">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0">Contoh Soal</h6>
                                    <span class="text-sm"><?= round(($user['latihan_selesai']/2)*100) ?>%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: <?= round(($user['latihan_selesai']/2)*100) ?>%" 
                                         aria-valuenow="<?= round(($user['latihan_selesai']/2)*100) ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">
                                    <?= $user['latihan_selesai'] ?> dari 2 soal selesai
                                </small>
                            </div>
                        </div>

                        <!-- Progress Mini Game -->
                        <div class="col-md-4">
                            <div class="progress-info">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0">Mini Game</h6>
                                    <span class="text-sm">Level <?= $user['minigame_level'] ?></span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" 
                                         style="width: <?= round(($user['minigame_level']/5)*100) ?>%" 
                                         aria-valuenow="<?= round(($user['minigame_level']/5)*100) ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">
                                    Level <?= $user['minigame_level'] ?> dari 5 level
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-3">
                                <?php if($user['materi_selesai'] < 3): ?>
                                <a href="<?= base_url('materi') ?>" class="btn btn-primary">
                                    <i class="fas fa-book me-2"></i>Lanjutkan Belajar
                                </a>
                                <?php elseif($user['latihan_selesai'] < 2): ?>
                                <a href="<?= base_url('latihan') ?>" class="btn btn-success">
                                    <i class="fas fa-tasks me-2"></i>Contoh Soal
                                </a>
                                <?php else: ?>
                                <a href="<?= base_url('game') ?>" class="btn btn-warning">
                                    <i class="fas fa-gamepad me-2"></i>Main Game
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.progress {
    height: 8px;
    border-radius: 4px;
    background-color: #e9ecef;
    margin-bottom: 0.5rem;
}

.progress-bar {
    border-radius: 4px;
}

.progress-info {
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.progress-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.btn {
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style> 