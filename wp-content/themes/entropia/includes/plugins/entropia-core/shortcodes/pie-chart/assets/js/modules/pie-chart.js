(function($) {
	'use strict';
	
	var pieChart = {};
	edgtf.modules.pieChart = pieChart;
	
	pieChart.edgtfInitPieChart = edgtfInitPieChart;
	
	
	pieChart.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function edgtfInitPieChart() {
		var pieChartHolder = $('.edgtf-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.edgtf-pc-percentage'),
					svg = pieChart.find('svg'),
					barColor = '#ff0000',
					trackColor = '#8ef8d2',
					lineWidth = 2,
					size = 218;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
					if (size !==218) {
                    	pieChart.find('.edgtf-pc-title').css({'top' : size/2});
                    }
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: false,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: edgtfGlobalVars.vars.edgtfElementAppearAmount});

				svg.css({'color' : trackColor, 'width' : '105%'});

                var glow = glowColor(barColor,40,.55);

                pieChart.find('canvas').css({
					'color' : glow,
					'filter' : 'drop-shadow(1px 1px 5px currentColor) drop-shadow(-1px -1px 5px currentColor)',
					'-webkit-filter' : 'drop-shadow(1px 1px 5px currentColor) drop-shadow(-1px -1px 5px currentColor)'
				});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
    function initToCounterPieChart(pieChart) {
        var counter = pieChart.find('.edgtf-pc-percent'),
            svg = pieChart.find('svg'),
            max = parseFloat(counter.text()),
            barColor = '#ff0000',
            i,
			resto = 24*max % 100,
            getDotNum = Math.floor(24/100 * max);

        	if(resto > 70) {
                getDotNum = Math.ceil(24/100 * max);
			}


        if (typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
            barColor = pieChart.data('bar-color');
        }

        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

        svg.find(':last-child').css({'color': barColor});

        function delayedColorChange(i) {
            setTimeout(function () {
                svg.find(':nth-child(' + i + ')').css({'color': barColor});
            }, 100 + 50 * i);
        }

        for (i = 1; i <= getDotNum; i++) {
            delayedColorChange(i);
        }
    }

	//Get the glow color as a lighter version of the bar color
    function glowColor(color, percent, alpha) {

        var R = parseInt(color.substring(1,3),16);
        var G = parseInt(color.substring(3,5),16);
        var B = parseInt(color.substring(5,7),16);

        R = parseInt(R * (100 + percent) / 100);
        G = parseInt(G * (100 + percent) / 100);
        B = parseInt(B * (100 + percent) / 100);

        R = (R<255)?R:255;
        G = (G<255)?G:255;
        B = (B<255)?B:255;

		return 'rgba('+R+','+G+','+B+','+ alpha+')';
    }
	
})(jQuery);