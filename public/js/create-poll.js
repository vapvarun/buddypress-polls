jQuery('#poll_type').on('change', function (e) {
    e.preventDefault();
    var type = jQuery(this).val();
    if (type == 'default') {
        jQuery('#addtitonal_option').show();
        jQuery('#type_text').show();
        jQuery('#type_image').hide();
        jQuery('div#type_image input#wbpoll_answer').val('');
        jQuery('div#type_image input#wbpoll_image_answer_url').val('');
        jQuery('#type_video').hide();
        jQuery('div#type_video input#wbpoll_answer').val('');
        jQuery('div#type_video input#wbpoll_video_answer_url').val('');
        jQuery('#type_audio').hide();
        jQuery('div#type_audio input#wbpoll_answer').val('');
        jQuery('div#type_audio input#wbpoll_audio_answer_url').val('');
        jQuery('#type_html').hide();
        jQuery('div#type_html input#wbpoll_answer').val('');
        jQuery('div#type_html #wbpoll_html_answer_textarea').val('');
    } else if (type == 'image') {
        jQuery('#addtitonal_option').hide();
        jQuery('#type_image').show();
        jQuery('#type_text').hide();
        jQuery('div#type_text input#wbpoll_answer').val('');
        jQuery('#type_video').hide();
        jQuery('div#type_video input#wbpoll_answer').val('');
        jQuery('div#type_video input#wbpoll_video_answer_url').val('');
        jQuery('#type_audio').hide();
        jQuery('div#type_audio input#wbpoll_answer').val('');
        jQuery('div#type_audio input#wbpoll_audio_answer_url').val('');
        jQuery('#type_html').hide();
        jQuery('div#type_html input#wbpoll_answer').val('');
        jQuery('div#type_html #wbpoll_html_answer_textarea').val('');
    } else if (type == 'video') {
        jQuery('#addtitonal_option').hide();
        jQuery('#type_video').show();
        jQuery('#type_image').hide();
        jQuery('div#type_image input#wbpoll_answer').val('');
        jQuery('div#type_image input#wbpoll_image_answer_url').val('');
        jQuery('#type_text').hide();
        jQuery('div#type_text input#wbpoll_answer').val('');
        jQuery('#type_audio').hide();
        jQuery('div#type_audio input#wbpoll_answer').val('');
        jQuery('div#type_audio input#wbpoll_audio_answer_url').val('');
        jQuery('#type_html').hide();
        jQuery('div#type_html input#wbpoll_answer').val('');
        jQuery('div#type_html #wbpoll_html_answer_textarea').val('');
    } else if (type == 'audio') {
        jQuery('#addtitonal_option').hide();
        jQuery('#type_audio').show();
        jQuery('#type_video').hide();
        jQuery('div#type_video input#wbpoll_answer').val('');
        jQuery('div#type_video input#wbpoll_video_answer_url').val('');
        jQuery('#type_image').hide();
        jQuery('div#type_image input#wbpoll_answer').val('');
        jQuery('div#type_image input#wbpoll_image_answer_url').val('');
        jQuery('#type_text').hide();
        jQuery('div#type_text input#wbpoll_answer').val('');
        jQuery('#type_html').hide();
        jQuery('div#type_html input#wbpoll_answer').val('');
        jQuery('div#type_html #wbpoll_html_answer_textarea').val('');
    } else if (type == 'html') {
        jQuery('#addtitonal_option').hide();
        jQuery('#type_html').show();
        jQuery('#type_video').hide();
        jQuery('div#type_video input#wbpoll_answer').val('');
        jQuery('div#type_video input#wbpoll_video_answer_url').val('');
        jQuery('#type_image').hide();
        jQuery('div#type_image input#wbpoll_answer').val('');
        jQuery('div#type_image input#wbpoll_image_answer_url').val('');
        jQuery('#type_text').hide();
        jQuery('div#type_text input#wbpoll_answer').val('');
        jQuery('#type_audio').hide();
        jQuery('div#type_audio input#wbpoll_answer').val('');
        jQuery('div#type_audio input#wbpoll_audio_answer_url').val('');

    } else {
        jQuery('#addtitonal_option').hide();
        jQuery('#type_text').hide();
        jQuery('div#type_text input#wbpoll_answer').val('');
        jQuery('#type_image').hide();
        jQuery('div#type_image input#wbpoll_answer').val('');
        jQuery('div#type_image input#wbpoll_image_answer_url').val('');
        jQuery('#type_video').hide();
        jQuery('div#type_video input#wbpoll_answer').val('');
        jQuery('div#type_video input#wbpoll_video_answer_url').val('');
        jQuery('#type_audio').hide();
        jQuery('div#type_audio input#wbpoll_answer').val('');
        jQuery('div#type_audio input#wbpoll_audio_answer_url').val('');
        jQuery('#type_html').hide();
        jQuery('div#type_html input#wbpoll_answer').val('');
        jQuery('div#type_html #wbpoll_html_answer_textarea').val('');
    }
});

