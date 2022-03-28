import $ from 'jquery';

const attachToggleables = (form) => {
    form = $(form);
    let query = '[data-grav-field="toggleable"] input[type="checkbox"]';

    form.on('change', query, (event) => {
        let toggle = $(event.target);
        let enabled = toggle.is(':checked');
        let parent = toggle.closest('.form-field');
        let label = parent.find('label.toggleable');
        let fields = parent.find('.form-data');
        let inputs = fields.find('input, select, textarea, button');

        label.add(fields).css('opacity', enabled ? '' : 0.7);
        inputs.map((index, input) => {
            let isSelectize = input.selectize;
            input = $(input);

            if (isSelectize) {
                isSelectize[enabled ? 'enable' : 'disable']();
            } else {
                input.prop('disabled', !enabled);
            }
        });
    });

    form.find(query).trigger('change');
};

const attachDisabledFields = (form) => {
    form = $(form);
    let prefix = '.form-field-toggleable .form-data';
    let query = [];

    ['input', 'select', 'label[for]', 'textarea', '.selectize-control'].forEach((item) => {
        query.push(`${prefix} ${item}`);
    });

    form.on('mousedown', query.join(', '), (event) => {
        let input = $(event.target);
        let isFor = input.prop('for');
        let isSelectize = (input.hasClass('selectize-control') || input.parents('.selectize-control')).length;

        if (isFor) { input = $(`[id="${isFor}"]`); }
        if (isSelectize) { input = input.closest('.selectize-control').siblings('select[name]'); }

        if (!input.prop('disabled')) { return true; }

        let toggle = input.closest('.form-field').find('[data-grav-field="toggleable"] input[type="checkbox"]');
        toggle.trigger('click');
    });
};

/*
const submitUncheckedFields = (forms) => {
    forms = $(forms);
    let submitted = false;
    forms.each((index, form) => {
        form = $(form);
        form.on('submit', () => {
            // workaround for MS Edge, submitting multiple forms at the same time
            if (submitted) { return false; }

            let formId = form.attr('id');
            let unchecked = form.find('input[type="checkbox"]:not(:checked):not(:disabled)');
            let submit = form.find('[type="submit"]').add(`[form="${formId}"][type="submit"]`);

            if (!unchecked.length) { return true; }

            submit.addClass('pointer-events-disabled');
            unchecked.each((index, element) => {
                element = $(element);
                let name = element.prop('name');
                let fake = $(`<input type="hidden" name="${name}" value="0" />`);
                form.append(fake);
            });
            submitted = true;
            return true;
        });
    });
};
*/

$(document).ready(() => {
    const forms = $('form').filter((form) => $(form).find('[name="__form-name__"]'));
    if (!forms.length) { return; }

    forms.each((index, form) => {
        attachToggleables(form);
        attachDisabledFields(form);
        // submitUncheckedFields(form);
    });
});
