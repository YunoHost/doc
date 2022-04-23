import '../utils/indeterminate';
import './panel';
import { ReLoad } from '../columns';
import throttle from 'lodash/throttle';

document.addEventListener('click', (event) => {
    const filterType = event.target && event.target.dataset.filters;

    if (filterType === 'reset') {
        const filters = event.target.closest('#pages-filters');
        (filters.querySelectorAll('input[type="text"]') || []).forEach((input) => {
            input.value = '';
        });

        (filters.querySelectorAll('input[type="checkbox"]') || []).forEach((input) => {
            const wrapper = input.closest('.checkboxes');
            if (wrapper) {
                wrapper.classList.remove('status-checked', 'status-unchecked', 'status-indeterminate');
                wrapper.dataset._checkStatus = '0';
                wrapper.classList.add('status-unchecked');
            }

            input.indeterminate = false;
            input.checked = false;
            input.value = '';
        });

        return false;
    }

    if (filterType === 'apply') {
        ReLoad();
        return false;
    }
});

const throttledReload = throttle(() => {
    ReLoad();
}, 350, { leading: false });

document.addEventListener('input', (event) => {
    if (event.target.getAttribute && event.target.getAttribute('name') === 'filters[search]') {
        throttledReload.cancel();
        throttledReload();
    }
});
