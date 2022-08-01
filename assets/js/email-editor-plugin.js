var returnVal;
/*!
 * Bal - Email NewsLetter Builder Plugin
 * Author: Rufat Askerov
 * Author Uri : https://cidcode.net
 */

;
(function (factory) {
    "use strict";

    if (typeof define === 'function' && define.amd) { // AMD
        define(['jquery'], factory);
    } else if (typeof exports == "object" && typeof module == "object") { // CommonJS
        module.exports = factory(require('jquery'));
    } else { // Browser
        factory(jQuery);
    }
})(function ($, undefined) {
    "use strict";

    // -------------------------- variables -------------------------- //
    //left menu all items
    var _tabMenuItems = {
        //elements tab
        'typography': {
            itemSelector: 'typography',
            parentSelector: 'tab-elements'
        },
        'media': {
            itemSelector: 'media',
            parentSelector: 'tab-elements'
        },
        'layout': {
            itemSelector: 'layout',
            parentSelector: 'tab-elements'
        },
        'button': {
            itemSelector: 'button',
            parentSelector: 'tab-elements'
        },
        'social': {
            itemSelector: 'social',
            parentSelector: 'tab-elements'
        },
        //property tab
        'background': {
            itemSelector: 'background',
            parentSelector: 'tab-property'
        },
        'bg-general': {
            itemSelector: 'bg-general',
            parentSelector: 'tab-property'
        },
        'color-line': {
            itemSelector: 'color-line',
            parentSelector: 'tab-property'
        },
        'border-radius': {
            itemSelector: 'border-radius',
            parentSelector: 'tab-property'
        },
        'text-style': {
            itemSelector: 'text-style',
            parentSelector: 'tab-property'
        },
        'padding': {
            itemSelector: 'padding',
            parentSelector: 'tab-property'
        },
        'youtube-frame': {
            itemSelector: 'youtube-frame',
            parentSelector: 'tab-property'
        },
        'hyperlink': {
            itemSelector: 'hyperlink',
            parentSelector: 'tab-property'
        },
        'button': {
            itemSelector: 'button',
            parentSelector: 'tab-property'
        },
        'image-settings': {
            itemSelector: 'image-settings',
            parentSelector: 'tab-property'
        },
        'social-content': {
            itemSelector: 'social-content',
            parentSelector: 'tab-property'
        }
    };


    /**
     * Using all variables in plugin
     */
    var _language = [];
    var _aceEditor, _popup_save_template, _popup_editor, _blankPageHtml, _popup_send_email, _popup_demo, _popup_load_template;
    var _this, _nav, _result, _ytbUrl, _popupImportContent, _balContentWrapper, _removeClass, videoid, _getHtml, _addClass, _popupImagesContent, _loadPageHtml, _padding, _selection, _span, _menuType, _top, _left, _contentText, _spanId, _dataId, _outputSideBar, _url, _width, _outputContent, _class, _socialRow, _socialType, _val, _menu, _value, _activeElement, _href, _html, _dataTypes, _typeArr, _arrSize, _style, _aceEditor, _parentSelector, _parent, _arrElement, _outputHtml, _settings, _tabElements, _tabProperty, _items, _contentMenu, _generatedElements, _elementsContainer, _elements, _element, _tabSelector, _menuItem, _tabMenuItem, _accordionMenuItem, _dataValue;

    var EmailBuilder = function (elem, options) {
        //Private variables
        this.elem = elem;
        this.$elem = $(elem);
        this.options = options;
        this.langArr;
    };
    EmailBuilder.prototype = {
        defaults: {
            siteBaseUrl: '',
            //global settings
            elementJsonUrl: 'elements.json',
            elementsHTML: '',
            langJsonUrl: 'lang.json',
            lang: 'en',
            loading_color1: '#3B7694',
            loading_color2: '#09181F',
            showLoading: true,

            blankPageHtmlUrl: 'template-blank-page.html',
            // when page load showing this html
            loadPageHtmlUrl: 'template-load-page.html',

            //show context menu
            showContextMenu: true,
            showContextMenu_FontFamily: true,
            showContextMenu_FontSize: true,
            showContextMenu_Bold: true,
            showContextMenu_Italic: true,
            showContextMenu_Underline: true,
            showContextMenu_Strikethrough: true,
            showContextMenu_Hyperlink: true,

            //left menu
            showElementsTab: true,
            showPropertyTab: true,
            showCollapseMenu: true,
            showBlankPageButton: true,
            showCollapseMenuinBottom: true, //btn-collapse-bottom
            showMobileView: true,

            //setting items
            showSettingsBar: true,
            showSettingsPreview: true,
            showSettingsExport: true,
            showSettingsImport: true,
            showSettingsSendMail: true,
            showSettingsSave: true,
            showSettingsLoadTemplate: true,

            //show or hide elements actions
            showRowMoveButton: true,
            showRowRemoveButton: true,
            showRowDuplicateButton: true,
            showRowCodeEditorButton: true,

            //events of settings
            onSettingsPreviewButtonClick: function (e) {},
            onSettingsExportButtonClick: function (e) {},
            onBeforeSettingsSaveButtonClick: function (e) {},
            onSettingsSaveButtonClick: function (e) {},
            onBeforeSettingsLoadTemplateButtonClick: function (e) {},
            onSettingsSendMailButtonClick: function (e) {},

            //events in modal
            onBeforeChangeImageClick: function (e) {},
            onBeforePopupSelectImageButtonClick: function (e) {},
            onBeforePopupSelectTemplateButtonClick: function (e) {},
            onPopupSaveButtonClick: function (e) {},
            onPopupSendMailButtonClick: function (e) {},
            onPopupUploadImageButtonClick: function (e) {},
            onTemplateDeleteButtonClick: function (e) {},

            //selected element events
            onBeforeRowRemoveButtonClick: function (e) {},
            onAfterRowRemoveButtonClick: function (e) {},

            onBeforeRowDuplicateButtonClick: function (e) {},
            onAfterRowDuplicateButtonClick: function (e) {},

            onBeforeRowEditorButtonClick: function (e) {},
            onAfterRowEditorButtonClick: function (e) {},

            onBeforeShowingEditorPopup: function (e) {},
            onAfterLoad: function (e) {},

            onElementDragStart: function (e) {},
            onElementDragFinished: function (e, contentHtml) {},

            onUpdateButtonClick: function (e) {}
        },
        /**
         * Init Plugin
         */
        init: function () {
            _this = this;
            _this.config = $.extend({}, this.defaults, this.options);

            //show loading
            _this.show_loading();

            $.ajax({
                url: _this.config.loadPageHtmlUrl,
                data: '',
                success: function (data) {
                    _loadPageHtml = data;
                    _this.getLangs();
                    _this.getBlankPageHtml();
                },
                error: function () {
                    console.error('Has error');
                }
            });



            return this;
        },
        /**
         * Show loading
         */
        show_loading: function () {
            if (_this.config.showLoading == true) {
                // _this.$elem.css({
                //     'position': 'relative'
                // });
                _this.display('<div class="loading-container"><div class="loading"><div class="loading-bounce-1" style="background-color:' + _this.config.loading_color1 + '"></div><div class="loading-bounce-2" style="background-color:' + _this.config.loading_color2 + '"></div></div></div>');
            }
        },
        /**
         * Generate output information
         */
        generate: function (elementsHtml) {
            _nav = '<div class="nav">' +
                '<ul class="left-menu">';
            if (_this.config.showElementsTab == true) {
                _nav += '<li class="menu-item tab-selector active" data-tab-selector="tab-elements">' +
                    '<i class="fa fa-puzzle-piece"></i>' +
                    '<span class="menu-name">' + _this.langArr.elementsTab + '</span>' +
                    '</li>';
            }

            if (_this.config.showPropertyTab == true) {
                _nav += '<li class="menu-item tab-selector" data-tab-selector="tab-property">' +
                    '<i class="fa fa-pencil"></i>' +
                    '<span class="menu-name">' + _this.langArr.propertyTab + '</span>' +
                    '</li>';
            }

            if (_this.config.showBlankPageButton == true) {
                _nav += '<li class="menu-item blank-page">' +
                    '<i class="fa fa-file"></i>' +
                    '<span class="menu-name">' + _this.langArr.blankPage + '</span>' +
                    '</li>';
            }

            if (_this.config.showCollapseMenu == true) {
                _class = '';
                if (_this.config.showCollapseMenuinBottom == true) {
                    _class = 'btn-collapse-bottom ';
                }

                _nav += '<li class="menu-item collapse ' + _class + '">' +
                    '<i class="fa fa-chevron-circle-left"></i>' +
                    '<span class="menu-name">' + _this.langArr.collapseMenu + '</span>' +
                    '</li>';
            }
            _nav += '</ul></div>';

            _settings = '';
            if (_this.config.showSettingsBar == true) {



                _settings = '<div class="settings">' +
                    '<ul>';
                if (_this.config.showSettingsPreview == true) {
                    _settings += '<li class="setting-item preview" data-toggle="tooltip" title="' + _this.langArr.settingsPreview + '">' +
                        '<i class="fa fa-eye"></i>' +
                        '</li>';
                }

                if (_this.config.showSettingsExport == true) {
                    _settings += '<li class="setting-item export" data-toggle="tooltip" title="' + _this.langArr.settingsExport + '">' +
                        '<i class="fa fa-download  "></i>' +
                        '</li>';
                }
                if (_this.config.showSettingsImport == true) {
                    _settings += '<li class="setting-item import" data-toggle="tooltip" title="' + _this.langArr.settingsImport + '">' +
                        '<i class="fa fa-upload"></i>' +
                        '</li>';
                }
                if (_this.config.showSettingsSave == true) {
                    _settings += '<li class="setting-item save-template" data-toggle="tooltip" title="' + _this.langArr.settingsSaveTemplate + '">' +
                        '<i class="fa fa-floppy-o"></i>' +
                        '</li>';
                }

                if (_this.config.showSettingsLoadTemplate == true) {
                    _settings += '<li class="setting-item load-templates" data-toggle="tooltip" title="' + _this.langArr.settingsLoadTemplate + '">' +
                        '<i class="fa fa-file-text"></i>' +
                        '</li>';
                }

                if (_this.config.showSettingsSendMail == true) {
                    _settings += '<li class="setting-item send-email" data-toggle="tooltip" title="' + _this.langArr.settingsSendMail + '">' +
                        '<i class="fa fa-envelope"></i>' +
                        '</li>';
                }
                if (_this.config.showMobileView == true) {
                    _settings += '<li class="setting-item other-devices" data-toggle="tooltip" title="" data-original-title="' + _this.langArr.setttingsMobileViewTitle + '">' +
                        '<i class="fa fa-mobile"></i>' +
                        '</li>' +
                        '<div class="setting-content">' +
                        '  <div class="setting-content-item other-devices">' +
                        '    <ul>' +
                        '    <li class="setting-device-tab mobile " data-tab="mobile-content">' +
                        '    <i class="fa fa-mobile"></i>' +
                        '    </li>' +
                        '    <li class="setting-device-tab desktop active" data-tab="desktop-content">' +
                        '    <i class="fa fa-desktop"></i>' +
                        '    </li>' +
                        '    </ul>' +
                        '    <div>' +
                        '      <div class="mobile-content setting-device-content ">' + _this.langArr.setttingsMobileViewMobileDesc + '</div>' +
                        '      <div class="desktop-content setting-device-content active">' + _this.langArr.setttingsMobileViewDesktopDesc + '</div>' +
                        '    </div>' +
                        '  </div>  ' +
                        '</div>';
                }
                /*
                 */
                _settings += '</ul></div>';
            }

            _tabElements = _this.config.elementsHTML; //'<div class="tab-elements element-tab active"><ul class="elements-accordion">' + elementsHtml + '</ul></div>';

            //  _tabProperty='<div class="tab-property element-tab"><ul class="elements-accordion"><li class="elements-accordion-item" data-type="background"><a class="elements-accordion-item-title">Background</a><div class="elements-accordion-item-content clearfix"><div id="bg-color" class="bg-color bg-item" setting-type="background-color"><i class="fa fa-adjust"></i></div><!-- <div class="bg-item bg-image" setting-type="background-image"><i class="fa fa-image"></i></div>--></div></li><li class="elements-accordion-item" data-type="padding"><a class="elements-accordion-item-title">Padding</a><div class="elements-accordion-item-content"><div class=" element-boxs clearfix "><div class="big-box col-sm-6 "><input type="text" class="form-control padding all" setting-type="padding"></div><div class="small-boxs col-sm-6"><div class="row"><input type="text" class="form-control padding number" setting-type="padding-top"></div><div class="row clearfix"><div class="col-sm-6"><input type="text" class="form-control padding number" setting-type="padding-left"></div><div class="col-sm-6"><input type="text" class="form-control padding number" setting-type="padding-right"></div></div><div class="row"><input type="text" class="form-control padding number" setting-type="padding-bottom"></div></div></div></div></li><li class="elements-accordion-item" data-type="border-radius"><a class="elements-accordion-item-title">Border Radius</a><div class="elements-accordion-item-content"><div class=" element-boxs border-radius-box clearfix "><div class="big-box col-sm-6 "><input type="text" class="form-control border-radius all" setting-type="border-radius"></div><div class="small-boxs col-sm-6"><div class="row clearfix"><div class="col-sm-6"><input type="text" class="form-control border-radius" setting-type="border-top-left-radius"></div><div class="col-sm-6"><input type="text" class="form-control border-radius" setting-type="border-top-right-radius"></div></div><div class="row clearfix margin"><div class="col-sm-6"><input type="text" class="form-control border-radius" setting-type="border-bottom-left-radius"></div><div class="col-sm-6"><input type="text" class="form-control border-radius" setting-type="border-bottom-right-radius"></div></div></div></div></div></li><li class="elements-accordion-item" data-type="text-style"><a class="elements-accordion-item-title">Text Style</a><div class="elements-accordion-item-content"><div class="element-boxs text-style-box clearfix "><div class="element-font-family col-sm-8"><select class="form-control font-family" setting-type="font-family"><option value="Arial">Arial</option><option value="Helvetica">Helvetica</option><option value="Georgia">Georgia</option><option value="Times New Roman">Times New Roman</option><option value="Verdana">Verdana</option><option value="Tahoma">Tahoma</option><option value="Calibri">Calibri</option></select></div><div class="element-font-size col-sm-4"><input type="text" name="name" class="form-control number" value="14" setting-type="font-size" /></div><div class="icon-boxs text-icons clearfix"><div class="icon-box-item fontStyle" setting-type="font-style" setting-value="italic"><i class="fa fa-italic"></i></div><div class="icon-box-item active underline " setting-type="text-decoration" setting-value="underline"><i class="fa fa-underline"></i></div><div class="icon-box-item line " setting-type="text-decoration" setting-value="line-through"><i class="fa fa-strikethrough"></i></div></div><div class="icon-boxs align-icons clearfix"><div class="icon-box-item left active"><i class="fa fa-align-left"></i></div><div class="icon-box-item center "><i class="fa fa-align-center"></i></div><div class="icon-box-item right"><i class="fa fa-align-right"></i></div></div><div class="clearfix"></div><div class="icon-boxs text-icons "><div id="text-color" class="icon-box-item text-color" setting-type="color"></div>Text Color </div><div class="icon-boxs font-icons clearfix"><div class="icon-box-item" setting-type="bold"><i class="fa fa-bold"></i></div></div></div></div></li><li class="elements-accordion-item" data-type="social-content"><a class="elements-accordion-item-title">Social content</a><div class="elements-accordion-item-content"><div class="col-sm-12 social-content-box"><div class="row" data-social-type="instagram"><label class="small-title">Instagram</label><input type="text" name="name" value="#" class="social-input" /><label class="checkbox-title"><input type="checkbox" name="name" />Show </label></div><div class="row" data-social-type="pinterest"><label class="small-title">Pinterest</label><input type="text" name="name" value="#" class="social-input" /><label class="checkbox-title"><input type="checkbox" name="name" />Show </label></div><div class="row" data-social-type="google-plus"><label class="small-title">Google+</label><input type="text" name="name" value="#" class="social-input" /><label class="checkbox-title"><input type="checkbox" name="name" checked />Show </label></div><div class="row" data-social-type="facebook"><label class="small-title">Facebook</label><input type="text" name="name" value="#" class="social-input" /><label class="checkbox-title"><input type="checkbox" name="name" checked />Show </label></div><div class="row" data-social-type="twitter"><label class="small-title">Twitter</label><input type="text" name="name" value="#" class="social-input" /><label class="checkbox-title"><input type="checkbox" name="name" checked />Show </label></div><div class="row" data-social-type="linkedin"><label class="small-title">Linkedin</label><input type="text" name="name" value="#" class="social-input" /><label class="checkbox-title"><input type="checkbox" name="name" checked />Show </label></div><div class="row" data-social-type="youtube"><label class="small-title">Youtube</label><input type="text" name="name" value="#" class="social-input" /><label class="checkbox-title"><input type="checkbox" name="name" checked />Show </label></div><div class="row" data-social-type="skype"><label class="small-title">Skype</label><input type="text" name="name" value="#" class="social-input" /><label class="checkbox-title"><input type="checkbox" name="name" checked />Show </label></div></div></div></li><li class="elements-accordion-item" data-type="youtube-frame"><a class="elements-accordion-item-title">Youtube</a><div class="elements-accordion-item-content"><div class="social-content-box "><label>Youtube Video ID</label><input type="text" class=" youtube" setting-type=""></div></div></li><li class="elements-accordion-item" data-type="hyperlink"><a class="elements-accordion-item-title">Hyperlink</a><div class="elements-accordion-item-content"><div class="social-content-box "><label>Url</label><input type="text" class="hyperlink-url" setting-type=""></div></div></li></ul></div>';
            _tabProperty = '<div class="tab-property element-tab">' +
                ' <ul class="elements-accordion">' +
                ' <li class="elements-accordion-item" data-type="bg-general">' +
                '   <a class="elements-accordion-item-title">' + _this.langArr.propertyBG + '</a>' +
                '   <div class="elements-accordion-item-content clearfix">' +
                '   <div>Outer backspaceground color :<br/><div id="bg-color-outer" class="bg-color bg-item" setting-type="background-color"> <i class="fa fa-adjust"></i> </div></div>' +
                '   <div style="margin-top:34px">Inner background color :<br/><div id="bg-color-inner" class="bg-color bg-item" setting-type="background-color"> <i class="fa fa-adjust"></i> </div></div>' +
                ' </div>' +
                ' </li>' +
                ' <li class="elements-accordion-item" data-type="color-line">' +
                '   <a class="elements-accordion-item-title">Line</a>' +
                '   <div class="elements-accordion-item-content clearfix">' +
                '   <div>Line color:<div id="color-line" class="bg-color bg-item" setting-type="background-color" style="float:unset;"> <i class="fa fa-adjust"></i> </div></div>' +
                '   <div>Line height:<div class=" element-boxs clearfix " style="height:unset">        <div class="small-boxs col-sm-6"> <div class="row">   <input type="text" class="form-control number line-height" style="height: 30px;">   </div></div> </div></div>' +
                ' </div>' +
                ' </li>' +
                ' <li class="elements-accordion-item" data-type="background">' +
                '   <a class="elements-accordion-item-title">' + _this.langArr.propertyBG + '</a>' +
                '   <div class="elements-accordion-item-content clearfix">' +
                '   <div id="bg-color" class="bg-color bg-item" setting-type="background-color"> <i class="fa fa-adjust"></i> </div>' +

                ' </div>' +
                ' </li>' +
                '   <li class="elements-accordion-item" data-type="padding">' +
                '     <a class="elements-accordion-item-title">' + _this.langArr.propertyPadding + '</a>' +
                '   <div class="elements-accordion-item-content">' +
                '     <div class=" element-boxs clearfix ">' +
                '       <div class="big-box col-sm-6 ">' +
                '         <input type="text" class="form-control padding all" setting-type="padding">' +
                '   </div>' +
                ' <div class="small-boxs col-sm-6">' +
                ' <div class="row">' +
                '   <input type="text" class="form-control padding number" setting-type="padding-top">' +
                '   </div>' +
                '   <div class="row clearfix">' +
                '     <div class="col-sm-6">' +
                '         <input type="text" class="form-control padding number" setting-type="padding-left">' +
                '   </div>' +
                '   <div class="col-sm-6">' +
                ' <input type="text" class="form-control padding number" setting-type="padding-right">' +
                ' </div>' +
                ' </div>' +
                '   <div class="row">' +
                '   <input type="text" class="form-control padding number" setting-type="padding-bottom">' +
                '   </div>' +
                '   </div>' +
                ' </div>' +
                '   </div>' +
                '   </li>' +
                '   <li class="elements-accordion-item" data-type="border-radius">' +
                '   <a class="elements-accordion-item-title">' + _this.langArr.propertyBorderRadius + '</a>' +
                '   <div class="elements-accordion-item-content">' +
                '   <div class=" element-boxs border-radius-box clearfix ">' +
                '   <div class="big-box col-sm-6 ">' +
                '     <input type="text" class="form-control border-radius all" setting-type="border-radius">' +
                '     </div>' +
                '   <div class="small-boxs col-sm-6">' +
                '     <div class="row clearfix">' +
                '   <div class="col-sm-6">' +
                '     <input type="text" class="form-control border-radius" setting-type="border-top-left-radius">' +
                '     </div>' +
                ' <div class="col-sm-6">' +
                '   <input type="text" class="form-control border-radius" setting-type="border-top-right-radius">' +
                '   </div>' +
                ' </div>' +
                '   <div class="row clearfix margin">' +
                '   <div class="col-sm-6">' +
                '   <input type="text" class="form-control border-radius" setting-type="border-bottom-left-radius">' +
                '   </div>' +
                ' <div class="col-sm-6">' +
                ' <input type="text" class="form-control border-radius" setting-type="border-bottom-right-radius">' +
                ' </div>' +
                ' </div>' +
                ' </div>' +
                ' </div>' +
                ' </div>' +
                ' </li>' +
                ' <li class="elements-accordion-item" data-type="text-style">' +
                '   <a class="elements-accordion-item-title">' + _this.langArr.propertyTextStyle + '</a>' +
                '   <div class="elements-accordion-item-content">' +
                '   <div class="element-boxs text-style-box clearfix ">' +
                '   <div class="element-font-family col-sm-8">' +
                '   <select class="form-control font-family" setting-type="font-family">' +
                '     <option value="Arial">Arial</option>' +
                '   <option value="Helvetica">Helvetica</option>' +
                ' <option value="Georgia">Georgia</option>' +
                '<option value="Times New Roman">Times New Roman</option>' +
                '<option value="Verdana">Verdana</option>' +
                '<option value="Tahoma">Tahoma</option>' +
                '<option value="Calibri">Calibri</option>' +
                '</select>' +
                '</div>' +
                '<div class="element-font-size col-sm-4">' +
                '  <input type="text" name="name" class="form-control number" value="14" setting-type="font-size" />' +
                '</div>' +
                '<div class="icon-boxs text-icons clearfix">' +
                '<div class="icon-box-item fontStyle" setting-type="font-style" setting-value="italic">' +
                '<i class="fa fa-italic"></i>' +
                '</div>' +
                '<div class="icon-box-item active underline " setting-type="text-decoration" setting-value="underline">' +
                '<i class="fa fa-underline"></i>' +
                '</div>' +
                '<div class="icon-box-item line " setting-type="text-decoration" setting-value="line-through">' +
                '  <i class="fa fa-strikethrough"></i>' +
                '</div>' +
                '</div>' +
                '<div class="icon-boxs align-icons clearfix">' +
                '<div class="icon-box-item left active">' +
                '<i class="fa fa-align-left"></i>' +
                '</div>' +
                '<div class="icon-box-item center ">' +
                '  <i class="fa fa-align-center"></i>' +
                '</div>' +
                '<div class="icon-box-item right">' +
                '  <i class="fa fa-align-right"></i>' +
                '  </div>' +
                '</div>' +
                '  <div class="clearfix"></div>' +
                '  <div class="icon-boxs text-icons ">' +
                '  <div id="text-color" class="icon-box-item text-color" setting-type="color">' +
                '  </div>' +
                '  Text Color' +
                '  </div>' +
                '<div class="icon-boxs font-icons clearfix">' +
                '<div class="icon-box-item" setting-type="bold">' +
                '<i class="fa fa-bold"></i>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '  </li>' +
                '<li class="elements-accordion-item" data-type="social-content">' +
                '  <a class="elements-accordion-item-title">' + _this.langArr.propertySocialContent + '</a>' +
                '<div class="elements-accordion-item-content">' +
                '  <div class="col-sm-12 social-content-box">' +
                '  <div class="row" data-social-type="instagram">' +
                '<label class="small-title">Instagram</label>' +
                '<input type="text" name="name" value="#" class="social-input" />' +
                '<label class="checkbox-title">' +
                '<input type="checkbox" name="name" /> Show' +
                '</label>' +
                '</div>' +
                '  <div class="row" data-social-type="pinterest">' +
                '<label class="small-title">Pinterest</label>' +
                '  <input type="text" name="name" value="#" class="social-input" />' +
                '<label class="checkbox-title">' +
                '<input type="checkbox" name="name" /> Show' +
                '  </label>' +
                '</div>' +
                '<div class="row" data-social-type="google-plus">' +
                '  <label class="small-title">Google+</label>' +
                '<input type="text" name="name" value="#" class="social-input" />' +
                '<label class="checkbox-title">' +
                '  <input type="checkbox" name="name" checked /> Show' +
                '</label>' +
                '</div>' +
                '  <div class="row" data-social-type="facebook">' +
                '  <label class="small-title">Facebook</label>' +
                '  <input type="text" name="name" value="#" class="social-input" />' +
                '<label class="checkbox-title">' +
                '<input type="checkbox" name="name" checked /> Show' +
                '</label>' +
                '</div>' +
                '  <div class="row" data-social-type="twitter">' +
                '<label class="small-title">Twitter</label>' +
                '<input type="text" name="name" value="#" class="social-input" />' +
                '<label class="checkbox-title">' +
                '  <input type="checkbox" name="name" checked /> Show' +
                '</label>' +
                '</div>' +
                '<div class="row" data-social-type="linkedin">' +
                '<label class="small-title">Linkedin</label>' +
                '<input type="text" name="name" value="#" class="social-input" />' +
                '<label class="checkbox-title">' +
                '<input type="checkbox" name="name" checked /> Show' +
                '</label>' +
                '</div>' +
                '<div class="row" data-social-type="youtube">' +
                '  <label class="small-title">Youtube</label>' +
                '  <input type="text" name="name" value="#" class="social-input" />' +
                '<label class="checkbox-title">' +
                '  <input type="checkbox" name="name" checked /> Show' +
                '  </label>' +
                '</div>' +
                '<div class="row" data-social-type="skype">' +
                '<label class="small-title">Skype</label>' +
                '  <input type="text" name="name" value="#" class="social-input" />' +
                '<label class="checkbox-title">' +
                '  <input type="checkbox" name="name" checked /> Show' +
                '</label>' +
                '</div>' +
                '</div>' +
                '  </div>' +
                '</li>' +
                '<li class="elements-accordion-item" data-type="youtube-frame">' +
                '<a class="elements-accordion-item-title">Youtube</a>' +
                '<div class="elements-accordion-item-content">' +
                '<div class="social-content-box ">' +
                '<label>Youtube Url</label>' +
                '<input type="text" class=" youtube" setting-type=""><span class="muted" style="font-size: 13px;">Example: https://www.youtube.com/watch?v=_eThAg5OrHQ</span>' +
                '</div>' +
                '</div>' +
                '</li>' +
                '  <li class="elements-accordion-item" data-type="width">' +
                '<a class="elements-accordion-item-title">' + _this.langArr.propertyEmailWidth + '</a>' +
                '<div class="elements-accordion-item-content">' +
                '  <div class="social-content-box ">' +
                '<label>Width</label>' +
                '<input type="text" class="email-width number" setting-type="">' +
                '<span class="help">' + _this.langArr.propertyEmailWidthHelp + '</span>' +
                '  </div>' +
                '</div>' +
                '</li>' +
                '<li class="elements-accordion-item" data-type="image-settings">' +
                '<a class="elements-accordion-item-title">' + _this.langArr.propertyImageSettings + '</a>' +
                '<div class="elements-accordion-item-content">' +
                '<div class="social-content-box ">' +
                '<div class="change-image">' + _this.langArr.propertyChangeImage + '</div>' +
                '<label>Image width</label>' +
                '<input type="text" class="image-width  image-size " setting-type="" >' +
                '<label>Image height</label>' +
                '<input type="text" class="image-height  image-size" setting-type="">' +
                '<label>Image URL</label>' +
                '<input type="text" class="image-url  image-size" setting-type="">' +
                '</div>' +
                '</div>' +
                '</li>' +
                '<li class="elements-accordion-item" data-type="hyperlink">' +
                '<a class="elements-accordion-item-title">' + _this.langArr.propertyHyperlink + '</a>' +
                '<div class="elements-accordion-item-content">' +
                '<div class="social-content-box ">' +
                '<label>Url</label>' +
                '<input type="text" class="hyperlink-url" setting-type="">' +
                '</div>' +
                '</div>' +
                '  </li>' +
                '<li class="elements-accordion-item" data-type="button">' +
                '<a class="elements-accordion-item-title">' + _this.langArr.propertyButton + '</a>' +
                '<div class="elements-accordion-item-content">' +
                '<div class="social-content-box ">' +
                '<label>Text</label>' +
                '<input type="text" class="button-text" setting-type="">' +
                '</div>' +
                '<div class="social-content-box ">' +
                '<label>Hyperlink</label>' +
                '<input type="text" class="button-hyperlink" setting-type="">' +
                '</div>' +
                '<div class="social-content-box ">' +
                '<label>Text color</label><br>' +
                ' <div id="button-text-color" class="bg-color bg-item" setting-type="">' +
                '   <i class="fa fa-adjust"></i>' +
                ' </div>' +
                '</div><br>' +
                '<div class="social-content-box ">' +
                '<br><label>Background color</label><br>' +
                ' <div id="button-bg-color" class="bg-color bg-item" setting-type="">' +
                '   <i class="fa fa-adjust"></i>' +
                ' </div>' +
                '</div>' +
                '<div class="social-content-box "><br><br>' +

                '<label class="checkbox-title"><input type="checkbox" name="button-full-width" checked class="button-full-width"> Full width</label>' +
                '</div>' +


                '</div>' +
                '  </li>' +
                '</ul>' +
                '</div>';
            _elementsContainer = '<div class="elements-container">' + _tabElements + _tabProperty + '</div>';
            _elements = '<div class="elements">' + _elementsContainer + _settings + '</div>';

            _outputSideBar = '<aside class="left-menu-container clearfix">' + _nav + _elements + '</aside>';



            _outputContent = '<div class="content">' +
                                '<div id="editorContent" class="content-wrapper" data-types="bg-general,padding,width">' +
                                  '<div class="content-main lg-width">' +
                                    '<div class="email-editor-elements-sortable">' +
                                        _this.helperForGenerateHTMl(_loadPageHtml) +
                                    '</div>' +
                                  '</div>' +
                                '</div>' +
                              '</div>';
            _contentMenu = '';


            _outputHtml = '<div class="editor-container clearfix"> ' + _outputSideBar + _outputContent + _contentMenu + '</div>';
            _this.generatePopups();
            _this.display(_outputHtml);


            _this.default_func();
            _this.events();

        },
        helperForGenerateHTMl:function (html) {
          var _loadTempLoad= $('<div/>');
          _loadTempLoad.html(html);
          var _contentOfLoad = '';
          _loadTempLoad.find('.main').each(function (index, item) {

              _contentOfLoad += '<div class="sortable-row">' +
                      '<div class="sortable-row-container">' +
                      ' <div class="sortable-row-actions">';

              _contentOfLoad += '<div class="row-move row-action">' +
                          '<i class="fa fa-arrows-alt"></i>' +
                          '</div>';


              _contentOfLoad += '<div class="row-remove row-action">' +
                  '<i class="fa fa-remove"></i>' +
                  '</div>';


              _contentOfLoad += '<div class="row-duplicate row-action">' +
                  '<i class="fa fa-files-o"></i>' +
                  '</div>';


              _contentOfLoad += '<div class="row-code row-action">' +
                  '<i class="fa fa-code"></i>' +
                  '</div>';

              _contentOfLoad += '</div>' +

              '<div class="sortable-row-content" >' +$('<div/>').html(item).html()+

              '</div></div></div>';

          });
          return _contentOfLoad;
        },
        /**
         * Generate popups html
         */
        generatePopups: function () {
            _popupImportContent = '<div class="modal fade popupimport" id="popupimport" role="dialog">' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">' + _this.langArr.popupImportTitle + '</h4>' +
                '</div>' +
                '<div class="modal-body">' +
                '<div class="row">' +
                '<div class="col-sm-6">' +
                '<input type="file" class="input-import-file" >' +
                '<span>-allowed only html file </span>' +
                '</div>' +

                '</div>' +

                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-success btn-import" >' + _this.langArr.popupImportUpload + '</button>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">' + _this.langArr.popupImageClose + '</button> ' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';


            jQuery(_popupImportContent).appendTo('body');

            _popupImagesContent = '<div class="modal fade popup_images" id="popup_images" role="dialog">' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">' + _this.langArr.popupImageTitle + '</h4>' +
                '</div>' +
                '<div class="modal-body">' +
                '<div class="row">' +
                '<div class="col-sm-6">' +
                '<input type="file" class="input-file" accept="image/*" >' +
                '</div>' +
                '<div class="col-sm-6">' +
                '<button class="btn-upload">' + _this.langArr.popupImageUpload + '</button>' +
                '</div>' +
                '</div>' +
                '<div class="upload-images">' +
                ' <div class="row">     ' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-success btn-select" >' + _this.langArr.popupImageOk + '</button>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">' + _this.langArr.popupImageClose + '</button> ' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';


            jQuery(_popupImagesContent).appendTo('body');

            _popup_save_template = '<div class="modal fade " id="popup_save_template" role="dialog">' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">' + _this.langArr.popupSaveTemplateTitle + '<br>' +
                '<small>' + _this.langArr.popupSaveTemplateSubTitle + '</small></h4>' +
                '</div>' +
                '<div class="modal-body">' +
                '<div class="row">' +
                '<div class="col-sm-12">' +
                '<input type="text" class="form-control template-name" placeholder="' + _this.langArr.popupSaveTemplatePLaceHolder + '"  >' +
                '<br>' +
                '<label class="input-error" style="color:red"></label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-success btn-save-template" >' + _this.langArr.popupSaveTemplateOk + '</button>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">' + _this.langArr.popupSaveTemplateClose + '</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
            jQuery(_popup_save_template).appendTo('body');

            _popup_editor = '<div class="modal fade modal-wide" id="popup_editor" role="dialog">' +
                '<div class="modal-dialog modal-lg">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">' + _this.langArr.popupEditorTitle + '<br/>' +
                '  <small></small></h4>' +
                '  </div>' +
                '<div class="modal-body">' +
                '<div id="editorHtml" class="">' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-success btn-save-editor" >' + _this.langArr.popupEditorOk + '</button>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">' + _this.langArr.popupEditorClose + '</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            jQuery(_popup_editor).appendTo('body');


            _popup_send_email = '<div class="modal fade " id="popup_send_email" role="dialog">' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">' + _this.langArr.popupSendEmailTitle + '<br>' +
                '<small>' + _this.langArr.popupSendEmailSubTitle + '</small></h4>' +
                '  </div>' +
                '<div class="modal-body">' +
                '  <div class="row">' +
                '<div class="col-sm-12">' +
                '  <input type="email" class="form-control email-title" placeholder="' + _this.langArr.popupSendEmailTitle+ '"  >' +

                '  <br><input type="email" class="form-control recipient-email" placeholder="' + _this.langArr.popupSendEmailPlaceHolder + '"  >' +

                ' <br> <label>Select attachment</label><input type="file" id="send_attachments" multiple=""  />' +
                '<br>' +
                '<label class="popup_send_email_output" style="color:red"></label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-success btn-send-email-template" >' + _this.langArr.popupSendEmailOk + '</button>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">' + _this.langArr.popupSendEmailClose + '</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            jQuery(_popup_send_email).appendTo('body');

            _popup_demo = '<div class="modal fade " id="popup_demo" role="dialog">' +
                '<div class="modal-dialog">' +
                '  <div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">Demo<br>' +
                '</h4>' +
                '  </div>' +
                '<div class="modal-body">' +
                '<label  style="color:red">This is demo version. There is not access to use more.' +
                'If you want to more please buy plugin.<a href="https://codecanyon.net/item/email-newsletter-builder-php-version/18060733" title="Buy">Buy Plugin</a></label>' +
                '</div>' +
                '<div class="modal-footer">' +
                '  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                '  </div>' +
                '</div>' +
                '</div>' +
                '</div>';

            jQuery(_popup_demo).appendTo('body');

            _popup_load_template = '<div class="modal fade " id="popup_load_template" role="dialog">' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                '<h4 class="modal-title">' + _this.langArr.popupLoadTemplateTitle + '<br>' +
                '<small>' + _this.langArr.popupLoadTemplateSubtitle + '</small></h4>' +
                '</div>' +
                '<div class="modal-body">' +
                '<div class="template-list">' +
                '</div>' +
                '<label class="template-load-error" style="color:red"></label>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-success btn-load-template" >' + _this.langArr.popupLoadTemplateOk + '</button>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">' + _this.langArr.popupLoadTemplateClose + '</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            jQuery(_popup_load_template).appendTo('body');

        },
        /**
         * show output in page
         */
        display: function (data) {
            _this.$elem.html(data);
        },
        /**
         * this functions must be work after generate source code
         */
        default_func: function () {
            //Nicescroll
            _this.$elem.find(".elements-container").niceScroll({
                cursorcolor: "#5D8397",
                cursorwidth: "10px",
                background: "#253843"
            });
            //make bootstrap tooltip
            jQuery('[data-toggle="tooltip"]').tooltip();

            // set colorpicker  default values and chnaged events
            _this.$elem.find('#bg-color').ColorPicker({
                color: '#fff',
                onChange: function (hsb, hex, rgb) {
                    $('#bg-color').css('background-color', '#' + hex);
                    _this.changeSettings($('#bg-color').attr('setting-type'), '#' + hex);
                }
            });
            _this.$elem.find('#bg-color-inner').ColorPicker({
                color: '#fff',
                onChange: function (hsb, hex, rgb) {
                    $('.sortable-row-content .main .element-content').css('background-color', '#' + hex);
                    //_this.changeSettings($('#bg-color-inner').attr('setting-type'), '#' + hex);
                }
            });
            _this.$elem.find('#bg-color-outer').ColorPicker({
                color: '#fff',
                onChange: function (hsb, hex, rgb) {
                    $('.content-wrapper').css('background-color', '#' + hex);
                    //_this.changeSettings($('#bg-color-outer').attr('setting-type'), '#' + hex);
                }
            });
            _this.$elem.find('#color-line').ColorPicker({
                color: '#fff',
                onChange: function (hsb, hex, rgb) {
                    _this.getActiveElementContent().find('.divider').css('border-color', '#' + hex);
                    //_this.changeSettings($('#bg-color-outer').attr('setting-type'), '#' + hex);
                }
            });


            _this.$elem.find('#button-bg-color').ColorPicker({
                color: '#3498DB',
                onChange: function (hsb, hex, rgb) {
                    $('#button-bg-color').css('background-color', '#' + hex);
                    _this.getActiveElementContent().find('.button-td').css('background-color', '#' + hex);
                    _this.getActiveElementContent().find('a').css('background-color', '#' + hex);

                    //_this.changeSettings($('#bg-color').attr('setting-type'), '#' + hex);
                }
            });
            _this.$elem.find('#button-text-color').ColorPicker({
                color: '#fff',
                onChange: function (hsb, hex, rgb) {
                    $('#button-text-color').css('background-color', '#' + hex);
                    _this.getActiveElementContent().find('.button-link').css('color', '#' + hex);
                    //_this.changeSettings($('#bg-color').attr('setting-type'), '#' + hex);
                }
            });
            //button-bg-color
            _this.$elem.find('#text-color').ColorPicker({
                color: '#000',
                onChange: function (hsb, hex, rgb) {
                    $('#text-color').css('background-color', '#' + hex);
                    _this.changeSettings($('#text-color').attr('setting-type'), '#' + hex);
                }
            });

            //show content edit on page load
            setTimeout(function () {
                jQuery('.content-wrapper').click();
                _this.tabMenu('typography');
            }, 100);
            _this.makeSortable();
            //_this.tabMenu('typography');

            _aceEditor = ace.edit("editorHtml");
            _aceEditor.setTheme("ace/theme/monokai");
            _aceEditor.getSession().setMode("ace/mode/html");

            _this.tinymceContextMenu();

            _this.remove_row_elements();

            $('.content-wrapper').removeAttr('contenteditable');

            _this.commandsUndoManager();
        },
        /**
         * Remove row buttons
         */
        remove_row_elements: function () {

            jQuery('.sortable-row-actions').html('');
            if (_this.config.showRowMoveButton == false) {
                jQuery('.row-move').remove();
            } else {
                jQuery('.sortable-row-actions').append('<div class="row-move row-action"><i class="fa fa-arrows-alt"></i></div>');
            }

            if (_this.config.showRowRemoveButton == false) {
                jQuery('.row-remove').remove();
            } else {
                jQuery('.sortable-row-actions').append('<div class="row-remove row-action"><i class="fa fa-remove"></i></div>');
            }

            if (_this.config.showRowDuplicateButton == false) {
                jQuery('.row-duplicate').remove();
            } else {
                jQuery('.sortable-row-actions').append('<div class="row-duplicate row-action"><i class="fa fa-files-o"></i></div>');
            }

            if (_this.config.showRowCodeEditorButton == false) {
                jQuery('.row-code').remove();
            } else {
                jQuery('.sortable-row-actions').append('<div class="row-code row-action"><i class="fa fa-code"></i></div>');
            }
        },
        /**
         *  Get content active element for change setting
         */
        getActiveElementContent: function () {

            _element = _this.$elem.find('.sortable-row.active .sortable-row-content .element-content');

            //element-contenteditable active
            if (_element.find('[contenteditable="true"]').hasClass('element-contenteditable')) {
                _element = _element.find('.element-contenteditable.active');
            }

            if (_this.$elem.find('.content-wrapper').hasClass('active')) {
                _element = _this.$elem.find('.content-wrapper');
            }

            return _element;
        },
        /**
         *  Make content elements sortable
         */
        makeSortable: function () {
            _this.$elem.find(".email-editor-elements-sortable").sortable({
                placeholder: "editor-elements-placeholder",
                forcePlaceholderSize: true,
                //group: 'no-drop',
                handle: '.row-move',
                revert: false
            });
        },
        /**
         *  All events
         */
        events: function () {

            jQuery(function () {
                if (_this.config.onAfterLoad !== undefined) {
                    _this.config.onAfterLoad();
                }
                _this.makeSortable();
                // setTimeout(function() {
                //     _this.makeSortable();
                // }, 2000);
                jQuery('.content-main').attr('data-width', '600px');
                jQuery('.main').css('width', '600px');
            });

            //left menu tab click
            _this.$elem.find('.tab-selector').on('click', function () {
                _element = $(this);
                _this.tabMenuItemClick(_element, true);
            });
            //menu accordion click
            _this.$elem.find('.elements-accordion .elements-accordion-item-title').on('click', function (j) {
                _element = $(this);
                _this.menuAccordionClick(_element, false);
            });

            _this.$elem.find('.collapse').on('click', function () {
                _element = $(this);
                _dataValue = _element.attr('data-value');
                //console.log(_dataValue);
                if (_dataValue === 'closed') {
                    _this.$elem.find('.left-menu-container').animate({
                        width: 380
                    }, 300, function () {
                        _this.$elem.find('.elements').show();
                        _this.$elem.find('.content').css({
                            'padding-left': '380px'
                        });
                        _this.$elem.find('.left-menu-container').find('.menu-item:eq(0)').addClass('active');
                    });
                    _element.find('.menu-name').show();
                    _element.find('.fa').removeClass().addClass('fa fa-chevron-circle-left');
                    _element.attr('data-value', 'opened');
                } else {
                    _this.$elem.find('.left-menu-container').animate({
                        width: 70
                    }, 300, function () {
                        _this.$elem.find('.elements').hide();
                        _this.$elem.find('.left-menu-container').find('.menu-item.active').removeClass('active');
                    });
                    _this.$elem.find('.content').css({
                        'padding-left': '70px'
                    });
                    _element.find('.menu-name').hide();
                    _element.find('.fa').removeClass().addClass('fa fa-chevron-circle-right');
                    _element.attr('data-value', 'closed');
                }
            });

            _this.$elem.find('.blank-page').on('click', function () {
                _element = $(this);
                //console.log(_this.langArr.modalDeleteTitle);
                swal({
                    title: _this.langArr.modalDeleteTitle,
                    text: _this.langArr.modalDeleteText,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: _this.langArr.modalDeleteconfirmButtonText,
                    cancelButtonText: _this.langArr.modalDeletecancelButtonText,
                    confirmButtonClass: 'btn btn-success btn-margin',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function () {
                    _this.$elem.find('.content-main').html('<div class="email-editor-elements-sortable">' +
                                                              _this.helperForGenerateHTMl(_blankPageHtml) +
                                                          '</div>');

                    _this.makeSortable();
                    _this.remove_row_elements();

                    jQuery('.project-container').hide();
                    jQuery('.project-name').attr('data-id', '');

                }, function (dismiss) {

                });


            });

            _this.$elem.find('.elements-container .sortable-row-content').each(function (i) {
                // _element = $(this);
                // (function(_element) {
                //     $.get(_this.config.siteBaseUrl+_element.attr('data-url'), function(responseText) {
                //         _element.html(responseText.split('[site-url]').join(_this.config.siteBaseUrl));
                //     });
                // }(_element));
            });

            _this.$elem.find(".elements-list .elements-list-item").draggable({
                connectToSortable: ".email-editor-elements-sortable",
                helper: "clone",
                //revert: "invalid",
                create: function (event, ui) {
                    //console.log(event.target);
                },
                drag: function (event, ui) {

                    if ($(event.target).parents('.editor').length==0) {
                      return false;
                    }
                    //console.log('1');
                },
                start: function (event, ui) {

                    _this.$elem.find(".elements-container").css({
                        'overflow': ''
                    });
                    ui.helper.find('.preview').hide();
                    ui.helper.find('.view').show()
                        //$(this).find('.demo').show();

                    if (_this.config.onElementDragStart !== undefined) {
                        _this.config.onElementDragStart(event);
                    }
                },
                stop: function (event, ui) {

                    var _dataId = ui.helper.find('.view .sortable-row-content').attr('data-id');
                    _this.$elem.find(".elements-container").css({
                        'overflow': 'hidden'
                    });

                    ui.helper.html(ui.helper.find('.view').html());
                    //ui.helper.remove();
                    //_this.$elem.find('.email-editor-elements-sortable').append(ui.helper.find('.view').html());
                    _this.$elem.find('.email-editor-elements-sortable .elements-list-item').css({
                        'width': '',
                        'height': ''
                    });

                    //
                    //$(ui.helper).remove();


                    var contentHtml = _this.getContentHtml();
                    if (_this.config.onElementDragFinished !== undefined) {
                        _this.config.onElementDragFinished(event, contentHtml, _dataId);
                    }


                }
            });

            _this.$elem.on('click', '.content-wrapper', function (event) {
                _this.$elem.find('.sortable-row.active').removeClass('active');
                _this.$elem.find('.sortable-row .element-contenteditable.active').removeClass('.element-contenteditable .active');
                jQuery(this).addClass('active');
                _dataTypes = jQuery(this).attr('data-types');
                if (_dataTypes.length < 1) {
                    return;
                }
                _typeArr = _dataTypes.toString().split(',');
                _arrSize = _this.$elem.find('.tab-property .elements-accordion-item').length;
                for (var i = 0; i < _arrSize; i++) {
                    _accordionMenuItem = _this.$elem.find('.tab-property .elements-accordion-item').eq(i);
                    //console.log(_accordionMenuItem.attr('data-type'))
                    if (_dataTypes.indexOf(_accordionMenuItem.attr('data-type')) > -1) {
                        _accordionMenuItem.show();
                    } else {
                        _accordionMenuItem.hide();
                    }
                }
                _this.$elem.find('[setting-type="padding-top"]').val(jQuery(this).css('padding-top').replace('px', ''));
                _this.$elem.find('[setting-type="padding-bottom"]').val(jQuery(this).css('padding-bottom').replace('px', ''));
                _this.$elem.find('[setting-type="padding-left"]').val(jQuery(this).css('padding-left').replace('px', ''));
                _this.$elem.find('[setting-type="padding-right"]').val(jQuery(this).css('padding-right').replace('px', ''));

                //  _this.$elem.find('.email-width').val(jQuery('.content-main').width());
                _this.$elem.find('.email-width').val(jQuery('.main').width() == '100' ? '600' : jQuery('.main').width());

                _this.tabMenu(_typeArr[0]);
            });

            _this.events_of_row();

            _this.events_of_property();

            _this.events_of_popup();

            _this.events_of_setting();

            _this.remove_row_elements();
        },
        /**
         *  Events of row
         */
        events_of_row: function () {
            //remove button
            _this.$elem.on('click', '.sortable-row .row-remove', function (e) {

                if (_this.config.onBeforeRemoveButtonClick !== undefined) {
                    _this.config.onBeforeRemoveButtonClick(e);
                }
                //if user want stop this action : e.preventDefault();
                if (e.isDefaultPrevented() == true) {
                    return false;
                }

                if (_this.$elem.find('.content .sortable-row').length == 1) {
                    alert('At least should be 1 item');
                    return;
                }
                jQuery(this).parents('.sortable-row').remove();

                if (_this.config.onAfterRemoveButtonClick !== undefined) {
                    _this.config.onAfterRemoveButtonClick(e);
                }
            });

            //duplicate button
            _this.$elem.on('click', '.sortable-row .row-duplicate', function (e) {
                if (_this.config.onBeforeRowDuplicateButtonClick !== undefined) {
                    _this.config.onBeforeRowDuplicateButtonClick(e);
                }
                //if user want stop this action : e.preventDefault();
                if (e.isDefaultPrevented() == true) {
                    return false;
                }
                if (jQuery(this).hasParent('.elements-list-item')) {
                    _parentSelector = '.elements-list-item';
                } else {
                    _parentSelector = '.sortable-row';
                }
                _parent = jQuery(this).parents(_parentSelector);
                jQuery('.sortable-row').removeClass('active');
                jQuery('.elements-list-item').removeClass('active');
                _parent.addClass('active');
                //_parent.after('<div class="sortable-row">'+ _parent.html()+"</div>");
                _parent.clone().insertAfter(_parentSelector + '.active');

                if (_this.config.onAfterRowDuplicateButtonClick !== undefined) {
                    _this.config.onAfterRowDuplicateButtonClick(e);
                }
            });

            //code button . for showing code editor popup
            _this.$elem.on('click', '.sortable-row .row-code', function (e) {
                if (_this.config.onBeforeRowEditorButtonClick !== undefined) {
                    _this.config.onBeforeRowEditorButtonClick(e);
                }
                //if user want stop this action : e.preventDefault();
                if (e.isDefaultPrevented() == true) {
                    return false;
                }
                jQuery(this).parents('.sortable-row').addClass('code-editor');
                _html = jQuery(this).parents('.sortable-row').find('.sortable-row-content').html();
                _aceEditor.session.setValue(_html);

                if (_this.config.onAfterRowEditorButtonClick !== undefined) {
                    _this.config.onAfterRowEditorButtonClick(e);
                }

                if (_this.config.onBeforeShowingEditorPopup !== undefined) {
                    _this.config.onBeforeShowingEditorPopup(e);
                }
                if (e.isDefaultPrevented() == true) {
                    return false;
                }
                jQuery('#popup_editor').modal('show');
            });

            _this.$elem.on('click', '.element-content', function (event) {
                jQuery('.content-wrapper').removeClass('active');
                _this.$elem.find('[contenteditable="true"]').removeClass('element-contenteditable active');
                _this.sortableClick(jQuery(this));
                event.stopPropagation();
            });

            _this.$elem.on('click', '[contenteditable="true"]', function (event) {
                jQuery('.content-wrapper').removeClass('active');
                _this.$elem.find('.content [contenteditable="true"]').removeClass('element-contenteditable active')
                jQuery(this).addClass('element-contenteditable active');
                _this.sortableClick(jQuery(this));

                event.stopPropagation();
            });
        },
        /**
         *  Events for Property
         */
        events_of_property: function () {
            //email width of template
            _this.$elem.on('keyup', '.email-width', function (event) {
                _element = jQuery(this);
                _val = jQuery('.email-width').val();
                if (parseInt(_val) < 300 || parseInt(_val) > 1000) {
                    return false;
                }
                //jQuery('.content-main').css('width', _val + 'px');
                jQuery('.content-main').attr('data-width', _val);
                jQuery('.main').css('width', _val + 'px');
            });

            //hyperlink
            _this.$elem.on('keyup', '.elements-accordion-item-content .hyperlink-url', function (event) {
                _element = jQuery(this);
                _val = _element.val();
                _activeElement = _this.getActiveElementContent();
                _activeElement.attr('href', _val);
            });

            _this.$elem.on('keyup', '.elements-accordion-item-content .button-text', function (event) {
                _element = jQuery(this);
                _val = _element.val();
                _activeElement = _this.getActiveElementContent();
                _activeElement.find('.button-link').text(_val);
            });
            _this.$elem.on('keyup', '.elements-accordion-item-content .button-hyperlink', function (event) {
                _element = jQuery(this);
                _val = _element.val();
                _activeElement = _this.getActiveElementContent();
                _activeElement.find('a').attr('href', _val);
            });

            _this.$elem.on('change', '.elements-accordion-item-content .button-full-width', function (event) {
                _element = jQuery(this);
                _activeElement = _this.getActiveElementContent();
                if ($('.button-full-width').is(':checked') == true) {
                    //_activeElement.find('a').css('display', 'block');
                    _activeElement.find('.btn-1-container').css('width', '100%');
                    // btn-1-container
                } else {
                      //_activeElement.find('a').css('display', 'inline-block');
                      _activeElement.find('.btn-1-container').css('width', '');
                }
            });

            //youtube
            _this.$elem.on('keyup', '.elements-accordion-item-content .youtube', function (event) {
                _element = jQuery(this);
                _val = _element.val();
                _activeElement = _this.getActiveElementContent();
                _activeElement.find('a').attr('href', _val);
                // _activeElement.find('table').css('background-image', "url('https://img.youtube.com/vi/" + _this.getYoutubeVideoId(_val) + "/sddefault.jpg')");
                var src='https://www.youtube.com/embed/'+_this.getYoutubeVideoId(_val);
              //  console.log(src);
                // document.getElementById('youtube-iframe').src=src;
                // document.getElementById('youtube-iframe').contentWindow.location.reload();


              var aLink='<a href="http://www.youtube.com/watch?v='+_this.getYoutubeVideoId(_val)+'&feature=em-share_video_user" style="text-decoration:none;display:none" class="nonplayable-ytb" target="_blank">'+
                          '<img src="http://i3.ytimg.com/vi/'+_this.getYoutubeVideoId(_val)+'/mqdefault.jpg" height="274" width="498" />'+
                        '</a>';

              var embed='<embed id="youtube-iframe" width="100%" height="315" base="https://www.youtube.com/v/" wmode="opaque"  id="swfContainer0" '+
                        'type="application/x-shockwave-flash" src="https://www.youtube.com/v/'+_this.getYoutubeVideoId(_val)+'?border=0&client=ytapi-google-gmail&version=3&start=0">'+
                        '</embed>';

                 $('.youtube-frame').html(aLink+embed);

            });

            //text style
            _this.$elem.on('click', '.text-icons .icon-box-item', function (event) {
                _element = jQuery(this);
                if (_element.hasClass('active')) {
                    _element.removeClass('active');
                } else {
                    _element.addClass('active');
                }
                if (_this.$elem.find('.text-icons .icon-box-item.fontStyle').hasClass('active')) {
                    _this.changeSettings('font-style', 'italic');
                } else {
                    _this.changeSettings('font-style', '');
                }
                _value = '';
                if (_this.$elem.find('.text-icons .icon-box-item.underline').hasClass('active')) {
                    _value += 'underline ';
                }
                if (_this.$elem.find('.text-icons .icon-box-item.line').hasClass('active')) {
                    _value += ' line-through';
                }
                _this.changeSettings('text-decoration', _value);
            });


            //font
            _this.$elem.on('click', '.font-icons .icon-box-item', function (event) {
                _element = jQuery(this);
                if (_element.hasClass('active')) {
                    _element.removeClass('active');
                } else {
                    _element.addClass('active');
                }
                if (_this.$elem.find('.font-icons .icon-box-item').hasClass('active')) {
                    _this.changeSettings('font-weight', 'bold');
                } else {
                    _this.changeSettings('font-weight', '');
                }
            });

            //align
            _this.$elem.on('click', '.align-icons .icon-box-item', function (event) {
                _element = jQuery(this);
                _this.$elem.find('.align-icons .icon-box-item').removeClass('active');
                _element.addClass('active');
                _value = 'left';
                if (_this.$elem.find('.align-icons .icon-box-item.center').hasClass('active')) {
                    _value = 'center';
                }
                if (_this.$elem.find('.align-icons .icon-box-item.right').hasClass('active')) {
                    _value = 'right';
                }
                _this.changeSettings('text-align', _value);
            });


            //chnage form cpntrol value for select
            _this.$elem.on('change', '.left-menu-container  .form-control:not(.line-height)', function (event) {
                _element = jQuery(this);
                _this.changeSettings(_element.attr('setting-type'), _element.val());
            });

            //chnage form cpntrol value for input
            _this.$elem.on('keyup', '.left-menu-container .form-control:not(.line-height)', function (event) {
                _element = jQuery(this);
                if (_element.hasClass('all') && _element.hasClass('padding')) {
                    _this.$elem.find('.padding:not(".all")').val(_element.val());
                }
                if (_element.hasClass('all') && _element.hasClass('border-radius')) {
                    _this.$elem.find('.border-radius:not(".all")').val(_element.val());
                }
                _this.changeSettings(_element.attr('setting-type'), _element.val() + 'px');
            });
            _this.$elem.on('keyup', '.left-menu-container .line-height', function (event) {
                _element = jQuery(this);

                var _heightOfD=_element.val();
                console.log(_heightOfD);
                _this.getActiveElementContent().find('.divider').css('border-top-width',_heightOfD);

            });


            //social
            _this.$elem.on('keyup', '.social-content-box .social-input', function (event) {
                _element = jQuery(this);
                _socialType = _element.parents('.row').attr('data-social-type');
                _val = _element.val();
                _activeElement = _this.getActiveElementContent();
                if (_activeElement.hasClass('social-content')) {
                    _activeElement.find('a.' + _socialType).attr('href', _val);
                }
            });

            //image-size
            _this.$elem.on('keyup', '.image-size', function (event) {
                _activeElement = _this.getActiveElementContent();

                if (jQuery(this).hasClass('image-height')) {
                    _activeElement.find('.content-image').css('height', jQuery(this).val());
                } else if (jQuery(this).hasClass('image-width')) {
                    _activeElement.find('.content-image').css('width', jQuery(this).val());
                }
                else if (jQuery(this).hasClass('image-url')) {
                  _activeElement.find('.image-hyperlink').attr('href', jQuery(this).val());
                }
            });

            //number
            _this.$elem.on('keydown', '.number', function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1
                    //// Allow: Ctrl+A
                    //(e.keyCode == 65 && e.ctrlKey === true) ||
                    //// Allow: Ctrl+C
                    //(e.keyCode == 67 && e.ctrlKey === true) ||
                    //// Allow: Ctrl+X
                    //(e.keyCode == 88 && e.ctrlKey === true) ||
                    //// Allow: home, end, left, right
                    //(e.keyCode >= 35 && e.keyCode <= 39)
                ) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            //example
            _this.$elem.on('change', '.social-content-box .checkbox-title input', function (event) {
                _socialType = jQuery(this).parents('.row').attr('data-social-type');
                _activeElement = _this.getActiveElementContent();
                if (jQuery(this).is(":checked")) {
                    _activeElement.find('a.' + _socialType).show();
                } else {
                    _activeElement.find('a.' + _socialType).hide();
                }
            });


        },
        /**
         * Get video id from youtube url
         */
        getYoutubeVideoId: function (url) {
            videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
            if (videoid != null) {
                return videoid[1];
            } else {
                return '';
            }

        },
        /**
         *  Events for Settings
         */
        events_of_setting: function () {

            //other-devices
            _this.$elem.on('click', '.setting-item.other-devices', function (event) {
                _element = jQuery(this);
                _parent = _element.parents('.settings');
                if (_element.hasClass('active')) {
                    _parent.find('.setting-content .setting-content-item.other-devices').hide();
                    _element.removeClass('active');
                } else {
                    _parent.find('.setting-content .setting-content-item.other-devices').show();
                    _element.addClass('active');
                }
            });

            //other devices content
            _this.$elem.on('click', '.setting-content .setting-device-tab', function (event) {
                _element = jQuery(this);

                _parent = _element.parents('.setting-content');
                _parent.find('.setting-device-tab').removeClass('active');
                _element.addClass('active');
                _parent.find('.setting-device-content').removeClass('active');
                _parent.find('.setting-device-content.' + _element.attr('data-tab')).addClass('active');
                _removeClass = 'sm-width lg-width';
                _addClass = '';
                switch (_element.attr('data-tab')) {
                    case 'mobile-content':
                        _addClass = 'sm-width';
                        _this.$elem.find('.email-editor-elements-sortable').css({
                            'margin-left': '-150px'
                        });
                        break;
                    case 'desktop-content':
                        _addClass = 'lg-width';
                        _this.$elem.find('.email-editor-elements-sortable').css({
                            'margin-left': '0'
                        });
                        break;
                }
                _this.$elem.find('.content-main').removeClass(_removeClass);
                _this.$elem.find('.content-main').addClass(_addClass);
            });

            //laod templates button
            _this.$elem.on('click', '.setting-item.load-templates', function (event) {

                if (_this.config.onBeforeSettingsLoadTemplateButtonClick !== undefined) {
                    _this.config.onBeforeSettingsLoadTemplateButtonClick(event);
                }
                //if user want stop this action : e.preventDefault();
                if (event.isDefaultPrevented() == true) {
                    return false;
                }
                jQuery('.btn-load-template').hide();
                $('#popup_load_template').modal('show');
            });

            //export click
            _this.$elem.on('click', '.setting-item.export', function (event) {
                _getHtml = _this.getContentHtml();
                if (_this.config.onSettingsExportButtonClick !== undefined) {
                    _this.config.onSettingsExportButtonClick(event, _getHtml);
                }
                //if user want stop this action : e.preventDefault();
                if (event.isDefaultPrevented() == true) {
                    return false;
                }
            });

            //preview click
            _this.$elem.on('click', '.setting-item.preview', function (event) {
                _getHtml = _this.getContentHtml();
                if (_this.config.onSettingsPreviewButtonClick !== undefined) {
                    _this.config.onSettingsPreviewButtonClick(event, _getHtml);
                }
                //if user want stop this action : e.preventDefault();
                if (event.isDefaultPrevented() == true) {
                    return false;
                }
            });
            //preview click
            _this.$elem.on('click', '.setting-item.import', function (event) {
                if (_this.config.onSettingsImportClick !== undefined) {
                    _this.config.onSettingsImportClick(event);
                }
                //if user want stop this action : e.preventDefault();
                if (event.isDefaultPrevented() == true) {
                    return false;
                }
            });
            //save-template click
            _this.$elem.on('click', '.setting-item.save-template', function (event) {
                if (_this.config.onBeforeSettingsSaveButtonClick !== undefined) {
                    _this.config.onBeforeSettingsSaveButtonClick(event);
                }
                //if user want stop this action : e.preventDefault();
                if (event.isDefaultPrevented() == true) {
                    return false;
                }


                jQuery('.input-error').text('');
                jQuery('.template-name').val('');
                jQuery('#popup_save_template').modal('show');
            });


            //btn-save-template
            jQuery('#popup_save_template').on('click', '.btn-save-template', function (event) {

                jQuery('.input-error').text('');
                if (jQuery('.template-name').val().length < 1) {
                    jQuery('.input-error').text(_this.langArr.popupSaveTemplateError);
                    return false;
                }

                if (_this.config.onPopupSaveButtonClick !== undefined) {
                    _this.config.onPopupSaveButtonClick(event);
                }
                //if user want stop this action : e.preventDefault();
                if (event.isDefaultPrevented() == true) {
                    return false;
                }

            });

            //btn-save-template
            jQuery(document).on('click', '.btn-save', function (event) {


                if (_this.config.onUpdateButtonClick !== undefined) {
                    _this.config.onUpdateButtonClick(event);
                }
                //if user want stop this action : e.preventDefault();
                if (event.isDefaultPrevented() == true) {
                    return false;
                }

            });
            //send-email
            _this.$elem.on('click', '.setting-item.send-email', function (event) {

                if (_this.config.onSettingsSendMailButtonClick !== undefined) {
                    _this.config.onSettingsSendMailButtonClick(event);
                }

                if (event.isDefaultPrevented() == true) {
                    return false;
                }
                jQuery('.recipient-email').val('');
                jQuery('#send_attachments').val('');
                jQuery('.popup_send_email_output').text('');
                jQuery('#popup_send_email').modal('show');

            });

            jQuery('#popup_send_email').on('click', '.btn-send-email-template', function (event) {
                _element = $(this);
                if ($(this).hasClass('has-loading')) {
                    return;
                }
                _element.addClass('has-loading');
                _element.text(_this.langArr.loading);

                _getHtml = _this.getContentHtml();

                if (_this.config.onPopupSendMailButtonClick !== undefined) {
                    _this.config.onPopupSendMailButtonClick(event, _getHtml);
                }
                //if user want stop this action : e.preventDefault();
                if (event.isDefaultPrevented() == true) {
                    return false;
                }

            });
            //open modal for change image
            _this.$elem.on('click', '.change-image', function (event) {
                $('.mce-resizehandle').remove();
                if (_this.config.onBeforeChangeImageClick !== undefined) {
                    _this.config.onBeforeChangeImageClick(event);
                }

                if (event.isDefaultPrevented() == true) {
                    return false;
                }
                jQuery('#popup_images').modal('show');
                jQuery('#popup_images').css('z-index', '999999');

            });
            jQuery('#popupimport').on('click', '.btn-import', function (event) {

                if (_this.config.onBeforePopupBtnImportClick !== undefined) {
                    _this.config.onBeforePopupBtnImportClick(event);
                }

                if (event.isDefaultPrevented() == true) {
                    return false;
                }


                jQuery('#popupimport').modal('hide');
                _this.makeSortable();
            });


            //select image
            jQuery('#popup_images').on('click', '.upload-image-item', function (event) {
                jQuery('.modal .upload-image-item').removeClass('active');
                jQuery(this).addClass('active');
            });

            //change select image button click
            jQuery('#popup_images').on('click', '.btn-select', function (event) {

                if (_this.config.onBeforePopupSelectImageButtonClick !== undefined) {
                    _this.config.onBeforePopupSelectImageButtonClick(event);
                }

                if (event.isDefaultPrevented() == true) {
                    return false;
                }


                _url = jQuery('.modal').find('.upload-image-item.active').attr('src');
                //my code
                var files = $("#popup_images .input-file")[0].files;
                if(files.length > 0)
                {
                    var formData = new FormData();
                    formData.append('image',files[0]);
                    $.ajax({
                        url: _this.config.image_upload_url,
                        type: 'POST',
                        data: formData,
                        processData:false,
                        contentType: false,
                        success: function(data) {
                            data = JSON.parse(data);
                            if(data.possible)
                            {
                                _this.getActiveElementContent().find('.content-image').attr('src',data.path);
                                jQuery('#popup_images').modal('hide');
                            }
                        },
                        error: function() {}
                    });
                }
            });

            jQuery('#popup_load_template').on('click', '.template-list .template-item', function (event) {

                jQuery('.template-list .template-item').removeClass('active');
                jQuery(this).addClass('active');
                jQuery('.btn-load-template').show();
            });
            jQuery('#popup_load_template').on('click', '.template-item-delete', function (event) {

                _dataId = jQuery(this).parents('.template-item').attr('data-id');
                event.stopPropagation();
                if (_this.config.onTemplateDeleteButtonClick !== undefined) {
                    _this.config.onTemplateDeleteButtonClick(event, _dataId, jQuery(this).parents('.template-item'));
                }

            });
            jQuery('#popup_load_template').on('click', '.btn-load-template', function (event) {
                _dataId = jQuery('.template-list .template-item.active').attr('data-id');

                if (_this.config.onBeforePopupSelectTemplateButtonClick !== undefined) {
                    _this.config.onBeforePopupSelectTemplateButtonClick(_dataId);
                }

                if (event.isDefaultPrevented() == true) {
                    return false;
                }

                //search template in array
                var result = jQuery.grep(_templateListItems, function (e) {
                    return e.id == _dataId;
                });
                if (result.length == 0) {
                    //show error
                    jQuery('.template-load-error').text('An error has occurred');
                }
                //    _contentText = jQuery('<div/>').html(result[0].content).text();


                jQuery('.header .project-name').html(result[0].name);
                jQuery('.header .project-name').attr('data-id', _dataId);
                jQuery('.project-container').show();

                //  jQuery('.content-wrapper').html(_contentText);
                jQuery('#popup_load_template').modal('hide');
                _this.makeSortable();
                event.stopPropagation();
            });

            jQuery('body').on('click', '.btn-upload', function (event) {

                if (_this.config.onPopupUploadImageButtonClick !== undefined) {
                    _this.config.onPopupUploadImageButtonClick(event);
                }

                if (event.isDefaultPrevented() == true) {
                    return false;
                }


            });

        },
        /**
         *  Events of popup save
         */
        events_of_popup: function () {

            //save code editor
            jQuery('#popup_editor').on('click', '.btn-save-editor', function () {
                jQuery('.sortable-row.code-editor .sortable-row-content').html(_aceEditor.getSession().getValue());
                jQuery('#popup_editor').modal('hide');
                jQuery('.sortable-row.code-editor').removeClass('code-editor');
            });

        },
        /**
         *  Left menu tab click event
         */
        tabMenuItemClick: function (_element, handle) {
            _tabSelector = _element.data('tab-selector');
            if (_element.hasClass('collapse')) {
                return false;
            }
            _this.$elem.find('.menu-item.active').removeClass('active');
            _this.$elem.find('.element-tab.active').removeClass('active');
            //show tab content
            _this.$elem.find('.' + _tabSelector).addClass('active');
            //select new tab
            _element.addClass('active');
            if (!handle) {
                _this.$elem.find('.sortable-row.active').removeClass('active');
            }
        },
        /**
         *  menu accordion
         */
        menuAccordionClick: function (_element, toggle) {
            var dropDown = _element.closest('.elements-accordion-item').find('.elements-accordion-item-content');
            _element.closest('.elements-accordion').find('.elements-accordion-item-content').not(dropDown).slideUp();
            if ($('.tab-property').hasClass('active')) {
                _this.$elem.find('.sortable-row.active .main').attr('data-last-type', _element.closest('.elements-accordion-item').attr('data-type'));
            }
            if (!toggle) {
                _element.closest('.elements-accordion').find('.elements-accordion-item-title.active').removeClass('active');
                _element.addClass('active');
                dropDown.stop(false, true).slideDown();
            } else {
                if (_element.hasClass('active')) {
                    _element.removeClass('active');
                } else {
                    _element.closest('.elements-accordion').find('.elements-accordion-item-title.active').removeClass('active');
                    _element.addClass('active');
                }
                dropDown.stop(false, true).slideToggle();
            }
        },
        /**
         * Open/close left menu tab and it's child
         */
        tabMenu: function (tab) {
            _menuItem = _tabMenuItems[tab];
            _tabMenuItem = _this.$elem.find('.left-menu-container .menu-item[data-tab-selector="' + _menuItem.parentSelector + '"]');
            _accordionMenuItem = _this.$elem.find('.elements-accordion .elements-accordion-item[data-type="' + _menuItem.itemSelector + '"] .elements-accordion-item-title');
            _this.tabMenuItemClick(_tabMenuItem, true);
            _this.menuAccordionClick(_accordionMenuItem, false);
        },
        /**
         * Get created email template
         */
        getContentHtml: function () {
            _balContentWrapper = _this.$elem.find('.content-wrapper');
            _balContentWrapper.find('a').css({
                'word-wrap': 'break-word'
            });
            _balContentWrapper.find('table').css({
                'border-spacing': '0',
                'border-collapse': 'collapse',
                'mso-table-lspace': 'collapse',
                'mso-table-rspace': 'collapse'
            });
            _balContentWrapper.find('table td').css({
                'border-collapse': 'collapse'
            });
            _balContentWrapper.find('table, td, p, a, li').css({
                '-webkit-text-size-adjust': '100%',
                '-ms-text-size-adjust': '100%'
            });


            _html = '';
            _this.$elem.find('.content .content-wrapper .sortable-row').each(function () {
                _html += jQuery(this).find('.sortable-row-content').html().split('contenteditable="true"').join('');
            });
            _width = jQuery('.content-main').attr('data-width') == '100' ? '600' : jQuery('.content-main').attr('data-width'); //$('.content-main').css('width');

            if (typeof _width == 'undefined') {
                _width = '600px';
            }
            _style = '';
            _style += 'background-color:'+jQuery('.content-wrapper').css('background-color')+';background:' + jQuery('.content-wrapper').css('background') + ';';
            _padding = 'padding:' + jQuery('.content-wrapper').css('padding');

            var demoH=$('<div/>');
            demoH.html(_html);
            demoH.find('.nonplayable-ytb').css('display','block');
            demoH.find('.main').attr('width',_width);
            _html=demoH.html();
            _result = '<div class="email-content" style="' + _style + '">' + _html + '</div>';



            _result = '<table width="100%" cellspacing="0" cellpadding="0" border="0" style="' + _style + '"><tbody><tr><td><div style="margin:0 auto;width:' + _width + ';' + _padding + '">' + _html + '</div></td></tr></table>';
            return _result;
        },
        /**
         * Generate left menu elements tab
         */
        generateElements: function () {
            _outputHtml = '';
            _this.generate(_outputHtml);
            // $.ajax({
            //     url: _this.config.elementJsonUrl,
            //     data: '',
            //     success: function(data) {
            //         data = data.elements;
            //         for (var i = 0; i < data.length; i++) {
            //
            //             _outputHtml += '<li class="elements-accordion-item" data-type="' + data[i].name.toLowerCase() + '"><a class="elements-accordion-item-title">' + data[i].name + '</a>';
            //
            //             _outputHtml += '<div class="elements-accordion-item-content"><ul class="elements-list">';
            //
            //             _items = data[i].items;
            //
            //             for (var j = 0; j < _items.length; j++) {
            //                 _outputHtml += '<li>' +
            //                     '<div class="elements-list-item">' +
            //                     '<div class="preview">' +
            //                     '<div class="elements-item-icon">' +
            //                     ' <i class="' + _items[j].icon + '"></i>' +
            //                     '</div>' +
            //                     '<div class="elements-item-name">' +
            //                     _items[j].name +
            //                     '</div>' +
            //                     '</div>' +
            //                     '<div class="view">' +
            //                     '<div class="sortable-row">' +
            //                     '<div class="sortable-row-container">' +
            //                     ' <div class="sortable-row-actions">';
            //
            //                 if (_this.config.showRowMoveButton == true) {
            //                     _outputHtml += '<div class="row-move row-action">' +
            //                         '<i class="fa fa-arrows-alt"></i>' +
            //                         '</div>';
            //                 }
            //
            //                 if (_this.config.showRowRemoveButton == true) {
            //                     _outputHtml += '<div class="row-remove row-action">' +
            //                         '<i class="fa fa-remove"></i>' +
            //                         '</div>';
            //                 }
            //
            //                 if (_this.config.showRowDuplicateButton == true) {
            //                     _outputHtml += '<div class="row-duplicate row-action">' +
            //                         '<i class="fa fa-files-o"></i>' +
            //                         '</div>';
            //                 }
            //
            //                 if (_this.config.showRowCodeEditorButton == true) {
            //                     _outputHtml += '<div class="row-code row-action">' +
            //                         '<i class="fa fa-code"></i>' +
            //                         '</div>';
            //                 }
            //                 _outputHtml += '</div>' +
            //                     '<div class="sortable-row-content" data-url="' + _items[j].content + '">' +
            //                     '</div>' +
            //                     '</div>' +
            //                     '</div>' +
            //                     ' </div>' +
            //                     '</div>' +
            //                     '</li>';
            //             }
            //
            //
            //             _outputHtml += '</ul></div>';
            //             _outputHtml += '</li>';
            //         }
            //
            //
            //
            //         _this.generate(_outputHtml);
            //     },
            //     error: function() {
            //         console.error('Has error');
            //     },
            //     dataType: 'json'
            // });
        },
        /**
         * Get Site Url
         */
        getAbsolutePath: function () {
            var loc = window.location;
            var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
            return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
        },
        /**
         * Content row click event
         */
        sortableClick: function (_thisElement) {
            _element = _thisElement.parents('.sortable-row');
            //select current item
            _this.$elem.find('.content .sortable-row').removeClass('active');
            _element.addClass('active');
            _dataTypes = _element.find('.sortable-row-content ').attr('data-types');
            if (typeof _dataTypes == 'undefined') {
                return;
            }

            if (_dataTypes.length < 1) {
                return;
            }
            _typeArr = _dataTypes.toString().split(',');
            _arrSize = _this.$elem.find('.tab-property .elements-accordion-item').length;
            for (var i = 0; i < _arrSize; i++) {
                _accordionMenuItem = _this.$elem.find('.tab-property .elements-accordion-item').eq(i);
                //console.log(_accordionMenuItem.attr('data-type'))
                if (_dataTypes.indexOf(_accordionMenuItem.attr('data-type')) > -1) {
                    _accordionMenuItem.show();
                } else {
                    _accordionMenuItem.hide();
                }
            }
            var lastType = _element.find('.sortable-row-content').attr('data-last-type');
            // console.log(lastType);
            // if (lastType===undefined) {
            //   lastType=_element.find('.sortable-row-content').attr('data-types').split(',')[0];
            // }
            _this.tabMenu(lastType);
            _this.getSettings();
        },
        /**
         * Get active element settings
         */
        getSettings: function () {
            _element = _this.getActiveElementContent();
            _style = _element.attr('style');
            if (typeof _style === "undefined" || _style.length < 1) {
                return;
            }
            if (_element.find('.divider').length!=0) {
              _this.$elem.find('.tab-property .elements-accordion-item .line-height').val(_element.find('.divider').css('border-top-width').replace('px', ''));

            }

            //background
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="background-color"]').css('background-color', _element.css('background-color'));
            /*Paddings*/
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="padding-top"]').val(_element.css('padding-top').replace('px', ''));
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="padding-bottom"]').val(_element.css('padding-bottom').replace('px', ''));
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="padding-left"]').val(_element.css('padding-left').replace('px', ''));
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="padding-right"]').val(_element.css('padding-right').replace('px', ''));
            /*Border radius*/
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="border-top-left-radius"]').val(_element.css('border-top-left-radius').replace('px', ''));
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="border-top-right-radius"]').val(_element.css('border-top-right-radius').replace('px', ''));
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="border-bottom-left-radius"]').val(_element.css('border-bottom-left-radius').replace('px', ''));
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="border-bottom-right-radius"]').val(_element.css('border-bottom-right-radius').replace('px', ''));
            /*text style*/
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="font-family"]').val(_element.css('font-family'));
            _this.$elem.find('.tab-property .elements-accordion-item [setting-type="font-size"]').val(_element.css('font-size').replace('px', ''));
            //text color
            _this.$elem.find('.tab-property .icon-box-item[setting-type="color"]').css({
                'background': _element.css('color')
            });
            //text align
            _this.$elem.find('.tab-property .align-icons .icon-box-item').removeClass('active');
            _this.$elem.find('.tab-property .align-icons .icon-box-item.' + _element.css('text-align')).addClass('active');
            //text bold
            if (_element.css('font-weight') == 'bold') {
                _this.$elem.find('.tab-property .icon-box-item[setting-type="bold"]').addClass('active');
            } else {
                _this.$elem.find('.tab-property .icon-box-item[setting-type="bold"]').removeClass('active');
            }
            //text group style
            _this.$elem.find('.tab-property .text-icons .icon-box-item').removeClass('active');
            if (_element.css('text-decoration').indexOf('underline') > -1) {
                _this.$elem.find('.tab-property .text-icons .icon-box-item.underline').addClass('active');
            }
            if (_element.css('text-decoration').indexOf('line-through') > -1) {
                _this.$elem.find('.tab-property .text-icons .icon-box-item.line').addClass('active');
            }
            if (_element.css('font-style').indexOf('italic') > -1) {
                _this.$elem.find('.tab-property .text-icons .icon-box-item.fontStyle').addClass('active');
            }

            if (_element.hasClass('social-content')) {
                $('.content .sortable-row.active .sortable-row-content .element-content.social-content a').each(function () {
                    _socialType = jQuery(this).attr('class');
                    _socialRow = _this.$elem.find('[data-social-type="' + _socialType + '"]');
                    _socialRow.find('.social-input').val(jQuery(this).attr('href'));
                    if (jQuery(this).css('display') == 'none') {
                        _socialRow.find('.checkbox-title input').prop("checked", false);
                    } else {
                        _socialRow.find('.checkbox-title input').prop("checked", true);
                    }
                });
            }
            if (_element.hasClass('youtube-frame')) {
                _ytbUrl = _element.find('a').attr('href');

                _this.$elem.find('.youtube').val(_ytbUrl);
            }

            //hyperlink
            if (_element.hasClass('hyperlink')) {
                _href = _element.attr('href');
                _this.$elem.find('.hyperlink-url').val(_href);
            }
            if (_element.hasClass('button-1')) {
                _href = _element.find('a').text();
                _this.$elem.find('.button-text').val($.trim(_href));

                _href = _element.find('a').attr('href');
                _this.$elem.find('.button-hyperlink').val($.trim(_href));
            }
            //image size
            _this.$elem.find('.tab-property .elements-accordion-item .image-width').val(_element.find('.content-image').css('width'));
            _this.$elem.find('.tab-property .elements-accordion-item .image-height').val(_element.find('.content-image').css('height'));
            _this.$elem.find('.tab-property .elements-accordion-item .image-url').val(_element.find('.image-hyperlink').attr('href'));

        },
        /**
         * Change active element settings
         */
        changeSettings: function (type, value) {
            _activeElement = _this.getActiveElementContent();


            if (type == 'font-size') {
                _activeElement.find('>h1,>h4').css(type, value);
            } else if (type == 'background-image') {
                _activeElement.css(type, 'url("' + value + '")');
                _activeElement.css({
                    'background-size': 'cover',
                    'background-repeat': 'no-repeat'
                });
            }

            if (_activeElement.hasClass('button-1') && type == 'border-radius') {
                _activeElement.find('a').css(type, value);
            } else {
                _activeElement.css(type, value);
            }

            if (type == 'background-color' && _activeElement.hasClass('content-wrapper')) {
                _this.$elem.find('.content-main').css('background-color', value);
            }
        },
        /**
         * Get selected html of the window
         */
        getSelectedHtml: function () {
            var html = "";
            if (typeof window.getSelection != "undefined") {
                var sel = window.getSelection();
                if (sel.rangeCount) {
                    var container = document.createElement("div");
                    for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                        container.appendChild(sel.getRangeAt(i).cloneContents());
                    }
                    html = container.innerHTML;
                }
            } else if (typeof document.selection != "undefined") {
                if (document.selection.type == "Text") {
                    html = document.selection.createRange().htmlText;
                }
            }
            return html;
        },
        /**
         * tinymce Context Menu
         */
        tinymceContextMenu: function () {
            if (_this.config.showContextMenu == false) {
                return false;
            }
            var _toolBar = ''; //'fontselect fontsizeselect bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | link | unlink removeformat',
            if (_this.config.showContextMenu_FontFamily == true) {
                _toolBar += 'fontselect ';
            }
            if (_this.config.showContextMenu_FontSize == true) {
                _toolBar += 'fontsizeselect ';
            }
            if (_this.config.showContextMenu_Bold == true) {
                _toolBar += 'bold ';
            }
            if (_this.config.showContextMenu_Italic == true) {
                _toolBar += 'italic ';
            }
            if (_this.config.showContextMenu_Underline == true) {
                _toolBar += 'underline ';
            }
            if (_this.config.showContextMenu_Strikethrough == true) {
                _toolBar += 'strikethrough ';
            }
            if (_this.config.showContextMenu_Hyperlink == true) {
                _toolBar += 'link ';
            }
            //default options
            _toolBar += ' | alignleft aligncenter alignright alignjustify | bullist numlist | forecolor backcolor |  unlink removeformat  ';

            tinymce.init({
                selector: 'div.content-wrapper',
                theme: 'inlite',
                plugins: ' link textcolor image imagetools',
                width: 300,
                selection_toolbar: _toolBar,
                fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt 48pt 72pt",
                inline: true,
                paste_data_images: false
            });

        },
        /**
         * Get languages
         */
        getLangs: function () {
            $.ajax({
                url: _this.config.langJsonUrl,
                data: '',
                success: function (data) {
                    jQuery.each(data, function (i, val) {
                        _language[i] = val[0];
                    });

                    //set language data to private variable
                    _this.langArr = _language[_this.config.lang];
                    _this.generateElements();
                },
                error: function () {
                    console.error('Has error');
                },
                dataType: 'json'
            });
        },
        /**
         * Get blank page html code
         */
        getBlankPageHtml: function () {
            $.ajax({
                url: _this.config.blankPageHtmlUrl,
                success: function (data) {
                    _blankPageHtml = data;
                },
                error: function () {
                    console.error('Has error getBlankPageHtml');
                }
            });
        },

        /**
         * Undo /redo
         */
        commandsUndoManager: function () {

        }
    };

    $.fn.emailBuilder = function (options) {

        var _emailBuilder;
        /**
         * Set elements json file url, include which elements want to show in email builder
         */
        this.setElementJsonUrl = function (elementJsonUrl) {
                _emailBuilder.config.elementJsonUrl = elementJsonUrl;
            }
            /**
             * Chnage language builder  (en | fr | de | ru | tr ).
             */
        this.setLang = function (lang) {
                _emailBuilder.config.lang = lang;
            }
            /**
             *  Set json file url  include which supported languages .
             *  If you want ,you can add any language very easily.
             */
        this.setLangJsonUrl = function (value) {
                _emailBuilder.config.langJsonUrl = value;
            }
            /**
             * Set blank page html source. when users want to create blank page,they see this html
             */
        this.setBlankPageHtmlUrl = function (blankPageHtmlUrl) {
                _emailBuilder.config.blankPageHtmlUrl = blankPageHtmlUrl;
            }
            /**
             * Set html when page loading you can load your template from database or you can show any html into editor
             */
        this.setLoadPageHtmlUrl = function (loadPageHtmlUrl) {
            _emailBuilder.config.loadPageHtmlUrl = loadPageHtmlUrl;
        }

        /**
         * Show or hide context menu in editor
         */
        this.setShowContextMenu = function (showContextMenu) {
                _emailBuilder.config.showContextMenu = showContextMenu;
            }
            /**
             * Show or hide font family option context menu in editor
             */
        this.setShowContextMenu_FontFamily = function (showContextMenu_FontFamily) {
            _emailBuilder.config.showContextMenu_FontFamily = showContextMenu_FontFamily;
        }

        /**
         * Show or hide font size option context menu in editor
         */
        this.setShowContextMenu_FontSize = function (showContextMenu_FontSize) {
                _emailBuilder.config.showContextMenu_FontSize = showContextMenu_FontSize;
            }
            /**
             * Show or hide bold option context menu in editor
             */
        this.setShowContextMenu_Bold = function (showContextMenu_Bold) {
                _emailBuilder.config.showContextMenu_Bold = showContextMenu_Bold;
            }
            /**
             * Show or hide italic option context menu in editor
             */
        this.setShowContextMenu_Italic = function (showContextMenu_Italic) {
                _emailBuilder.config.showContextMenu_Italic = showContextMenu_Italic;
            }
            /**
             * Show or hide underline option context menu in editor
             */
        this.setShowContextMenu_Underline = function (showContextMenu_Underline) {
                _emailBuilder.config.showContextMenu_Underline = showContextMenu_Underline;
            }
            /**
             * Show or hide strikethrough option context menu in editor
             */
        this.setShowContextMenu_Strikethrough = function (showContextMenu_Strikethrough) {
                _emailBuilder.config.showContextMenu_Strikethrough = showContextMenu_Strikethrough;
            }
            /**
             * Show or hide hyperlink option context menu in editor
             */
        this.setShowContextMenu_Hyperlink = function (showContextMenu_Hyperlink) {
            _emailBuilder.config.showContextMenu_Hyperlink = showContextMenu_Hyperlink;
        }




        /**
         * Show or hide elements tab in left menu
         */
        this.setShowElementsTab = function (showElementsTab) {
                _emailBuilder.config.showElementsTab = showElementsTab;
            }
            /**
             * Show or hide property tab in left menu
             */
        this.setShowPropertyTab = function (showPropertyTab) {
                _emailBuilder.config.showPropertyTab = showPropertyTab;
            }
            /**
             * Show or hide 'collapse menu' button in left menu
             */
        this.setShowCollapseMenu = function (showCollapseMenu) {
                _emailBuilder.config.showCollapseMenu = showCollapseMenu;
            }
            /**
             * Show or hide 'blank page' button in left menu
             */
        this.setShowBlankPageButton = function (showBlankPageButton) {
                _emailBuilder.config.showBlankPageButton = showBlankPageButton;
            }
            /**
             * Show or hide 'collapse menu' button bottom or above
             */
        this.setShowCollapseMenuinBottom = function (showCollapseMenuinBottom) {
            _emailBuilder.config.showCollapseMenuinBottom = showCollapseMenuinBottom;
        }


        /**
         * Set value show or hide settings bar
         */
        this.setShowSettingsBar = function (showSettingsBar) {
                _emailBuilder.config.showSettingsBar = showSettingsBar;
            }
            /**
             * Set value  show or hide 'Preview' button in settings bar
             */
        this.setShowSettingsPreview = function (showSettingsPreview) {
                _emailBuilder.config.showSettingsPreview = showSettingsPreview;
            }
            /**
             * Set value show or hide 'Export' button in settings bar
             */
        this.setShowSettingsExport = function (showSettingsExport) {
                _emailBuilder.config.showSettingsExport = showSettingsExport;
            }
            /**
             * Set value show or hide 'Send Mail' button in settings bar
             */
        this.setShowSettingsSendMail = function (showSettingsSendMail) {
                _emailBuilder.config.showSettingsSendMail = showSettingsSendMail;
            }
            /**
             * Set value show or hide 'Save' button in settings bar
             */
        this.setShowSettingsSave = function (showSettingsSave) {
                _emailBuilder.config.showSettingsSave = showSettingsSave;
            }
            /**
             * Set value show or hide 'Load Template' button in settings bar
             */
        this.setShowSettingsLoadTemplate = function (showSettingsLoadTemplate) {
            _emailBuilder.config.showSettingsLoadTemplate = showSettingsLoadTemplate;
        }


        /**
         * Set value show or hide 'Move' button in actions row item
         */
        this.setShowRowMoveButton = function (showRowMoveButton) {
                _emailBuilder.config.showRowMoveButton = showRowMoveButton;
            }
            /**
             * Set value show or hide 'Remove' button in actions row item
             */
        this.setShowRowRemoveButton = function (showRowRemoveButton) {
                _emailBuilder.config.showRowRemoveButton = showRowRemoveButton;
            }
            /**
             * Set value show or hide 'Duplicate' button in actions row item
             */
        this.setShowRowDuplicateButton = function (showRowDuplicateButton) {
                _emailBuilder.config.showRowDuplicateButton = showRowDuplicateButton;
            }
            /**
             * Set value show or hide 'Code Editor' button in actions row item
             */
        this.setShowRowCodeEditorButton = function (showRowCodeEditorButton) {
            _emailBuilder.config.showRowCodeEditorButton = showRowCodeEditorButton;
        }

        /**
         * Init email builder any time
         */
        this.init = function () {
            _emailBuilder.init();
        }



        /**
         * Set settings preview button click event
         */
        this.setSettingsPreviewButtonClick = function (func) {
                _emailBuilder.config.onSettingsPreviewButtonClick = func;
            }
            /**
             * Set Settings export button click event
             */
        this.setSettingsExportButtonClick = function (func) {
                _emailBuilder.config.onSettingsExportButtonClick = func;
            }
            /**
             * Set Settings before save button click event
             */
        this.setBeforeSettingsSaveButtonClick = function (func) {
                _emailBuilder.config.onBeforeSettingsSaveButtonClick = func;
            }
            /**
             * Set Settings save button click event
             */
        this.setSettingsSaveButtonClick = function (func) {
                _emailBuilder.config.onSettingsSaveButtonClick = func;
            }
            /**
             * Set Settings before load template button click event
             */
        this.setBeforeSettingsLoadTemplateButtonClick = function (func) {
                _emailBuilder.config.onBeforeSettingsLoadTemplateButtonClick = func;
            }
            /**
             * Set Settings send mail button click event
             */
        this.setSettingsSendMailButtonClick = function (func) {
            _emailBuilder.config.onSettingsSendMailButtonClick = func;
        }

        /** Set Before 'change image'  click event*/
        this.setBeforeChangeImageClick = function (func) {
                _emailBuilder.config.onBeforeChangeImageClick = func;
            }
            /**
             * Set Before save button click event in 'select image' popup
             */
        this.setBeforePopupSelectImageButtonClick = function (func) {
                _emailBuilder.config.onBeforePopupSelectImageButtonClick = func;
            }
            /**
             * Set xxxxxxxxxxxx
             */
        this.setBeforePopupSelectTemplateButtonClick = function (func) {
                _emailBuilder.config.onBeforePopupSelectTemplateButtonClick = func;
            }
            /**
             * Set Save button click event in 'Save template' popup
             */
        this.setPopupSaveButtonClick = function (func) {
                _emailBuilder.config.onPopupSaveButtonClick = func;
            }
            /**
             * Set Before select template button click event in 'load template' popup
             */
        this.setPopupSendMailButtottonClick = function (func) {
                _emailBuilder.config.onPopupSendMailButtonClick = func;
            }
            /**
             * Set 'Upload' button click for upload image in 'select image' popup
             */
        this.setPopupUploadImageButtonClick = function (func) {
            _emailBuilder.config.onPopupUploadImageButtonClick = func;
        }

        /**
         * Set Before clicking 'Remove' button in element settings
         */
        this.setBeforeRowRemoveButtonClick = function (func) {
                _emailBuilder.config.onBeforeRowRemoveButtonClick = func;
            }
            /**
             * Set After clicking 'Remove' button in element settings
             */
        this.setAfterRowRemoveButtonClick = function (func) {
                _emailBuilder.config.onAfterRowRemoveButtonClick = func;
            }
            /**
             * Set Before clicking 'Duplicate' button in element settings
             */
        this.setBeforeRowDuplicateButtonClick = function (func) {
                _emailBuilder.config.onBeforeRowDuplicateButtonClick = func;
            }
            /**
             * Set After clicking 'Duplicate' button in element settings
             */
        this.setAfterRowDuplicateButtonClick = function (func) {
                _emailBuilder.config.onAfterRowDuplicateButtonClick = func;
            }
            /**
             * Set Before clicking 'Code editor' button in element settings
             */
        this.setBeforeRowEditorButtonClick = function (func) {
                _emai_emailBuilder.config.onBeforeRowEditorButtonClick = func;
            }
            /**
             * Set After clicking 'Code editor' button in element settings
             */
        this.setAfterRowEditorButtonClick = function (func) {
                _emailBuilder.config.onAfterRowEditorButtonClick = func;
            }
            /**
             * Set Before, show code editor for edit source any elemnt of template
             */
        this.setBeforeShowingEditorPopup = function (func) {
                _emailBuilder.config.onBeforeShowingEditorPopup = func;
            }
            /**
             * Set After page loading event
             */
        this.setAfterLoad = function (func) {
                _emailBuilder.config.onAfterLoad = func;
            }
            /**
             * Get created email template
             */
        this.getContentHtml = function () {
            return _emailBuilder.getContentHtml();
        }

        this.makeSortable = function () {
            _emailBuilder.makeSortable();
        }
        this.makeRowElements = function () {
            _emailBuilder.remove_row_elements();
        }
        return this.each(function () {
            _emailBuilder = new EmailBuilder(this, options);
            _emailBuilder.init();
        });
    };
});

jQuery.fn.hasParent = function (e) {
    return (jQuery(this).parents(e).length == 1 ? true : false);
}
