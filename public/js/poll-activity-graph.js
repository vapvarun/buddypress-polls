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
				text: "Poll Rate - 2018"
			},
			axisY: {
				title: "Poll Rate (in %)",
				suffix: "%",
				includeZero: false
			},
			axisX: {
				title: "Poll Activity Graph"
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
})( jQuery );	
