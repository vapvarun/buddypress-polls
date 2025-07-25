if (typeof wp !== 'undefined' && wp.i18n) {
	const { __ } = wp.i18n;
}

(function ($) {
	'use strict';

	var bpollsChartInstances = {};

	function renderPollChart(canvasId, dataItems, title) {
		var ctx = document.getElementById(canvasId);
		var arr_label = [];
		var arr_per = [];
		var arr_color = [];
		var maxLabelLength = 20;

		$.each(dataItems, function (i, item) {
			var truncatedLabel = item.label.length > maxLabelLength
				? item.label.substring(0, maxLabelLength) + '…'
				: item.label;

			arr_label.push(truncatedLabel);
			arr_per.push(item.y.toString());
			arr_color.push(item.color);
		});

		if (bpollsChartInstances[canvasId]) {
			bpollsChartInstances[canvasId].destroy();
		}

		bpollsChartInstances[canvasId] = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: arr_label,
				datasets: [{
					label: "Poll Activity Graph (%)",
					backgroundColor: arr_color,
					data: arr_per
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				animation: {
					animateScale: true,
					animateRotate: true
				},
				plugins: {
					title: {
						display: true,
						text: title
					},
					tooltip: {
						callbacks: {
							label: function (context) {
								var index = context.dataIndex;
								return dataItems[index].label + ': ' + context.formattedValue + '%';
							}
						}
					},
					legend: {
						position: 'bottom',
						labels: {
							boxWidth: 12
						}
					}
				}
			}
		});
	}

	function loadPollChart(element) {
		var $select = $(element);
		var actid = $select.val();

		if (!actid) return;

		var data = {
			action: 'bpolls_activity_graph_ajax',
			actid: actid,
			ajax_nonce: bpolls_wiget_obj.ajax_nonce
		};

		$.post(bpolls_wiget_obj.ajax_url, data, function (response) {
			var resp = JSON.parse(response);
			if (!resp[actid]) return;

			$select.parents().siblings('.poll-bar-chart').remove();

			var canvasId = 'bpolls-activity-chart-' + actid;
			$('<canvas class="poll-bar-chart" data-id="' + actid + '" id="' + canvasId + '"></canvas>')
				.insertAfter($select.parents('.bpolls-activity-select'));

			renderPollChart(canvasId, resp[actid], resp[actid][0].poll_title);
		});
	}

	window.onload = function () {
		var res = JSON.parse(bpolls_wiget_obj.votes);

		$('.poll-bar-chart, .poll-activity-chart').each(function () {
			var $canvas = $(this);
			var act_id = $canvas.data('id');
			var id = $canvas.attr('id');

			if (res[act_id]) {
				renderPollChart(id, res[act_id], res[act_id][0].poll_title);
			}
		});

		
	};

	$(document).ready(function () {
		$(document).on('change', '.bpolls-activities-list', function (e) {
			e.preventDefault();
			var activityId = $(this).val();
			if (activityId) {
				$('#export-poll-data').attr('href',
					'?export_csv=1&buddypress_poll=1&activity_id=' + activityId + '&_wpnonce=' + bpolls_wiget_obj.export_csv_nonce
				);
			}
		});

		if ($(".bpolls-activities-list option:selected").val() != '') {
			loadPollChart( '.bpolls-activities-list' );
		}


		$(document).on('change', '.bpolls-activities-list', function () {
			loadPollChart( '.bpolls-activities-list' );
		});
		
	});

})(jQuery);
