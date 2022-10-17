// Default ckeditor
CKEDITOR.replace( 'editor1', {
    startupFocus : true,
    language:'en',
    toolbarGroups: [
        {
            "name":"basicstyles",
            "groups":['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'],
        },
        {
            "name": "paragraph",
            "groups":  [ 'list', 'indent', 'align' ]
        },
        {
            "name": "insert",
            "groups": ["insert"]
        },
        {
            "name":"colors",
            "groups":["textColor","BGColor"]
        },
        { "name": 'tools', "groups": [ 'tools' ] },
        {
            "name": "styles",
            "groups": ["font","fontSize"]
        },

    ],
    removeButtons: 'Format,styles,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Flash, ShowBlocks',
    on: {
        contentDom: function( evt ) {
            // Allow custom context menu only with table elemnts.
            evt.editor.editable().on( 'contextmenu', function( contextEvent ) {
                var path = evt.editor.elementPath();

                if ( !path.contains( 'table' ) ) {
                    contextEvent.cancel();
                }
            }, null, null, 5 );
        }
    }
} );

// Inline ckeditor
CKEDITOR.disableAutoInline = true;
//init the area to be done
CKEDITOR.inline( 'area1', {
    toolbar: [
        {
            name: 'basicstyles',
            groups: ['basicstyles'],
            items: [
                'Format',
                'Bold',
                'Italic',
                'Underline'
            ]
        },
        {
            name: 'paragraph',
            groups: [
                'list',
                'indent',
                'blocks',
                'align',
                'bidi'
            ],
            items: [
                'NumberedList',
                'BulletedList',
                'JustifyLeft',
                'JustifyCenter',
                'JustifyRight',
            ]
        },
        {
            name: 'links',
            items: [
                'Link',
                'Unlink'
            ]
        },
    ],
    fillEmptyBlocks: false,
    autoParagraph: false
} );