var clickCount = 0;
jQuery('.extra-fields-text').click(function (e) {
    e.preventDefault();
        // var dataid = jQuery('.extra-fields-text').data('id');
        clickCount++;
        jQuery('.extra-fields-text').attr('data-id', clickCount);
        // alert(idinc);
        
    jQuery('.text_records').clone().appendTo('.text_records_dynamic');
    jQuery('.text_records_dynamic .text_records').addClass('single remove');
    jQuery('.html_records_dynamic .extra-fields-text').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-text">Remove Fields</a>');
    jQuery('.text_records_dynamic > .single').attr("class", 'remove remove'+clickCount);

    jQuery('.text_records_dynamic input').each(function () {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });
    jQuery('.remove'+clickCount+' .wbpoll_answer').val('');

});

jQuery('.extra-fields-image').click(function(e) {
    e.preventDefault();
    clickCount++;
    jQuery('.extra-fields-image').attr('data-id', clickCount);
    jQuery('.image_records').clone().appendTo('.image_records_dynamic');
    jQuery('.image_records_dynamic .image_records').addClass('single remove');
    jQuery('.remove'+clickCount+' .extra-fields-image').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-image">Remove Fields</a>');
    jQuery('.image_records_dynamic > .single').attr("class", 'remove remove'+clickCount);

    jQuery('.image_records_dynamic input').each(function () {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });
    jQuery('.remove'+clickCount+' .wbpoll_answer').val('');
    jQuery('.remove'+clickCount+' .wbpoll_image_answer_url').val('');
    jQuery('.remove'+clickCount+' .wbpoll-image-input-preview .wbpoll-image-input-preview-thumbnail').html('');
    
    jQuery('.wbpoll_image_answer_url').on(
        'keyup',
        function (e) {
            e.preventDefault();
            var url = jQuery(this).val();
            var imagclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
            jQuery(imagclass).html('<img width="266" height="266" src="' + url + '">');

        });
    jQuery(document).on(
        'click',
        '#bpolls-attach-image',
        function (event) {
            event.preventDefault();
            updateurl = jQuery(this).parent().find('.wbpoll_image_answer_url');
            imageclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');

            if (file_frame) {
                file_frame.open();
                return;
            }

            file_frame = wp.media.frames.file_frame = wp.media(
                {
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    library: {
                        type: ['image']
                    },
                    multiple: false,
                    // library: {
                    // 	author: bpolls_ajax_object.poll_user
                    // }
                }
            );

            file_frame.on(
                'select',
                function () {
                    attachment = file_frame.state().get('selection').first().toJSON();

                    if (attachment.url) {
                        jQuery(imageclass).html('<img width="266" height="266" src="' + attachment.url + '">');
                        jQuery(updateurl).val(attachment.url);

                    }
                }
            );
            file_frame.open();
        }
    );

});

