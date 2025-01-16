$(document).ready(function() {
    // Fungsi validasi khusus level 2
    function validateLevel2Answers(answers) {
        $.ajax({
            url: BASE_URL + 'game/verify_answer',
            type: 'POST',
            data: {
                answers: answers,
                level: CURRENT_LEVEL
            },
            success: function(response) {
                // Handle response
                handleValidationResponse(response);
            }
        });
    }

    // Export fungsi
    window.level2Validation = {
        validate: validateLevel2Answers
    };
}); 