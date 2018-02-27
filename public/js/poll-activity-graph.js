(function( $ ) {
	'use strict';

window.onload = function () {
	$('.bpolls-activity-chartContainer').each(function(){
		var act_id = $(this).data('id');

		var res = JSON.parse(bpolls_wiget_obj.votes);
		var pollObj = [];
		$.each(res[act_id], function(i, item) {
			var poll = {}
			poll["label"] = item.label;
			poll["y"] = item.y;
			pollObj.push(poll);
		});

		var options = {
			animationEnabled: true,
			title: {
				text: res[act_id][0].poll_title
			},
			axisY: {
				title: "Poll Rate (in %)",
				suffix: "%",
				includeZero: false
			},
			axisX: {
				title: 'Poll Options'
			},
			data: [{
				type: "column",
				yValueFormatString: "#,##0.0#"%"",
				dataPoints:pollObj
			}]
		};
		var id = $(this).attr('id');
		$("#"+id).CanvasJSChart(options);
	});
}

$( document ).on(
	'change', '.bpolls-activities-list', function () {
		var actid = $( this ).find( ":selected" ).val();
		var clickd_obj = $(this);
		var data = {
					'action': 'bpolls_activity_graph_ajax',
					'actid' : actid,
					'ajax_nonce': bpolls_wiget_obj.ajax_nonce
				};

		$.post( bpolls_wiget_obj.ajax_url, data, function ( response ) {
			var resp = JSON.parse(response);
			var pollObj = [];
			$.each(resp[actid], function(i, item) {
				var poll = {}
				poll["label"] = item.label;
				poll["y"] = item.y;
				pollObj.push(poll);
			});
			var options = {
				animationEnabled: true,
				title: {
					text: resp[actid][0].poll_title
				},
				axisY: {
					title: "Poll Rate (in %)",
					suffix: "%",
					includeZero: false
				},
				axisX: {
					title: 'Poll Options'
				},
				data: [{
					type: "column",
					yValueFormatString: "#,##0.0#"%"",
					dataPoints:pollObj
				}]
			};
			clickd_obj.parents().siblings('.bpolls-activity-chartContainer').CanvasJSChart(options);
		} );
	}
);
})( jQuery );	
