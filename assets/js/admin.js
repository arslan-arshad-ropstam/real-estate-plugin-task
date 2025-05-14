jQuery(document).ready(function ($) {
    // Basic validation for admin inputs
    $('#rel_price, #rel_square_feet').on('input', function () {
        if ($(this).val() < 0) {
            $(this).val('');
            alert('Please enter a positive number.');
        }
    });
});