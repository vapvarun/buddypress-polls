if (typeof wp !== 'undefined' && wp.i18n) {
    const { __ } = wp.i18n;
}
(function ($) {
    'use strict';
    var load_Chart;
    window.onload = function () {
        $('.poll-default-bar-chart').each(
            function () {
                var act_id = $(this).data('id');
                var id = $(this).attr('id');
                var res = JSON.parse(bp_default_poll_wiget_obj.votes);
               
                if (res[act_id]) {
                    var arr_label = [];
                    var arr_per = [];
                    var arr_color = [];
                    $.each(
                        res[act_id],
                        function (i, item) {
                            arr_label.push(item.label.toString());
                            arr_per.push(item.y.toString());
                            arr_color.push(item.color);
                        }
                    );

                    load_Chart = new Chart(
                        $("#" + id),
                        {
                            type: 'pie',
                            data: {
                                labels: arr_label,
                                datasets: [{
                                    label: "Poll Default Activity Graph (%)",
                                    backgroundColor: arr_color,
                                    data: arr_per
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: res[act_id][0].poll_title
                                }
                            }
                        }
                    );
                }

            }
        );
    }


})(jQuery);
