<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Latihan Soal Persilangan Pewarisan Sifat</h4>
                </div>
                <div class="card-body">
                    <?php foreach($soal as $index => $s): ?>
                    <div class="soal-item mb-4">
                        <h5><?= ($index + 1) . ". " . $s->pertanyaan ?></h5>
                        
                        <?php if($s->gambar): ?>
                        <div class="text-center my-3">
                            <img src="<?= base_url($s->gambar) ?>" alt="Gambar Soal" class="img-fluid">
                        </div>
                        <?php endif; ?>
                        
                        <div class="pilihan-jawaban">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban_<?= $s->id ?>" value="a" id="jawaban_<?= $s->id ?>_a">
                                <label class="form-check-label" for="jawaban_<?= $s->id ?>_a">
                                    <?= $s->pilihan_a ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban_<?= $s->id ?>" value="b" id="jawaban_<?= $s->id ?>_b">
                                <label class="form-check-label" for="jawaban_<?= $s->id ?>_b">
                                    <?= $s->pilihan_b ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban_<?= $s->id ?>" value="c" id="jawaban_<?= $s->id ?>_c">
                                <label class="form-check-label" for="jawaban_<?= $s->id ?>_c">
                                    <?= $s->pilihan_c ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban_<?= $s->id ?>" value="d" id="jawaban_<?= $s->id ?>_d">
                                <label class="form-check-label" for="jawaban_<?= $s->id ?>_d">
                                    <?= $s->pilihan_d ?>
                                </label>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary mt-3 check-answer" data-soal-id="<?= $s->id ?>">
                            Cek Jawaban
                        </button>
                        
                        <div class="feedback mt-2" id="feedback_<?= $s->id ?>"></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.check-answer').click(function() {
        var soalId = $(this).data('soal-id');
        var jawaban = $('input[name="jawaban_' + soalId + '"]:checked').val();
        
        if(!jawaban) {
            alert('Silakan pilih jawaban terlebih dahulu!');
            return;
        }
        
        $.ajax({
            url: '<?= base_url('latihan/check') ?>',
            type: 'POST',
            data: {
                soal_id: soalId,
                jawaban: jawaban
            },
            success: function(response) {
                var result = JSON.parse(response);
                var feedback = $('#feedback_' + soalId);
                
                if(result.status === 'success') {
                    feedback.html('<div class="alert alert-success">' + result.message + '</div>');
                } else {
                    feedback.html('<div class="alert alert-danger">' + result.message + '</div>');
                }
            }
        });
    });
});
</script> 