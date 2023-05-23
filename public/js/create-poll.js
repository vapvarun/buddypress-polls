jQuery('#poll_type').on('change', function() {
    var type = jQuery(this).val();
    if (type == 'default') {
        jQuery('#type_text').show();
    } else if (type == 'image') {
        jQuery('#type_image').show();
    } else if (type == 'video') {
        jQuery('#type_video').show();
    } else if (type == 'audio') {
        jQuery('#type_audio').show();
    } else if (type == 'html') {
        jQuery('#type_html').show();
    } else {
        jQuery('#type_text').hide();
        jQuery('#type_image').hide();
        jQuery('#type_video').hide();
        jQuery('#type_audio').hide();
        jQuery('#type_html').hide();
    }
});

jQuery('.extra-fields-text').click(function(e) {
    e.preventDefault();
    jQuery('.text_records').clone().appendTo('.text_records_dynamic');
    jQuery('.text_records_dynamic .text_records').addClass('single remove');
    jQuery('.single .extra-fields-text').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-text">Remove Fields</a>');
    jQuery('.text_records_dynamic > .single').attr("class", "remove");

    jQuery('.text_records_dynamic input').each(function() {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });

});

jQuery('.extra-fields-image').click(function() {
    jQuery('.image_records').clone().appendTo('.image_records_dynamic');
    jQuery('.image_records_dynamic .image_records').addClass('single remove');
    jQuery('.single .extra-fields-image').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-image">Remove Fields</a>');
    jQuery('.image_records_dynamic > .single').attr("class", "remove");

    jQuery('.image_records_dynamic input').each(function() {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });

});

jQuery('.extra-fields-video').click(function() {
    jQuery('.video_records').clone().appendTo('.video_records_dynamic');
    jQuery('.video_records_dynamic .video_records').addClass('single remove');
    jQuery('.single .extra-fields-video').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-video">Remove Fields</a>');
    jQuery('.video_records_dynamic > .single').attr("class", "remove");

    jQuery('.video_records_dynamic input').each(function() {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });

});

jQuery('.extra-fields-audio').click(function() {
    jQuery('.audio_records').clone().appendTo('.audio_records_dynamic');
    jQuery('.audio_records_dynamic .audio_records').addClass('single remove');
    jQuery('.single .extra-fields-audio').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-audio">Remove Fields</a>');
    jQuery('.audio_records_dynamic > .single').attr("class", "remove");

    jQuery('.audio_records_dynamic input').each(function() {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });

});

jQuery('.extra-fields-html').click(function() {
    jQuery('.html_records').clone().appendTo('.html_records_dynamic');
    jQuery('.html_records_dynamic .html_records').addClass('single remove');
    jQuery('.single .extra-fields-html').remove();
    jQuery('.single').append('<a href="#" class="remove-field btn-remove-html">Remove Fields</a>');
    jQuery('.html_records_dynamic > .single').attr("class", "remove");

    jQuery('.html_records_dynamic input').each(function() {
        var count = 0;
        var fieldname = jQuery(this).attr("name");
        jQuery(this).attr('name', fieldname);
        count++;
    });

});

jQuery(document).on('click', '.remove-field', function(e) {
    jQuery(this).parent('.remove').remove();
    e.preventDefault();
});


jQuery('#wbpolls-create').submit(function (event) {
    event.preventDefault();

    const title = jQuery('#polltitle').val();
    const content = jQuery('#poll-content').val();
    const poll_type = jQuery('#poll_type').val();
    const answer = jQuery('[name="_wbpoll_answer[]"]').map(function() {
        return jQuery(this).val();
    }).get();
    const answertype = jQuery('[name="_wbpoll_answer_extra[][type]"]').map(function() {
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

    const data = {
        title: title,
        content: content,
        poll_type: poll_type,
        _wbpoll_answer:answer,
        _wbpoll_answer_extra:answertype,
        _wbpoll_start_date:_wbpoll_start_date,
        _wbpoll_end_date:_wbpoll_end_date,
        _wbpoll_user_roles:_wbpoll_user_roles,
        _wbpoll_content:_wbpoll_content,
        _wbpoll_never_expire:_wbpoll_never_expire,
        _wbpoll_show_result_before_expire:_wbpoll_show_result_before_expire,
        _wbpoll_multivote:_wbpoll_multivote,
        _wbpoll_vote_per_session:_wbpoll_vote_per_session,
    };

    jQuery.ajax({
        url: 'http://totalpoll.local/wp-json/wbpoll/v1/postpoll',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            if (response.success) {
                alert('Post created successfully.');
                jQuery('#post-form')[0].reset();
            } else {
                alert('Failed to create post.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
});