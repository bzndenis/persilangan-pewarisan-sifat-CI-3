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
                                    <span class="text-sm"><?= round(($user['minigame_progress']/17)*100) ?>%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" 
                                         style="width: <?= round(($user['minigame_progress']/17)*100) ?>%" 
                                         aria-valuenow="<?= round(($user['minigame_progress']/17)*100) ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">
                                    <?= $user['minigame_progress'] ?> dari 17 jawaban benar
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

    <!-- Leaderboard -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Leaderboard Pembelajar</h5>
                </div>
                <div class="card-body">
                    <!-- Tambahkan form pencarian -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="<?= base_url('dashboard') ?>" method="GET" class="search-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Cari nama pembelajar..." 
                                           value="<?= $this->input->get('search') ?>">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <?php if($this->input->get('search')): ?>
                                        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Nama</th>
                                    <th>Materi Selesai</th>
                                    <th>Contoh Soal Selesai</th>
                                    <th>Progress Game</th>
                                    <th>Total Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $rank = 1;
                                foreach($leaderboard as $user): 
                                    $total_score = ($user->materi_selesai * 30) + 
                                                   ($user->latihan_selesai * 20) + 
                                                   ($user->minigame_progress * 10);
                                    
                                    // Hitung skor maksimal
                                    $max_score = (3 * 30) + (2 * 20) + (17 * 10); // 3 materi, 2 latihan, 17 game
                                    $is_perfect = $total_score == $max_score;
                                ?>
                                <tr <?= ($user->user_id == $this->session->userdata('id')) ? 'class="table-primary"' : ''; ?>>
                                    <td>
                                        <?php if($rank <= 3): ?>
                                            <i class="fas fa-trophy text-<?= ($rank == 1) ? 'warning' : (($rank == 2) ? 'secondary' : 'bronze') ?>"></i>
                                        <?php else: ?>
                                            <?= $rank ?>
                                        <?php endif; ?>
                                        
                                        <?php if($is_perfect): ?>
                                            <i class="fas fa-crown text-warning ms-1" data-bs-toggle="tooltip" title="Skor Sempurna"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= $user->nama_lengkap ?>
                                        <?php if($is_perfect): ?>
                                            <span class="badge bg-warning text-dark ms-2">Perfect Score!</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-primary" role="progressbar" 
                                                 style="width: <?= ($user->materi_selesai/3)*100 ?>%" 
                                                 aria-valuenow="<?= $user->materi_selesai ?>" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="3">
                                                <?= $user->materi_selesai ?>/3
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                 style="width: <?= ($user->latihan_selesai/2)*100 ?>%" 
                                                 aria-valuenow="<?= $user->latihan_selesai ?>" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="2">
                                                <?= $user->latihan_selesai ?>/2
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-warning" role="progressbar" 
                                                 style="width: <?= ($user->minigame_progress/17)*100 ?>%" 
                                                 aria-valuenow="<?= $user->minigame_progress ?>" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="17">
                                                <?= $user->minigame_progress ?>/17
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong><?= $total_score ?></strong></td>
                                </tr>
                                <?php 
                                $rank++;
                                endforeach; 
                                ?>
                            </tbody>
                        </table>
                        
                        <!-- Tambahkan pagination di bawah table -->
                        <div class="mt-4">
                            <?php echo $pagination; ?>
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

.text-bronze {
    color: #cd7f32;
}

.pagination {
    margin-bottom: 0;
}

.page-link {
    color: #333;
    border: none;
    padding: 0.5rem 1rem;
    margin: 0 2px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.page-link:hover {
    background-color: #f8f9fa;
    color: #000;
    transform: translateY(-2px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: transparent;
}

.fa-crown {
    animation: shine 1.5s infinite;
}

@keyframes shine {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.8;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

.search-form .input-group {
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    border-radius: 8px;
    overflow: hidden;
}

.search-form .form-control {
    border: 1px solid #e9ecef;
    border-right: none;
    padding: 0.75rem 1rem;
}

.search-form .form-control:focus {
    box-shadow: none;
    border-color: #007bff;
}

.search-form .btn {
    padding: 0.75rem 1.5rem;
    border: none;
}

.search-form .btn-secondary {
    background-color: #6c757d;
}

.search-form .btn:hover {
    transform: none;
}
</style>

<!-- Tambahkan script untuk mengaktifkan tooltip Bootstrap -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script> 