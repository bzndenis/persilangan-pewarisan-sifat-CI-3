<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">Materi Pembelajaran</h2>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                 style="width: <?= ($current_step/3)*100 ?>%" 
                                 aria-valuenow="<?= ($current_step/3)*100 ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="step <?= $current_step >= 1 ? 'active' : '' ?>">
                                <span class="badge <?= $current_step >= 1 ? 'bg-primary' : 'bg-secondary' ?>">1</span>
                                <small class="d-block mt-1">Pengenalan</small>
                            </div>
                            <div class="step <?= $current_step >= 2 ? 'active' : '' ?>">
                                <span class="badge <?= $current_step >= 2 ? 'bg-primary' : 'bg-secondary' ?>">2</span>
                                <small class="d-block mt-1">Monohibrid</small>
                            </div>
                            <div class="step <?= $current_step >= 3 ? 'active' : '' ?>">
                                <span class="badge <?= $current_step >= 3 ? 'bg-primary' : 'bg-secondary' ?>">3</span>
                                <small class="d-block mt-1">Dihibrid</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Materi Content -->
                    <div class="materi-content bg-light p-4 rounded">
                        <h3><?= $materi->judul ?></h3>
                        
                        <?php if($materi->gambar): ?>
                        <div class="text-center my-4">
                            <img src="<?= base_url($materi->gambar) ?>" 
                                 class="img-fluid rounded shadow-sm" 
                                 alt="Ilustrasi <?= $materi->judul ?>"
                                 style="max-height: 400px;">
                        </div>
                        <?php endif; ?>
                        
                        <div class="materi-text">
                            <?= nl2br($materi->isi) ?>
                        </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <?php if($current_step > 1): ?>
                        <a href="<?= base_url('materi/step/'.($current_step-1)) ?>" 
                           class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                        </a>
                        <?php else: ?>
                        <div></div>
                        <?php endif; ?>
                        
                        <?php if($current_step < 3): ?>
                        <a href="<?= base_url('materi/step/'.($current_step+1)) ?>" 
                           class="btn btn-primary">
                            Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <?php else: ?>
                        <a href="<?= base_url('latihan') ?>" 
                           class="btn btn-success">
                            Mulai Latihan <i class="fas fa-check ms-2"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.materi-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.step {
    text-align: center;
    position: relative;
    flex: 1;
}

.step.active small {
    color: #0d6efd;
    font-weight: 500;
}

.badge {
    width: 25px;
    height: 25px;
    line-height: 25px;
    padding: 0;
    border-radius: 50%;
}
</style>