jQuery('.extra-fields-video').click(function(e) {
    e.preventDefault();
    clickCount++;
    jQuery('.extra-fields-video').attr('data-id', clickCount);
    jQuery('.video_records').clone().appendTo('.video_records_dynamic');
    jQuery('.video_records_dynamic .video_records').addClass('single remove');
    jQuery('.remove'+clickCount+' .extra-fields-video').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-video">Remove Fields</a>');
    jQuery('.video_records_dynamic > .single').attr("class", 'remove remove'+clickCount);

    jQuery('.video_records_dynamic input').each(function () {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });

    jQuery('.remove'+clickCount+' .wbpoll_answer').val('');
    jQuery('.remove'+clickCount+' .wbpoll_video_answer_url').val('');
    jQuery('.remove'+clickCount+' .wbpoll-image-input-preview .wbpoll-image-input-preview-thumbnail').html('');
    

    jQuery('.wbpoll_video_answer_url').on(
        'keyup',
        function (e) {
            e.preventDefault();
            var url = jQuery(this).val();
            var suggestion = jQuery(this).parent().find('.hide_suggestion');
            var imagclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
            jQuery(imagclass).html('<video src="' + url + '" controls="" poster="" preload="none"></video>');
            jQuery(suggestion).show();
            jQuery(suggestion).find('#no').prop('checked', true);
            jQuery(suggestion).find('#yes').prop('checked', false);
            jQuery('.yes_video').on('click', function () {
                var url = jQuery(this).parent().parent().find('.wbpoll_video_answer_url').val();
                var imagclass = jQuery(this).parent().parent().parent().find('.wbpoll-image-input-preview-thumbnail');
                var title = jQuery(this).parent().parent().find('.wbpoll_answer');
                var updateurl = jQuery(this).parent().parent().find('.wbpoll_video_answer_url');
                jQuery.getJSON('https://noembed.com/embed', {
                    format: 'json',
                    url: url,
                }, function (response) {
                    if (response.error) {
                        jQuery(suggestion).find('#no').prop('checked', true);
                        jQuery(suggestion).find('#yes').prop('checked', false);
                    } else {
                        jQuery(imagclass).html(response.html);
                        jQuery(title).val(response.title);
                        var iframe = jQuery(response.html);
                        jQuery(suggestion).find('#no').prop('checked', true);
                        var src = iframe.attr('src');
                        jQuery(updateurl).val(src);
                    }
                });
                jQuery(suggestion).hide();
            });
        });

    jQuery(document).on(
        'click',
        '#bpolls-attach-video',
        function (event) {
            event.preventDefault();
            updateurl = jQuery(this).parent().find('.wbpoll_video_answer_url');
            imageclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
            jQuery(this).parent().find('#no').prop('checked', true);
            jQuery(this).parent().find('#yes').prop('checked', false);
            if (file_frame) {
                file_frame.open();
                return;
            }

            file_frame = wp.media.frames.file_frame = wp.media(
                {
                    title: 'Choose video',
                    button: {
                        text: 'Choose video'
                    },
                    library: {
                        type: ['video']
                    },
                    multiple: false,
                    // library: {
                    // 	author: bpolls_ajax_object.poll_user
                    // }
                }
            );

            file_frame.on(
                'select',
                function () {
                    attachment = file_frame.state().get('selection').first().toJSON();

                    if (attachment.url) {
                        jQuery(imageclass).html('<video src="' + attachment.url + '" controls="" poster="" preload="none"></video>');
                        jQuery(updateurl).val(attachment.url);

                    }
                }
            );
            file_frame.open();
        }
    )

});

