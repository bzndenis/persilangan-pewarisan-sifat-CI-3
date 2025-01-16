$(document).ready(function() {
    function updateFlowerIllustration(genotype) {
        const illustration = $('.flower-illustration-realtime');
        const genotypeText = $('.genotype-text');

        // Reset semua style dan class
        illustration.removeClass('purple white tall short');

        if (genotype && genotype.length === 4) {
            // Tampilkan ilustrasi
            illustration.show();
            
            // Update warna bunga berdasarkan alel R
            if (genotype.includes('R')) {
                illustration.addClass('purple');
            } else {
                illustration.addClass('white');
            }

            // Update tinggi batang berdasarkan alel T
            if (genotype.includes('T')) {
                illustration.addClass('tall');
            } else {
                illustration.addClass('short');
            }

            // Update teks genotipe dan fenotipe
            let phenotype = '';
            if (genotype.includes('R') && genotype.includes('T')) {
                phenotype = 'Ungu Tinggi';
            } else if (genotype.includes('R') && !genotype.includes('T')) {
                phenotype = 'Ungu Pendek';
            } else if (!genotype.includes('R') && genotype.includes('T')) {
                phenotype = 'Putih Tinggi';
            } else {
                phenotype = 'Putih Pendek';
            }

            genotypeText.html(`
                <div class="genotype">${genotype}</div>
                <div class="phenotype">${phenotype}</div>
            `);
        } else {
            // Sembunyikan ilustrasi jika tidak ada input atau input tidak valid
            illustration.hide();
            genotypeText.html(`
                <div class="genotype">____</div>
                <div class="phenotype">Masukkan genotipe</div>
            `);
        }
    }

    // Event listener untuk input
    $('.punnett-input').on('input', function() {
        const genotype = $(this).val();
        updateFlowerIllustration(genotype);
    });

    // Event listener untuk focus pada input
    $('.punnett-input').on('focus', function() {
        const genotype = $(this).val();
        updateFlowerIllustration(genotype);
    });

    // Export function
    window.gameIllustrations = {
        updateFlowerIllustration
    };
}); 