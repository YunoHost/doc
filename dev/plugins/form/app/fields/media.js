import $ from 'jquery';
import FilesField from './file';
import { config, translations } from 'grav-form';
import Sortable from 'sortablejs';

const template = `
    <div class="dz-preview dz-file-preview">
      <div class="dz-details">
        <div class="dz-filename"><span data-dz-name></span></div>
        <div class="dz-size" data-dz-size></div>
        <img data-dz-thumbnail />
      </div>
      <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
      <div class="dz-success-mark"><span>✔</span></div>
      <div class="dz-error-mark"><span>✘</span></div>
      <div class="dz-error-message"><span data-dz-errormessage></span></div>
      <a class="dz-remove" title="${translations.PLUGIN_FORM.DELETE}" href="javascript:undefined;" data-dz-remove>${translations.PLUGIN_FORM.DELETE}</a>
    </div>`.trim();

export default class PageMedia extends FilesField {
    constructor({ container = '#grav-dropzone', options = {} } = {}) {
        const previewTemplate = $('#dropzone-media-template').html() || template;
        options = Object.assign(options, { previewTemplate });
        super({ container, options });
        if (!this.container.length) { return; }

        this.urls = {
            fetch: `${this.container.data('media-url')}/task${config.param_sep}listmedia`,
            add: `${this.container.data('media-url')}/task${config.param_sep}addmedia`,
            delete: `${this.container.data('media-url')}/task${config.param_sep}delmedia`
        };

        this.dropzone.options.url = this.urls.add;

        if (typeof this.options.fetchMedia === 'undefined' || this.options.fetchMedia) {
            this.fetchMedia();
        }

        const field = $(`[name="${this.container.data('dropzone-field')}"]`);

        if (field.length) {
            this.sortable = new Sortable(this.container.get(0), {
                animation: 150,
                // forceFallback: true,
                setData: (dataTransfer, target) => {
                    target = $(target);
                    this.dropzone.disable();
                    target.addClass('hide-backface');
                    dataTransfer.effectAllowed = 'copy';
                },
                onSort: () => {
                    let names = [];
                    this.container.find('[data-dz-name]').each((index, file) => {
                        file = $(file);
                        const name = file.text().trim();
                        names.push(name);
                    });

                    field.val(names.join(','));
                }
            });
        }
    }

    onDropzoneRemovedFile(file, ...extra) {
        if (!file.accepted || file.rejected) { return; }
        const form = this.container.closest('form');
        const unique_id = form.find('[name="__unique_form_id__"]');
        let url = file.removeUrl || this.urls.delete || `${location.href}.json`;
        let path = (url || '').match(/path:(.*)\//);
        let data = new FormData();

        data.append('filename', file.name);
        data.append('__form-name__', form.find('[name="__form-name__"]').val());
        if (unique_id.length) {
            data.append('__unique_form_id__', unique_id.val());
        }
        data.append('name', this.options.dotNotation);
        data.append('form-nonce', config.form_nonce);

        if (file.sessionParams) {
            data.append('__form-file-remover__', '1');
            data.append('session', file.sessionParams);
        }

        $.ajax({
            url,
            data,
            method: 'POST',
            contentType: false,
            processData: false,
            success: () => {
                if (!path) { return; }

                path = global.atob(path[1]);
                let input = this.container.find('[name][type="hidden"]');
                let data = JSON.parse(input.val() || '{}');
                delete data[path];
                input.val(JSON.stringify(data));
            }
        });
    }

    fetchMedia() {
        const order = this.container.closest('.form-field').find('[name="data[header][media_order]"]').val();
        const data = { order };
        let url = this.urls.fetch;

        $.ajax({
            url,
            method: 'POST',
            data,
            success: (response) => {
                if (typeof response === 'string' || response instanceof String) {
                    return false;
                }

                response = response.results;
                Object.keys(response).forEach((name) => {
                    let data = response[name];
                    let mock = { name, size: data.size, accepted: true, extras: data };

                    this.dropzone.files.push(mock);
                    this.dropzone.options.addedfile.call(this.dropzone, mock);
                    this.dropzone.options.thumbnail.call(this.dropzone, mock, data.url);
                });

                this.container.find('.dz-preview').prop('draggable', 'true');
            }
        });

        /*
        request(url, { method: 'post', body }, (response) => {
            let results = response.results;

            Object.keys(results).forEach((name) => {
                let data = results[name];
                let mock = { name, size: data.size, accepted: true, extras: data };

                this.dropzone.files.push(mock);
                this.dropzone.options.addedfile.call(this.dropzone, mock);
                this.dropzone.options.thumbnail.call(this.dropzone, mock, data.url);
            });

            this.container.find('.dz-preview').prop('draggable', 'true');
        });*/
    }

    onDropzoneSending(file, xhr, formData) {
        /*
        // Cannot call super because Safari and IE API don't implement `delete`
        super.onDropzoneSending(file, xhr, formData);
        formData.delete('task');
        */

        formData.append('name', this.options.dotNotation);
        formData.append('admin-nonce', config.admin_nonce);
    }

    onDropzoneComplete(file) {
        super.onDropzoneComplete(file);
        this.sortable.options.onSort();

        // accepted
        $('.dz-preview').prop('draggable', 'true');
    }

    // onDropzoneRemovedFile(file, ...extra) {
    //     super.onDropzoneRemovedFile(file, ...extra);
    //     this.sortable.options.onSort();
    // }
}

export let Instance = new PageMedia();
