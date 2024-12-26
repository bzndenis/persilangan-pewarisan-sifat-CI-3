<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card auth-card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-transparent text-center">
                    <i class="fas fa-dna dna-icon mb-3"></i>
                    <h3 class="font-weight-light">
                        <span class="text-primary">Login</span>
                    </h3>
                    <p class="text-muted">Selamat datang di Aplikasi Pembelajaran Genetika</p>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url('auth/login'); ?>" method="post">
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="username" 
                                       placeholder="Masukkan username" value="<?= set_value('username'); ?>">
                            </div>
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Masukkan password">
                            </div>
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-transparent text-center py-3">
                    <div class="small">
                        <a href="<?= base_url('auth/register'); ?>" class="text-decoration-none">
                            Belum punya akun? <span class="text-primary">Daftar sekarang!</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 