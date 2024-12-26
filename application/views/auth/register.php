<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card auth-card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-transparent text-center">
                    <i class="fas fa-dna dna-icon mb-3"></i>
                    <h3 class="font-weight-light">
                        <span class="text-primary">Register</span>
                    </h3>
                    <p class="text-muted">Bergabung dengan Aplikasi Pembelajaran Genetika</p>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url('auth/register'); ?>" method="post">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                       placeholder="Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>">
                            </div>
                            <?= form_error('nama_lengkap', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                                <input type="text" class="form-control" id="username" name="username" 
                                       placeholder="Username" value="<?= set_value('username'); ?>">
                            </div>
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Password">
                            </div>
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-check-lock"></i></span>
                                <input type="password" class="form-control" id="konfirmasi_password" 
                                       name="konfirmasi_password" placeholder="Konfirmasi Password">
                            </div>
                            <?= form_error('konfirmasi_password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                <select class="form-select" id="kelas" name="kelas">
                                    <option value="">Pilih Kelas</option>
                                    <option value="9">Kelas 9</option>
                                </select>
                            </div>
                            <?= form_error('kelas', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i> Register
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-transparent text-center py-3">
                    <div class="small">
                        <a href="<?= base_url('auth/login'); ?>" class="text-decoration-none">
                            Sudah punya akun? <span class="text-primary">Login sekarang!</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 