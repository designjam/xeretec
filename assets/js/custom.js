jQuery(document).ready(function($){

	// SCROLL TO TOP
	if ($('.scroll__top').length) {
	    var scrollTrigger = 500, // px
	        backToTop = function () {
	            var scrollTop = $(window).scrollTop();
	            if (scrollTop > scrollTrigger) {
	                $('.scroll__top').addClass('show');
	            } else {
	                $('.scroll__top').removeClass('show');
	            }
	        };
	    backToTop();
	    $(window).on('scroll', function () {
	        backToTop();
	    });
	}

	// PARALLAX
	var image = document.getElementsByClassName('parallax');
	new simpleParallax(image, {
		delay: .6,
		transition: 'cubic-bezier(0,0,0,1)'
	});

	//Hero Nav offset
	$offset = $('.site-header').height()
	$('.module-hero--homepage').css({'top' : -$offset, 'margin-bottom': -$offset})

	$(window).on("resize", function(){
		$offset = $('.site-header').height()
		$('.module-hero--homepage').css({'top' : -$offset, 'margin-bottom': -$offset})
	})

	// VIDEO FACADES
	$(".video__trigger").on("click",function(e) {
    	$('.video__video').each(function() {
    		if( $(this).children('iframe').length > 0 ) {
    			$(this).children('iframe').remove();
    			$(this).addClass(".video__poster");
    			$(this).children(".video__trigger").show();
        		$(this).children(".video__image").show();
    		}
    	});
        $(this).hide(); // new line
        $(this).siblings(".video__image").hide();
        $(this).hide();
        $(this).parent().removeClass("video__poster");
        var embedcode = $(this).parent().attr('data-video-embed');
        //$(this).parent().html(embedcode);
        $(this).parent().append(embedcode); // new line
        $(".video__video iframe")[0].src += "?feature=oembed&autoplay=1";
    });

	// HOMEPAGE VIDEO
	$(window).on('load', function() {
	    $('.module-hero__video').html(' <video src=https://player.vimeo.com/progressive_redirect/playback/725965612/rendition/1080p/file.mp4?loc=external&signature=e25b55ddf940d60e97c6b816a4563438cb7cdd8c5252d5e6ee1b8984753b0ea9 autoplay loop playsinline muted></video> ');
	});

	// SLICK SPECIFIC SLIDERS
	$('.module-casestudies-slider').slick({
		dots: true,
		arrows: false,
		infinite: true,
		speed: 600,
		autoplay: true,
  		autoplaySpeed: 10000,
		fade: true,
		cssEase: 'linear',
		lazyLoad: 'ondemand',
		pauseOnHover: false,
		responsive: [
			{
			breakpoint: 1349,
				settings: {
					dots: false
				}
			}
		]
	});

	// MOBILE ONLY SLICK SLIDER
	mobileOnlySlider(".module-products__slider", true, true, 767);
		function mobileOnlySlider($slidername, $dots, $arrows, $breakpoint) {
			var slider = $($slidername);
			var settings = {
			mobileFirst: true,
			dots: $dots,
			arrows: $arrows,
				responsive: [
					{
						breakpoint: $breakpoint,
						settings: "unslick"
					},
				]
		};

		slider.slick(settings);

		$(window).on("resize", function () {
			if ($(window).width() > $breakpoint) {
				return;
			}
			if (!slider.hasClass("slick-initialized")) {
				return slider.slick(settings);
			}
		});
	}

	// MOBILE DROPDOWN 
	$(".menu-jump__list button").click(function(event) {
		event.stopPropagation();
		if($(this).parent().hasClass("open")) {
			$('.menu-jump__list').removeClass("open");
		} else {
			$('.menu-jump__list').removeClass("open");
			$(this).parent().addClass("open");
		}
	});
	$(document).on('click', function (event) {
		event.stopPropagation();
		$('.menu-jump__list').removeClass("open");
	});	

	// REPEATER FILTER ACTIVE
	$('.menu-jump__link').on('click', function(e) {
        $('.menu-jump__link').removeClass('menu-jump__link--active');
        $(this).addClass('menu-jump__link--active');
    });

	// SITE SEARCH TOGGLE
    $('.search-toggle').on('click', function(event){
    	event.stopPropagation();
        $('.site-search').toggleClass('site-search--closed');
        $(this).toggleClass('search-toggle--open');
        //Close menu when search opened
		$('.menu-item--level-2.menu-item-has-children > ul, .menu-item--level-2.menu-item-has-children > a, .menu-item--level-1.menu-item-has-children > ul, .menu-item--level-1.menu-item-has-children > a, .menu-item--level-0 > ul').each(function(){
			$(this).removeClass('show');
		})
		//Styling changes linked to menu closing
    	$('html').removeClass("site-header--open");
        $('.navbar-toggler').removeClass('open');
    });

    $('.search-form-container input').click(function(){
    	event.stopPropagation()
    })
    $(document).click(function(){
    	$('.site-search').addClass('site-search--closed');
    	$('.search-toggle').removeClass('search-toggle--open');
    })

    // TOP LEVEL NAVIGATION
    var $previousSelection;
    $('.menu-item--level-0 > a').on('click', function(){
    	//Check if menu should close, or switch to new tab. Closes if same top link clicked twice in a row
    	if($('html').hasClass("site-header--open") && $previousSelection === this){
    		$('html').removeClass("site-header--open");
    	}else{
    		$('html').addClass("site-header--open");
    	}
    	//Styling changes for moving from light theme header -- Legal pages/Search results
    	if($('.site-header').hasClass('site-header--dark') && !$(this).parent().hasClass('dropdown')){
    		$('html').removeClass("site-header--open");
    	}
    	//Close search when menu opens
    	$('.site-search').addClass('site-search--closed');
    	$('.search-toggle').removeClass('search-toggle--open');
    	//Set most recent click as value for close/switch tab check
    	$previousSelection = this;
    	
    })

	// Remove site-header--open when mega menu closes (click outside)
	$(document).on('hidden.bs.dropdown', '.dropdown', function() {
		// Check if any mega menu dropdowns are still open
		var hasOpenMenu = $('.dropdown-menu.v2-menu.depth-0.show').length > 0;
		if (!hasOpenMenu) {
			$('html').removeClass("site-header--open");
		}
	});

	// NAVIGATION
    $('.dropdown-menu').on('click', function (event) {
	   	event.stopPropagation();
	});
    //Append arrow to sub items with children
	$('.menu-item--level-1.menu-item-has-children, .menu-item--level-2.menu-item-has-children').each(function(){
		$(this).append('<button class="menu-item-children-toggle"><span></span></button>')
	})
	//Hover effect to show children of sublinks
	$('.menu-item--level-1.menu-item-has-children > a').mouseover(function(){
		event.stopPropagation();
		$('.menu-item--level-2.menu-item-has-children > button, .menu-item--level-2.menu-item-has-children > ul, .menu-item--level-2.menu-item-has-children > a, .menu-item--level-1.menu-item-has-children > button, .menu-item--level-1.menu-item-has-children > ul, .menu-item--level-1.menu-item-has-children > a').each(function(){
			$(this).removeClass('show');
		})
		$(this).addClass('show');
		$(this).siblings('ul, a').addClass('show');
	})
	//Second level down, as above
	$('.menu-item--level-2.menu-item-has-children > a').mouseover(function(){
		event.stopPropagation();
		$('.menu-item--level-2.menu-item-has-children > button, .menu-item--level-2.menu-item-has-children > ul, .menu-item--level-2.menu-item-has-children > a').each(function(){
			$(this).removeClass('show');
		})
		$(this).addClass('show');
		$(this).siblings('ul, a').addClass('show');
	})
	//Removes final level of submenu if second level link hovered has no children
	$('.menu-item--level-2:not(.menu-item-has-children)').mouseover(function(){
		$('.menu-item--level-2.menu-item-has-children > button, .menu-item--level-2.menu-item-has-children > ul, .menu-item--level-2.menu-item-has-children > a').each(function(){
			$(this).removeClass('show');
		})
	})
	//Close menu via button
	$('.close').attr('aria-label', "Close Menu");
	$('.close').on('click', function (event) {
		$('.menu-item--level-2.menu-item-has-children > button, .menu-item--level-2.menu-item-has-children > ul, .menu-item--level-2.menu-item-has-children > a, .menu-item--level-1.menu-item-has-children > button, .menu-item--level-1.menu-item-has-children > ul, .menu-item--level-1.menu-item-has-children > a, .menu-item--level-0 > ul').each(function(){
			$(this).removeClass('show');
		})

		if($('html').hasClass("site-header--open")){
    		$('html').removeClass("site-header--open")
    	}else{
    		$('html').addClass("site-header--open")
    	}
	})
	//Adding content to mobile menu
	$('.social-icons').eq(0).clone().prependTo('.social-container');
	$('.social-icons').eq(0).clone().appendTo('#menu-location-primary_navigation_mobile');
	$('.footer__brand').eq(0).clone().prependTo('#menu-location-primary_navigation_mobile');
	$('.close').eq(0).clone().addClass('mobile-close').prependTo('#menu-location-primary_navigation_mobile');
	//Mobile close functionality
	$('.mobile-close').click(function(){
		$('.mm-ocd').removeClass('mm-ocd--open');
		$('body').removeClass('mm-ocd-opened');
		$('html').removeClass("site-header--open");
	})
	//Responsive check for menus
	if($(window).width() < 478){
		$('.mm-spn--open').css("top","100px");
		$('.sub-menu').css("bottom", '100px');
	}
	$(window).on("resize", function(){
		if($(window).width() < 478){
			$('.mm-spn--open').css("top","100px");
			$('.sub-menu').css("bottom", '100px');
		}
	})
	//Styling changes if menu is open - mobile
    $('#primary-navigation-mobile-toggle').click(function(){
		$('html').addClass("site-header--open");
	})

	// INPUT ACCESSIBLILITY
	$(document).on('focus','input',function() {
		$(this).parent().parent().addClass('active');
	});
	$(document).on('focus','textarea',function() {
		$(this).parent().parent().addClass('active');
	});

	$(document).on("change keyup", 'input',function(){
	    $(this).parent().parent().addClass('active');
	});
	$(document).on("change keyup", 'textarea',function(){
	    $(this).parent().parent().addClass('active');
	});

	$(document).on('blur','input',function() {
	    if( $(this).val().length === 0 ) {
	      	$(this).parent().parent().removeClass('active');
	    }
	});
	$(document).on('blur','textarea',function() {
	    if( $(this).val().length === 0 ) {
	      	$(this).parent().parent().removeClass('active');
	    }
	});


	// REPLACE ALL SVG IMAGES WITH INLINE SVG
	$('img.svg').each(function(){
	    var $img = $(this);
	    var imgID = $img.attr('id');
	    var imgClass = $img.attr('class');
	    var imgURL = $img.attr('src');

	    $.get(imgURL, function(data) {
	         //Get the SVG tag, ignore the rest
	        var $svg = $(data).find('svg');
	         //Add replaced image's ID to the new SVG
	        if (typeof imgID !== 'undefined') {
	            $svg = $svg.attr('id', imgID);
	        }
	         //Add replaced image's classes to the new SVG
	        if (typeof imgClass !== 'undefined') {
	            $svg = $svg.attr('class', imgClass+' replaced-svg');
	        }
	         //Remove any invalid XML tags as per http:validator.w3.org
	        $svg = $svg.removeAttr('xmlns:a');
	        // Replace image with new SVG
	        $img.replaceWith($svg);
	    });
	});

	// LAZY LOAD IMAGES
	$(function() {
    	$('.lazy').lazy();
    });

});

