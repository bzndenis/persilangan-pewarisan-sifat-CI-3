$(document).ready(function() {
    // Fungsi untuk mengupdate ilustrasi
    function updateIllustration(genotype) {
        const illustration = $('.pea-illustration-realtime');
        const genotypeText = $('.genotype-text');
        
        // Reset classes
        illustration.removeClass('round wrinkled yellow green');
        illustration.find('.wrinkle-pattern').remove();
        
        if (genotype) {
            // Validasi format genotype
            if (genotype.length !== 4) {
                genotypeText.text('Format tidak valid');
                return;
            }

            let phenotype = '';
            
            // Tentukan fenotipe
            if (['BBKK', 'BBKk', 'BbKK', 'BbKk'].includes(genotype)) {
                illustration.addClass('round yellow');
                phenotype = 'Bulat Kuning';
            } else if (['BBkk', 'Bbkk'].includes(genotype)) {
                illustration.addClass('round green');
                phenotype = 'Bulat Hijau';
            } else if (['bbKK', 'bbKk'].includes(genotype)) {
                illustration.addClass('wrinkled yellow');
                illustration.append('<div class="wrinkle-pattern"></div>');
                phenotype = 'Keriput Kuning';
            } else if (genotype === 'bbkk') {
                illustration.addClass('wrinkled green');
                illustration.append('<div class="wrinkle-pattern"></div>');
                phenotype = 'Keriput Hijau';
            }

            // Tambahkan kelas dan style yang diperlukan
            illustration.addClass('pea-illustration');
            illustration.css({
                'width': '120px',
                'height': '120px',
                'display': 'block',
                'margin': '0 auto',
                'position': 'relative'
            });
            
            // Update text
            genotypeText.html(`
                <div class="genotype">${genotype}</div>
                <div class="phenotype">${phenotype}</div>
            `);
            
            // Tambahkan animasi
            illustration.css('transform', 'scale(1.05)');
            setTimeout(() => {
                illustration.css('transform', 'scale(1)');
            }, 200);
        } else {
            genotypeText.html(`
                <div class="genotype">____</div>
                <div class="phenotype">Masukkan genotype</div>
            `);
        }
    }

    // Event handler untuk input Punnett
    $('.punnett-input').on('input', function() {
        const value = $(this).val().trim();
        
        if (value.length === 4) {
            updateIllustration(value);
            $('.punnett-input').removeClass('active-input');
            $(this).addClass('active-input');
        } else {
            updateIllustration(null);
        }
    });
    
    // Event handler untuk focus pada input
    $('.punnett-input').on('focus', function() {
        const value = $(this).val().trim();
        $('.punnett-input').removeClass('active-input');
        $(this).addClass('active-input');
        if (value.length === 4) {
            updateIllustration(value);
        }
    });

    // Export fungsi yang dibutuhkan
    window.gameIllustrations = {
        updateIllustration: updateIllustration
    };
}); 