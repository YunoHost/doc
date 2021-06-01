import $ from 'jquery';

let ajax;
$(document).on('input', '[data-search-input]', (event) => {
    const target = $(event.currentTarget);
    const value = target.val();
    const items = $('[data-nav-id]');

    items.removeClass('search-match');

    const topics = $('ul.topics');
    const highlightable = $('.highlightable');
    if (!value.length) {
        topics.removeClass('searched');
        items.css('display', 'block');
        window.sessionStorage.removeItem('search-value');

        highlightable.unhighlight({ element: 'mark' });

        return;
    }

    window.sessionStorage.setItem('search-value', value);
    highlightable.unhighlight({ element: 'mark' }).highlight(value, { element: 'mark' });

    if (ajax && ajax.abort) {
        ajax.abort();
    }

    ajax = $.ajax({
        url: `${target.data('search-input')}:${value}`
    }).done((data) => {
        if (data && data.results && data.results.length) {
            items.css('display', 'none');
            topics.addClass('searched');
            data.results.forEach((item) => {
                const navItem = $(`[data-nav-id="${item}"]`);
                navItem.css('display', 'block').addClass('search-match');
                navItem.parents('li').css('display', 'block');
            });
        }
    });
});

$(document).on('click', '[data-search-clear]', () => {
    $('[data-search-input]').val('').trigger('input');
    window.sessionStorage.removeItem('search-input');
    $('.highlightable').unhighlight({ element: 'mark' });
});
