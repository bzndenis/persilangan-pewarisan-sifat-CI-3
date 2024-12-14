<!-- Sidebar untuk Desktop -->
<div class="sidebar position-fixed top-0 start-0 bg-light d-none d-lg-block" style="width: 250px;">
    <div class="d-flex flex-column p-3">
        <a href="<?= base_url('dashboard'); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <span class="fs-4">Genetika App</span>
        </a>
        <hr>
        <div class="user-info">
            <?php if(isset($user) && is_array($user)): ?>
                <p>Selamat datang, <?= isset($user['nama_lengkap']) ? $user['nama_lengkap'] : 'Pengguna' ?></p>
                <p>Kelas: <?= isset($user['kelas']) ? $user['kelas'] : '-' ?></p>
            <?php endif; ?>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : 'link-dark'; ?>">
                    <i class="fas fa-home me-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?= base_url('materi'); ?>" class="nav-link <?= $this->uri->segment(1) == 'materi' ? 'active' : 'link-dark'; ?>">
                    <i class="fas fa-book me-2"></i>
                    Materi
                </a>
            </li>
            <li>
                <a href="<?= base_url('latihan'); ?>" class="nav-link <?= $this->uri->segment(1) == 'contoh_soal' ? 'active' : 'link-dark'; ?>">
                    <i class="fas fa-tasks me-2"></i>
                    Contoh Soal
                </a>
            </li>
            <li>
                <a href="<?= base_url('game'); ?>" class="nav-link <?= $this->uri->segment(1) == 'game' ? 'active' : 'link-dark'; ?>">
                    <i class="fas fa-gamepad me-2"></i>
                    Mini Game
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <button class="btn btn-danger" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
        </div>
    </div>
</div>

<!-- Navbar untuk Mobile -->
<nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('dashboard'); ?>">Genetika App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>" href="<?= base_url('dashboard'); ?>">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'materi' ? 'active' : ''; ?>" href="<?= base_url('materi'); ?>">
                        <i class="fas fa-book me-2"></i>Materi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'contoh_soal' ? 'active' : ''; ?>" href="<?= base_url('latihan'); ?>">
                        <i class="fas fa-tasks me-2"></i>Contoh Soal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'game' ? 'active' : ''; ?>" href="<?= base_url('game'); ?>">
                        <i class="fas fa-gamepad me-2"></i>Mini Game
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <button class="btn btn-danger" onclick="window.location.href='<?= base_url('auth/logout'); ?>'">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="content"> 