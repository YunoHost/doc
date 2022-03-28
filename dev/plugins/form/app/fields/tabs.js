import $ from 'jquery';

$('body').on('touchstart click', '[data-tabid]', (event) => {
    event && event.stopPropagation();
    let target = $(event.currentTarget);

    const panel = $(`[id="${target.data('tabid')}"]`);

    target.siblings('[data-tabid]').removeClass('active');
    target.addClass('active');

    panel.siblings('[id]').removeClass('active');
    panel.addClass('active');
});
