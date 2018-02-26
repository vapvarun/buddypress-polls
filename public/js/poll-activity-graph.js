(function( $ ) {
	'use strict';
	var res = JSON.parse(bpolls_wiget_obj.votes);
	var pollObj = [];
	$.each(res, function(i, item) {
		var poll = {}
		poll["label"] = res[i].label;
		poll["y"] = res[i].y;
		 pollObj.push(poll);
	});
	
	window.onload = function () {
	var res = JSON.parse(bpolls_wiget_obj.votes);
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

//$("#bpolls-activity-chartContainer").CanvasJSChart(options);

$('.bpolls-activity-chartContainer').each(function(){
	$(this).CanvasJSChart(options);
});

}

})( jQuery );	
