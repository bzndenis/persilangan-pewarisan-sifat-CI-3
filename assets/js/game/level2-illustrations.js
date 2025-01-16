$(document).ready(function() {
    function updateFlowerIllustration(genotype) {
        const illustration = $('.flower-illustration-realtime');
        const flowerColor = illustration.find('.flower-color');
        const stemHeight = illustration.find('.stem-height');
        const genotypeText = $('.genotype-text');

        // Clear previous classes
        illustration.removeClass('purple white tall short');
        
        if (genotype) {
            // Update flower color based on R allele
            if (genotype.includes('R')) {
                flowerColor.css('background-color', '#800080');
                illustration.addClass('purple');
            } else {
                flowerColor.css('background-color', '#f8f9fa');
                flowerColor.css('border', '2px solid #dee2e6');
                illustration.addClass('white');
            }

            // Update stem height based on T allele
            if (genotype.includes('T')) {
                stemHeight.css('height', '100px');
                illustration.addClass('tall');
            } else {
                stemHeight.css('height', '50px');
                illustration.addClass('short');
            }

            genotypeText.text(genotype);
        } else {
            // Reset illustration
            flowerColor.css('background-color', '');
            flowerColor.css('border', '');
            stemHeight.css('height', '');
            genotypeText.text('');
        }
    }

    // Listen for input changes
    $('.punnett-input').on('input', function() {
        const genotype = $(this).val();
        updateFlowerIllustration(genotype);
    });

    // Export function
    window.gameIllustrations = {
        updateFlowerIllustration
    };
}); 