jQuery('.extra-fields-audio').click(function(e) {
    e.preventDefault();
    clickCount++;
    jQuery('.extra-fields-audio').attr('data-id', clickCount);
    jQuery('.audio_records').clone().appendTo('.audio_records_dynamic');
    jQuery('.audio_records_dynamic .audio_records').addClass('single remove');
    jQuery('.remove'+clickCount+' .extra-fields-audio').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-audio">Remove Fields</a>');
    jQuery('.audio_records_dynamic > .single').attr("class", 'remove remove'+clickCount);

    jQuery('.audio_records_dynamic input').each(function () {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });

    
    jQuery('.remove'+clickCount+' .wbpoll_answer').val('');
    jQuery('.remove'+clickCount+' .wbpoll_audio_answer_url').val('');
    jQuery('.remove'+clickCount+' .wbpoll-image-input-preview .wbpoll-image-input-preview-thumbnail').html('');
    

    jQuery('.wbpoll_audio_answer_url').on(
        'keyup',
        function (e) {
            e.preventDefault();
            var url = jQuery(this).val();
            var suggestion = jQuery(this).parent().find('.hide_suggestion');
            var imagclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
            jQuery(imagclass).html('<audio src="' + url + '" controls="" preload="none"></audio>')
            jQuery(suggestion).show();
            jQuery(suggestion).find('#no').prop('checked', true);
            jQuery(suggestion).find('#yes').prop('checked', false);
            jQuery('.yes_audio').on('click', function () {
                var url = jQuery(this).parent().parent().find('.wbpoll_audio_answer_url').val();
                var imagclass = jQuery(this).parent().parent().parent().find('.wbpoll-image-input-preview-thumbnail');
                var title = jQuery(this).parent().parent().find('.wbpoll_answer');
                var updateurl = jQuery(this).parent().parent().find('.wbpoll_audio_answer_url');
                jQuery.getJSON('https://noembed.com/embed', {
                    format: 'json',
                    url: url,
                }, function (response) {
                    if (response.error) {
                        jQuery(suggestion).find('#no').prop('checked', true);
                        jQuery(suggestion).find('#yes').prop('checked', false);
                    } else {
                        jQuery(imagclass).html(response.html);
                        jQuery(title).val(response.title);
                        jQuery(suggestion).find('#no').prop('checked', false);
                        var iframe = jQuery(response.html);
                        var src = iframe.attr('src');
                        jQuery(updateurl).val(src);
                    }
                });
                jQuery(suggestion).hide();
            });

        });

    jQuery(document).on(
        'click',
        '#bpolls-attach-audio',
        function (event) {
            event.preventDefault();
            updateurl = jQuery(this).parent().find('.wbpoll_audio_answer_url');
            imageclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
            jQuery(this).parent().find('#no').prop('checked', true);
            jQuery(this).parent().find('#yes').prop('checked', false);
            if (file_frame) {
                file_frame.open();
                return;
            }

            file_frame = wp.media.frames.file_frame = wp.media(
                {
                    title: 'Choose Audio',
                    button: {
                        text: 'Choose Audio'
                    },
                    library: {
                        type: ['audio']
                    },
                    multiple: false,
                    // library: {
                    // 	author: bpolls_ajax_object.poll_user
                    // }
                }
            );

            file_frame.on(
                'select',
                function () {
                    attachment = file_frame.state().get('selection').first().toJSON();

                    if (attachment.url) {
                        jQuery(imageclass).html('<audio src="' + attachment.url + '" controls="" preload="none"></audio>');
                        jQuery(updateurl).val(attachment.url);

                    }
                }
            );
            file_frame.open();
        }
    )

});

jQuery('.extra-fields-html').click(function(e) {
    e.preventDefault();
    clickCount++;
    jQuery('.extra-fields-html').attr('data-id', clickCount);
    jQuery('.html_records').clone().appendTo('.html_records_dynamic');
    jQuery('.html_records_dynamic .html_records').addClass('single remove');
    jQuery('.remove'+clickCount+' .extra-fields-html').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-html">Remove Fields</a>');
    jQuery('.html_records_dynamic > .single').attr("class", 'remove remove'+clickCount);

    jQuery('.html_records_dynamic input').each(function () {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });

    jQuery('.remove'+clickCount+' .wbpoll_answer').val('');
    jQuery('.remove'+clickCount+' .wbpoll_html_answer_textarea').val('');
    
});

