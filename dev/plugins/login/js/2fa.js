(function($) {
    if (typeof window.GravForm === 'undefined') { return; }

    var config = window.GravForm.config;
    var body = $('body');

    body.on('click', '[data-2fa-regenerate]', function(event) {
        event.preventDefault();
        let element = $(this);
        let url = `${config.base_url_relative}/task${config.param_sep}login.regenerate2FASecret`;

        element.attr('disabled', 'disabled').find('> .fa').addClass('fa-spin');

        jQuery.post(url, function(response) {
            $('[data-2fa-image]').attr('src', response.image);
            $('[data-2fa-secret]').text(response.secret);
            $('[data-2fa-value]').val(response.secret);

            element.removeAttr('disabled').find('> .fa').removeClass('fa-spin');
        });
    });

    var toggleSecret = function() {
        const toggle = $('#toggle_twofa_enabled1');
        const secret = $('.twofa-secret');

        secret.css('display', toggle.is(':checked') ? 'inherit' : 'none');
        // [toggle.is(':checked') ? 'addClass' : 'removeClass']('login-show');
    };

    body.on('click', '.twofa-toggle input', toggleSecret);
    toggleSecret();

})(jQuery);
