/**
 * (c) Trilby Media, LLC
 * Author Djamil Legato
 *
 * Based on Mark Matyas's Finderjs
 * MIT License
 */

import $ from 'jquery';
import EventEmitter from 'eventemitter3';

export const DEFAULTS = {
    labelKey: 'name',
    valueKey: 'value', // new
    childKey: 'children',
    iconKey: 'icon', // new
    itemKey: 'item-key', // new
    itemTrigger: null,
    pathBar: true,
    className: {
        container: 'fjs-container',
        pathBar: 'fjs-path-bar',
        col: 'fjs-col',
        list: 'fjs-list',
        item: 'fjs-item',
        active: 'fjs-active',
        children: 'fjs-has-children',
        url: 'fjs-url',
        itemPrepend: 'fjs-item-prepend',
        itemContent: 'fjs-item-content',
        itemAppend: 'fjs-item-append'
    }
};

class Finder {
    constructor(container, data, options) {
        this.$emitter = new EventEmitter();
        this.container = $(container);
        this.data = data;

        this.config = $.extend(true, {}, DEFAULTS, options);
        this.container.off('click.finder keydown.finder');

        // dom events
        this.container.on('click.finder', this.clickEvent.bind(this));
        this.container.on('keydown.finder', this.keydownEvent.bind(this));

        // internal events
        this.$emitter.on('item-selected', this.itemSelected.bind(this));
        this.$emitter.on('create-column', this.addColumn.bind(this));
        this.$emitter.on('navigate', this.navigate.bind(this));
        this.$emitter.on('go-to', this.goTo.bind(this, this.data));

        this.container.addClass(this.config.className.container).attr('tabindex', 0);

        this.createColumn(this.data);

        if (this.config.pathBar) {
            this.pathBar = this.createPathBar();
            this.pathBar.on('click.finder', '[data-breadcrumb-node]', (event) => {
                event.preventDefault();
                const location = $(event.currentTarget).data('breadcrumbNode');
                this.goTo(this.data, location);
            });
        }

        // '' is <Root>
        if (this.config.defaultPath || this.config.defaultPath === '') {
            this.goTo(this.data, this.config.defaultPath);
        }
    }

    reload(data = this.data) {
        this.createColumn(data);

        // '' is <Root>
        if (this.config.defaultPath || this.config.defaultPath === '') {
            this.goTo(data, this.config.defaultPath);
        }
    }

    createColumn(data, parent) {
        const callback = (data) => this.createColumn(data, parent);

        if (typeof data === 'function') {
            data.call(this, parent, callback);
        } else if (Array.isArray(data) || typeof data === 'object') {
            if (typeof data === 'object') {
                data = Array.from(data);
            }
            const list = this.config.createList || this.createList;
            const div = $('<div />');
            div.append(list.call(this, data)).addClass(this.config.className.col);
            this.$emitter.emit('create-column', div);

            return div;
        } else {
            throw new Error('Unknown data type');
        }
    }

    createPathBar() {
        this.container.siblings(`.${this.config.className.pathBar}`).remove();
        const pathBar = $(`<div class="${this.config.className.pathBar}" />`);
        pathBar.insertAfter(this.container);

        return pathBar;
    }

    clickEvent(event) {
        const target = $(event.target);
        const column = target.closest(`.${this.config.className.col}`);
        const item = target.closest(`.${this.config.className.item}`);
        const prevent = target.is('[data-flexpages-prevent]') ? target : target.closest('[data-flexpages-prevent]');

        if (prevent.data('flexpagesPrevent') === undefined) {
            return true;
        }

        if (this.config.itemTrigger) {
            if (target.is(this.config.itemTrigger) || target.closest(this.config.itemTrigger).length) {
                event.stopPropagation();
                event.preventDefault();

                this.$emitter.emit('item-selected', {column, item});
            }

            return true;
        }

        event.stopPropagation();
        event.preventDefault();

        if (item.length) {
            this.$emitter.emit('item-selected', { column, item });
        }
    }

    keydownEvent(event) {
        const codes = { 37: 'left', 38: 'up', 39: 'right', 40: 'down', 13: 'enter' };

        if (event.keyCode in codes) {
            event.stopPropagation();
            event.preventDefault();

            this.$emitter.emit('navigate', {
                direction: codes[event.keyCode]
            });
        }
    }

    itemSelected(value) {
        const element = value.item;
        if (!element.length) { return false; }
        const item = element[0]._item;
        const column = value.column;
        const data = item[this.config.childKey] || this.data; // TODO: this.data for constant refresh
        const active = $(column).find(`.${this.config.className.active}`);

        if (active.length) {
            active.removeClass(this.config.className.active);
        }

        element.addClass(this.config.className.active);
        column.nextAll().remove(); // ?!?!?

        this.container[0].focus();
        window.scrollTo(window.pageXOffset, window.pageYOffset);

        this.updatePathBar();

        let newColumn;
        if (data) {
            newColumn = this.createColumn(data, item);
            this.$emitter.emit('interior-selected', item);
        } else {
            this.$emitter.emit('leaf-selected', item);
        }

        return newColumn;
    }

    addColumn(column) {
        this.container.append(column);
        this.$emitter.emit('column-created', column);
    }

