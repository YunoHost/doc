((function($) {
    $(document).ready(function() {
        var Request, Toastr = null;
        if (typeof Grav !== 'undefined' && Grav && Grav.default && Grav.default.Utils) {
            Request = Grav.default.Utils.request;
            Toastr = Grav.default.Utils.toastr;
        }
        var indexer = $('#tntsearch-index, #admin-nav-quick-tray .tntsearch-reindex'),
            current = null, currentTray = null;
        if (!indexer.length) { return; }

        indexer.on('click', function(e) {
            e.preventDefault();
            var target = $(e.target),
                isTray = target.closest('#admin-nav-quick-tray').length,
                status = indexer.siblings('.tntsearch-status'),
                errorDetails = indexer.siblings('.tntsearch-error-details');
            current = status.clone(true);

            console.log(isTray);
            if (isTray) {
                target = target.is('i') ? target.parent() : target;
                currentTray = target.find('i').attr('class');
                target.find('i').attr('class', 'fa fa-fw fa-circle-o-notch fa-spin');
            }

            errorDetails
                .hide()
                .empty();

            status
                .removeClass('error success')
                .empty()
                .html('<i class="fa fa-circle-o-notch fa-spin" />');

            $.ajax({
                type: 'POST',
                url: GravAdmin.config.base_url_relative + '.json/task' + GravAdmin.config.param_sep + 'reindexTNTSearch',
                data: { 'admin-nonce': GravAdmin.config.admin_nonce }
            }).done(function(done) {
                if (done.status === 'success') {
                    indexer.removeClass('critical').addClass('reindex');
                    status.removeClass('error').addClass('success');
                    Toastr.success(done.message);
                } else {
                    indexer.removeClass('reindex').addClass('critical');
                    status.removeClass('success').addClass('error');
                    var error = done.message;
                    if (done.details) {
                        error += '<br />' + done.details;
                        errorDetails
                            .text(done.details)
                            .show();

                        status.replaceWith(current);
                    }

                    Toastr.error(error);
                }

                status.html(done.message);
            }).fail(function(error) {
                if (error.responseJSON && error.responseJSON.error) {
                    indexer.removeClass('reindex').addClass('critical');
                    errorDetails
                        .text(error.responseJSON.error.message)
                        .show();

                    status.replaceWith(current);
                }
            }).always(function() {
                target.find('i').attr('class', currentTray);
                current = null;
                currentTray = null;
            });
        })
    });
})(jQuery));
