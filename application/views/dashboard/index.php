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
                    <h5 class="card-title">Latihan Soal</h5>
                    <p class="card-text">Uji pemahaman Anda dengan mengerjakan soal-soal latihan.</p>
                    <a href="<?= base_url('latihan'); ?>" class="btn btn-success">Mulai Latihan</a>
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
                        <div class="col-md-4">
                            <div class="progress-info">
                                <h6>Materi Selesai</h6>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="progress-info">
                                <h6>Latihan Soal</h6>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="progress-info">
                                <h6>Mini Game Level</h6>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Level 3</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 