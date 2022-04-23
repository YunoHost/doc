import $ from 'jquery';
import {config} from 'grav-form';

const MAX_SAFE_DELAY = 2147483647;

$(document).ready(() => {
    const keepAlive = $('[data-grav-keepalive]');

    if (keepAlive.length) {
        const timeout = config.session_timeout / 1.5 * 1000;
        setInterval(() => {
            $.ajax({
                url: `${config.base_url_relative}/task${config.param_sep}keep-alive`
            });
        }, Math.min(timeout, MAX_SAFE_DELAY));
    }
});
