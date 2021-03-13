import $ from 'jquery';

if (window.sessionStorage.getItem('search-value')) {
    $(document.body).removeClass('searchbox-hidden');
    $('[data-search-input]').val(sessionStorage.getItem('search-value')).trigger('input');
}

// allow keyboard control for prev/next links
$(document).on('click', '.nav-prev, .nav-next', (event) => {
    const target = $(event.currentTarget);
    window.location.href = target.attr('href');
});

$(document).on('keydown', (event) => {
    const item = event.which === 37 ? $('a.nav-prev') : (event.which === 39 ? $('a.nav-next') : null);
    if (item) {
        item.click();
    }
});
