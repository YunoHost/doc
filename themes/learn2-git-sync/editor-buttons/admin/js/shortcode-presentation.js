(function($){
    $(function(){
        $('body').on('grav-editor-ready', function() {
            var Instance = Grav.default.Forms.Fields.EditorField.Instance;
            Instance.addButton({
              'shortcodes-presentation': {
                identifier: 'shortcodes-presentation',
                title: 'Presentation',
                label: '<i class="fa fa-file-powerpoint-o"></i>',
                modes: ['gfm', 'markdown'],
                action: function(_ref) {
                    var codemirror = _ref.codemirror, button = _ref.button;
                    button.on('click.editor.shortcodes-presentation', function() {
                      Instance.buttonStrategies.replaceSelections({ token: '$1', template: '[presentation="presentations/"]$1', codemirror: codemirror});
                      codemirror.setCursor(codemirror.getCursor().line,codemirror.getCursor().ch-2);
                    });
                }
              }
            });
        });
    });
})(jQuery);
