import $ from 'jquery';

// History
$(document).on('click', '[data-clear-history-toggle]', (event) => {
    event.preventDefault();

    window.sessionStorage.clear();
    window.location.reload();
});
