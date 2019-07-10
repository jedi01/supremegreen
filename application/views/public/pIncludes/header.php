<!DOCTYPE html>
<html lang="en-US" class="no-js" lang="en" xmlns:fb="http://ogp.me/ns/fb#" itemscope itemtype="http://schema.org/Restaurant">

<head>
	<title>
		<?php echo $title; ?>
	</title>
	<base href="<?php echo base_url();?>">
	<script>
	var base_url = '<?php echo base_url(); ?>';
	</script>
	<meta charset="utf-8">
	<link rel=dns-prefetch href=http://ajax.googleapis.com/>
	<link rel=dns-prefetch href=http://fonts.googleapis.com/>
	<link rel=dns-prefetch href=http://www.google-analytics.com/>
	<meta http-equiv="cleartype" content="on">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- Google Chrome Frame for IE -->
	<meta name="robots" content="NOODP">
	<meta name="apple-mobile-web-app-title" content="sweetgreen">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, user-scalable=yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<link href="http://cdn-5.sweetgreen.com/assets/favicon-dbf4e36aaa1a45ed3d4392f00fceb54b.ico" rel="shortcut icon" type="image/x-icon" />
	<link rel="pingback" href="xmlrpc.php">
	<meta name="description" content="Simple, seasonal, healthy salads and grain bowls made in-house from scratch, using whole produce delivered that morning.">
	<meta name="keywords" content="sweetgreen, sweet green, menu, healthy, salads, grain bowls, organic, vegan, local, nutritious, detox, sweetlife, food, washington, dc, maryland, virginia, md, va, dmv, philadelphia, philly, boston, new york, nyc, los angeles, santa monica">
	<meta property="og:title" content="sweetgreen | Inspiring healthier communities">
	<meta property="og:type" content="blog">
	<meta property="og:site_name" content="sweetgreen">
	<meta property="og:url" content="index.html">
	<meta property="og:description" content="Simple, seasonal, healthy salads and grain bowls made in-house from scratch, using whole produce delivered that morning.">
	<meta property="og:image" content="content/uploads/2016/01/sweetgreen-logo_300x355.html">
	<meta property="og:image:width" content="300">
	<meta property="og:image:height" content="355">
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:title" content="sweetgreen | Inspiring healthier communities" />
	<meta name="twitter:url" content="index.html">
	<meta name="twitter:description" content="Simple, seasonal, healthy salads and grain bowls made in-house from scratch, using whole produce delivered that morning.">
	<meta name="twitter:image" content="content/uploads/2016/01/sweetgreen-logo_300x355.html" />
	<meta name="twitter:image:width" content="300" />
	<meta name="twitter:image:height" content="355" />
	<meta itemprop="name" content="sweetgreen">
	<meta itemprop="description" content="Simple, seasonal, healthy salads and grain bowls made in-house from scratch, using whole produce delivered that morning.">
	<meta itemprop="image" content="pub-assets/content/uploads/2016/01/sweetgreen-logo_300x355.html" />
	<script src="pub-assets/public/themes/sweetgreen-wp-theme/js/vendor/modernizr-2.6.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="pub-assets/public/themes/sweetgreen-wp-theme/css/main5153.css?lastmodified=1548316488">
	<link rel='dns-prefetch' href='http://ajax.googleapis.com/' />
	<link rel='dns-prefetch' href='http://s.w.org/' />
	<script type="text/javascript">
	window._wpemojiSettings = {
		"baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/2.4\/72x72\/",
		"ext": ".png",
		"svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/2.4\/svg\/",
		"svgExt": ".svg",
		"source": {
			"concatemoji": "https:\/\/www.sweetgreen.com\/wp-includes\/js\/wp-emoji-release.min.js"
		}
	};
	! function(a, b, c) {
		function d(a, b) {
			var c = String.fromCharCode;
			l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, a), 0, 0);
			var d = k.toDataURL();
			l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, b), 0, 0);
			var e = k.toDataURL();
			return d === e
		}

		function e(a) {
			var b;
			if(!l || !l.fillText) return !1;
			switch(l.textBaseline = "top", l.font = "600 32px Arial", a) {
				case "flag":
					return !(b = d([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819])) && (b = d([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]), !b);
				case "emoji":
					return b = d([55357, 56692, 8205, 9792, 65039], [55357, 56692, 8203, 9792, 65039]), !b
			}
			return !1
		}

		function f(a) {
			var c = b.createElement("script");
			c.src = a, c.defer = c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
		}
		var g, h, i, j, k = b.createElement("canvas"),
			l = k.getContext && k.getContext("2d");
		for(j = Array("flag", "emoji"), c.supports = {
				everything: !0,
				everythingExceptFlag: !0
			}, i = 0; i < j.length; i++) c.supports[j[i]] = e(j[i]), c.supports.everything = c.supports.everything && c.supports[j[i]], "flag" !== j[i] && (c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && c.supports[j[i]]);
		c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && !c.supports.flag, c.DOMReady = !1, c.readyCallback = function() {
			c.DOMReady = !0
		}, c.supports.everything || (h = function() {
			c.readyCallback()
		}, b.addEventListener ? (b.addEventListener("DOMContentLoaded", h, !1), a.addEventListener("load", h, !1)) : (a.attachEvent("onload", h), b.attachEvent("onreadystatechange", function() {
			"complete" === b.readyState && c.readyCallback()
		})), g = c.source || {}, g.concatemoji ? f(g.concatemoji) : g.wpemoji && g.twemoji && (f(g.twemoji), f(g.wpemoji)))
	}(window, document, window._wpemojiSettings);
	</script>
	<style type="text/css">
	img.wp-smiley,
	img.emoji {
		display: inline !important;
		border: none !important;
		box-shadow: none !important;
		height: 1em !important;
		width: 1em !important;
		margin: 0 .07em !important;
		vertical-align: -0.1em !important;
		background: none !important;
		padding: 0 !important;
	}
	</style>
	<link rel='stylesheet' id='contact-form-7-css' href='pub-assets/public/plugins/contact-form-7/includes/css/styles.css' type='text/css' media='all' />
	<link rel='stylesheet' id='jquery-ui-theme-css' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='jquery-ui-timepicker-css' href='pub-assets/public/plugins/contact-form-7-datepicker/js/jquery-ui-timepicker/jquery-ui-timepicker-addon.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='jquery-ui-css-css' href='pub-assets/public/plugins/contact-form-7-datepicker-fix/css/jquery-ui.css' type='text/css' media='all' />
	<script type='text/javascript' src='pub-assets/wp-includes/js/jquery/jquery.js'></script>
	<script type='text/javascript' src='pub-assets/wp-includes/js/jquery/jquery-migrate.min.js'></script>
	<link rel='https://api.w.org/' href='pub-assets/wp-json/index.html' />
	<link rel="canonical" href="index.html" />
	<link rel='shortlink' href='index.html' />
	<link rel="alternate" type="application/json+oembed" href="pub-assets/wp-json/oembed/1.0/embedc42c.json?url=https%3A%2F%2Fwww.sweetgreen.com%2F" />
	<link rel="alternate" type="text/xml+oembed" href="pub-assets/wp-json/oembed/1.0/embed6224?url=https%3A%2F%2Fwww.sweetgreen.com%2F&amp;format=xml" />
	<link rel="canonical" href="index.html">
	<link rel="icon" href="pub-assets/s3-us-west-1.amazonaws.com/sweetgreen-wordpress/wp-content/uploads/2013/05/31185945/sg-ios-150x150.png" sizes="32x32" />
	<link rel="icon" href="pub-assets/s3-us-west-1.amazonaws.com/sweetgreen-wordpress/wp-content/uploads/2013/05/31185945/sg-ios.png" sizes="192x192" />
	<link rel="apple-touch-icon-precomposed" href="pub-assets/s3-us-west-1.amazonaws.com/sweetgreen-wordpress/wp-content/uploads/2013/05/31185945/sg-ios.png" />
	<meta name="msapplication-TileImage" content="https://s3-us-west-1.amazonaws.com/sweetgreen-wordpress/wp-content/uploads/2013/05/31185945/sg-ios.png" />
	<!-- Custom CSS -->
	<link rel='stylesheet' href='pub-assets/assets/custom.css' type='text/css' media='all' />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script type="text/javascript">
	document.documentElement.className = 'js';
	</script>
	<script>
	var et_site_url = 'http://www.jour.fr';
	var et_post_id = '205';

	function et_core_page_resource_fallback(a, b) {
		"undefined" === typeof b && (b = a.sheet.cssRules && 0 === a.sheet.cssRules.length);
		b && (a.onerror = null, a.onload = null, a.href ? a.href = et_site_url + "/?et_core_page_resource=" + a.id + et_post_id : a.src && (a.src = et_site_url + "/?et_core_page_resource=" + a.id + et_post_id))
	}
	</script>
	<title>NOS ENGAGEMENTS - Jour.fr</title>
	<meta property="og:description" content="Nous sommes de véritables passionnés culinaires, des « food addict » 100% pur jus, avide de nouveauté et d’originalité!" />
	<meta property="og:url" content="http://www.jour.fr/nos-engagements/" />
	<meta property="og:site_name" content="Jour.fr" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:description" content="Nous sommes de véritables passionnés culinaires, des « food addict » 100% pur jus, avide de nouveauté et d’originalité!" />
	<meta name="twitter:title" content="NOS ENGAGEMENTS - Jour.fr" />
	<meta name="twitter:image" content="http://wp.jour.fr/wp-content/uploads/2016/03/tracabilite.jpg" />
	<!-- / Yoast SEO plugin. -->
	<link rel='dns-prefetch' href='//fonts.googleapis.com' />
	<link rel='dns-prefetch' href='//s.w.org' />
	<link rel="alternate" type="application/rss+xml" title="Jour.fr &raquo; Feed" href="http://www.jour.fr/feed/" />
	<script type="text/javascript">
	window._wpemojiSettings = {
		"baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/11\/72x72\/",
		"ext": ".png",
		"svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/11\/svg\/",
		"svgExt": ".svg",
		"source": {
			"concatemoji": "http:\/\/www.jour.fr\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.9.8"
		}
	};
	! function(a, b, c) {
		function d(a, b) {
			var c = String.fromCharCode;
			l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, a), 0, 0);
			var d = k.toDataURL();
			l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, b), 0, 0);
			var e = k.toDataURL();
			return d === e
		}

		function e(a) {
			var b;
			if(!l || !l.fillText) return !1;
			switch(l.textBaseline = "top", l.font = "600 32px Arial", a) {
				case "flag":
					return !(b = d([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819])) && (b = d([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]), !b);
				case "emoji":
					return b = d([55358, 56760, 9792, 65039], [55358, 56760, 8203, 9792, 65039]), !b
			}
			return !1
		}

		function f(a) {
			var c = b.createElement("script");
			c.src = a, c.defer = c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
		}
		var g, h, i, j, k = b.createElement("canvas"),
			l = k.getContext && k.getContext("2d");
		for(j = Array("flag", "emoji"), c.supports = {
				everything: !0,
				everythingExceptFlag: !0
			}, i = 0; i < j.length; i++) c.supports[j[i]] = e(j[i]), c.supports.everything = c.supports.everything && c.supports[j[i]], "flag" !== j[i] && (c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && c.supports[j[i]]);
		c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && !c.supports.flag, c.DOMReady = !1, c.readyCallback = function() {
			c.DOMReady = !0
		}, c.supports.everything || (h = function() {
			c.readyCallback()
		}, b.addEventListener ? (b.addEventListener("DOMContentLoaded", h, !1), a.addEventListener("load", h, !1)) : (a.attachEvent("onload", h), b.attachEvent("onreadystatechange", function() {
			"complete" === b.readyState && c.readyCallback()
		})), g = c.source || {}, g.concatemoji ? f(g.concatemoji) : g.wpemoji && g.twemoji && (f(g.twemoji), f(g.wpemoji)))
	}(window, document, window._wpemojiSettings);
	</script>
	<meta content="Jour v." name="generator" />
	<style type="text/css">
	img.wp-smiley,
	img.emoji {
		display: inline !important;
		border: none !important;
		box-shadow: none !important;
		height: 1em !important;
		width: 1em !important;
		margin: 0 .07em !important;
		vertical-align: -0.1em !important;
		background: none !important;
		padding: 0 !important;
	}
	</style>
	<link rel='stylesheet' id='contact-form-7-css' href='http://www.jour.fr/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.0.3' type='text/css' media='all' />
	<link rel='stylesheet' id='rs-plugin-settings-css' href='http://www.jour.fr/wp-content/plugins/revslider/public/assets/css/settings.css?ver=5.4.8' type='text/css' media='all' />
	<style id='rs-plugin-settings-inline-css' type='text/css'>
	#rs-demo-id {}
	</style>
	<link rel='stylesheet' id='bodhi-svgs-attachment-css' href='http://www.jour.fr/wp-content/plugins/svg-support/css/svgs-attachment.css?ver=4.9.8' type='text/css' media='all' />
	<link rel='stylesheet' id='et_monarch-css-css' href='http://www.jour.fr/wp-content/plugins/monarch/css/style.css?ver=1.4.5' type='text/css' media='all' />
	<link rel='stylesheet' id='et-gf-open-sans-css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' type='text/css' media='all' />
	<link rel='stylesheet' id='parent-style-css' href='http://www.jour.fr/wp-content/themes/Divi/style.css?ver=4.9.8' type='text/css' media='all' />
	<link rel='stylesheet' id='child-style-css' href='http://www.jour.frArray?ver=4.9.8' type='text/css' media='all' />
	<link rel='stylesheet' id='divi-fonts-css' href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&#038;subset=latin,latin-ext' type='text/css' media='all' />
	<link rel='stylesheet' id='et-gf-lato-css' href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic&#038;subset=latin' type='text/css' media='all' />
	<link rel='stylesheet' id='et-gf-montserrat-css' href='http://fonts.googleapis.com/css?family=Montserrat:400,700&#038;subset=latin' type='text/css' media='all' />
	<link rel='stylesheet' id='divi-style-css' href='http://www.jour.fr/wp-content/themes/jour/style.css?ver=2.5.8' type='text/css' media='all' />
	<link rel='stylesheet' id='et-shortcodes-css-css' href='http://www.jour.fr/wp-content/themes/Divi/epanel/shortcodes/css/shortcodes.css?ver=3.0' type='text/css' media='all' />
	<link rel='stylesheet' id='et-shortcodes-responsive-css-css' href='http://www.jour.fr/wp-content/themes/Divi/epanel/shortcodes/css/shortcodes_responsive.css?ver=3.0' type='text/css' media='all' />
	<link rel='stylesheet' id='magnific-popup-css' href='http://www.jour.fr/wp-content/themes/Divi/includes/builder/styles/magnific_popup.css?ver=2.5.8' type='text/css' media='all' />
	<link rel='stylesheet' id='ulp-css' href='http://www.jour.fr/wp-content/plugins/layered-popups/css/style.min.css?ver=6.43' type='text/css' media='all' />
	<link rel='stylesheet' id='ulp-link-buttons-css' href='http://www.jour.fr/wp-content/plugins/layered-popups/css/link-buttons.min.css?ver=6.43' type='text/css' media='all' />
	<link rel='stylesheet' id='animate.css-css' href='http://www.jour.fr/wp-content/plugins/layered-popups/css/animate.min.css?ver=6.43' type='text/css' media='all' />
	<link rel='stylesheet' id='spinkit-css' href='http://www.jour.fr/wp-content/plugins/layered-popups/css/spinkit.min.css?ver=6.43' type='text/css' media='all' />
	<!--n2css-->
	<script type='text/javascript' src='http://www.jour.fr/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
	<script type='text/javascript' src='http://www.jour.fr/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
	<script type='text/javascript' src='http://www.jour.fr/wp-content/plugins/revslider/public/assets/js/jquery.themepunch.tools.min.js?ver=5.4.8'></script>
	<script type='text/javascript' src='http://www.jour.fr/wp-content/plugins/revslider/public/assets/js/jquery.themepunch.revolution.min.js?ver=5.4.8'></script>
	<script type='text/javascript' src='http://www.jour.fr/wp-content/plugins/sticky-menu-or-anything-on-scroll/assets/js/jq-sticky-anything.min.js?ver=2.1.1'></script>
	<script type='text/javascript' src='http://www.jour.fr/wp-content/themes/jour/custom.js?v=1&#038;ver=4.9.8'></script>
	<link rel='https://api.w.org/' href='http://www.jour.fr/wp-json/' />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.jour.fr/xmlrpc.php?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://www.jour.fr/wp-includes/wlwmanifest.xml" />
	<meta name="generator" content="WordPress 4.9.8" />
	<link rel='shortlink' href='http://www.jour.fr/?p=205' />
	<link rel="alternate" type="application/json+oembed" href="http://www.jour.fr/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fwww.jour.fr%2Fnos-engagements%2F" />
	<link rel="alternate" type="text/xml+oembed" href="http://www.jour.fr/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fwww.jour.fr%2Fnos-engagements%2F&#038;format=xml" />
	<meta name="generator" content="Custom Login v3.2.8" />
	<style type="text/css" id="et-social-custom-css">

	</style>
	<!-- Facebook Pixel Code -->
	<script>
	! function(f, b, e, v, n, t, s) {
		if(f.fbq) return;
		n = f.fbq = function() {
			n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
		};
		if(!f._fbq) f._fbq = n;
		n.push = n;
		n.loaded = !0;
		n.version = '2.0';
		n.queue = [];
		t = b.createElement(e);
		t.async = !0;
		t.src = v;
		s = b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t, s)
	}(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '1809813032584245');
	fbq('track', "PageView");
	</script>
	<noscript> <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1809813032584245&ev=PageView&noscript=1" /> </noscript>
	<!-- End Facebook Pixel Code -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<style id="theme-customizer-css">
	body {
		color: #505d6d;
	}
	
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		color: #007d3f;
	}
	
	body {
		line-height: 1.6em;
	}
	
	.woocommerce #respond input#submit,
	.woocommerce-page #respond input#submit,
	.woocommerce #content input.button,
	.woocommerce-page #content input.button,
	.woocommerce-message,
	.woocommerce-error,
	.woocommerce-info {
		background: #007d3f !important;
	}
	
	#et_search_icon:hover,
	.mobile_menu_bar:before,
	.et-social-icon a:hover,
	.et_pb_sum,
	.et_pb_pricing li a,
	.et_pb_pricing_table_button,
	.et_overlay:before,
	.entry-summary p.price ins,
	.woocommerce div.product span.price,
	.woocommerce-page div.product span.price,
	.woocommerce #content div.product span.price,
	.woocommerce-page #content div.product span.price,
	.woocommerce div.product p.price,
	.woocommerce-page div.product p.price,
	.woocommerce #content div.product p.price,
	.woocommerce-page #content div.product p.price,
	.et_pb_member_social_links a:hover,
	.woocommerce .star-rating span:before,
	.woocommerce-page .star-rating span:before,
	.et_pb_widget li a:hover,
	.et_pb_filterable_portfolio .et_pb_portfolio_filters li a.active,
	.et_pb_filterable_portfolio .et_pb_portofolio_pagination ul li a.active,
	.et_pb_gallery .et_pb_gallery_pagination ul li a.active,
	.wp-pagenavi span.current,
	.wp-pagenavi a:hover,
	.nav-single a,
	.posted_in a {
		color: #007d3f;
	}
	
	.et_pb_contact_submit,
	.et_password_protected_form .et_submit_button,
	.et_pb_bg_layout_light .et_pb_newsletter_button,
	.comment-reply-link,
	.form-submit input,
	.et_pb_bg_layout_light .et_pb_promo_button,
	.et_pb_bg_layout_light .et_pb_more_button,
	.woocommerce a.button.alt,
	.woocommerce-page a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce-page input.button.alt,
	.woocommerce #respond input#submit.alt,
	.woocommerce-page #respond input#submit.alt,
	.woocommerce #content input.button.alt,
	.woocommerce-page #content input.button.alt,
	.woocommerce a.button,
	.woocommerce-page a.button,
	.woocommerce button.button,
	.woocommerce-page button.button,
	.woocommerce input.button,
	.woocommerce-page input.button {
		color: #007d3f;
	}
	
	.footer-widget h4 {
		color: #007d3f;
	}
	
	.et-search-form,
	.nav li ul,
	.et_mobile_menu,
	.footer-widget li:before,
	.et_pb_pricing li:before,
	blockquote {
		border-color: #007d3f;
	}
	
	.et_pb_counter_amount,
	.et_pb_featured_table .et_pb_pricing_heading,
	.et_quote_content,
	.et_link_content,
	.et_audio_content {
		background-color: #007d3f;
	}
	
	a {
		color: #007d3f;
	}
	
	#top-header,
	#et-secondary-nav li ul {
		background-color: #007d3f;
	}
	
	#top-menu li a {
		font-size: 12px;
	}
	
	body.et_vertical_nav .container.et_search_form_container .et-search-form input {
		font-size: 12px !important;
	}
	
	#top-menu li a,
	.et_search_form_container input {
		font-weight: normal;
		font-style: normal;
		text-transform: uppercase;
		text-decoration: none;
		letter-spacing: 1px;
	}
	
	.et_search_form_container input::-moz-placeholder {
		font-weight: normal;
		font-style: normal;
		text-transform: uppercase;
		text-decoration: none;
		letter-spacing: 1px;
	}
	
	.et_search_form_container input::-webkit-input-placeholder {
		font-weight: normal;
		font-style: normal;
		text-transform: uppercase;
		text-decoration: none;
		letter-spacing: 1px;
	}
	
	.et_search_form_container input:-ms-input-placeholder {
		font-weight: normal;
		font-style: normal;
		text-transform: uppercase;
		text-decoration: none;
		letter-spacing: 1px;
	}
	
	#top-menu li.current-menu-ancestor > a,
	#top-menu li.current-menu-item > a,
	.et_color_scheme_red #top-menu li.current-menu-ancestor > a,
	.et_color_scheme_red #top-menu li.current-menu-item > a,
	.et_color_scheme_pink #top-menu li.current-menu-ancestor > a,
	.et_color_scheme_pink #top-menu li.current-menu-item > a,
	.et_color_scheme_orange #top-menu li.current-menu-ancestor > a,
	.et_color_scheme_orange #top-menu li.current-menu-item > a,
	.et_color_scheme_green #top-menu li.current-menu-ancestor > a,
	.et_color_scheme_green #top-menu li.current-menu-item > a {
		color: #007d3f;
	}
	
	#main-footer {
		background-color: #007d3f;
	}
	
	#footer-widgets .footer-widget li a {
		color: #cccccc;
	}
	
	.footer-widget {
		color: #ffffff;
	}
	
	#main-footer .footer-widget h4 {
		color: #ffffff;
	}
	
	.footer-widget li:before {
		border-color: #ffffff;
	}
	
	.footer-widget .et_pb_widget div,
	.footer-widget .et_pb_widget ul,
	.footer-widget .et_pb_widget ol,
	.footer-widget .et_pb_widget label {
		line-height: 1.4em;
	}
	
	#footer-widgets .footer-widget li:before {
		top: 6.8px;
	}
	
	#et-footer-nav {
		background-color: #007d3f;
	}
	
	.bottom-nav,
	.bottom-nav a,
	.bottom-nav li.current-menu-item a {
		color: #ffffff;
	}
	
	#et-footer-nav .bottom-nav li.current-menu-item a {
		color: #ffffff;
	}
	
	.bottom-nav {
		letter-spacing: 1px;
	}
	
	.bottom-nav a {
		font-weight: normal;
		font-style: normal;
		text-transform: uppercase;
		text-decoration: none;
	}
	
	.bottom-nav,
	.bottom-nav a {
		font-size: 12px;
	}
	
	#footer-bottom {
		background-color: #007d3f;
	}
	
	#footer-info,
	#footer-info a {
		color: #ffffff;
	}
	
	#footer-info,
	#footer-info a {
		font-weight: normal;
		font-style: normal;
		text-transform: uppercase;
		text-decoration: none;
	}
	
	#footer-bottom .et-social-icon a {
		font-size: 16px;
	}
	
	#footer-bottom .et-social-icon a {
		color: #ffffff;
	}
	
	body .et_pb_button,
	.woocommerce a.button.alt,
	.woocommerce-page a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce-page input.button.alt,
	.woocommerce #respond input#submit.alt,
	.woocommerce-page #respond input#submit.alt,
	.woocommerce #content input.button.alt,
	.woocommerce-page #content input.button.alt,
	.woocommerce a.button,
	.woocommerce-page a.button,
	.woocommerce button.button,
	.woocommerce-page button.button,
	.woocommerce input.button,
	.woocommerce-page input.button,
	.woocommerce #respond input#submit,
	.woocommerce-page #respond input#submit,
	.woocommerce #content input.button,
	.woocommerce-page #content input.button {
		font-size: 14px;
		background: rgba(255, 255, 255, 0);
		border-color: #007d3f;
		border-radius: 0px;
		font-weight: bold;
		font-style: normal;
		text-transform: uppercase;
		text-decoration: none;
		;
	}
	
	body.et_pb_button_helper_class .et_pb_button,
	.woocommerce.et_pb_button_helper_class a.button.alt,
	.woocommerce-page.et_pb_button_helper_class a.button.alt,
	.woocommerce.et_pb_button_helper_class button.button.alt,
	.woocommerce-page.et_pb_button_helper_class button.button.alt,
	.woocommerce.et_pb_button_helper_class input.button.alt,
	.woocommerce-page.et_pb_button_helper_class input.button.alt,
	.woocommerce.et_pb_button_helper_class #respond input#submit.alt,
	.woocommerce-page.et_pb_button_helper_class #respond input#submit.alt,
	.woocommerce.et_pb_button_helper_class #content input.button.alt,
	.woocommerce-page.et_pb_button_helper_class #content input.button.alt,
	.woocommerce.et_pb_button_helper_class a.button,
	.woocommerce-page.et_pb_button_helper_class a.button,
	.woocommerce.et_pb_button_helper_class button.button,
	.woocommerce-page.et_pb_button_helper_class button.button,
	.woocommerce.et_pb_button_helper_class input.button,
	.woocommerce-page.et_pb_button_helper_class input.button,
	.woocommerce.et_pb_button_helper_class #respond input#submit,
	.woocommerce-page.et_pb_button_helper_class #respond input#submit,
	.woocommerce.et_pb_button_helper_class #content input.button,
	.woocommerce-page.et_pb_button_helper_class #content input.button {
		color: #007d3f !important;
	}
	
	body .et_pb_button:after,
	.woocommerce a.button.alt:after,
	.woocommerce-page a.button.alt:after,
	.woocommerce button.button.alt:after,
	.woocommerce-page button.button.alt:after,
	.woocommerce input.button.alt:after,
	.woocommerce-page input.button.alt:after,
	.woocommerce #respond input#submit.alt:after,
	.woocommerce-page #respond input#submit.alt:after,
	.woocommerce #content input.button.alt:after,
	.woocommerce-page #content input.button.alt:after,
	.woocommerce a.button:after,
	.woocommerce-page a.button:after,
	.woocommerce button.button:after,
	.woocommerce-page button.button:after,
	.woocommerce input.button:after,
	.woocommerce-page input.button:after,
	.woocommerce #respond input#submit:after,
	.woocommerce-page #respond input#submit:after,
	.woocommerce #content input.button:after,
	.woocommerce-page #content input.button:after {
		content: 'E';
		font-size: 14px;
	}
	
	body .et_pb_button:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce-page a.button.alt:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce-page button.button.alt:hover,
	.woocommerce input.button.alt:hover,
	.woocommerce-page input.button.alt:hover,
	.woocommerce #respond input#submit.alt:hover,
	.woocommerce-page #respond input#submit.alt:hover,
	.woocommerce #content input.button.alt:hover,
	.woocommerce-page #content input.button.alt:hover,
	.woocommerce a.button:hover,
	.woocommerce-page a.button:hover,
	.woocommerce button.button,
	.woocommerce-page button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce-page input.button:hover,
	.woocommerce #respond input#submit:hover,
	.woocommerce-page #respond input#submit:hover,
	.woocommerce #content input.button:hover,
	.woocommerce-page #content input.button:hover {
		background: rgba(0, 0, 0, 0) !important;
		border-color: #007d3f !important;
		border-radius: 0px;
	}
	
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.et_quote_content blockquote p,
	.et_pb_slide_description .et_pb_slide_title {
		font-weight: bold;
		font-style: normal;
		text-transform: none;
		text-decoration: none;
		line-height: 1.2em;
	}
	
	@media only screen and ( min-width: 981px) {
		h1 {
			font-size: 40px;
		}
		h2,
		.product .related h2,
		.et_pb_column_1_2 .et_quote_content blockquote p {
			font-size: 34px;
		}
		h3 {
			font-size: 29px;
		}
		h4,
		.et_pb_circle_counter h3,
		.et_pb_number_counter h3,
		.et_pb_column_1_3 .et_pb_post h2,
		.et_pb_column_1_4 .et_pb_post h2,
		.et_pb_blog_grid h2,
		.et_pb_column_1_3 .et_quote_content blockquote p,
		.et_pb_column_3_8 .et_quote_content blockquote p,
		.et_pb_column_1_4 .et_quote_content blockquote p,
		.et_pb_blog_grid .et_quote_content blockquote p,
		.et_pb_column_1_3 .et_link_content h2,
		.et_pb_column_3_8 .et_link_content h2,
		.et_pb_column_1_4 .et_link_content h2,
		.et_pb_blog_grid .et_link_content h2,
		.et_pb_column_1_3 .et_audio_content h2,
		.et_pb_column_3_8 .et_audio_content h2,
		.et_pb_column_1_4 .et_audio_content h2,
		.et_pb_blog_grid .et_audio_content h2,
		.et_pb_column_3_8 .et_pb_audio_module_content h2,
		.et_pb_column_1_3 .et_pb_audio_module_content h2,
		.et_pb_gallery_grid .et_pb_gallery_item h3,
		.et_pb_portfolio_grid .et_pb_portfolio_item h2,
		.et_pb_filterable_portfolio_grid .et_pb_portfolio_item h2 {
			font-size: 24px;
		}
		h5 {
			font-size: 21px;
		}
		h6 {
			font-size: 18px;
		}
		.et_pb_slide_description .et_pb_slide_title {
			font-size: 61px;
		}
		.woocommerce ul.products li.product h3,
		.woocommerce-page ul.products li.product h3,
		.et_pb_gallery_grid .et_pb_gallery_item h3,
		.et_pb_portfolio_grid .et_pb_portfolio_item h2,
		.et_pb_filterable_portfolio_grid .et_pb_portfolio_item h2,
		.et_pb_column_1_4 .et_pb_audio_module_content h2 {
			font-size: 21px;
		}
		.footer-widget h4 {
			font-size: 18px;
		}
		.et_header_style_left #et-top-navigation,
		.et_header_style_split #et-top-navigation {
			padding: 34px 0 0 0;
		}
		.et_header_style_left #et-top-navigation nav > ul > li > a,
		.et_header_style_split #et-top-navigation nav > ul > li > a {
			padding-bottom: 34px;
		}
		.et_header_style_split .centered-inline-logo-wrap {
			width: 67px;
			margin: -67px 0;
		}
		.et_header_style_split .centered-inline-logo-wrap #logo {
			max-height: 67px;
		}
		.et_pb_svg_logo.et_header_style_split .centered-inline-logo-wrap #logo {
			height: 67px;
		}
		.et_header_style_centered #top-menu > li > a {
			padding-bottom: 12px;
		}
		.et_header_style_centered #main-header .logo_container {
			height: 67px;
		}
		#logo {
			max-height: 75%;
		}
		.et_pb_svg_logo #logo {
			height: 75%;
		}
		.et_header_style_centered.et_hide_primary_logo #main-header:not(.et-fixed-header) .logo_container,
		.et_header_style_centered.et_hide_fixed_logo #main-header.et-fixed-header .logo_container {
			height: 12.06px;
		}
		.et-fixed-header#top-header,
		.et-fixed-header#top-header #et-secondary-nav li ul {
			background-color: #007d3f;
		}
		.et-fixed-header #top-menu li a {
			font-size: 12px;
		}
		.et-fixed-header #top-menu li.current-menu-ancestor > a,
		.et-fixed-header #top-menu li.current-menu-item > a {
			color: #007d3f !important;
		}
	}
	
	@media only screen and ( min-width: 1350px) {
		.et_pb_row {
			padding: 27px 0;
		}
		.et_pb_section {
			padding: 54px 0;
		}
		.single.et_pb_pagebuilder_layout.et_full_width_page .et_post_meta_wrapper {
			padding-top: 81px;
		}
		.et_pb_section.et_pb_section_first {
			padding-top: inherit;
		}
		.et_pb_fullwidth_section {
			padding: 0;
		}
	}
	
	@media only screen and ( max-width: 980px) {
		.et_header_style_centered .mobile_nav .select_page,
		.et_header_style_split .mobile_nav .select_page,
		.et_mobile_menu li a,
		.mobile_menu_bar:before,
		.et_nav_text_color_light #top-menu > li > a,
		.et_nav_text_color_dark #top-menu > li > a,
		#top-menu a,
		.et_mobile_menu li a,
		#et_search_icon:before,
		#et_top_search .et-search-form input,
		.et_search_form_container input,
		#et-top-navigation .et-cart-info {
			color: #333333;
		}
		.et_close_search_field:after {
			color: #333333 !important;
		}
		.et_search_form_container input::-moz-placeholder {
			color: #333333;
		}
		.et_search_form_container input::-webkit-input-placeholder {
			color: #333333;
		}
		.et_search_form_container input:-ms-input-placeholder {
			color: #333333;
		}
	}
	
	@media only screen and ( max-width: 767px) {}
	</style>
	<style class="et_heading_font">
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		font-family: 'Lato', Helvetica, Arial, Lucida, sans-serif;
	}
	</style>
	<style class="et_body_font">
	body,
	input,
	textarea,
	select {
		font-family: 'Montserrat', Helvetica, Arial, Lucida, sans-serif;
	}
	</style>
	<style id="module-customizer-css">
	.et_pb_blog_grid .et_pb_post h2 {
		font-size: 16px;
	}
	
	.et_pb_blog_grid .et_pb_post h2 {
		font-weight: bold;
		font-style: normal;
		text-transform: none;
		text-decoration: none;
	}
	</style>
	<link rel="shortcut icon" href="http://www.jour.fr/wp-content/uploads/2018/11/favicon.ico" />
	<meta name="generator" content="Powered by Slider Revolution 5.4.8 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
	<link rel="stylesheet" type="text/css" href="https://cloud.typography.com/7402694/6329352/css/fonts.css?v=1" />
	<script>
	var ulp_custom_handlers = {};
	var ulp_cookie_value = "ilovelencha";
	var ulp_onload_popup = "";
	var ulp_onload_mode = "none";
	var ulp_onload_period = "5";
	var ulp_onscroll_popup = "";
	var ulp_onscroll_mode = "none";
	var ulp_onscroll_period = "5";
	var ulp_onexit_popup = "";
	var ulp_onexit_mode = "none";
	var ulp_onexit_period = "5";
	var ulp_onidle_popup = "";
	var ulp_onidle_mode = "none";
	var ulp_onidle_period = "5";
	var ulp_onabd_popup = "";
	var ulp_onabd_mode = "none";
	var ulp_onabd_period = "5";
	var ulp_onload_delay = "5";
	var ulp_onload_close_delay = "0";
	var ulp_onscroll_offset = "600";
	var ulp_onidle_delay = "30";
	var ulp_recaptcha_enable = "off";
	var ulp_content_id = "205";
	</script>
	<script type="text/javascript">
	function setREVStartSize(e) {
		try {
			e.c = jQuery(e.c);
			var i = jQuery(window).width(),
				t = 9999,
				r = 0,
				n = 0,
				l = 0,
				f = 0,
				s = 0,
				h = 0;
			if(e.responsiveLevels && (jQuery.each(e.responsiveLevels, function(e, f) {
					f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
				}), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
				var u = (e.c.width(), jQuery(window).height());
				if(void 0 != e.fullScreenOffsetContainer) {
					var c = e.fullScreenOffsetContainer.split(",");
					if(c) jQuery.each(c, function(e, i) {
						u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
					}), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
				}
				f = u
			} else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
			e.c.closest(".rev_slider_wrapper").css({
				height: f
			})
		} catch(d) {
			console.log("Failure at Presize of Slider:" + d)
		}
	};
	</script>
</head>

<body data-spy="scroll" data-target="#sidenav" class="home page-template-default page page-id-300 ">