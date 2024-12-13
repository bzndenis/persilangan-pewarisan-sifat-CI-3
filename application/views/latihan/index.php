<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Contoh Soal Persilangan Pewarisan Sifat</h4>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: <?= ($current_step / 2) * 100 ?>%"
                                aria-valuenow="<?= ($current_step / 2) * 100 ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="step <?= $current_step >= 1 ? 'active' : '' ?>">
                                <span class="badge <?= $current_step >= 1 ? 'bg-primary' : 'bg-secondary' ?>">1</span>
                                <small class="d-block mt-1">Soal Pertama</small>
                            </div>
                            <div class="step <?= $current_step >= 2 ? 'active' : '' ?>">
                                <span class="badge <?= $current_step >= 2 ? 'bg-primary' : 'bg-secondary' ?>">2</span>
                                <small class="d-block mt-1">Soal Kedua</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="soal-container">
                        <?php foreach ($soal as $index => $s): ?>
                            <div class="soal-item mb-5 p-4 bg-light rounded <?= $index === 0 ? 'active' : '' ?>"
                                data-soal="<?= $index + 1 ?>">
                                <h5 class="mb-4"><?= ($index + 1) . ". " . $s->pertanyaan ?></h5>

                                <?php if ($s->gambar): ?>
                                    <div class="text-center my-4">
                                        <img src="<?= base_url($s->gambar) ?>" alt="Gambar Soal"
                                            class="img-fluid rounded shadow-sm">
                                    </div>
                                <?php endif; ?>

                                <div class="pilihan-jawaban">
                                    <div class="mb-3 p-3 bg-white rounded shadow-sm pilihan" data-bs-toggle="tooltip"
                                        data-bs-placement="right" onclick="pilihJawaban(this)"
                                        title="Coba Tebak Jawaban Yang Benar">
                                        <strong>A. </strong><?= $s->pilihan_a ?>
                                    </div>
                                    <div class="mb-3 p-3 bg-white rounded shadow-sm pilihan" data-bs-toggle="tooltip"
                                        data-bs-placement="right" onclick="pilihJawaban(this)"
                                        title="Coba Tebak Jawaban Yang Benar">
                                        <strong>B. </strong><?= $s->pilihan_b ?>
                                    </div>
                                    <div class="mb-3 p-3 bg-white rounded shadow-sm pilihan" data-bs-toggle="tooltip"
                                        data-bs-placement="right" onclick="pilihJawaban(this)"
                                        title="Coba Tebak Jawaban Yang Benar">
                                        <strong>C. </strong><?= $s->pilihan_c ?>
                                    </div>
                                    <div class="mb-3 p-3 bg-white rounded shadow-sm pilihan" data-bs-toggle="tooltip"
                                        data-bs-placement="right" onclick="pilihJawaban(this)"
                                        title="Coba Tebak Jawaban Yang Benar">
                                        <strong>D. </strong><?= $s->pilihan_d ?>
                                    </div>
                                </div>

                                <button class="btn btn-primary mt-4 lihat-penjelasan" data-soal-id="<?= $s->id ?>"
                                    data-jawaban-benar="<?= $s->jawaban_benar ?>" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Klik untuk melihat penjelasan">
                                    <i class="fas fa-lightbulb me-2"></i>Lihat Penjelasan
                                </button>

                                <div class="penjelasan mt-4" id="penjelasan_<?= $s->id ?>" style="display: none;">
                                    <div class="alert alert-success">
                                        <h5 class="alert-heading mb-3">Jawaban yang benar:
                                            <?= strtoupper($s->jawaban_benar) ?></h5>
                                        <hr>

                                        <div class="penjelasan-content">
                                            <?php
                                            // Memformat penjelasan dengan menambahkan styling
                                            $penjelasan = nl2br($s->penjelasan);

                                            // Menambahkan badge pada langkah-langkah
                                            $penjelasan = preg_replace(
                                                '/Langkah (\d+):/i',
                                                '<span class="badge bg-primary me-2">$1</span>',
                                                $penjelasan
                                            );

                                            // Menebalkan sub-judul
                                            $penjelasan = preg_replace(
                                                '/(Diketahui:|Ditanya:|Jawab:|Kesimpulan:)/',
                                                '<h6 class="fw-bold mt-3 mb-2">$1</h6>',
                                                $penjelasan
                                            );
                                            ?>

                                            <div class="penjelasan-text">
                                                <?= $penjelasan ?>
                                            </div>

                                            <?php if ($s->gambar_penjelasan): ?>
                                                <div class="text-center mt-3">
                                                    <img src="<?= base_url($s->gambar_penjelasan) ?>" alt="Penjelasan"
                                                        class="img-fluid rounded shadow-sm">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Tombol Navigasi -->
                        <div class="d-flex justify-content-between mt-4">
                            <?php if ($current_step > 1): ?>
                                <button class="btn btn-outline-primary" id="prevBtn">
                                    <i class="fas fa-arrow-left me-2"></i>Soal Sebelumnya
                                </button>
                            <?php else: ?>
                                <div></div>
                            <?php endif; ?>

                            <?php if ($current_step < 2): ?>
                                <button class="btn btn-primary" id="nextBtn">
                                    Soal Berikutnya<i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            <?php else: ?>
                                <a href="<?= base_url('dashboard') ?>" class="btn btn-success">
                                    Kembali ke Dashboard<i class="fas fa-home ms-2"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-steps {
        padding: 20px 0;
    }

    .steps {
        position: relative;
        max-width: 600px;
        margin: 0 auto;
    }

    .steps::after {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
        height: 2px;
        background: #e9ecef;
        z-index: 1;
    }

    .step {
        position: relative;
        z-index: 2;
        background: white;
        padding: 0 10px;
        text-align: center;
    }

    .step.active .badge {
        transform: scale(1.2);
    }

    .badge {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .pilihan-jawaban>div {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .pilihan-jawaban>div:hover {
        transform: translateX(10px);
        border-left: 4px solid #0d6efd;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .tooltip {
        font-size: 14px;
    }

    .tooltip .tooltip-inner {
        background-color: #333;
        padding: 8px 12px;
    }

    .tooltip .tooltip-arrow::before {
        border-top-color: #333;
    }

    .soal-container .soal-item {
        display: none;
    }

    .soal-container .soal-item.active {
        display: block;
    }

    .step {
        cursor: pointer;
    }

    .penjelasan-content {
        font-size: 15px;
        line-height: 1.6;
    }

    .penjelasan-text {
        padding-left: 1rem;
    }

    .penjelasan-text ul {
        list-style-type: none;
        padding-left: 1rem;
    }

    .penjelasan-text ul li:before {
        content: "•";
        color: #0d6efd;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .badge {
        font-size: 0.9em;
        padding: 0.5em 0.8em;
    }

    .alert-success {
        background-color: #f8fff9;
        border-color: #d1e7dd;
    }

    .pilihan.terpilih {
        background-color: #d4edda !important;
        border-color: #c3e6cb !important;
        color: #155724;
        transform: translateX(10px);
        border-left: 4px solid #28a745;
    }

    .pilihan.salah {
        background-color: #f8d7da !important;
        border-color: #f5c6cb !important;
        color: #721c24;
        transform: translateX(10px);
        border-left: 4px solid #dc3545;
    }

    .pilihan.benar {
        background-color: #d4edda !important;
        border-color: #c3e6cb !important;
        color: #155724;
        transform: translateX(10px);
        border-left: 4px solid #28a745;
    }

    .pilihan {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .pilihan:hover {
        transform: translateX(10px);
        border-left: 4px solid #0d6efd;
    }
</style>

<script>
    function pilihJawaban(element) {
        // Hapus kelas terpilih dari semua pilihan dalam soal yang sama
        $(element).closest('.pilihan-jawaban').find('.pilihan').removeClass('terpilih');

        // Tambahkan kelas terpilih ke pilihan yang diklik
        $(element).addClass('terpilih');
    }

    $(document).ready(function () {
        // Inisialisasi tooltip Bootstrap
        var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        var tooltipList = tooltipTriggerList.map(function (el) {
            return new bootstrap.Tooltip(el);
        });

        // Event untuk lihat penjelasan
        $('.lihat-penjelasan').click(function () {
            var soalId = $(this).data('soal-id');
            var penjelasanDiv = $('#penjelasan_' + soalId);
            var button = $(this);
            var pilihanTerpilih = $(this).closest('.soal-item').find('.pilihan.terpilih');
            var jawabanBenar = $(this).data('jawaban-benar').toLowerCase();

            // Hapus kelas benar/salah yang mungkin ada sebelumnya
            $(this).closest('.soal-item').find('.pilihan').removeClass('benar salah');

            if (pilihanTerpilih.length > 0) {
                var pilihanIndex = pilihanTerpilih.index();
                var pilihanHuruf = String.fromCharCode(65 + pilihanIndex);

                if (pilihanHuruf.toLowerCase() !== jawabanBenar) {
                    pilihanTerpilih.removeClass('terpilih').addClass('salah');
                }

                var jawabanBenarIndex = jawabanBenar.toUpperCase().charCodeAt(0) - 65;
                $(this).closest('.soal-item').find('.pilihan').eq(jawabanBenarIndex).addClass('benar');
            }

            if (penjelasanDiv.is(':hidden')) {
                $('.penjelasan').slideUp();
                penjelasanDiv.slideDown();
                button.html('<i class="fas fa-times me-2"></i>Sembunyikan Penjelasan')
                    .removeClass('btn-primary').addClass('btn-danger');
            } else {
                penjelasanDiv.slideUp();
                button.html('<i class="fas fa-lightbulb me-2"></i>Lihat Penjelasan')
                    .removeClass('btn-danger').addClass('btn-primary');
            }
        });

        // Event untuk navigasi
        $('#nextBtn').click(function () {
            window.location.href = '<?= base_url("latihan/step/2") ?>';
        });

        $('#prevBtn').click(function () {
            window.location.href = '<?= base_url("latihan/step/1") ?>';
        });
    });
</script>