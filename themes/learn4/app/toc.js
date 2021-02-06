import $ from 'jquery';

// TOC
$(document).on('click', '.toc-toggle', () => {
    $('.page-toc').toggleClass('toc-closed');
});
