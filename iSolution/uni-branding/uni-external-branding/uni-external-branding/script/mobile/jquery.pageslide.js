$.fn.pageSlide = function (options) {
	var settings = $.extend({
		width: "227px", // Accepts fixed widths
		duration: "fast", // Accepts standard jQuery effects speeds (i.e. fast, normal or milliseconds)
		direction: "left", // default direction is left.
		modal: false, // if true, the only way to close the pageslide is to define an explicit close class. 
		start: function () {}, // event trigger that fires at the start of every open and close.
		stop: function () {}, // event trigger that fires at the end of every open and close.
		complete: function () {} // event trigger that fires once an open or close has completed.
	}, options);
	// these are the minimum css requirements for the pageslide elements introduced in this plugin.
	var pageslide_slide_wrap_css = {
		position: 'fixed',
		width: '0',
		top: '0',
		height: '100%',
		zIndex: '999',
		overflow: 'auto'
	};
	var pageslide_body_wrap_css = {
		position: 'relative',
		zIndex: '0'
	};
	var pageslide_blanket_css = {
		position: 'absolute',
		top: '0px',
		left: '0px',
		height: '100%',
		width: '100%',
		opacity: '0.0',
		backgroundColor: 'black',
		zIndex: '1',
		display: 'none'
	};

	function _initialize(anchor) {
		// Create and prepare elements for pageSlide
		if ($("#pageslide-body-wrap, #pageslide-content, #pageslide-slide-wrap").size() == 0) {
			var psBodyWrap = document.createElement("div");
			$(psBodyWrap).css(pageslide_body_wrap_css);
			$(psBodyWrap).attr("id", "pageslide-body-wrap").width('auto');
			$("#ls-canvas").contents().not("#ls-row-5, #ls-row-6").wrapAll(psBodyWrap);
			//$("body").contents().not("script").attr("hello", "true");
			var psSlideContent = document.createElement("div");
			$(psSlideContent).attr("id", "pageslide-content").width(settings.width);
			var psSlideWrap = document.createElement("div");
			$(psSlideWrap).css(pageslide_slide_wrap_css);
			$(psSlideWrap).attr("id", "pageslide-slide-wrap").append(psSlideContent);
			$("body").append(psSlideWrap);
		}
		// introduce the blanket if modal option is set to true.
		if ($("#pageslide-blanket").size() == 0 && settings.modal == true) {
			var psSlideBlanket = document.createElement("div");
			$(psSlideBlanket).css(pageslide_blanket_css);
			$(psSlideBlanket).attr("id", "pageslide-blanket");
			$("body").append(psSlideBlanket);
			$("#pageslide-blanket").click(function () {
				return false;
			});
		}
		$("#pageslide-slide-wrap").click(function () {
			// return false;
		});
		if (settings.modal != true) {
			$("#pageslide-body-wrap").unbind('click').click(function (elm) {
				_closeSlide(elm);
				//return false
			});
		}
		// Callback events for window resizing
		$(window).resize(function () {
			$("#pageslide-body-wrap").width('auto');
		});
	};

	function _openSlide(elm) {
		pauseresize = 1;
		sotonReactive.isOpen = 1;
		//Move components for open menu
		$("#nav").appendTo("#pageslide-content");
		$("#nav").css("display", "block");
		$("#ls-row-5-area-1").css("margin-left", "210px");
		_showBlanket();
		settings.start();
		// decide on a direction
		if (settings.direction == "right") {
			direction = {
				right: "-" + settings.width
			};
			$("#pageslide-slide-wrap").css({
				left: 0
			});
			_overflowFixAdd();
		} else {
			direction = {
				left: "-" + settings.width
			};
			$("#pageslide-slide-wrap").css({
				right: 0
			});
		};
		$("#pageslide-slide-wrap").animate({
			width: settings.width
		}, settings.duration);
		$("#pageslide-body-wrap").animate(direction, settings.duration, function () {
			settings.stop();
			settings.complete();
			// restore working order to all anchors
			$("#slide-right").unbind('click').click(function (elm) {
				document.location.href = elm.target.href;
			});
			setTimeout(function () {
				pauseresize = 0
			}, 1000);
		});
	};

	function _closeSlide(elm) {
		// later, now switching back
		if ($(elm)[0].button != 2 && $("#pageslide-slide-wrap").css('width') != "0px") { // if not right click.
			pauseresize = 1;
			sotonReactive.isOpen = 0;
			_hideBlanket();
			settings.start();
			direction = ($("#pageslide-slide-wrap").css("left") != "0px") ? {
				left: "0"
			} : {
				right: "0"
			};
			$("#pageslide-body-wrap").animate(direction, settings.duration);
			$("#pageslide-slide-wrap").animate({
				width: "0"
			}, settings.duration, function () {
				$("#nav").css("display", "none");
				$("#ls-row-5-area-1").css("margin-left", "");
				// clear bug
				$('#pageslide-body-wrap, #pageslide-slide-wrap').css('left', '');
				$('#pageslide-body-wrap, #pageslide-slide-wrap').css('right', '');
				settings.stop();
				settings.complete();
				// restore working order to all anchors
				$("#slide-right").unbind('click').click(function (elm) {
					document.location.href = elm.target.href;
					_openSlide(window);
				});
				//Resume normal device functionality
				document.ontouchmove = function (e) {
					return true;
				}
				//Timeout for slide animation
				setTimeout(function () {
					pauseresize = 0
				}, 1000);
			});
		}
	};
	// Close slide fucntion call. 
	$.slideclose = {
		close: function () {
			_closeSlide(window);
		}
	};
	$.slideopen = {
		open: function () {
			_openSlide(window);
		}
	};
	// this is used to activate the modal blanket, if the modal setting is defined as true.
	function _showBlanket() {
		if (settings.modal == true) {
			$("#pageslide-blanket").toggle().animate({
				opacity: '0.8'
			}, 'fast', 'linear');
		}
	};
	// this is used to deactivate the modal blanket, if the modal setting is defined as true.
	function _hideBlanket() {
		if (settings.modal == true) {
			$("#pageslide-blanket").animate({
				opacity: '0.0'
			}, 'fast', 'linear', function () {
				$(this).toggle();
			});
		}
	};
	// fixes an annoying horizontal scrollbar.
	function _overflowFixAdd() {
		($.browser.msie) ? $("body, html").css({
			overflowX: 'hidden'
		}) : $("body").css({
			overflowX: 'hidden'
		});
	}

	function _overflowFixRemove() {
		($.browser.msie) ? $("body, html").css({
			overflowX: ''
		}) : $("body").css({
			overflowX: ''
		});
	}
	// Initalize pageslide, if it hasn't already been done.
	_initialize(this);
	return this.each(function () {
		$(this).unbind("click").bind("click", function () {
			_openSlide(this);
			return false;
		});
	});
};

