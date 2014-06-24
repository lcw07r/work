jQuery(document).ready(function () {

                var userAgent = navigator.userAgent.toLowerCase();
                var browser = jQuery.browser;
                browser.chrome = /chrome/.test(userAgent.toLowerCase());
                var hashChangeEvent=false;
                var hashValue="";

                if (browser.msie) {
                                // Is this a version of IE?
                                jQuery('body').addClass('browserIE');

                                // Add the version number
                                jQuery('body').addClass('browserIE' + browser.version.substring(0,1));


                                if ( browser.version.substring(0,2) <8) {hashChangeEvent=true;}
                }
                else if(browser.chrome) {
                                // Is this a version of Chrome?

                                jQuery('body').addClass('browserChrome');

                                //Add the version number
                                userAgent = userAgent.substring(userAgent.indexOf('chrome/') +7);
                                userAgent = userAgent.substring(0,1);
                                jQuery('body').addClass('browserChrome' + userAgent);

                                // If it is chrome then jQuery thinks it's safari so we have to tell it it isn't
                                browser.safari = false;

                                if ( browser.version.substring(0,1) <5) hashChangeEvent=true;

                }
                else if (browser.safari) {
                                // Is this a version of Safari?
                                jQuery('body').addClass('browserSafari');

                                // Add the version number
                                userAgent = userAgent.substring(userAgent.indexOf('version/') +8);
                                userAgent = userAgent.substring(0,1);
                                jQuery('body').addClass('browserSafari' + userAgent);
                }
                else if (browser.mozilla) {
                                // Is this a version of Mozilla?

                                // Is it Firefox?
                                if (userAgent.indexOf('firefox') != -1) {
                                                jQuery('body').addClass('browserFirefox');

                                                // Add the version number
                                                userAgent = userAgent.substring(userAgent.indexOf('firefox/') +8);
                                                userAgent = userAgent.substring(0,1);
                                                jQuery('body').addClass('browserFirefox' + userAgent);
                                                if ( browser.version.substring(0,2) <4) hashChangeEvent=true;

                                }
                                else {
                                                // If not then it must be another Mozilla
                                                jQuery('body').addClass('browserMozilla');
                                }
                }
                else if (browser.opera) {
                // Is this a version of Opera?
                                jQuery('body').addClass('browserOpera');
                }


                // Hide all tabs but first.
                jQuery(".card:gt(0)").hide();

//            if (typeof console == 'undefined') {
//                            console = {
//                                            log: function(msg) {
//                                                            // alert(msg);
//                                            }
//                            };
//            }

                // Enable Tabs functionality
                jQuery("ul.tabs li a").click(function(event) {
                                //event.preventDefault();
                                //console.log("Tab clicked");
                //            jQuery(".card:visible").hide();
                //            var cardId = jQuery(this).attr("id").replace("tab", "card");
                                //console.log("Card : " + cardId);
                //            jQuery("#" + cardId).show();
                //            jQuery("ul.tabs li").removeClass("active");
                //            jQuery(this).parent().addClass("active");
                });

                /* Need to display YouTube description on mouse over
                * Take the description from the alt text of the image
                * Look for #youtube_image_description div
                */
                jQuery("#youtube_image_list li a").mouseover(
                                function(event) {
                                                var description = jQuery(this).attr("title");
                                                jQuery("#youtube_image_description").html(description);
                                }
                );

                /* Need to hide YouTube description when user
                * moves mouse outside youtube area in peripheral content
                */
                jQuery("div.peripheralcontent").mouseleave(
                                function(event) {
                                                jQuery("#youtube_image_description").html("");
                                }
                );

                /*
                * Fix layout in staff listing (vertical centring required of content of
                * unknown height in a block of unknown height).
                */
                jQuery("li.staff_list_item").each(
                                function(index) {
                                                var jContent = jQuery("p", this);
                                                var offset = (jQuery(this).innerHeight() - jContent.height())/2 - 5;
                                                                // The -5 is to allow for the padding of the <li> tag, which
                                                                // is included in the inner height.
                                                jContent.css("margin-top", offset);
                                }
                );

                /*
                * Fix layout in student testimonial (vertical height of quote needs to match image).
                */
                jQuery("div.article_heading").each(function(index) {
                                var $img = jQuery("div.image", this);
                                var $quote = jQuery("div.intro", this);
                                var height = $img.outerHeight() - ($quote.outerHeight() - $quote.height());
                                if (height > $quote.height()) {
                                                $quote.height(height);
                                }
                });

                /*
                * shrink image list area if there are fewer than 3 videos
                */
                if (jQuery("#youtube_image_list li a").size() <3){
                                jQuery("#youtube_image_list").css("min-height","50px");
                };

                /*
                * set height correctly by clearing out description
                */
                jQuery("#youtube_image_description").html("");

                /*
                * Slide the image captions up when rolled over
                */
                jQuery("div.image").hover(
        function(event) {
                                jQuery("div.moreContainer", this).slideToggle(400);
                },
                function(event) {
                                jQuery("div.moreContainer", this).slideToggle(400);
                }
    );

                /*
                * Slide the image captions up when rolled over
                */
                jQuery("#searchText").focus(function(event) {
                                if (this.value == this.defaultValue) {
                                                this.value = '';
                                }
                }).blur(function(event) {
                                if (this.value == '') {
                                                this.value = this.defaultValue;
                                }
    });

							function changeTab() {
			if (jQuery("ul.tabs").attr('id') == "theTabs") {
				var url = document.URL.split("#");
				var hashloc = location.hash;
				if (!hashloc) {
					hashloc = jQuery("#theTabs li a:first").attr('id');
					if (hashloc) {
						hashloc = "#" + hashloc.substring(0, hashloc.length - 1);
					}
				}
				if (hashloc) {
					jQuery(".card:visible").hide();
					var cardId = "#card_" + hashloc.replace("#", "");
					var tabId = hashloc + "1";
					jQuery("ul.tabs li").removeClass("active");
					jQuery(tabId).parent().addClass("active");
					jQuery(cardId).addClass("active");
					jQuery(cardId).show();
				}
			} else {

				// Enable Tabs functionality
				jQuery("ul.tabs li a").click(function (event) {
					event.preventDefault();
					//console.log("Tab clicked");
					jQuery(".card:visible").hide();
					var cardId = jQuery(this).attr("id").replace("tab", "card");
					//console.log("Card : " + cardId);
					jQuery("#" + cardId).show();
					jQuery("ul.tabs li").removeClass("active");
					jQuery(this).parent().addClass("active");
				});
			}
		}



function hasHashChanged()
{
if (hashValue!=location.hash)
{
  changeTab();
  hashValue=location.hash;
}
var t=setTimeout(function () {hasHashChanged()}, 100);
}


if (hashChangeEvent == false)
{
                $(window).bind('hashchange', function() {
 changeTab();
                                                                                });
}
else
{
                hasHashChanged();
}
changeTab();  

if ($('#filterList').length) {
    (function ($) {
        function listFilter(headerList, filterList) {
            // header is any element, list is an unordered list
            // create and add the filter form to the header
            var form = $("<form>").attr({
                "class": "filterform",
                "action": "#"
            }),
                input = $("<input>").attr({
                    "id": "filterinput",
                    "type": "text",
                    "color": "#ccc",
                    "value": "Search..."
                });
            $(input).appendTo(headerList);
            var selectSearch = $("#filterinput");
            var li = $("#filterList").find("li");
            var currentTimeout;
            selectSearch.on("keyup", function () {
                if (currentTimeout) {
                    window.clearTimeout(currentTimeout)
                };
                currentTimeout = setTimeout(showMatches, 100);
            });
            var inp = document.getElementById('filterinput'),
                def = inp.value;
            inp.onfocus = function () {
                inp.value = '';
            };
            inp.onblur = function () {
                inp.value = inp.value || def;
            };

            function showMatches() {
                var txt = selectSearch.val();
                txt = txt.toLowerCase()
                $('#filterList h3').hide();
                for (var i = 0, len = li.length; i < len; i++) {
                    var cont = i;
                    var a = $("a", li[i]);
                    var content = a ? a.text().toLowerCase() : li[i].innerText;
                    if ((txt && content.indexOf(txt) > -1) || (txt == "")) {
                        if (li[i].style.display !== "block") {
                            li[i].style.display = "block";
                        }
                        $(li[i]).parent().prev().show();
                        $('.pageList ul').css('border', 'none', 'important');
                    } else {
                        if (li[i].style.display !== "none") {
                            li[i].style.display = "none";
                        }
                    }
                }
            }
        }
        //ondomready
        $(function () {
            listFilter($("#headerList"), $("#filterList"));
        });
    }(jQuery));
}

$(function(){

	// The height of the content block when it's not expanded
	var adjustheight = 72;
	// The "more" link text
	var moreText = "...  More";
	// The "less" link text
	var lessText = "- Less";

	// Sets the .more-block div to the specified height and hides any content that overflows
	$(".more-less .more-block").css('height', adjustheight).css('overflow', 'hidden');

	// The section added to the bottom of the "more-less" div
	$(".more-less").append('<p class="continued"><!--block--></p><a href="#" class="adjust"></a>');

	$("a.adjust").text(moreText);

	$(".adjust").toggle(function() {
			$(this).parents("div:first").find(".more-block").css('height', 'auto').css('overflow', 'visible');
			// Hide the [...] when expanded
			$(this).parents("div:first").find("p.continued").css('display', 'none');
			$(this).text(lessText);
		}, function() {
			$(this).parents("div:first").find(".more-block").css('height', adjustheight).css('overflow', 'hidden');
			$(this).parents("div:first").find("p.continued").css('display', 'block');
			$(this).text(moreText);
	});
	});
		$( "<div class='addthis_toolbox addthis_default_style addthis_16x16_style'><span>Share:</span><a class='addthis_button_facebook'></a><a class='addthis_button_twitter'></a><a class='addthis_button_google_plusone_share'></a><a class='addthis_button_compact'></a><a class='addthis_counter addthis_bubble_style'></a></div>" ).appendTo( "#container" );


});

