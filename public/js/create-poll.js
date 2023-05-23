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
        jQuery(this).attr('name', fieldname + count);
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
        jQuery(this).attr('name', fieldname + count);
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
        jQuery(this).attr('name', fieldname + count);
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
        jQuery(this).attr('name', fieldname + count);
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
        jQuery(this).attr('name', fieldname + count);
        count++;
    });

});

jQuery(document).on('click', '.remove-field', function(e) {
    jQuery(this).parent('.remove').remove();
    e.preventDefault();
});