    navigate(value) {
        const active = this.findLastActive();
        const direction = value.direction;
        let column;
        let item;
        let target;

        if (active) {
            item = active.item;
            column = active.column;

            if (direction === 'up' && item.prev().length) {
                target = item.prev();
            } else if (direction === 'down' && item.next().length) {
                target = item.next();
            } else if (direction === 'right' && column.next().length) {
                column = column.next();
                target = column.find(`.${this.config.className.item}`).first();
            } else if (direction === 'left' && column.prev().length) {
                column = column.prev();
                target = column.find(`.${this.config.className.active}`).first() || column.find(`.${this.config.className.item}`);
            }
        } else {
            column = this.container.find(`.${this.config.className.col}`).first();
            target = column.find(`.${this.config.className.item}`).first();
        }

        if (active && direction === 'enter') {
            const href = active.item.find('a').prop('href');
            if (href) {
                window.location = href;
            }
        }

        if (target) {
            this.$emitter.emit('item-selected', {
                column,
                item: target
            });

            if (!this.isInView(target, column, true)) {
                this.scrollToView(target[0], column[0]);
            }
        }
    }

    goTo(data, path) {
        path = Array.isArray(path) ? path : path.split('/').map(bit => bit.trim()).filter(Boolean);

        if (path.length) {
            this.container.children().remove();
        }

        if (typeof data === 'function') {
            data.call(this, null, (data) => this.selectPath(path, data));
        } else {
            this.selectPath(path, data);
        }
    }

    selectPath(path, data, column) {
        column = column || (path.length ? this.createColumn(data) : this.container.find(`> .${this.config.className.col}`));

        const current = path[0] || '';
        const children = data.find((item) => item[this.config.itemKey] === current);
        const item = column.find(`[data-fjs-item="${current}"]`).first();
        const newColumn = this.itemSelected({
            column,
            item
        });

        if (!this.isInView(item, column, true)) {
            this.scrollToView(item[0], column[0]);
        }

        path.shift();

        if (path.length && children) {
            this.selectPath(path, children[this.config.childKey], newColumn);
        }
    }

    findLastActive() {
        const active = this.container.find(`.${this.config.className.active}`);
        if (!active.length) {
            return null;
        }

        const item = active.last();
        const column = item.closest(`.${this.config.className.col}`);

        return { item, column };
    }

    createList(data) {
        const list = $('<ul />');
        const createItem = this.config.createItem || this.createItem;
        const items = data.map((item) => createItem.call(this, item));

        const fragments = items.reduce((fragment, current) => {
            fragment.appendChild(current[0] || current);

            return fragment;
        }, document.createDocumentFragment());

        list.append(fragments).addClass(this.config.className.list);

        return list;
    }

    createItem(item) {
        const listItem = $('<li />');
        const listItemClasses = [this.config.className.item];
        const link = $(`<a href="${item.href || ''}" />`);
        const createItemContent = this.config.createItemContent || this.createItemContent;
        const fragment = createItemContent.call(this, item);
        link.append(fragment)
            .attr('href', '')
            .attr('tabindex', -1);

        if (item.url) {
            link.attr('href', item.url);
            listItemClasses.push(item.className);
        }

        if (item[this.config.childKey]) {
            listItemClasses.push(this.config.className[this.config.childKey]);
        }

        listItem.addClass(listItemClasses.join(' '));
        listItem.append(link)
            .attr('data-fjs-item', item[this.config.itemKey]);

        listItem[0]._item = item;

        return listItem;
    }

    updatePathBar() {
        if (!this.config.pathBar) { return false; }

        const activeItems = this.container.find(`.${this.config.className.active}`);
        let itemKeys = '';
        this.pathBar.empty();
        activeItems.each((index, activeItem) => {
            const item = activeItem._item;
            const isLast = (index + 1) === activeItems.length;
            itemKeys += `/${item[this.config.itemKey]}`;
            this.pathBar.append(`
                <span class="breadcrumb-node ${item.icon}" ${item.type === 'dir' || item.child_count > 0 ? `data-breadcrumb-node="${itemKeys}"` : ''}>
                    <i class="${item.icon}"></i>
                    <span class="breadcrumb-node-name">${$('<div />').html(item[this.config.labelKey]).html()}</span>
                    ${!isLast ? '<i class="fa fa-fw fa-chevron-right"></i>' : ''}
                </span>
            `);
        });
    }

    getIcon(type) {
        switch (type) {
            case 'root':
                return 'fa-sitemap';
            case 'file':
                return 'fa-file-o';
            case 'dir':
            default:
                return 'fa-folder';
        }
    }

    isInView(element, container, partial) {
        if (!element.length || !container.length) {
            return true;
        }

        const containerHeight = container.height();
        const elementTop = $(element).offset().top - container.offset().top;
        const elementBottom = elementTop + $(element).height();

        const isTotal = (elementTop >= 0 && elementBottom <= containerHeight);
        const isPartial = ((elementTop < 0 && elementBottom > 0) || (elementTop > 0 && elementTop <= container.height())) && partial;

        return isTotal || isPartial;
    }

    scrollToView(element, container) {
        const top = parseInt(container.getBoundingClientRect().top, 10);
        const bot = parseInt(container.getBoundingClientRect().bottom, 10);

        const now_top = parseInt(element.getBoundingClientRect().top, 10);
        const now_bot = parseInt(element.getBoundingClientRect().bottom, 10);

        let scroll_by = 0;
        if (now_top < top) {
            scroll_by = -(top - now_top);
        } else if (now_bot > bot) {
            scroll_by = now_bot - bot;
        }

        if (scroll_by !== 0) {
            container.scrollTop += scroll_by;
        }
    }
}

export default Finder;