var sotonReactive = 
	{
		tabletWidth: 768,
		phoneWidth: 480,
		viewMode: "Full",
		isOpen: 0,
		removeHoverNew: function() {
		
		if (!("ontouchstart" in document.documentElement)) {
    document.documentElement.className += " no-touch";
}
},
		removeHover: function() {
		// disable :hover on touch devices
// re http://retrogamecrunch.com/tmp/hover
if ('createTouch' in document) {
    try {
        var pattern = /:hover\b/,
        sheet, rule, selectors, newSelector,
        selectorAdded, newRule, i, j, k;
 
        for (i=0; i<document.styleSheets.length; i++) {
            sheet = document.styleSheets[i];
 
            for (j=sheet.cssRules.length-1; j>=0; j--) {
                rule = sheet.cssRules[j];
 
                if (rule.type !== CSSRule.STYLE_RULE || !pattern.test(rule.selectorText)) {
                    continue;
                }
 
                selectors = rule.selectorText.split(',');
                newSelector = '';
                selectorAdded = false;
 
                // Iterate over the selectors and test them against the pattern
                for (k=0; k<selectors.length; k++) {
                    // Add string to the new selector if it didn't match
                    if (pattern.test(selectors[k])) {
                        continue;
                    }
 
                    if (!selectorAdded) {
                        newSelector += selectors[k];
                        selectorAdded = true;
                    } else {
                        newSelector += ", " + selectors[k];
                    }
                }
 
                // Remove the rule, and add the new one if we've got something
                // added to the new selector
                if (selectorAdded) {
                    newRule = rule.cssText.replace(/([^{]*)?/, newSelector + ' ');
 
                    sheet.deleteRule(j);
                    sheet.insertRule(newRule, j);
                } else {
                    sheet.deleteRule(j);
                }
            }
        }
    } catch(e){}
}
		
		},
	    anchorLookup: [],
		populateAnchorLookup: function(){
			var count = 0;
			$('#accordion h3 a').each(function() {sotonReactive.anchorLookup[$(this).attr("href")] = count;count++;});
			},
		/* The main function. Checks what the current window size is and where components should be placed. */
	    checkWidth: function() {
	        var windowsize = $(document).width();
	        if (windowsize <= sotonReactive.tabletWidth && sotonReactive.viewMode === "Full") { // entering tablet mode from full
				// apply styles for tablet portrait and below
				$("#nav").css("display", "none");
				$("#nav").appendTo("#pageslide-content");
				$("#slide-right").css("display", "block");
				//producing bug
				//$(".profileQuote").prepend($('.profileQuote'));
				$(".profileQuote").insertAfter(".staffname")
				$("#slide-right").unbind('click').click(function (elm) {
					$.slideopen.open();
				});
				//sotonReactive.checkIfvisible();
				$("div.summary").appendTo("#ls-row-3");
				$("#pageslide-slide-wrap").css('width', '0');
				$('#pageslide-body-wrap, #pageslide-slide-wrap').css('left', '');
				$('#pageslide-body-wrap, #pageslide-slide-wrap').css('right', '');
				if ($('.flexslider').length) {
				$(".homepage .menu-icon").css("bottom", "177px");
				}else {
				$(".homepage .menu-icon").css("bottom", "83px");
				}
						
				sotonReactive.viewMode = "Tablet";
			}
			if ((windowsize <= sotonReactive.phoneWidth && sotonReactive.viewMode === "Tablet") ){ // entering phone mode from tablet
					var hash = window.location.hash;
					var thash = hash.substring(hash.lastIndexOf('#'), hash.length);
					var activeTabIndex;
					if (thash) {activeTabIndex = sotonReactive.anchorLookup[thash];} else {activeTabIndex = 0;}
					

    				$(".tabtitle > a").click(function(event){
					var tabhref = $(this).attr('href');
					window.location.hash=tabhref.toLowerCase();					
					})

					sotonReactive.viewMode = "Phone";
			}
			if ((windowsize > sotonReactive.phoneWidth && sotonReactive.viewMode === "Phone") ){ // entering tablet mode from phone
				
				//$("#accordion").accordion( "destroy" );	

				sotonReactive.viewMode = "Tablet";
			}
			if ((windowsize > sotonReactive.tabletWidth && sotonReactive.viewMode === "Tablet") ){ // entering full mode from tablet
				$("#slide-right").unbind('click').click(function (elm) {
					$.slideopen.open();
				});
				$(".profileQuote").prependTo("#card_background .col2")
				$("#pageslide-slide-wrap").css('width', '0');
				$('#pageslide-body-wrap, #pageslide-slide-wrap').css('left', '');
				$('#pageslide-body-wrap, #pageslide-slide-wrap').css('right', '');
				if ($('#navposbig').length) {
				$("#nav").appendTo("#navposbig");
				} else {
				$("#nav").appendTo("#navposdefault");
				}
				$("div.summary").appendTo(".headerImage");
				$("#nav").css("display", "block");
				$("#slide-right").css("display", "none");
				sotonReactive.viewMode = "Full";
			}
	    },
		
		activateFlexslider: function(){
		

		if ($("#homeHead").length > 0) {
			    // For section page image slider Can also be used with $(document).ready()
	    $('.flexslider').flexslider({
	        animation: "fade",
			animationDuration: 400,
	        controlNav: false,
	        directionNav: true,
			smoothHeight: false, 
	        slideshow: true,
	        easing: "swing",
			                  //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
	    });

}
 else { 


	    $('.flexslider').flexslider({
    animation: "fade",
      controlsContainer: ".flex-container",		//Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. If the given element is not found, the default action will be taken.				  
      slideDirection: "horizontal",   //String: Select the sliding direction, 'horizontal' or 'vertical'
      slideshow: true,                //Boolean: Animate slider automatically
      slideshowSpeed: 4000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
      animationDuration: 400,         //Integer: Set the speed of animations, in milliseconds
      directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
      controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
      keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
      mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
      prevText: "Previous",           //String: Set the text for the "previous" directionNav item
      nextText: "Next",               //String: Set the text for the "next" directionNav item
      pausePlay: false,               //Boolean: Create pause/play dynamic element
      pauseText: "Pause",             //String: Set the text for the "pause" pausePlay item
      playText: "Play",               //String: Set the text for the "play" pausePlay item
      randomize: false,               //Boolean: Randomize slide order
      slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
      animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
      pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
      pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering     
      manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
      start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
      before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
      after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
      end: function(){} 
			                  //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
	    });

}
		}

	};
	
	jQuery(document).ready(function ($) {
		//sotonReactive.populateAnchorLookup(); 
		sotonReactive.activateFlexslider();
		//sotonReactive.removeHover(); This will be used for cases where hover does not operate us expected on touch devices.
		sotonReactive.removeHoverNew();
	    /* prepend menu icon */
		if ($('.headerImage').length) {
			$('<a href="#" title="Open Menu" id="slide-right" rel="pageslide" class="menu-icon">Menu</a>').appendTo('.headerImage');
		}
		else {
			if ($('#navposbig').length) {
			$('#navposbig').prepend('<a href="#" title="Open Menu" id="slide-right" rel="pageslide" class="menu-icon">Menu</a>');
			}
			else {
			$('#navposdefault').prepend('<a href="#" title="Open Menu" id="slide-right" rel="pageslide" class="menu-icon">Menu</a>');
			}
		}
	    
	    //  Bind event listener
	    sotonReactive.checkWidth();
	    $(window).resize(sotonReactive.checkWidth);
	    /* toggle nav */
	    $(".menu-icon").on("click", function () {
	        $("#slide-right").pageSlide({
	            width: "227px",
	            direction: "right"
	        });
	        $("#nav").css("display", "block");
	    });
	    // function call for the slide functionality for smartphones and tablets.
	    $("#ls-canvas").wipetouch({
	        wipeLeft: function (result) {
	            if (sotonReactive.isOpen == 1) {
	                document.ontouchmove = function (e) {
	                    e.preventDefault();
	                }
	                $.slideclose.close();
	            }
	        },
	        wipeUp: function (result) {
	            if (sotonReactive.isOpen == 1) {
	                var menudiv = "ls-canvas";
	                menudiv.ontouchmove = function (e) {
	                    e.preventDefault();
	                }
	                $.slideclose.close();
	            }
	        }
	    });
	});
	//Page slide call
	jQuery(document).ready(function ($) {
	    $("#slide-right").pageSlide({
	        width: "227px",
	        direction: "right"
	    });
	    //jQuery.error = console.error;
	});
	