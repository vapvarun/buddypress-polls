jQuery('.pause_poll').on('click', function () {
    var pollid = jQuery(this).data('id');
    var pause_poll = jQuery(this).data('value');
    // if (pause_poll == 1) {
    //     jQuery(this).text('Resume');
    //     jQuery(this).attr('data-value', '0');
    // } else if (pause_poll == 0) {
    //     jQuery(this).text('Pause');
    //     jQuery(this).attr('data-value', '1');
    // }
    const data = {
        pollid: pollid,
        _wbpoll_pause_poll: pause_poll,
    };
    
    var siteUrl = wbpollpublic.url;
    jQuery.ajax({
        url: siteUrl + '/wp-json/wbpoll/v1/listpoll/pause/poll',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Failed to create post.');
            }
        }
    });
});

jQuery('.delete_poll').on('click', function () {
    var pollid = jQuery(this).data('id');
    
    const data = {
        pollid: pollid,
    };
    
    var siteUrl =wbpollpublic.url;
    jQuery.ajax({
        url: siteUrl + '/wp-json/wbpoll/v1/listpoll/delete/poll',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Failed to delete poll.');
            }
        }
    });
});