/*=========================================================================================
		File Name: form-repeater.js
		Description: Repeat forms or form fields
		----------------------------------------------------------------------------------------
		Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
		Version: 1.0
		Author: PIXINVENT
		Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

(function (window, document, $) {
    'use strict';
    // let j = 1;
    // Default
    $('.repeater-default').repeater();

    // Custom Show / Hide Configurations
    $('.file-repeater, .contact-repeater').repeater({
        show: function () {
            $(this).slideDown();
            // $(this).attr('name', 'image' + j);
            // j++;
        },
        hide: function (remove) {
            if (confirm('Are you sure you want to remove this item?')) {
                $(this).slideUp(remove);
                // j--;
            }
        }
    });


})(window, document, jQuery);
