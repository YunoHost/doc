import $ from 'jquery';

$.extend({
    highlight: function(node, re, nodeName, className) {
        if (node.nodeType === 3) {
            const match = node.data.match(re);
            if (match) {
                const highlight = document.createElement(nodeName || 'span');
                highlight.className = className || 'highlight';
                const wordNode = node.splitText(match.index);
                wordNode.splitText(match[0].length);
                const wordClone = wordNode.cloneNode(true);
                highlight.appendChild(wordClone);
                wordNode.parentNode.replaceChild(highlight, wordNode);
                return 1; // skip added node in parent
            }
        } else if ((node.nodeType === 1 && node.childNodes) && // only element nodes that have children
            !/(script|style)/i.test(node.tagName) && // ignore script and style nodes
            !(node.tagName === nodeName.toUpperCase() && node.className === className)) { // skip if already highlighted
            for (let i = 0; i < node.childNodes.length; i++) {
                i += $.highlight(node.childNodes[i], re, nodeName, className);
            }
        }
        return 0;
    }
});

$.fn.unhighlight = function(options) {
    const settings = {
        className: 'highlight',
        element: 'span'
    };

    $.extend(settings, options);

    return this.find(`${settings.element}.${settings.className}`).each(function() {
        const parent = this.parentNode;
        parent.replaceChild(this.firstChild, this);
        parent.normalize();
    }).end();
};

$.fn.highlight = function(words, options) {
    const settings = {
        className: 'highlight',
        element: 'span',
        caseSensitive: false,
        wordsOnly: false
    };

    $.extend(settings, options);

    if (!words) {
        return;
    }

    if (words.constructor === String) {
        words = [words];
    }
    words = $.grep(words, function(word) {
        return word !== '';
    });
    words = $.map(words, function(word) {
        return word.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
    });
    if (words.length === 0) {
        return this;
    }

    const flag = settings.caseSensitive ? '' : 'i';
    let pattern = `(${words.join('|')})`;
    if (settings.wordsOnly) {
        pattern = '\\b' + pattern + '\\b';
    }

    const re = new RegExp(pattern, flag);

    return this.each(function() {
        $.highlight(this, re, settings.element, settings.className);
    });
};
