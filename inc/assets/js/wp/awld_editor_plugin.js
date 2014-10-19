/**
 * Ancient World Linked Data plugin for WordPress
 *
 * TinyMCE 4.0 editor plugin, requires WordPress 3.9 or higher
 */
(function(){
    tinymce.PluginManager.add('wp_awld_js_mce_button', function( editor, url ){
        editor.addButton( 'wp_awld_js_mce_button',{
            text: false,
            icon: 'wp-awld-js-mce-button',
            type: 'menubutton',
            menu: [
                {
                    text: 'Enhanced Link',
                    onclick: function(){
                        editor.windowManager.open({
                            title: 'Ancient World Linked Data',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textName',
                                    label: 'Text',
                                    value: tinymce.activeEditor.selection.getContent({format:'text'})
                                },
                                {
                                    type: 'textbox',
                                    name: 'hrefName',
                                    label: 'URL',
                                    value: ''
                                },
                                {
                                    type: 'listbox',
                                    name: 'typeName',
                                    label: 'Type',
                                    'values': [
                                        {text: 'Default', value: ''},
                                        {text: 'Citation', value: 'citation'},
                                        {text: 'Event', value: 'event'},
                                        {text: 'Object', value: 'object'},
                                        {text: 'Person', value: 'person'},
                                        {text: 'Place', value: 'place'},
                                        {text: 'Text', value: 'text'}
                                    ]
                                }
                            ],
                            onsubmit: function(e){
                                editor.insertContent('[awld href="' + e.data.hrefName + '" type="' + e.data.typeName + '"]' + e.data.textName + '[/awld]');
                            }
                        });
                    }
                },
                {
                    text: 'Index',
                    onclick: function(){
                        editor.insertContent('[awld_index]');
                    }
                }
            ]
        });
    });
})();

/* end of file awld_editor_plugin.js */
