(function($) {
    'use strict';
	
	var masonryGalleryList = {};
	edgtf.modules.masonryGalleryList = masonryGalleryList;

    masonryGalleryList.edgtfInitMasonryGallery = edgtfInitMasonryGallery;

    masonryGalleryList.edgtfOnDocumentReady = edgtfOnDocumentReady;
	
	$(document).ready(edgtfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfInitMasonryGallery().init();
	}
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function edgtfInitMasonryGallery() {
		var holder = $('.edgtf-masonry-gallery-holder');
		
		var initMasonryGallery = function (thisHolder, size) {
			thisHolder.waitForImages(function () {
				var masonry = thisHolder.children();
				
				masonry.isotope({
					layoutMode: 'packery',
					itemSelector: '.edgtf-mg-item',
					percentPosition: true,
					packery: {
						gutter: '.edgtf-mg-grid-gutter',
						columnWidth: '.edgtf-mg-grid-sizer'
					}
				});
				
				edgtf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('.edgtf-mg-item'), size, true);
				
				setTimeout(function () {
					edgtf.modules.common.edgtfInitParallax();
				}, 600);
				
				masonry.isotope( 'layout').css('opacity', '1');
			});
		};
		
		var reInitMasonryGallery = function (thisHolder, size) {
			edgtf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('.edgtf-mg-item'), size, true);
			
			thisHolder.children().isotope('reloadItems');
		};
		
		return {
			init: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this),
							size = thisHolder.find('.edgtf-mg-grid-sizer').outerWidth();
						
						initMasonryGallery(thisHolder, size);
						
						$(window).resize(function () {
							reInitMasonryGallery(thisHolder, size);
						});
					});
				}
			}
		};
	}

})(jQuery);