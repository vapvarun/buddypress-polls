'use strict';


function wbpoll_copyStringToClipboard (str) {
    // Create new element
    var el = document.createElement('textarea');
    // Set value (string to be copied)
    el.value = str;
    // Set non-editable to avoid focus and move outside of view
    el.setAttribute('readonly', '');
    el.style = {position: 'absolute', left: '-9999px'};
    document.body.appendChild(el);
    // Select text inside element
    el.select();
    // Copy text to clipboard
    document.execCommand('copy');
    // Remove temporary element
    document.body.removeChild(el);
}


jQuery(document).ready(function ($) {
    $('.selecttwo-select').select2({
        placeholder: wbpolladminsingleObj.please_select,
        allowClear: false
    });

    // style the radio yes no
    $('.wbpollmetadatepicker').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });

    $.datepicker._gotoToday = function (id) {
        var inst = this._getInst($(id)[0]),
            $dp  = inst.dpDiv;
        this._base_gotoToday(id);
        //var tp_inst = this._get(inst, 'timepicker');
        //removed -> selectLocalTimeZone(tp_inst);
        var now     = new Date();
        var now_utc = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
        this._setTime(inst, now_utc);
        $('.ui-datepicker-today', $dp).click();
    };


    $('.wbpoll_answer_color').wpColorPicker();
    $('.wbpoll-colorpicker').wpColorPicker();


    if ($('#wb_poll_answers_items').length) {
        $('#wb_poll_answers_items').sortable({
            group: 'no-drop',
            placeholder: 'wb_poll_items wb_poll_items_placeholder',
            handle: '.cbpollmoveicon',
            onDragStart: function ($item, container, _super) {
                // Duplicate items of the no drop area
                if (!container.options.drop)
                {
                    $item.clone().insertAfter($item);
                }
                _super($item, container);
            }
        });

    }

    //config used to add color picker for newly added answer
    var colorOptions = {
        change: function (event, ui) {
        },
        // a callback to fire when the input is emptied or an invalid color
        clear: function () {
        },
        // hide the color picker controls on load
        hide: true,
        palettes: true
    };

    // add new answer
    $('#wbpoll_answer_wrap').on('click', '.add-wb-poll-answer', function (event) {
        event.preventDefault();

        var $this            = $(this);
        var $answer_wrap     = $this.closest('#wbpoll_answer_wrap');
        var $answer_add_wrap = $this.parent('.add-wb-poll-answer-wrap');

        var $post_id = Number($answer_add_wrap.data('postid'));
        //var $index               = Number($answer_add_wrap.data('answercount'));
        var $index   = Number($('#wbpoll_answer_extra_answercount').val());
        var $busy    = Number($answer_add_wrap.data('busy'));
        var $type    = $this.data('type');


        //get random answer color
        var answer_color = '#' + '0123456789abcdef'.split('').map(function (v, i, a) {
            return i > 5 ? null : a[Math.floor(Math.random() * 16)];
        }).join('');


        //sending ajax request to get the field template

        if ($busy === 0) {
            $answer_add_wrap.data('busy', 1);

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: wbpolladminsingleObj.ajaxurl,
                data: {
                    action: 'wbpoll_get_answer_template',
                    answer_counter: $index,
                    answer_color: answer_color,
                    is_voted: 0,
                    poll_postid: $post_id,
                    answer_type: $type,
                    security: wbpolladminsingleObj.nonce
                },
                success: function (data, textStatus, XMLHttpRequest) {
                    $('#wb_poll_answers_items').append(data);
                    $answer_wrap.find('.wbpoll_answer_color').last().wpColorPicker(colorOptions);


                    //helps to render the  editor properly
                    //quicktags({id : '_wbpoll_answer_extra_'+$count+'_html'});
                    //tinyMCE.execCommand('mceAddEditor', false, '_wbpoll_answer_extra_'+$count+'_html');

                    wp.wbpolljshooks.doAction('wppoll_new_answer_template_render', $index, $type, answer_color, $post_id, $);

                    $index++;
                    //$answer_add_wrap.data('answercount', $index);
                    $('#wbpoll_answer_extra_answercount').val($index);
                    $answer_add_wrap.data('busy', 0);
                }
            });
        }

    });


    //remove an answer
    $('#wbpoll_answer_wrap').on('click', '.wb_pollremove', function (event) {
        event.preventDefault();

        var $this = $(this);

        Ply.dialog({
            'confirm-step': {
                ui: 'confirm',
                data: {
                    text: wbpolladminsingleObj.deleteconfirm,
                    ok: wbpolladminsingleObj.deleteconfirmok, // button text
                    cancel: wbpolladminsingleObj.deleteconfirmcancel
                },
                backEffect: '3d-flip[-180,180]'
            }
        }).always(function (ui) {
            if (ui.state) {
                // Ok
                $this.parent('.wb_poll_items').remove();

            } else {
                // Cancel
                // ui.by — 'overlay', 'x', 'esc'
            }
        });
    });



    //click to copy shortcode
    $('.wbpoll_ctp').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);
        wbpoll_copyStringToClipboard($this.prev('.wbpollshortcode').text());

        $this.attr('aria-label', wbpolladminsingleObj.copied);

        window.setTimeout(function () {
            $this.attr('aria-label', wbpolladminsingleObj.copy);
        }, 1000);
    });
});
