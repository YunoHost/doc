export default () => {
    const inputs = document.querySelectorAll('#pages-filters input[name]');
    const filters = {};
    const trackMulti = [];

    inputs.forEach((filter) => {
        if (filter.type === 'checkbox') {
            if (filter.indeterminate || filter.checked) {
                if (filter.name.match(/\[]$/)) {
                    const name = filter.name.replace(/\[]$/, '');
                    if (!filters[name]) {
                        filters[name] = [];
                    }

                    if (!trackMulti.includes(name)) {
                        trackMulti.push(name);
                    }

                    filters[name].push(filter.value);
                } else {
                    filters[filter.name] = filter.value;
                }
            }
        } else if (filter.value) {
            filters[filter.name] = filter.value;
        }
    });

    trackMulti.forEach((multi) => {
        filters[multi] = filters[multi].join(',');
    });

    return filters;
};