/* (c) 2008-2013 AddThis, Inc */
var addthis_conf={ver:300};if(!((window._atc||{}).ver)){var _atd="www.addthis.com/",_atr=window.addthis_cdn||"//s7.addthis.com/",_atrc="//c.copyth.is/",_euc=encodeURIComponent,_duc=decodeURIComponent,_atc={dbg:0,rrev:123733,dr:0,ver:250,loc:0,enote:"",cwait:500,bamp:0.25,camp:1,csmp:0.0001,damp:1,famp:0.02,pamp:0.05,tamp:1,plmp:1,vamp:1,cscs:1,vrmp:0,ohmp:0,ltj:1,xamp:1,abf:!!window.addthis_do_ab,qs:0,cdn:0,rsrcs:{bookmark:_atr+"static/r07/bookmark039.html",atimg:_atr+"static/r07/atimg039.html",countercss:_atr+"static/r07/counter013.css",counterIE67css:_atr+"static/r07/counterIE67004.css",counter:_atr+"static/r07/counter016.js",core:_atr+"static/r07/core103.js",wombat:_atr+"static/r07/bar022.js",wombatcss:_atr+"static/r07/bar010.css",qbarcss:_atr+"bannerQuirks.css",fltcss:_atr+"static/r07/floating010.css",barcss:_atr+"static/r07/banner006.css",barjs:_atr+"static/r07/banner004.js",contentcss:_atr+"static/r07/content008.css",contentjs:_atr+"static/r07/content021.js",dynamicjs:_atr+"dynamic.js",dynamiccss:_atr+"dynamic.css",layersjs:_atr+"static/r07/layers021.js",layerscss:_atr+"static/r07/layers018.css",layersiecss:_atr+"static/r07/layersIE6005.css",layersdroidcss:_atr+"static/r07/layersdroid004.css",warning:_atr+"static/r07/warning000.html",copythis:_atrc+"static/r07/copythis00C.js",copythiscss:_atrc+"static/r07/copythis00C.css",ssojs:_atr+"static/r07/ssi005.js",ssocss:_atr+"static/r07/ssi004.css",authjs:_atr+"static/r07/auth014.js",peekaboocss:_atr+"static/r07/peekaboo002.css",overlayjs:_atr+"static/r07/overlay005.js",widget32css:_atr+"static/r07/widgetbig056.css",widget20css:_atr+"static/r07/widgetmed006.css",widgetcss:_atr+"static/r07/widget116.css",widgetIE67css:_atr+"static/r07/widgetIE67006.css",widgetpng:"//s7.addthis.com/static/r07/widget056.gif",embed:_atr+"static/r07/embed010.js",embedcss:_atr+"static/r07/embed004.css",lightbox:_atr+"static/r07/lightbox000.js",lightboxcss:_atr+"static/r07/lightbox000.css",link:_atr+"static/r07/link005.html",pinit:_atr+"static/r07/pinit016.html",linkedin:_atr+"static/r07/linkedin021.html",fbshare:_atr+"static/r07/fbshare004.html",tweet:_atr+"static/r07/tweet027.html",menujs:_atr+"static/r07/menu159.js",sh:_atr+"static/r07/sh138.html"}};}(function(){var i,q=window,C=document;var s=(window.location.protocol=="https:"),G,n,y,A=(navigator.userAgent||"unk").toLowerCase(),v=(/firefox/.test(A)),p=(/msie/.test(A)&&!(/opera/.test(A))),c={0:_atr,1:"//ct1.addthis.com/",6:"//ct6z.addthis.com/"},F={ch:"1",co:"1",cl:"1",is:"1",vn:"1",ar:"1",au:"1",id:"1",ru:"1",tw:"1",tr:"1",th:"1",pe:"1",ph:"1",jp:"1",hk:"1",br:"1",sg:"1",my:"1",kr:"1"},g={gb:"1",nl:"1",no:"1"},o={gr:"1",it:"1",cz:"1",ie:"1",es:"1",pt:"1",ro:"1",ca:"1",pl:"1",be:"1",fr:"1",dk:"1",hr:"1",de:"1",hu:"1",fi:"1",us:"1",ua:"1",mx:"1",se:"1",at:"1"},E={nz:"1",au:"1"},h=(h=document.getElementsByTagName("script"))&&h[h.length-1].parentNode;_atc.cdn=0;if(!window.addthis||window.addthis.nodeType!==i){try{G=window.navigator?(navigator.userLanguage||navigator.language):"";n=G.split("-").pop().toLowerCase();y=G.substring(0,2);if(n.length!=2){n="unk";}if(_atr.indexOf("-")>-1){}else{if(window.addthis_cdn!==i){_atc.cdn=window.addthis_cdn;}else{if(E[n]){_atc.cdn=6;}else{if(F[n]){_atc.cdn=0;}else{if(g[n]){_atc.cdn=(v||p)?0:1;}else{if(o[n]){_atc.cdn=(p)?0:1;}}}}}}if(_atc.cdn){for(var z in _atc.rsrcs){if(_atc.rsrcs.hasOwnProperty(z)){_atc.rsrcs[z]=_atc.rsrcs[z].replace(_atr,typeof(window.addthis_cdn)==="string"?window.addthis_cdn:c[_atc.cdn]).replace(/live\/([a-z])07/,"live/$107");}}_atr=c[_atc.cdn];}}catch(B){}function b(k,e,d,a){return function(){if(!this.qs){this.qs=0;}_atc.qs++;if(!((this.qs++>0&&a)||_atc.qs>1000)&&window.addthis){window.addthis.plo.push({call:k,args:arguments,ns:e,ctx:d});}};}function x(e){var d=this,a=this.queue=[];this.name=e;this.call=function(){a.push(arguments);};this.call.queuer=this;this.flush=function(w,r){this.flushed=1;for(var k=0;k<a.length;k++){w.apply(r||d,a[k]);}return w;};}window.addthis={ost:0,cache:{},plo:[],links:[],ems:[],timer:{load:((new Date()).getTime())},_Queuer:x,_queueFor:b,data:{getShareCount:b("getShareCount","data")},bar:{show:b("show","bar"),initialize:b("initialize","bar")},dynamic:{initialize:b("initialize","dynamic")},layers:b("layers"),login:{initialize:b("initialize","login"),connect:b("connect","login")},configure:function(e){if(!q.addthis_config){q.addthis_config={};}if(!q.addthis_share){q.addthis_share={};}for(var a in e){if(a=="share"&&typeof(e[a])=="object"){for(var d in e[a]){if(e[a].hasOwnProperty(d)){if(!addthis.ost){q.addthis_share[d]=e[a][d];}else{addthis.update("share",d,e[a][d]);}}}}else{if(e.hasOwnProperty(a)){if(!addthis.ost){q.addthis_config[a]=e[a];}else{addthis.update("config",a,e[a]);}}}}},box:b("box"),button:b("button"),counter:b("counter"),count:b("count"),lightbox:b("lightbox"),toolbox:b("toolbox"),update:b("update"),init:b("init"),ad:{menu:b("menu","ad","ad"),event:b("event","ad"),getPixels:b("getPixels","ad")},util:{getServiceName:b("getServiceName")},ready:b("ready"),addEventListener:b("addEventListener","ed","ed"),removeEventListener:b("removeEventListener","ed","ed"),user:{getID:b("getID","user"),getGeolocation:b("getGeolocation","user",null,true),getPreferredServices:b("getPreferredServices","user",null,true),getServiceShareHistory:b("getServiceShareHistory","user",null,true),ready:b("ready","user"),isReturning:b("isReturning","user"),isOptedOut:b("isOptedOut","user"),isUserOf:b("isUserOf","user"),hasInterest:b("hasInterest","user"),isLocatedIn:b("isLocatedIn","user"),interests:b("getInterests","user"),services:b("getServices","user"),location:b("getLocation","user")},session:{source:b("getSource","session"),isSocial:b("isSocial","session"),isSearch:b("isSearch","session")},_pmh:new x("pmh")};function f(a){a.style.width=a.style.height="1px";a.style.position="absolute";a.style.zIndex=100000;}if(document.location.href.indexOf(_atr)==-1){var t=document.getElementById("_atssh");if(!t){t=document.createElement("div");t.style.visibility="hidden";t.id="_atssh";f(t);h.appendChild(t);}function j(a){if(a&&!(a.data||{})["addthisxf"]){if(addthis._pmh.flushed){_ate.pmh(a);}else{addthis._pmh.call(a);}}}if(window.postMessage){if(window.attachEvent){window.attachEvent("onmessage",j);}else{if(window.addEventListener){window.addEventListener("message",j,false);}}}if(!t.firstChild){var l,A=navigator.userAgent.toLowerCase(),u=Math.floor(Math.random()*1000);l=document.createElement("iframe");l.id="_atssh"+u;l.title="AddThis utility frame";t.appendChild(l);f(l);l.frameborder=l.style.border=0;l.style.top=l.style.left=0;_atc._atf=l;}}var D=document.createElement("script");D.type="text/javascript";D.src=(s?"https:":"http:")+_atc.rsrcs.core;h.appendChild(D);var m=10000;setTimeout(function(){if(!window.addthis.timer.core){if(Math.random()<_atc.ohmp){(new Image()).src="//m.addthisedge.com/live/t00/oh.gif?"+Math.floor(Math.random()*4294967295).toString(36)+"&cdn="+_atc.cdn+"&sr="+_atc.ohmp+"&rev="+_atc.rrev+"&to="+m;}if(_atc.cdn!==0){var d=document.createElement("script");d.type="text/javascript";d.src=(s?"https:":"http:")+_atr+"static/r07/core103.js";h.appendChild(d);}}},m);}})();
