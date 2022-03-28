import $ from 'jquery';
import { b64_decode_unicode, b64_encode_unicode, FlexPages } from './finder';
import { isEnabled, getCookie, setCookie } from 'tiny-cookie';
import getFilters from '../utils/get-filters';

const container = document.querySelector('#pages-content-wrapper');

export const getStore = () => {
    if (!isEnabled) {
        return '';
    }

    return JSON.parse(b64_decode_unicode(getCookie('grav-admin-flexpages') || 'e30='));
};

export const setStore = (store = {}, options = { expires: '1Y', samesite: 'Lax' }) => {
    if (!isEnabled) {
        return '';
    }

    return setCookie('grav-admin-flexpages', b64_encode_unicode(JSON.stringify(store)), options);
};

export const getInitialRoute = () => {
    const parsed = getStore();
    return parsed.route || '';
};

export const setInitialRoute = ({ route = '', filters = getStore().filters || {}, options = { expires: '1Y' }} = {}) => {
    return setStore({ route, filters }, options);
};

export let FlexPagesInstance = null;

export const ReLoad = (fresh = false) => {
    const search = document.querySelector('#pages-filters [name="filters[search]"]');
    const loader = container.querySelector('.grav-loading');
    const content = container.querySelector('#pages-columns');
    const gravConfig = typeof global.GravConfig !== 'undefined' ? global.GravConfig : global.GravAdmin.config;

    if (fresh && search) {
        search.focus();
    }

    if (loader && content) {
        loader.style.display = 'block';
        content.innerHTML = '';

        const filters = fresh ? getStore().filters || {} : getFilters();
        const withFilters = Object.keys(filters).length ? { ...filters, initial: true } : {};

        const store = getStore();
        store.filters = filters;
        setStore(store);

        let isSearchFocused = false;
        if (search) {
            isSearchFocused = search === document.activeElement;
        }

        const contentWrapper = document.querySelector('.content-wrapper .gm-scroll-view');
        const scrollPosition = {
            top: contentWrapper ? contentWrapper.scrollTop : 0,
            left: contentWrapper ? contentWrapper.scrollLeft : 0
        };

        $.ajax({
            url: `${gravConfig.current_url}`,
            method: 'post',
            data: Object.assign({}, {
                route: b64_encode_unicode(getInitialRoute()),
                initial: true,
                action: 'listLevel'
            }, withFilters),
            success(response) {
                loader.style.display = 'none';

                if (response.status === 'error') {
                    content.innerHTML = response.message;
                    return true;
                }

                FlexPagesInstance = null;
                FlexPagesInstance = new FlexPages(content, response.data);

                if (search && isSearchFocused) {
                    search.focus();
                }

                if (contentWrapper) {
                    contentWrapper.scrollTo(scrollPosition);
                }

                return FlexPagesInstance;
            }
        });
    }
};

if (container) {
    ReLoad(true);
}