jQuery('.wbpoll_image_answer_url').on(
    'keyup',
    function (e) {
        e.preventDefault();
        var url = jQuery(this).val();
        var imagclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
        jQuery(imagclass).html('<img width="266" height="266" src="' + url + '">');

    });

jQuery('.wbpoll_video_answer_url').on(
    'keyup',
    function (e) {
        e.preventDefault();
        var url = jQuery(this).val();
        var suggestion = jQuery(this).parent().find('.hide_suggestion');
        var imagclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
        jQuery(imagclass).html('<video src="' + url + '" controls="" poster="" preload="none"></video>');
        jQuery(suggestion).show();
        jQuery(suggestion).find('#no').prop('checked', true);
        jQuery(suggestion).find('#yes').prop('checked', false);
        jQuery('.yes_video').on('click', function () {
            var url = jQuery(this).parent().parent().find('.wbpoll_video_answer_url').val();
            var imagclass = jQuery(this).parent().parent().parent().find('.wbpoll-image-input-preview-thumbnail');
            var title = jQuery(this).parent().parent().find('.wbpoll_answer');
            var updateurl = jQuery(this).parent().parent().find('.wbpoll_video_answer_url');
            jQuery.getJSON('https://noembed.com/embed', {
                format: 'json',
                url: url,
            }, function (response) {
                if (response.error) {
                    jQuery(suggestion).find('#no').prop('checked', true);
                    jQuery(suggestion).find('#yes').prop('checked', false);
                } else {
                    jQuery(suggestion).find('#no').prop('checked', false);
                    jQuery(imagclass).html(response.html);
                    jQuery(title).val(response.title);
                    var iframe = jQuery(response.html);
                    var src = iframe.attr('src');
                    jQuery(updateurl).val(src);
                }
            });
            jQuery(suggestion).hide();
        });
    });


jQuery('.wbpoll_audio_answer_url').on(
    'keyup',
    function (e) {
        e.preventDefault();
        var url = jQuery(this).val();
        var suggestion = jQuery(this).parent().find('.hide_suggestion');
        var imagclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
        jQuery(imagclass).html('<audio src="' + url + '" controls="" preload="none"></audio>')
        jQuery(suggestion).show();
        jQuery(suggestion).find('#no').prop('checked', true);
        jQuery(suggestion).find('#yes').prop('checked', false);
        jQuery('.yes_audio').on('click', function () {
            var url = jQuery(this).parent().parent().find('.wbpoll_audio_answer_url').val();
            var imagclass = jQuery(this).parent().parent().parent().find('.wbpoll-image-input-preview-thumbnail');
            var title = jQuery(this).parent().parent().find('.wbpoll_answer');
            var updateurl = jQuery(this).parent().parent().find('.wbpoll_audio_answer_url');
            jQuery.getJSON('https://noembed.com/embed', {
                format: 'json',
                url: url,
            }, function (response) {
                if (response.error) {
                    jQuery(suggestion).find('#no').prop('checked', true);
                    jQuery(suggestion).find('#yes').prop('checked', false);
                } else {
                    jQuery(suggestion).find('#no').prop('checked', false);
                    jQuery(imagclass).html(response.html);
                    jQuery(title).val(response.title);
                    var iframe = jQuery(response.html);
                    var src = iframe.attr('src');
                    console.log(src);
                    jQuery(updateurl).val(src);
                }
            });
            jQuery(suggestion).hide();
        });

    });

jQuery(document).on('click', '.remove-field', function (e) {
    jQuery(this).parent().remove();
    e.preventDefault();
});

