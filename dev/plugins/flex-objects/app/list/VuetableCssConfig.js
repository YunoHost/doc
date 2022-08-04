export default {
    table: {
        tableClass: 'table',
        loadingClass: 'loading',
        sortableIcon: '',
        ascendingIcon: 'fa fa-fw fa-chevron-up',
        descendingIcon: 'fa fa-fw fa-chevron-down',
        ascendingClass: '',
        descendingClass: '',
        handleIcon: 'fa fa-fw fa-bars',
        renderIcon: (classes, options) => `<i class="${classes.join(' ')}"></i>`
    },
    pagination: {
        wrapperClass: 'flex-objects-pagination',
        activeClass: 'button active',
        disabledClass: 'button disabled',
        pageClass: 'button page',
        linkClass: 'button link',
        icons: {
            first: 'fa fa-fw fa-angle-double-left',
            prev: 'fa fa-fw fa-chevron-left',
            next: 'fa fa-fw fa-chevron-right',
            last: 'fa fa-fw fa-angle-double-right'
        }
    },
    paginationInfo: {
        infoClass: ''
    }
};
