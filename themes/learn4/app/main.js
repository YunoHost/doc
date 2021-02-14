import $ from 'jquery';
import './utils';
import './toc';
import './history';
import './search';
import './nav';

$(window).on('load', function() {
    // store this page in session
    window.sessionStorage.setItem($('body').data('url'), '1');

    // loop through the sessionStorage and see if something should be marked as visited
    for (let url in window.sessionStorage) {
        if (window.sessionStorage.getItem(url) === '1') {
            $(`[data-nav-id="${url}"]`).addClass('visited');
        }
    }

    $('.highlightable').highlight(window.sessionStorage.getItem('search-value'), { element: 'mark' });
});
