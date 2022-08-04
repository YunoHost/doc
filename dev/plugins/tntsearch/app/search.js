import throttle from 'lodash/throttle';
import URI from 'url-parse';
import qs from 'querystringify';
import history from './history';

export const DEFAULTS = {
    uri: '',
    limit: 20,
    snippet: 300,
    min: 3,
    search_type: 'auto',
    in_page: false,
    live_update: true,
};

const historyPush = ({ value = false, params = false } = {}) => {
    const uri = new URI(global.location.href, true);

    if (params === false) {
        delete uri.query.q;
    } else {
        uri.query.q = params;
    }

    const querystring = qs.stringify(uri.query, '?');

    history.push(`${uri.pathname}${querystring}`, {
        historyValue: value, type: 'tntsearch',
    });
};

const throttling = throttle(async ({ input, results, historyValue = false } = {}) => {
    if (!input || !results) { return false; }

    const value = historyValue || input.value.trim();
    const clear = input.nextElementSibling;
    const data = Object.assign({}, DEFAULTS, JSON.parse(input.dataset.tntsearch || '{}'));

    if (!value) {
        results.style.display = 'none';

        if (data.in_page) {
            clear.style.display = 'none';

            if (historyValue === false && data.live_update) {
                historyPush({ value });
            }
        }

        return false;
    }

    if (value.length < data.min) {
        return false;
    }

    if (data.in_page) {
        clear.style.display = '';
    }

    const params = {
        q: encodeURIComponent(value),
        l: data.limit,
        sl: data.snippet,
        search_type: data.search_type,
        ajax: true,
    };

    const startEvent = new Event('tntsearch:start');
    const query = Object.keys(params)
        .map(k => `${k}=${params[k]}`)
        .join('&');

    input.dispatchEvent(startEvent);
    fetch(`${data.uri}?${query}`, { credentials: 'same-origin' })
        .then((response) => response.text())
        .then((response) => {
            if (data.in_page && data.live_update && !historyValue) {
                historyPush({ value, params: params.q });
            }
            return response;
        })
        .then((response) => {
            const doneEvent = new Event('tntsearch:done');
            results.style.display = '';
            results.innerHTML = response;
            input.dispatchEvent(doneEvent);

            return response;
        });

    return this;
}, 350, { leading: false });

history.listen((location) => {
    if (location.state && location.state.type === 'tntsearch') {
        location.state.input = document.querySelector('.tntsearch-field-inpage');
        location.state.results = document.querySelector('.tntsearch-results-inpage');

        if (location.state.input && location.state.results) {
            location.state.input.value = location.state.historyValue;
            throttling({ ...location.state });
        }
    }
});

export default throttling;