jQuery(document).on('ready', function (e) {
    e.preventDefault();
    jQuery('.wbpollmetadatepicker').datetimepicker();
});

jQuery(document).ready(
    function () {
        var file_frame;
        jQuery(document).on(
            'click',
            '#bpolls-attach-image',
            function (event) {
                event.preventDefault();
                updateurl = jQuery(this).parent().find('.wbpoll_image_answer_url');
                imageclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');

                if (file_frame) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media.frames.file_frame = wp.media(
                    {
                        title: 'Choose Image',
                        button: {
                            text: 'Choose Image'
                        },
                        library: {
                            type: ['image']
                        },
                        multiple: false,
                        // library: {
                        // 	author: bpolls_ajax_object.poll_user
                        // }
                    }
                );

                file_frame.on(
                    'select',
                    function () {
                        attachment = file_frame.state().get('selection').first().toJSON();

                        if (attachment.url) {
                            jQuery(imageclass).html('<img width="266" height="266" src="' + attachment.url + '">');
                            jQuery(updateurl).val(attachment.url);

                        }
                    }
                );
                file_frame.open();
            }
        );

        jQuery(document).on(
            'click',
            '#bpolls-attach-video',
            function (event) {
                event.preventDefault();
                updateurl = jQuery(this).parent().find('.wbpoll_video_answer_url');
                imageclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
                jQuery(this).parent().find('#no').prop('checked', true);
                jQuery(this).parent().find('#yes').prop('checked', false);
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media.frames.file_frame = wp.media(
                    {
                        title: 'Choose video',
                        button: {
                            text: 'Choose video'
                        },
                        library: {
                            type: ['video']
                        },
                        multiple: false,
                        // library: {
                        // 	author: bpolls_ajax_object.poll_user
                        // }
                    }
                );

                file_frame.on(
                    'select',
                    function () {
                        attachment = file_frame.state().get('selection').first().toJSON();

                        if (attachment.url) {
                            jQuery(imageclass).html('<video src="' + attachment.url + '" controls="" poster="" preload="none"></video>');
                            jQuery(updateurl).val(attachment.url);

                        }
                    }
                );
                file_frame.open();
            }
        )


        jQuery(document).on(
            'click',
            '#bpolls-attach-audio',
            function (event) {
                event.preventDefault();
                updateurl = jQuery(this).parent().find('.wbpoll_audio_answer_url');
                imageclass = jQuery(this).parent().parent().find('.wbpoll-image-input-preview-thumbnail');
                jQuery(this).parent().find('#no').prop('checked', true);
                jQuery(this).parent().find('#yes').prop('checked', false);
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media.frames.file_frame = wp.media(
                    {
                        title: 'Choose Audio',
                        button: {
                            text: 'Choose Audio'
                        },
                        library: {
                            type: ['audio']
                        },
                        multiple: false,
                        // library: {
                        // 	author: bpolls_ajax_object.poll_user
                        // }
                    }
                );

                file_frame.on(
                    'select',
                    function () {
                        attachment = file_frame.state().get('selection').first().toJSON();

                        if (attachment.url) {
                            jQuery(imageclass).html('<audio src="' + attachment.url + '" controls="" preload="none"></audio>');
                            jQuery(updateurl).val(attachment.url);

                        }
                    }
                );
                file_frame.open();
            }
        )
    }
);


