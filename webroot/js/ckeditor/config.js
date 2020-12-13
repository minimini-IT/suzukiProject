/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    CKEDITOR.config.height = "300px";

    /*
     * ツールバー
     * 不要なものはコメントアウト
     */
    CKEDITOR.config.toolbar = [
        [
            "Source", 
            //"Save",
            //"NewPage",
            "Preview",
            //"Templates",
        ],
        [
            //"Cut",
            //"Copy",
            //"Paste",
            //"PasteText",
            //"PasteFromWord",
            //"Print",
            "SpellChecker",
        ],
        [
            "Undo",
            "Redo",
            "Find",
            "Replace",
            "SelectAll",
            //"RemoveFormat",
        ],
        [
            //"Form",
            //"Checkbox",
            //"Radio",
            //"TextField",
            //"Textarea",
            //"Select",
            //"Button",
            //"ImageButton",
            //"HiddenField",
        ],
        [
            "JustifyLeft",
            "JustifyCenter",
            "JustifyRight",
            "JustifyBlock",
        ],
        [
            "Bold",
            "Italic",
            "Underline",
            "Strike",
            "Subscript",
            "Superscript",
        ],
        [
            "Link",
            "Unlick",
            "Anchor",
        ],
        [
            "NumberedList",
            "BulletedList",
            "Outdent",
            "Indent",
            "Blockquote",
        ],
        [
            //"Image", kcfinderダメだった
            //"Flash",
            "Table",
            "HorizontalRule",
            "Smiley ",
            "SpecialChar ",
            "PageBreak",
        ],
        [
            "Styles",
            "Format",
            "Font",
            "FontSize",
            "TextColor",
            "BGColor",
        ],
        [
            "ShowBlocks",
        ]
    ];

    /*
     * 画像ファイルの設定
     */
    //config.filebrowserImageBrowseUrl = location.protocol + "//" + location.hostname + "/js/kcfinder/browse.php?type=images";
    //config.filebrowserImageUploadUrl = location.protocol + "//" + location.hostname + "/js/kcfinder/upload.php?type=images";

    /*
     * 画像ファイル以外の設定
     */
    //config.filebrowserBrowseUrl = location.protocol + "//" + location.hostname + "/js/kcfinder/browse.php?type=files";
    //config.filebrowserUploadUrl = location.protocol + "//" + location.hostname + "/js/kcfinder/upload.php?type=files";
    
    //config.filebrowserFlashBrowseUrl = location.protocol + "//" + location.hostname + "/js/kcfinder/browse.php?type=flash";
    //config.filebrowserFlashUploadUrl = location.protocol + "//" + location.hostname + "/js/kcfinder/upload.php?type=flash";
};