// OBJECTFIT JS
/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-objectfit-setclasses !*/
!function(e,n,t){function r(e,n){return typeof e===n}function o(){var e,n,t,o,i,s,a;for(var l in C)if(C.hasOwnProperty(l)){if(e=[],n=C[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(o=r(n.fn,"function")?n.fn():n.fn,i=0;i<e.length;i++)s=e[i],a=s.split("."),1===a.length?Modernizr[a[0]]=o:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=o),h.push((o?"":"no-")+a.join("-"))}}function i(e){var n=_.className,t=Modernizr._config.classPrefix||"";if(w&&(n=n.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(r,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),w?_.className.baseVal=n:_.className=n)}function s(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function a(e,n){return!!~(""+e).indexOf(n)}function l(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):w?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function f(e,n){return function(){return e.apply(n,arguments)}}function u(e,n,t){var o;for(var i in e)if(e[i]in n)return t===!1?e[i]:(o=n[e[i]],r(o,"function")?f(o,t||n):o);return!1}function p(n,t,r){var o;if("getComputedStyle"in e){o=getComputedStyle.call(e,n,t);var i=e.console;if(null!==o)r&&(o=o.getPropertyValue(r));else if(i){var s=i.error?"error":"log";i[s].call(i,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else o=!t&&n.currentStyle&&n.currentStyle[r];return o}function c(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function d(){var e=n.body;return e||(e=l(w?"svg":"body"),e.fake=!0),e}function m(e,t,r,o){var i,s,a,f,u="modernizr",p=l("div"),c=d();if(parseInt(r,10))for(;r--;)a=l("div"),a.id=o?o[r]:u+(r+1),p.appendChild(a);return i=l("style"),i.type="text/css",i.id="s"+u,(c.fake?c:p).appendChild(i),c.appendChild(p),i.styleSheet?i.styleSheet.cssText=e:i.appendChild(n.createTextNode(e)),p.id=u,c.fake&&(c.style.background="",c.style.overflow="hidden",f=_.style.overflow,_.style.overflow="hidden",_.appendChild(c)),s=t(p,e),c.fake?(c.parentNode.removeChild(c),_.style.overflow=f,_.offsetHeight):p.parentNode.removeChild(p),!!s}function v(n,r){var o=n.length;if("CSS"in e&&"supports"in e.CSS){for(;o--;)if(e.CSS.supports(c(n[o]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var i=[];o--;)i.push("("+c(n[o])+":"+r+")");return i=i.join(" or "),m("@supports ("+i+") { #modernizr { position: absolute; } }",function(e){return"absolute"==p(e,null,"position")})}return t}function y(e,n,o,i){function f(){p&&(delete P.style,delete P.modElem)}if(i=r(i,"undefined")?!1:i,!r(o,"undefined")){var u=v(e,o);if(!r(u,"undefined"))return u}for(var p,c,d,m,y,g=["modernizr","tspan","samp"];!P.style&&g.length;)p=!0,P.modElem=l(g.shift()),P.style=P.modElem.style;for(d=e.length,c=0;d>c;c++)if(m=e[c],y=P.style[m],a(m,"-")&&(m=s(m)),P.style[m]!==t){if(i||r(o,"undefined"))return f(),"pfx"==n?m:!0;try{P.style[m]=o}catch(h){}if(P.style[m]!=y)return f(),"pfx"==n?m:!0}return f(),!1}function g(e,n,t,o,i){var s=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+b.join(s+" ")+s).split(" ");return r(n,"string")||r(n,"undefined")?y(a,n,o,i):(a=(e+" "+j.join(s+" ")+s).split(" "),u(a,n,t))}var h=[],C=[],S={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){C.push({name:e,fn:n,options:t})},addAsyncTest:function(e){C.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=S,Modernizr=new Modernizr;var _=n.documentElement,w="svg"===_.nodeName.toLowerCase(),x="Moz O ms Webkit",b=S._config.usePrefixes?x.split(" "):[];S._cssomPrefixes=b;var E=function(n){var r,o=prefixes.length,i=e.CSSRule;if("undefined"==typeof i)return t;if(!n)return!1;if(n=n.replace(/^@/,""),r=n.replace(/-/g,"_").toUpperCase()+"_RULE",r in i)return"@"+n;for(var s=0;o>s;s++){var a=prefixes[s],l=a.toUpperCase()+"_"+r;if(l in i)return"@-"+a.toLowerCase()+"-"+n}return!1};S.atRule=E;var j=S._config.usePrefixes?x.toLowerCase().split(" "):[];S._domPrefixes=j;var z={elem:l("modernizr")};Modernizr._q.push(function(){delete z.elem});var P={style:z.elem.style};Modernizr._q.unshift(function(){delete P.style}),S.testAllProps=g;var N=S.prefixed=function(e,n,t){return 0===e.indexOf("@")?E(e):(-1!=e.indexOf("-")&&(e=s(e)),n?g(e,n,t):g(e,"pfx"))};Modernizr.addTest("objectfit",!!N("objectFit"),{aliases:["object-fit"]}),o(),i(h),delete S.addTest,delete S.addAsyncTest;for(var T=0;T<Modernizr._q.length;T++)Modernizr._q[T]();e.Modernizr=Modernizr}(window,document);

// OBJECTFIT BACKGROUND IMAGE
function objectFitPolyfill() {
	jQuery('div.objectfit').each(function () {
		var $container = jQuery(this),
		imgUrl = $container.find('img').attr('data-original-src');
		if (imgUrl) {
			$container
			.css('backgroundImage', 'url(' + imgUrl + ')')
			.addClass('compat-object-fit');
		}  
	});
}

// SITEWIDE - OBJECTFIT BACKGROUND IMAGE
jQuery(document).ready(function($){
	if ( ! Modernizr.objectfit ) {
		objectFitPolyfill();
	}
});

// SEARCH FILTER PRO - OBJECTFIT BACKGROUND IMAGE AND LAZY LOAD
jQuery(document).on("sf:ajaxfinish", ".searchandfilter", function(){
    jQuery('.lazy').lazy();
    if ( ! Modernizr.objectfit ) {
		objectFitPolyfill();
	}
    // console.log("ajax progress");
});

// Validate & submit process
(function($) {


}(jQuery));

$ = jQuery.noConflict();

var doc = document.documentElement;
doc.setAttribute('data-useragent', navigator.userAgent);

/*! jQuery & Zepto Lazy v1.7.10 - http://jquery.eisbehr.de/lazy - MIT&GPL-2.0 license - Copyright 2012-2018 Daniel 'Eisbehr' Kern */
!function(t,e){"use strict";function r(r,a,i,u,l){function f(){L=t.devicePixelRatio>1,i=c(i),a.delay>=0&&setTimeout(function(){s(!0)},a.delay),(a.delay<0||a.combined)&&(u.e=v(a.throttle,function(t){"resize"===t.type&&(w=B=-1),s(t.all)}),u.a=function(t){t=c(t),i.push.apply(i,t)},u.g=function(){return i=n(i).filter(function(){return!n(this).data(a.loadedName)})},u.f=function(t){for(var e=0;e<t.length;e++){var r=i.filter(function(){return this===t[e]});r.length&&s(!1,r)}},s(),n(a.appendScroll).on("scroll."+l+" resize."+l,u.e))}function c(t){var i=a.defaultImage,o=a.placeholder,u=a.imageBase,l=a.srcsetAttribute,f=a.loaderAttribute,c=a._f||{};t=n(t).filter(function(){var t=n(this),r=m(this);return!t.data(a.handledName)&&(t.attr(a.attribute)||t.attr(l)||t.attr(f)||c[r]!==e)}).data("plugin_"+a.name,r);for(var s=0,d=t.length;s<d;s++){var A=n(t[s]),g=m(t[s]),h=A.attr(a.imageBaseAttribute)||u;g===N&&h&&A.attr(l)&&A.attr(l,b(A.attr(l),h)),c[g]===e||A.attr(f)||A.attr(f,c[g]),g===N&&i&&!A.attr(E)?A.attr(E,i):g===N||!o||A.css(O)&&"none"!==A.css(O)||A.css(O,"url('"+o+"')")}return t}function s(t,e){if(!i.length)return void(a.autoDestroy&&r.destroy());for(var o=e||i,u=!1,l=a.imageBase||"",f=a.srcsetAttribute,c=a.handledName,s=0;s<o.length;s++)if(t||e||A(o[s])){var g=n(o[s]),h=m(o[s]),b=g.attr(a.attribute),v=g.attr(a.imageBaseAttribute)||l,p=g.attr(a.loaderAttribute);g.data(c)||a.visibleOnly&&!g.is(":visible")||!((b||g.attr(f))&&(h===N&&(v+b!==g.attr(E)||g.attr(f)!==g.attr(F))||h!==N&&v+b!==g.css(O))||p)||(u=!0,g.data(c,!0),d(g,h,v,p))}u&&(i=n(i).filter(function(){return!n(this).data(c)}))}function d(t,e,r,i){++z;var o=function(){y("onError",t),p(),o=n.noop};y("beforeLoad",t);var u=a.attribute,l=a.srcsetAttribute,f=a.sizesAttribute,c=a.retinaAttribute,s=a.removeAttribute,d=a.loadedName,A=t.attr(c);if(i){var g=function(){s&&t.removeAttr(a.loaderAttribute),t.data(d,!0),y(T,t),setTimeout(p,1),g=n.noop};t.off(I).one(I,o).one(D,g),y(i,t,function(e){e?(t.off(D),g()):(t.off(I),o())})||t.trigger(I)}else{var h=n(new Image);h.one(I,o).one(D,function(){t.hide(),e===N?t.attr(C,h.attr(C)).attr(F,h.attr(F)).attr(E,h.attr(E)):t.css(O,"url('"+h.attr(E)+"')"),t[a.effect](a.effectTime),s&&(t.removeAttr(u+" "+l+" "+c+" "+a.imageBaseAttribute),f!==C&&t.removeAttr(f)),t.data(d,!0),y(T,t),h.remove(),p()});var m=(L&&A?A:t.attr(u))||"";h.attr(C,t.attr(f)).attr(F,t.attr(l)).attr(E,m?r+m:null),h.complete&&h.trigger(D)}}function A(t){var e=t.getBoundingClientRect(),r=a.scrollDirection,n=a.threshold,i=h()+n>e.top&&-n<e.bottom,o=g()+n>e.left&&-n<e.right;return"vertical"===r?i:"horizontal"===r?o:i&&o}function g(){return w>=0?w:w=n(t).width()}function h(){return B>=0?B:B=n(t).height()}function m(t){return t.tagName.toLowerCase()}function b(t,e){if(e){var r=t.split(",");t="";for(var a=0,n=r.length;a<n;a++)t+=e+r[a].trim()+(a!==n-1?",":"")}return t}function v(t,e){var n,i=0;return function(o,u){function l(){i=+new Date,e.call(r,o)}var f=+new Date-i;n&&clearTimeout(n),f>t||!a.enableThrottle||u?l():n=setTimeout(l,t-f)}}function p(){--z,i.length||z||y("onFinishedAll")}function y(t,e,n){return!!(t=a[t])&&(t.apply(r,[].slice.call(arguments,1)),!0)}var z=0,w=-1,B=-1,L=!1,T="afterLoad",D="load",I="error",N="img",E="src",F="srcset",C="sizes",O="background-image";"event"===a.bind||o?f():n(t).on(D+"."+l,f)}function a(a,o){var u=this,l=n.extend({},u.config,o),f={},c=l.name+"-"+ ++i;return u.config=function(t,r){return r===e?l[t]:(l[t]=r,u)},u.addItems=function(t){return f.a&&f.a("string"===n.type(t)?n(t):t),u},u.getItems=function(){return f.g?f.g():{}},u.update=function(t){return f.e&&f.e({},!t),u},u.force=function(t){return f.f&&f.f("string"===n.type(t)?n(t):t),u},u.loadAll=function(){return f.e&&f.e({all:!0},!0),u},u.destroy=function(){return n(l.appendScroll).off("."+c,f.e),n(t).off("."+c),f={},e},r(u,l,a,f,c),l.chainable?a:u}var n=t.jQuery||t.Zepto,i=0,o=!1;n.fn.Lazy=n.fn.lazy=function(t){return new a(this,t)},n.Lazy=n.lazy=function(t,r,i){if(n.isFunction(r)&&(i=r,r=[]),n.isFunction(i)){t=n.isArray(t)?t:[t],r=n.isArray(r)?r:[r];for(var o=a.prototype.config,u=o._f||(o._f={}),l=0,f=t.length;l<f;l++)(o[t[l]]===e||n.isFunction(o[t[l]]))&&(o[t[l]]=i);for(var c=0,s=r.length;c<s;c++)u[r[c]]=t[0]}},a.prototype.config={name:"lazy",chainable:!0,autoDestroy:!0,bind:"load",threshold:500,visibleOnly:!1,appendScroll:t,scrollDirection:"both",imageBase:null,defaultImage:"data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",placeholder:null,delay:-1,combined:!1,attribute:"data-src",srcsetAttribute:"data-srcset",sizesAttribute:"data-sizes",retinaAttribute:"data-retina",loaderAttribute:"data-loader",imageBaseAttribute:"data-imagebase",removeAttribute:!0,handledName:"handled",loadedName:"loaded",effect:"show",effectTime:0,enableThrottle:!0,throttle:250,beforeLoad:e,afterLoad:e,onError:e,onFinishedAll:e},n(t).on("load",function(){o=!0})}(window);

// SHARE THIS POPUPS
function newPopup(url) {
	popupWindow = window.open(
url,'popUpWindow','height=450,width=600,left=100,top=100,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}