'use strict';

hljs.initHighlightingOnLoad();

(function ($) {
    if ($.trumbowyg) {
        var configurations = {
            core: {},
            plugins: {
                btnsDef: {
                    // Customizables dropdowns
                    image: {
                        dropdown: ['insertImage', 'upload', 'base64', 'noEmbed'],
                        ico: 'insertImage'
                    }
                },
                btns: [
                    ['viewHTML'],
                    ['undo', 'redo'],
                    ['formatting'],
                    'btnGrp-design',
                    ['link'],
                    ['image'],
                    'btnGrp-justify',
                    'btnGrp-lists',
                    ['foreColor', 'backColor'],
                    ['preformatted'],
                    ['horizontalRule']
                    //['fullscreen']
                ],
                plugins: {
                    // Add imagur parameters to upload plugin
                    upload: {
                        serverPath: 'https://api.imgur.com/3/image',
                        fileFieldName: 'image',
                        headers: {
                            'Authorization': 'Client-ID 9e57cb1c4791cea'
                        },
                        urlPropertyName: 'data.link'
                    }
                }
            }
        };

        // Demo switch
        var $demoTextarea = $('#trumbowyg-demo');
        $demoTextarea.trumbowyg();
        $('.demo-switcher .button').on('click', function () {
            var $current = $('.demo-switcher .current');
            $(this).parent().removeClass('current-' + $current.data('config'));
            $current.removeClass('current');
            $(this).addClass('current');
            $(this).parent().addClass('current-' + $(this).data('config'));
            $demoTextarea.trumbowyg('destroy');
            $demoTextarea.trumbowyg(configurations[$(this).data('config')]);
        });

        // Lang accordion
        $('#lang-list-view-full').on('click', function () {
            $('#lang-list-light').slideUp(100);
            $('#lang-list-full').slideDown(350);
        });
    }

    // Languages continent switch
    var $continentNames = $('.continent-name');
    $continentNames.each(function() {
        $(this).parent().attr('data-height', $(this).parent().height());
    });
    $continentNames.click(function () {
        var $oldOpen = $('#languages').find('.col-list ul li[style]');
        $oldOpen.removeAttr('style');
        $(this).parent().css({
            height: $(this).parent().attr('data-height') + 'px'
        });
    });
    $continentNames.last().parent().css({
        height: $continentNames.last().parent().attr('data-height') + 'px'
    });

    // Add anchors
    $('.feature h3[id]').each(function () {
        $(this).after($('<a/>', {
            html: '<svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#trumbowyg-link"></use></svg>',
            'class': 'title-link',
            href: '#' + $(this).attr('id'),
            title: 'Permalink to ' + $(this).text()
        }));
    });

    // Toggle class on body to show/hide removed features
    $('#show-removed').click(function () {
        $('body').toggleClass('show-removed');
    });

    $('.link-to-removed').click(function () {
        $('body').addClass('show-removed');
    });
    if (window.location.hash.length > 1 && !$(window.location.hash).is(':visible')) {
        $('body').addClass('show-removed');
    }
})(jQuery);