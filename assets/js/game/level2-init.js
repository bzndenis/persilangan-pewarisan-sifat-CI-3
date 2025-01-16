$(document).ready(function() {
    // Inisialisasi khusus level 2
    function initializeLevel2() {
        // Sembunyikan tabel Punnett dan disable tombol verifikasi awal
        $('.punnett-table').hide();
        $('#verifyButton').prop('disabled', true);

        // Load progress yang tersimpan
        gameProgress.getSavedAnswers();
    }

    // Export fungsi yang dibutuhkan
    window.level2Init = {
        initialize: initializeLevel2
    };

    // Jalankan inisialisasi
    initializeLevel2();
}); 