jQuery('#wbpolls-create').submit(function (event) {
    event.preventDefault();
    const author_id = jQuery('#author_id').val();
    const title = jQuery('#polltitle').val();
    var editor = tinyMCE.get('poll-content');
    var content = editor.getContent();
    //const content = jQuery('#poll-content').val();
    const poll_type = jQuery('#poll_type').val();
    const answer = jQuery('[name="_wbpoll_answer[]"]').map(function () {
        return jQuery(this).val();
    }).get();
    const answertype = jQuery('[name="_wbpoll_answer_extra[][type]"]').map(function () {
        return jQuery(this).val();
    }).get();
    const full_size_image_answer = jQuery('[name="_wbpoll_full_size_image_answer[]"]').map(function () {
        return jQuery(this).val();
    }).get();
    const video_answer_url = jQuery('[name="_wbpoll_video_answer_url[]"]').map(function () {
        return jQuery(this).val();
    }).get();
    const audio_answer_url = jQuery('[name="_wbpoll_audio_answer_url[]"]').map(function () {
        return jQuery(this).val();
    }).get();
    const html_answer = jQuery('[name="_wbpoll_html_answer[]"]').map(function () {
        return jQuery(this).val();
    }).get();
    const video_import_info = jQuery('input[name="_wbpoll_video_import_info[]"]:checked').map(function () {
        return jQuery(this).val();
    }).get();
    const audio_import_info = jQuery('input[name="_wbpoll_audio_import_info[]"]:checked').map(function() {
        return jQuery(this).val();
      }).get();
      
    const _wbpoll_start_date = jQuery('#_wbpoll_start_date').val();
    const _wbpoll_end_date = jQuery('#_wbpoll_end_date').val();
    const _wbpoll_user_roles = jQuery('#_wbpoll_user_roles-chosen').val();
    const _wbpoll_content = jQuery('input[name="_wbpoll_content"]:checked').val();
    const _wbpoll_never_expire = jQuery('input[name="_wbpoll_never_expire"]:checked').val();
    const _wbpoll_show_result_before_expire = jQuery('input[name="_wbpoll_show_result_before_expire"]:checked').val();
    const _wbpoll_multivote = jQuery('input[name="_wbpoll_multivote"]:checked').val();
    const _wbpoll_vote_per_session = jQuery('#_wbpoll_vote_per_session-number').val();
    const _wbpoll_add_additional_fields = jQuery('input[name="_wbpoll_add_additional_fields"]:checked').val();

    if(title == ""){
        jQuery('#error_title').text('Poll Title is required');
    }else if(poll_type == ""){
        jQuery('#error_type').text('Poll Type is required');
    }else if(answer == ",,,,"){
        jQuery('#error_ans').text('Poll options is required');
    }else{
        const data = {
            author_id: author_id,
            title: title,
            content: content,
            poll_type: poll_type,
            _wbpoll_answer: answer,
            _wbpoll_answer_extra: answertype,
            _wbpoll_full_size_image_answer: full_size_image_answer,
            _wbpoll_video_answer_url: video_answer_url,
            _wbpoll_audio_answer_url: audio_answer_url,
            _wbpoll_video_import_info: video_import_info,
            _wbpoll_audio_import_info: audio_import_info,
            _wbpoll_html_answer: html_answer,
            _wbpoll_start_date: _wbpoll_start_date,
            _wbpoll_end_date: _wbpoll_end_date,
            _wbpoll_user_roles: _wbpoll_user_roles,
            _wbpoll_content: _wbpoll_content,
            _wbpoll_never_expire: _wbpoll_never_expire,
            _wbpoll_show_result_before_expire: _wbpoll_show_result_before_expire,
            _wbpoll_multivote: _wbpoll_multivote,
            _wbpoll_vote_per_session: _wbpoll_vote_per_session,
            _wbpoll_add_additional_fields:_wbpoll_add_additional_fields,
        };
        var siteUrl = wbpollpublic.url;
        jQuery.ajax({
            url: siteUrl + '/wp-json/wbpoll/v1/postpoll',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                if (response.success) {
                    jQuery('#pollsuccess').show();
                    jQuery('#pollsuccess').text(response.message);
                    window.setTimeout(
                        function () {
                            jQuery('#pollsuccess').hide();
                            jQuery('#pollsuccess').text(''); 
                            location.reload();                       
                        },
                        3000
                    );
                } else {
                    jQuery('#pollsuccess').hide();              
                }
            },
        });
    }
});