<div class="main-poll-create">
    <div class="deshboard-top">
        <div class="main-title">
            <h6>Create Poll</h6>
        </div>
    </div>
    <div class="poll-create">
        <form>
            <div class="form-group">
                <label for="polltitle">Poll Title</label>
                <input type="text" class="form-control" name="poll_title" id="polltitle">
            </div>
            <div class="form-group">
                <label for="polltitle">Poll Description</label>
                <textarea class="form-control" name="poll_description"></textarea>
            </div>
            <div class="form-group">
                <label for="polltitle">Poll Type</label>
                <select class="form-control" name="poll_type" id="poll_type">
                    <option value="">Select Poll Type</option>
                    <option value="default">Text</option>
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>
                    <option value="html">HTML</option>
                </select>
            </div>

            <!-- for text type -->
            <div class="row" id="type_text" style="display:none;">
                <div class="text_records">
                    <label>Text Answer</label>
                    <input name="_wbpoll_answer[]" type="text" value="">
                    <a class="extra-fields-text" href="#">Add More</a>
                </div>
                <div class="text_records_dynamic"></div>
            </div>

            <!-- for image type -->
            <div class="row" id="type_image" style="display:none;">
                <div class="image_records">
                    <label>Image Answer</label>
                    <input name="_wbpoll_answer[]" type="text" value="">
                    <label>Image URL</label>
                    <input name="_wbpoll_full_size_image_answer[]" type="url" value="">
                    <a class="extra-fields-image" href="#">Add More</a>
                </div>
                <div class="image_records_dynamic"></div>
            </div>

            <!-- for video type -->
            <div class="row" id="type_video" style="display:none;">
                <div class="video_records">
                    <label>Video Answer</label>
                    <input name="_wbpoll_answer[]" type="text" value="">
                    <label>video URL</label>
                    <input name="_wbpoll_video_answer_url[]" type="url" value="">
                    <a class="extra-fields-video" href="#">Add More</a>
                </div>
                <div class="video_records_dynamic"></div>
            </div>


            <!-- for audio type -->
            <div class="row" id="type_audio" style="display:none;">
                <div class="audio_records">
                    <label>Audio Answer</label>
                    <input name="_wbpoll_answer[]" type="text" value="">
                    <label>Audio URL</label>
                    <input name="_wbpoll_audio_answer_url[]" type="url" value="">
                    <a class="extra-fields-audio" href="#">Add More</a>
                </div>
                <div class="audio_records_dynamic"></div>
            </div>

            <!-- for html type -->
            <div class="row" id="type_html" style="display:none;">
                <div class="html_records">
                    <label>HTML Answer</label>
                    <textarea name="_wbpoll_answer[]"></textarea>
                    <a class="extra-fields-html" href="#">Add More</a>
                </div>
                <div class="html_records_dynamic"></div>
            </div>
            
            <div class="wbcom-polls-option-wrap">
                <table class="form-table wbpoll-answer-options">
                    <tbody>
                        <tr>
                            <th><label for="_wbpoll_start_date">Start Date</label></th>
                            <td><input type="text" class="wbpollmetadatepicker hasDatepicker" name="_wbpoll_start_date" id="_wbpoll_start_date-date-1183" value="2023-05-10 07:46:11" size="30">
                                <span class="description">Poll Start Date. [<strong> Note:</strong> Field required. Default is today]</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="_wbpoll_end_date">End Date</label></th>
                            <td><input type="text" class="wbpollmetadatepicker hasDatepicker" name="_wbpoll_end_date" id="_wbpoll_end_date-date-1183" value="2023-05-16 07:46:11" size="30">
                                <span class="description">Poll End Date. [<strong> Note:</strong> Field required. Default is next seven days. ]</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="_wbpoll_user_roles">Who Can Vote</label></th>
                            <td>
                                <select name="_wbpoll_user_roles[]" id="_wbpoll_user_roles-chosen-1183" class="selecttwo-select select2-hidden-accessible" multiple="" data-select2-id="_wbpoll_user_roles-chosen-1183" tabindex="-1" aria-hidden="true">
                                    <option value="administrator" selected="selected" data-select2-id="2">Administrator</option>
                                    <option value="editor" selected="selected" data-select2-id="3">Editor</option>
                                    <option value="author" selected="selected" data-select2-id="4">Author</option>
                                    <option value="contributor" selected="selected" data-select2-id="5">Contributor</option>
                                    <option value="subscriber" selected="selected" data-select2-id="6">Subscriber</option>
                                    <option value="customer">Customer</option>
                                    <option value="shop_manager">Shop manager</option>
                                </select>
                                <span class="description">Which user role will have vote capability</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="_wbpoll_content">Show Poll Description in Shortcode</label></th>
                            <td>
                                <fieldset class="radio_fields">
                                    <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                                    <label title="g:i a" for="_wbpoll_content-radio-1183-1">
                                        <input id="_wbpoll_content-radio-1183-1" type="radio" name="_wbpoll_content" value="1" checked="checked">
                                        <span>Yes</span>
                                    </label><label title="g:i a" for="_wbpoll_content-radio-1183-0">
                                        <input id="_wbpoll_content-radio-1183-0" type="radio" name="_wbpoll_content" value="0">
                                        <span>No</span>
                                    </label>
                                </fieldset>
                                <span class="description">Select if you want to show content.</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="_wbpoll_never_expire">Never Expire</label></th>
                            <td>
                                <fieldset class="radio_fields">
                                    <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                                    <label title="g:i a" for="_wbpoll_never_expire-radio-1183-1">
                                        <input id="_wbpoll_never_expire-radio-1183-1" type="radio" name="_wbpoll_never_expire" value="1">
                                        <span>Yes</span>
                                    </label><label title="g:i a" for="_wbpoll_never_expire-radio-1183-0">
                                        <input id="_wbpoll_never_expire-radio-1183-0" type="radio" name="_wbpoll_never_expire" value="0" checked="checked">
                                        <span>No</span>
                                    </label>
                                </fieldset>
                                <span class="description">Select if you want your poll to never expire.(can be override from shortcode param)</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="_wbpoll_show_result_before_expire">Show Result After Expires</label></th>
                            <td>
                                <fieldset class="radio_fields">
                                    <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                                    <label title="g:i a" for="_wbpoll_show_result_before_expire-radio-1183-1">
                                        <input id="_wbpoll_show_result_before_expire-radio-1183-1" type="radio" name="_wbpoll_show_result_before_expire" value="1" checked="checked">
                                        <span>Yes</span>
                                    </label><label title="g:i a" for="_wbpoll_show_result_before_expire-radio-1183-0">
                                        <input id="_wbpoll_show_result_before_expire-radio-1183-0" type="radio" name="_wbpoll_show_result_before_expire" value="0">
                                        <span>No</span>
                                    </label>
                                </fieldset>
                                <span class="description">Select if you want poll to show result After expires. After expires the result will be shown always. Please check it if poll never expires.</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="_wbpoll_multivote">Enable Multi Choice</label></th>
                            <td>
                                <fieldset class="radio_fields">
                                    <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                                    <label title="g:i a" for="_wbpoll_multivote-radio-1183-1">
                                        <input id="_wbpoll_multivote-radio-1183-1" type="radio" name="_wbpoll_multivote" value="1">
                                        <span>Yes</span>
                                    </label><label title="g:i a" for="_wbpoll_multivote-radio-1183-0">
                                        <input id="_wbpoll_multivote-radio-1183-0" type="radio" name="_wbpoll_multivote" value="0" checked="checked">
                                        <span>No</span>
                                    </label>
                                </fieldset>
                                <span class="description">Can user vote multiple option</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="_wbpoll_vote_per_session">Votes Per Session</label></th>
                            <td><input type="number" class="regular-text" name="_wbpoll_vote_per_session" id="_wbpoll_vote_per_session-number-1183" value="1" size="30">
                                <span class="description">Votes Per Session</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Poll Create</button>
        </form>
    </div>
</div>

<script>
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

    jQuery('.extra-fields-text').click(function() {
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
</script>