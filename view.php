<?php
require_once('db_connect.php');
if (empty($_GET['token'])) die('Invalid request: no token provided.');
$token = $_GET['token'];
$stmt = $pdo->prepare("SELECT * FROM ga1 WHERE token = :token LIMIT 1");
$stmt->execute(['token' => $token]);
$result = $stmt->fetch();
if (!$result) die('No record found.');
$purpose = $result['purpose'];
$t1 = $result['tick1'];
$t2 = $result['tick2'];
$t3 = $result['tick3'];
$t4 = $result['tick4'];
$t5 = $result['tick5'];
$t6 = $result['tick6'];
$t7 = $result['test'];
$t8 = $result['exam'];
?>

<!DOCTYPE html>
<html lang="en-US"><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width, initial-scale=1, minimum-scale=1" name="viewport"/>
<link href="https://gmpg.org/xfn/11" rel="profile"/>
<title>GA1 </title>
<meta content="max-image-preview:large" name="robots"/>
<style>img:is([sizes="auto" i], [sizes^="auto," i]) { contain-intrinsic-size: 3000px 1500px }</style>
<link href="file://maxcdn.bootstrapcdn.com/" rel="dns-prefetch"/>
<link href="https://ccc.help/feed/" rel="alternate" title="CCChelp » Feed" type="application/rss+xml"/>
<link href="https://ccc.help/comments/feed/" rel="alternate" title="CCChelp » Comments Feed" type="application/rss+xml"/>
<script>
window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/15.1.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/15.1.0\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/ccc.help\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.8.1"}};
/*! This file is auto-generated */
!function(i,n){var o,s,e;function c(e){try{var t={supportTests:e,timestamp:(new Date).valueOf()};sessionStorage.setItem(o,JSON.stringify(t))}catch(e){}}function p(e,t,n){e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(t,0,0);var t=new Uint32Array(e.getImageData(0,0,e.canvas.width,e.canvas.height).data),r=(e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(n,0,0),new Uint32Array(e.getImageData(0,0,e.canvas.width,e.canvas.height).data));return t.every(function(e,t){return e===r[t]})}function u(e,t,n){switch(t){case"flag":return n(e,"\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f","\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f")?!1:!n(e,"\ud83c\uddfa\ud83c\uddf3","\ud83c\uddfa\u200b\ud83c\uddf3")&&!n(e,"\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f","\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f");case"emoji":return!n(e,"\ud83d\udc26\u200d\ud83d\udd25","\ud83d\udc26\u200b\ud83d\udd25")}return!1}function f(e,t,n){var r="undefined"!=typeof WorkerGlobalScope&&self instanceof WorkerGlobalScope?new OffscreenCanvas(300,150):i.createElement("canvas"),a=r.getContext("2d",{willReadFrequently:!0}),o=(a.textBaseline="top",a.font="600 32px Arial",{});return e.forEach(function(e){o[e]=t(a,e,n)}),o}function t(e){var t=i.createElement("script");t.src=e,t.defer=!0,i.head.appendChild(t)}"undefined"!=typeof Promise&&(o="wpEmojiSettingsSupports",s=["flag","emoji"],n.supports={everything:!0,everythingExceptFlag:!0},e=new Promise(function(e){i.addEventListener("DOMContentLoaded",e,{once:!0})}),new Promise(function(t){var n=function(){try{var e=JSON.parse(sessionStorage.getItem(o));if("object"==typeof e&&"number"==typeof e.timestamp&&(new Date).valueOf()<e.timestamp+604800&&"object"==typeof e.supportTests)return e.supportTests}catch(e){}return null}();if(!n){if("undefined"!=typeof Worker&&"undefined"!=typeof OffscreenCanvas&&"undefined"!=typeof URL&&URL.createObjectURL&&"undefined"!=typeof Blob)try{var e="postMessage("+f.toString()+"("+[JSON.stringify(s),u.toString(),p.toString()].join(",")+"));",r=new Blob([e],{type:"text/javascript"}),a=new Worker(URL.createObjectURL(r),{name:"wpTestEmojiSupports"});return void(a.onmessage=function(e){c(n=e.data),a.terminate(),t(n)})}catch(e){}c(n=f(s,u,p))}t(n)}).then(function(e){for(var t in e)n.supports[t]=e[t],n.supports.everything=n.supports.everything&&n.supports[t],"flag"!==t&&(n.supports.everythingExceptFlag=n.supports.everythingExceptFlag&&n.supports[t]);n.supports.everythingExceptFlag=n.supports.everythingExceptFlag&&!n.supports.flag,n.DOMReady=!1,n.readyCallback=function(){n.DOMReady=!0}}).then(function(){return e}).then(function(){var e;n.supports.everything||(n.readyCallback(),(e=n.source||{}).concatemoji?t(e.concatemoji):e.wpemoji&&e.twemoji&&(t(e.twemoji),t(e.wpemoji)))}))}((window,document),window._wpemojiSettings);
</script>
<style id="wp-emoji-styles-inline-css">
	img.wp-smiley, img.emoji {
		display: inline !important;
		border: none !important;
		box-shadow: none !important;
		height: 1em !important;
		width: 1em !important;
		margin: 0 0.07em !important;
		vertical-align: -0.1em !important;
		background: none !important;
		padding: 0 !important;
	}
</style>
<link href="./ga1_files/style.min.css" id="wp-block-library-css" media="all" rel="stylesheet"/>
<style id="classic-theme-styles-inline-css">
/*! This file is auto-generated */
.wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none}
</style>
<style id="global-styles-inline-css">
:root{--wp--preset--aspect-ratio--square: 1;--wp--preset--aspect-ratio--4-3: 4/3;--wp--preset--aspect-ratio--3-4: 3/4;--wp--preset--aspect-ratio--3-2: 3/2;--wp--preset--aspect-ratio--2-3: 2/3;--wp--preset--aspect-ratio--16-9: 16/9;--wp--preset--aspect-ratio--9-16: 9/16;--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--color--neve-link-color: var(--nv-primary-accent);--wp--preset--color--neve-link-hover-color: var(--nv-secondary-accent);--wp--preset--color--nv-site-bg: var(--nv-site-bg);--wp--preset--color--nv-light-bg: var(--nv-light-bg);--wp--preset--color--nv-dark-bg: var(--nv-dark-bg);--wp--preset--color--neve-text-color: var(--nv-text-color);--wp--preset--color--nv-text-dark-bg: var(--nv-text-dark-bg);--wp--preset--color--nv-c-1: var(--nv-c-1);--wp--preset--color--nv-c-2: var(--nv-c-2);--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;--wp--preset--spacing--20: 0.44rem;--wp--preset--spacing--30: 0.67rem;--wp--preset--spacing--40: 1rem;--wp--preset--spacing--50: 1.5rem;--wp--preset--spacing--60: 2.25rem;--wp--preset--spacing--70: 3.38rem;--wp--preset--spacing--80: 5.06rem;--wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);--wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);--wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);--wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);--wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);}:where(.is-layout-flex){gap: 0.5em;}:where(.is-layout-grid){gap: 0.5em;}body .is-layout-flex{display: flex;}.is-layout-flex{flex-wrap: wrap;align-items: center;}.is-layout-flex > :is(*, div){margin: 0;}body .is-layout-grid{display: grid;}.is-layout-grid > :is(*, div){margin: 0;}:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-neve-link-color-color{color: var(--wp--preset--color--neve-link-color) !important;}.has-neve-link-hover-color-color{color: var(--wp--preset--color--neve-link-hover-color) !important;}.has-nv-site-bg-color{color: var(--wp--preset--color--nv-site-bg) !important;}.has-nv-light-bg-color{color: var(--wp--preset--color--nv-light-bg) !important;}.has-nv-dark-bg-color{color: var(--wp--preset--color--nv-dark-bg) !important;}.has-neve-text-color-color{color: var(--wp--preset--color--neve-text-color) !important;}.has-nv-text-dark-bg-color{color: var(--wp--preset--color--nv-text-dark-bg) !important;}.has-nv-c-1-color{color: var(--wp--preset--color--nv-c-1) !important;}.has-nv-c-2-color{color: var(--wp--preset--color--nv-c-2) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-neve-link-color-background-color{background-color: var(--wp--preset--color--neve-link-color) !important;}.has-neve-link-hover-color-background-color{background-color: var(--wp--preset--color--neve-link-hover-color) !important;}.has-nv-site-bg-background-color{background-color: var(--wp--preset--color--nv-site-bg) !important;}.has-nv-light-bg-background-color{background-color: var(--wp--preset--color--nv-light-bg) !important;}.has-nv-dark-bg-background-color{background-color: var(--wp--preset--color--nv-dark-bg) !important;}.has-neve-text-color-background-color{background-color: var(--wp--preset--color--neve-text-color) !important;}.has-nv-text-dark-bg-background-color{background-color: var(--wp--preset--color--nv-text-dark-bg) !important;}.has-nv-c-1-background-color{background-color: var(--wp--preset--color--nv-c-1) !important;}.has-nv-c-2-background-color{background-color: var(--wp--preset--color--nv-c-2) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-neve-link-color-border-color{border-color: var(--wp--preset--color--neve-link-color) !important;}.has-neve-link-hover-color-border-color{border-color: var(--wp--preset--color--neve-link-hover-color) !important;}.has-nv-site-bg-border-color{border-color: var(--wp--preset--color--nv-site-bg) !important;}.has-nv-light-bg-border-color{border-color: var(--wp--preset--color--nv-light-bg) !important;}.has-nv-dark-bg-border-color{border-color: var(--wp--preset--color--nv-dark-bg) !important;}.has-neve-text-color-border-color{border-color: var(--wp--preset--color--neve-text-color) !important;}.has-nv-text-dark-bg-border-color{border-color: var(--wp--preset--color--nv-text-dark-bg) !important;}.has-nv-c-1-border-color{border-color: var(--wp--preset--color--nv-c-1) !important;}.has-nv-c-2-border-color{border-color: var(--wp--preset--color--nv-c-2) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}
:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}
:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}
:root :where(.wp-block-pullquote){font-size: 1.5em;line-height: 1.6;}
</style>
<link href="./ga1_files/dashicons.min.css" id="dashicons-css" media="all" rel="stylesheet"/>
<link href="./ga1_files/font-awesome.min.css" id="obfx-module-pub-css-menu-icons-0-css" media="all" rel="stylesheet"/>
<link href="./ga1_files/public.css" id="obfx-module-pub-css-menu-icons-1-css" media="all" rel="stylesheet"/>
<link href="./ga1_files/style-main-new.min.css" id="neve-style-css" media="all" rel="stylesheet"/>
<style id="neve-style-inline-css">
.nv-meta-list li.meta:not(:last-child):after { content:"/" }.nv-meta-list .no-mobile{
			display:none;
		}.nv-meta-list li.last::after{
			content: ""!important;
		}@media (min-width: 769px) {
			.nv-meta-list .no-mobile {
				display: inline-block;
			}
			.nv-meta-list li.last:not(:last-child)::after {
		 		content: "/" !important;
			}
		}
 :root{ --container: 748px;--postwidth:100%; --primarybtnbg: var(--nv-primary-accent); --primarybtnhoverbg: var(--nv-primary-accent); --primarybtncolor: #fff; --secondarybtncolor: var(--nv-primary-accent); --primarybtnhovercolor: #fff; --secondarybtnhovercolor: var(--nv-primary-accent);--primarybtnborderradius:3px;--secondarybtnborderradius:3px;--secondarybtnborderwidth:3px;--btnpadding:13px 15px;--primarybtnpadding:13px 15px;--secondarybtnpadding:calc(13px - 3px) calc(15px - 3px); --bodyfontfamily: Arial,Helvetica,sans-serif; --bodyfontsize: 16px; --bodylineheight: 1.6; --bodyletterspacing: 0px; --bodyfontweight: 400; --h1fontsize: 36px; --h1fontweight: 700; --h1lineheight: 1.2; --h1letterspacing: 0px; --h1texttransform: none; --h2fontsize: 28px; --h2fontweight: 700; --h2lineheight: 1.3; --h2letterspacing: 0px; --h2texttransform: none; --h3fontsize: 24px; --h3fontweight: 700; --h3lineheight: 1.4; --h3letterspacing: 0px; --h3texttransform: none; --h4fontsize: 20px; --h4fontweight: 700; --h4lineheight: 1.6; --h4letterspacing: 0px; --h4texttransform: none; --h5fontsize: 16px; --h5fontweight: 700; --h5lineheight: 1.6; --h5letterspacing: 0px; --h5texttransform: none; --h6fontsize: 14px; --h6fontweight: 700; --h6lineheight: 1.6; --h6letterspacing: 0px; --h6texttransform: none;--formfieldborderwidth:2px;--formfieldborderradius:3px; --formfieldbgcolor: var(--nv-site-bg); --formfieldbordercolor: #dddddd; --formfieldcolor: var(--nv-text-color);--formfieldpadding:10px 12px; } .nv-index-posts{ --borderradius:0px; } .has-neve-button-color-color{ color: var(--nv-primary-accent)!important; } .has-neve-button-color-background-color{ background-color: var(--nv-primary-accent)!important; } .single-post-container .alignfull > [class*="__inner-container"], .single-post-container .alignwide > [class*="__inner-container"]{ max-width:718px } .nv-meta-list{ --avatarsize: 20px; } .single .nv-meta-list{ --avatarsize: 20px; } .nv-post-cover{ --height: 250px;--padding:40px 15px;--justify: flex-start; --textalign: left; --valign: center; } .nv-post-cover .nv-title-meta-wrap, .nv-page-title-wrap, .entry-header{ --textalign: left; } .nv-is-boxed.nv-title-meta-wrap{ --padding:40px 15px; --bgcolor: var(--nv-dark-bg); } .nv-overlay{ --opacity: 50; --blendmode: normal; } .nv-is-boxed.nv-comments-wrap{ --padding:20px; } .nv-is-boxed.comment-respond{ --padding:20px; } .single:not(.single-product), .page{ --c-vspace:0 0 0 0;; } .global-styled{ --bgcolor: var(--nv-site-bg); } .header-top{ --rowbcolor: var(--nv-light-bg); --color: var(--nv-text-color); --bgcolor: var(--nv-site-bg); } .header-main{ --rowbcolor: var(--nv-light-bg); --color: var(--nv-text-color); --bgcolor: var(--nv-site-bg); } .header-bottom{ --rowbcolor: var(--nv-light-bg); --color: var(--nv-text-color); --bgcolor: var(--nv-site-bg); } .header-menu-sidebar-bg{ --justify: flex-start; --textalign: left;--flexg: 1;--wrapdropdownwidth: auto; --color: var(--nv-text-color); --bgcolor: var(--nv-site-bg); } .header-menu-sidebar{ width: 360px; } .builder-item--logo{ --maxwidth: 120px; --fs: 24px;--padding:10px 0;--margin:0; --textalign: left;--justify: flex-start; } .builder-item--nav-icon,.header-menu-sidebar .close-sidebar-panel .navbar-toggle{ --borderradius:0; } .builder-item--nav-icon{ --label-margin:0 5px 0 0;;--padding:10px 15px;--margin:0; } .builder-item--primary-menu{ --hovercolor: var(--nv-c-1); --hovertextcolor: var(--nv-text-color); --activecolor: var(--nv-primary-accent); --spacing: 20px; --height: 25px;--padding:0;--margin:0; --fontsize: 1em; --lineheight: 1.6; --letterspacing: 0px; --fontweight: 500; --texttransform: none; --iconsize: 1em; } .hfg-is-group.has-primary-menu .inherit-ff{ --inheritedfw: 500; } .footer-top-inner .row{ grid-template-columns:1fr 1fr 1fr; --valign: flex-start; } .footer-top{ --rowbcolor: var(--nv-light-bg); --color: var(--nv-text-color); --bgcolor: var(--nv-site-bg); } .footer-main-inner .row{ grid-template-columns:1fr 1fr 1fr; --valign: flex-start; } .footer-main{ --rowbcolor: var(--nv-light-bg); --color: var(--nv-text-color); --bgcolor: var(--nv-site-bg); } .footer-bottom-inner .row{ grid-template-columns:1fr 1fr 1fr; --valign: flex-start; } .footer-bottom{ --rowbcolor: var(--nv-light-bg); --color: var(--nv-text-dark-bg); --bgcolor: var(--nv-dark-bg); } @media(min-width: 576px){ :root{ --container: 992px;--postwidth:100%;--btnpadding:13px 15px;--primarybtnpadding:13px 15px;--secondarybtnpadding:calc(13px - 3px) calc(15px - 3px); --bodyfontsize: 16px; --bodylineheight: 1.6; --bodyletterspacing: 0px; --h1fontsize: 38px; --h1lineheight: 1.2; --h1letterspacing: 0px; --h2fontsize: 30px; --h2lineheight: 1.2; --h2letterspacing: 0px; --h3fontsize: 26px; --h3lineheight: 1.4; --h3letterspacing: 0px; --h4fontsize: 22px; --h4lineheight: 1.5; --h4letterspacing: 0px; --h5fontsize: 18px; --h5lineheight: 1.6; --h5letterspacing: 0px; --h6fontsize: 14px; --h6lineheight: 1.6; --h6letterspacing: 0px; } .single-post-container .alignfull > [class*="__inner-container"], .single-post-container .alignwide > [class*="__inner-container"]{ max-width:962px } .nv-meta-list{ --avatarsize: 20px; } .single .nv-meta-list{ --avatarsize: 20px; } .nv-post-cover{ --height: 320px;--padding:60px 30px;--justify: flex-start; --textalign: left; --valign: center; } .nv-post-cover .nv-title-meta-wrap, .nv-page-title-wrap, .entry-header{ --textalign: left; } .nv-is-boxed.nv-title-meta-wrap{ --padding:60px 30px; } .nv-is-boxed.nv-comments-wrap{ --padding:30px; } .nv-is-boxed.comment-respond{ --padding:30px; } .single:not(.single-product), .page{ --c-vspace:0 0 0 0;; } .header-menu-sidebar-bg{ --justify: flex-start; --textalign: left;--flexg: 1;--wrapdropdownwidth: auto; } .header-menu-sidebar{ width: 360px; } .builder-item--logo{ --maxwidth: 120px; --fs: 24px;--padding:10px 0;--margin:0; --textalign: left;--justify: flex-start; } .builder-item--nav-icon{ --label-margin:0 5px 0 0;;--padding:10px 15px;--margin:0; } .builder-item--primary-menu{ --spacing: 20px; --height: 25px;--padding:0;--margin:0; --fontsize: 1em; --lineheight: 1.6; --letterspacing: 0px; --iconsize: 1em; } }@media(min-width: 960px){ :root{ --container: 1170px;--postwidth:100%;--btnpadding:13px 15px;--primarybtnpadding:13px 15px;--secondarybtnpadding:calc(13px - 3px) calc(15px - 3px); --bodyfontsize: 15px; --bodylineheight: 1.7; --bodyletterspacing: 0px; --h1fontsize: 40px; --h1lineheight: 1.1; --h1letterspacing: 0px; --h2fontsize: 32px; --h2lineheight: 1.2; --h2letterspacing: 0px; --h3fontsize: 28px; --h3lineheight: 1.4; --h3letterspacing: 0px; --h4fontsize: 24px; --h4lineheight: 1.5; --h4letterspacing: 0px; --h5fontsize: 20px; --h5lineheight: 1.6; --h5letterspacing: 0px; --h6fontsize: 16px; --h6lineheight: 1.6; --h6letterspacing: 0px; } body:not(.single):not(.archive):not(.blog):not(.search):not(.error404) .neve-main > .container .col, body.post-type-archive-course .neve-main > .container .col, body.post-type-archive-llms_membership .neve-main > .container .col{ max-width: 100%; } body:not(.single):not(.archive):not(.blog):not(.search):not(.error404) .nv-sidebar-wrap, body.post-type-archive-course .nv-sidebar-wrap, body.post-type-archive-llms_membership .nv-sidebar-wrap{ max-width: 0%; } .neve-main > .archive-container .nv-index-posts.col{ max-width: 100%; } .neve-main > .archive-container .nv-sidebar-wrap{ max-width: 0%; } .neve-main > .single-post-container .nv-single-post-wrap.col{ max-width: 70%; } .single-post-container .alignfull > [class*="__inner-container"], .single-post-container .alignwide > [class*="__inner-container"]{ max-width:789px } .container-fluid.single-post-container .alignfull > [class*="__inner-container"], .container-fluid.single-post-container .alignwide > [class*="__inner-container"]{ max-width:calc(70% + 15px) } .neve-main > .single-post-container .nv-sidebar-wrap{ max-width: 30%; } .nv-meta-list{ --avatarsize: 20px; } .single .nv-meta-list{ --avatarsize: 20px; } .nv-post-cover{ --height: 400px;--padding:60px 40px;--justify: flex-start; --textalign: left; --valign: center; } .nv-post-cover .nv-title-meta-wrap, .nv-page-title-wrap, .entry-header{ --textalign: left; } .nv-is-boxed.nv-title-meta-wrap{ --padding:60px 40px; } .nv-is-boxed.nv-comments-wrap{ --padding:40px; } .nv-is-boxed.comment-respond{ --padding:40px; } .single:not(.single-product), .page{ --c-vspace:0 0 0 0;; } .header-menu-sidebar-bg{ --justify: flex-start; --textalign: left;--flexg: 1;--wrapdropdownwidth: auto; } .header-menu-sidebar{ width: 360px; } .builder-item--logo{ --maxwidth: 120px; --fs: 24px;--padding:10px 0;--margin:0; --textalign: left;--justify: flex-start; } .builder-item--nav-icon{ --label-margin:0 5px 0 0;;--padding:10px 15px;--margin:0; } .builder-item--primary-menu{ --spacing: 20px; --height: 25px;--padding:0;--margin:0; --fontsize: 1em; --lineheight: 1.6; --letterspacing: 0px; --iconsize: 1em; } }.nv-content-wrap .elementor a:not(.button):not(.wp-block-file__button){ text-decoration: none; }:root{--nv-primary-accent:#555555;--nv-secondary-accent:#ef7745;--nv-site-bg:#ffffff;--nv-light-bg:#ededed;--nv-dark-bg:#14171c;--nv-text-color:#555555;--nv-text-dark-bg:#ffffff;--nv-c-1:#77b978;--nv-c-2:#f37262;--nv-fallback-ff:Arial, Helvetica, sans-serif;}
:root{--e-global-color-nvprimaryaccent:#555555;--e-global-color-nvsecondaryaccent:#ef7745;--e-global-color-nvsitebg:#ffffff;--e-global-color-nvlightbg:#ededed;--e-global-color-nvdarkbg:#14171c;--e-global-color-nvtextcolor:#555555;--e-global-color-nvtextdarkbg:#ffffff;--e-global-color-nvc1:#77b978;--e-global-color-nvc2:#f37262;}
</style>
<script id="wpen-jsredirect-js" src="./ga1_files/jsredirect.js.download"></script>
<link href="https://ccc.help/wp-json/" rel="https://api.w.org/"/><link href="https://ccc.help/wp-json/wp/v2/pages/660" rel="alternate" title="JSON" type="application/json"/><link href="https://ccc.help/xmlrpc.php?rsd" rel="EditURI" title="RSD" type="application/rsd+xml"/>
<meta content="WordPress 6.8.1" name="generator"/>
<link href="https://ccc.help/ga1-form/" rel="canonical"/>
<link href="https://ccc.help/?p=660" rel="shortlink"/>
<link href="https://ccc.help/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fccc.help%2Fga1-form%2F" rel="alternate" title="oEmbed (JSON)" type="application/json+oembed"/>
<link href="https://ccc.help/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fccc.help%2Fga1-form%2F&amp;format=xml" rel="alternate" title="oEmbed (XML)" type="text/xml+oembed"/>
<meta content="Elementor 3.28.3; features: additional_custom_breakpoints, e_local_google_fonts; settings: css_print_method-external, google_font-enabled, font_display-auto" name="generator"/>
<style>.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<style>
				.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload),
				.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload) * {
					background-image: none !important;
				}
				@media screen and (max-height: 1024px) {
					.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload),
					.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload) * {
						background-image: none !important;
					}
				}
				@media screen and (max-height: 640px) {
					.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload),
					.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload) * {
						background-image: none !important;
					}
				}
</style>
<link href="https://ccc.help/wp-content/uploads/2019/02/cropped-logo-150x150.jpg" rel="icon" sizes="32x32"/>
<link href="https://ccc.help/wp-content/uploads/2019/02/cropped-logo.jpg" rel="icon" sizes="192x192"/>
<link href="https://ccc.help/wp-content/uploads/2019/02/cropped-logo.jpg" rel="apple-touch-icon"/>
<meta content="https://ccc.help/wp-content/uploads/2019/02/cropped-logo.jpg" name="msapplication-TileImage"/>
<style id="wp-custom-css">
			
.elementor-element-117881b8 .content-forms-required, .elementor-element-117881b8 .required-mark {
	display: none;
}		</style>
<style>
table input, table textarea {
  width: 98%;
  box-sizing: border-box;
}
</style>
<script defer="" src="./ga1_files/wp-emoji-release.min.js.download"></script>
</head>
<body class="wp-singular page-template-default page page-id-660 wp-custom-logo wp-theme-neve nv-blog-default nv-sidebar-full-width nv-without-header nv-without-title nv-without-footer menu_sidebar_slide_left elementor-default elementor-kit-264" id="neve_body" style=" font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: large;">
<div class="wrapper">
<header class="header">
<a class="neve-skip-link show-on-focus" href="file:///C:/Users/Me/OneDrive%20-%20GS/Desktop/WEB/ga1.html#content">
			Skip to content		</a>
</header>
<main class="neve-main" id="content">
<div class="container single-page-container">
<div class="row">
<div class="nv-single-page-wrap col">
<div class="nv-content-wrap entry-content">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>GA1</title>
<p style="text-indent: 0pt;text-align: right;"><span><img alt="image" decoding="async" height="200" src="./ga1_files/CCC-logo.png" width="125"/></span></p>
<h2 style="color: #009; text-align: center;"><strong>Report of Thorough Examination GA1</strong></h2>
<br/>
<form action="update_ga1.php" method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
<table style="background: #accfd1;width: 100%;border-collapse:collapse; text-align: left; font-size: medium; border-style: solid;">
<tbody><tr>
<td style="border-style: solid; border-color: dimgray; width: 50%;">
<strong>Date:</strong>   
  <input id="today" name="date1" style="width: 70%; box-sizing: border-box;" type="date" value="<?php echo htmlspecialchars($result['date1']); ?>">
</td>
<td style="border-style: solid; border-color: dimgray; width: 50%;"><strong>Reference:</strong><input name="ref" id="ref" value="<?php echo htmlspecialchars($result['ref']); ?>"></td>
</tr>
<tr>
<td style="width: 50%;"><strong>Name of employer or owner for whom the thorough examination was made:</strong></td>
<td style="width: 50%;"><textarea name="username" style="text-align: center"><?php echo htmlspecialchars($result['username']); ?></textarea></td>
</tr>
<tr>
<td style="border-top-style: solid;border-color: dimgray; width: 50%;"><strong>Address of employer or owner for whom the thorough examination was made:</strong></td>
<td style="border-top-style: solid;border-color: dimgray; width: 50%;"><textarea name="address" style="text-align: center;"><?php echo htmlspecialchars($result['address']); ?></textarea></td>
</tr>
<tr>
<td style="border-top-style: solid;border-color: dimgray; width: 50%;"><strong>Address where thorough examination was made:</strong></td>
<td style="border-top-style: solid;border-color: dimgray; width: 50%;"><textarea name="address1" style="text-align: center;"><?php echo htmlspecialchars($result['address1']); ?></textarea></td>
</tr>
<tr>
<td style="border-top-style: solid;border-color: dimgray; width: 50%;"><strong>Particulars identifying the lifting equipment:</strong></td>
<td style="border-top-style: solid;border-color: dimgray; width: 50%;"><textarea name="particulars" style="text-align: center;"><?php echo htmlspecialchars($result['particulars']); ?></textarea></td>
</tr>
<tr>
<td style="border-top-style: solid;border-color: dimgray; width: 50%;"><strong>Type of Lifting Equipment:</strong></td>
<td style="border-top-style: solid;border-color: dimgray; width: 50%;"><textarea name="type" style="text-align: center;"><?php echo htmlspecialchars($result['type']); ?></textarea></td>
</tr>
<tr>
<td style="border-style: solid; border-color: dimgray; width: 50%;"><strong>Serial Number: </strong><textarea name="serialnumber" style="text-align: center;"><?php echo htmlspecialchars($result['serialnumber']); ?></textarea></td>
<td style="border-style: solid; border-color: dimgray; width: 50%;">
<strong>Date:</strong>   
  <input name="datem" style="width: 70%; box-sizing: border-box;" type="date" value="<?php echo htmlspecialchars($result['datem']); ?>">
</td>
</tr>
</tbody></table>
<br/>
<table style="background: #accfd1; width: 100%;border-collapse:collapse; text-align: center; font-size: medium; border-style: solid;">
<tbody><tr>
<th style="background: #009; color: aliceblue ;border-style: solid; border-color: dimgray; width: 50%;"><strong>Safe Working Load</strong></th>
<th style="background: #009; color: aliceblue ;border-style: solid; border-color: dimgray; width: 50%;"><strong>Configuration (s)</strong></th>
</tr>
<tr style="border-style: solid; border-color: dimgray; width: 50%;">
<td style="border-style: solid; border-color: dimgray;"> <input name="swl1" value="<?php echo htmlspecialchars($result['swl1']); ?>"> </td>
<td style="border-style: solid; border-color: dimgray;"> <input name="configuration1" value="<?php echo htmlspecialchars($result['configuration1']); ?>"> </td>
</tr>
<tr style="border-style: solid; border-color: dimgray; width: 50%;">
<td style="border-style: solid; border-color: dimgray;"> <input name="swl2" value="<?php echo htmlspecialchars($result['swl2']); ?>"> </td>
<td style="border-style: solid; border-color: dimgray;"> <input name="configuration2" value="<?php echo htmlspecialchars($result['configuration2']); ?>"> </td>
</tr>
<tr style="border-style: solid; border-color: dimgray; width: 50%;">
<td style="border-style: solid; border-color: dimgray;"> <input name="swl3" value="<?php echo htmlspecialchars($result['swl3']); ?>"> </td>
<td style="border-style: solid; border-color: dimgray;"> <input name="configuration3" value="<?php echo htmlspecialchars($result['configuration3']); ?>"> </td>
</tr>
<tr style="width: 100%;">
<td colspan="2" style=" border-style: solid; text-align: center; border-color: dimgray;"> Note: Each configuration should reflect the working arrangements, for example length of jib; fly jib; radius; angle; ballast; number of rope falls; height under hook. Please detail the safe working loads for all configurations, as per manufacturer’s instructions. Use additional sheets if more than three configurations. </td>
</tr>
</tbody></table>
<br/>
<table style=" width: 100%;border-collapse:collapse; text-align: center; font-size: medium;">
<tbody><tr style="height: 100px;border-collapse:collapse;">
<td style="border-collapse:collapse; width: 50%;"> <input type="checkbox" name="test"  <?php if ($t7 == "1") echo "checked"; ?>> Testing </td>
<td style="border-collapse:collapse; width: 50%;"> <input type="checkbox" name="exam"  <?php if ($t8 == "1") echo "checked"; ?>> Thorough Examination </td>
</tr>
</tbody></table>
<p style="width: 100%;border-collapse:collapse; text-align: right; font-size: medium;">
        Purpose of thorough examination 
    </p>
<table style="width: 50%; background-color:#accfd1; border: 1px solid dimgray; text-align: right; font-size: medium; float: right; margin-bottom: 10px; border-collapse: collapse;">
  <tbody>
    <tr>
      <td style="padding: 5px; border: 1px solid dimgray;">
        <select name="purpose" style="width: 100%; box-sizing: border-box;">
  <option value="12 Monthly" <?= ($purpose === '12 Monthly') ? 'selected' : '' ?>>12 Monthly</option>
  <option value="6 Monthly" <?= ($purpose === '6 Monthly') ? 'selected' : '' ?>>6 Monthly</option>
</select>
      </td>
    </tr>
  </tbody>
</table>
<br/>
<br>
<br>
<p style="width: 100%;border-collapse:collapse; text-align:right; font-size: medium;">
        Latest date, before next examination/test: 
    </p>
<table style="width: 50%; background-color:#accfd1; border: 1px solid dimgray; text-align: right; font-size: medium; float: right; margin-bottom: 10px; border-collapse: collapse;">
<tbody><tr>
<td style="padding: 5px; border: 1px solid dimgray;">
<input id="date2" name="date2" style="width: 70%; box-sizing: border-box;" type="date" value="<?php echo htmlspecialchars($result['date2']); ?>">

</td>
</tr>
</tbody></table>
<br/>
<table>
<tbody><tr>
<td style="width: 45%;">Defect which is danger to a person:</td>
<td style="width: 10%;"> <img align="center" decoding="async" src="./ga1_files/arrow-2.png" width="50"/></td>
<td style="width: 45%;">Repair, Renowal or alteration required to remedy this defect:</td>
</tr>
</tbody></table>
<table style="background: #accfd1; width: 100%;border-collapse:collapse; text-align: center; font-size: medium; border-style: solid;">
<tbody><tr style="height: 100px;border-style: solid; border-color: dimgray; width: 50%;">
<td style="border-style: solid; border-color: dimgray;"> <textarea name="defect1" style="text-align: center;"><?php echo htmlspecialchars($result['defect1']); ?></textarea> </td>
<td style="border-style: solid; border-color: dimgray;"> <textarea name="repair1" style="text-align: center;"><?php echo htmlspecialchars($result['repair1']); ?></textarea> </td>
</tr>
</tbody></table>
<br/>
<br/>
<table>
<tbody><tr>
<td style="width: 30%;">Defect which could become a danger to persons:</td>
<td style="width: 5%;"> <img align="center" decoding="async" src="./ga1_files/arrow-2.png" width="50"/></td>
<td style="width: 30%;">Timeframe for defect becoming a danger:</td>
<td style="width: 5%;"> <img align="center" decoding="async" src="./ga1_files/arrow-2.png" width="50"/></td>
<td style="width: 30%;">Repair, renewal or alteration required to remedy this defect, including date(s)</td>
</tr>
</tbody></table>
<table style="background: #accfd1; width: 100%;border-collapse:collapse; text-align: center; font-size: medium; border-style: solid;">
<tbody><tr style="height: 100px;border-style: solid; border-color: dimgray; width: 50%;">
<td style="border-style: solid; border-color: dimgray;"> <textarea name="defect2" style="text-align: center;"><?php echo htmlspecialchars($result['defect2']); ?></textarea> </td>
<td style="border-style: solid; border-color: dimgray;"> <textarea name="timeframe" style="text-align: center;"><?php echo htmlspecialchars($result['timeframe']); ?></textarea> </td>
<td style="border-style: solid; border-color: dimgray;"> <textarea name="repair2" style="text-align: center;"><?php echo htmlspecialchars($result['repair2']); ?></textarea> </td>
</tr>
</tbody></table>
<br/>
<table style="background: #accfd1;width: 100%;border-collapse:collapse; text-align: left; font-size: medium; border-style: solid;">
<tbody><tr>
<td style="width: 50%;"><strong>Parts not accessible for examination:</strong></td>
<td style="width: 50%;"><textarea name="parts" style="text-align: center;"><?php echo htmlspecialchars($result['parts']); ?></textarea></td>
</tr>
<tr>
<td style="border-style: solid; border-color: dimgray; width: 50%;"><strong>Name, address &amp; qualifications of person making the report:</strong></td>
<td style="border-style: solid; border-color: dimgray; width: 50%;"><strong>Name and position of the person authentication the report:</strong></td>
</tr>
<tr>
<td style="border-style: solid; border-color: dimgray; width: 50%;"><textarea name="inspectorname"><?php echo htmlspecialchars($result['inspectorname']); ?> </textarea></td>
<td style="border-style: solid; border-color: dimgray; width: 50%;"><textarea name="authoriser"><?php echo htmlspecialchars($result['authoriser']); ?> </textarea> </td>
</tr>
</tbody></table>
<br/>
<table style="background: #accfd1; width: 100%;border-collapse:collapse; text-align: center; font-size: medium; border-style: solid;">
  <tbody>
    <tr>
      <th colspan="2" style="background: #009; color: aliceblue; border-style: solid; border-color: dimgray; width: 50%;">
        <strong>We certify that:</strong> (tick when complete)
      </th>
      <th colspan="2" style="background: #009; color: aliceblue; border-style: solid; border-color: dimgray; width: 50%;">
        <strong>You must:</strong> (tick to confirm you understand)
      </th>
    </tr>

    <tr style="height: 100px; border-style: solid; border-color: dimgray; width: 100%;">
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        We have undertaken the test / thorough examination as prescribed
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        <input type="checkbox" name="tick1"  <?php if ($t1 == "1") echo "checked"; ?>>
      </td>
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        Keep this report of thorough examination safe and available for inspection
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        <input type="checkbox" name="tick2"  <?php if ($t2 == "1") echo "checked"; ?>>
      </td>
    </tr>

    <tr style="height: 100px; border-style: solid; border-color: dimgray; width: 100%;">
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        We have identified defects which are or could be a danger to persons
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        <input type="checkbox" name="tick3"  <?php if ($t3 == "1") echo "checked"; ?>>
      </td>
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        Undertake identified repairs
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        <input type="checkbox" name="tick4"  <?php if ($t4 == "1") echo "checked"; ?>>
      </td>
    </tr>

    <tr style="height: 100px; border-style: solid; border-color: dimgray; width: 100%;">
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        The particulars in this report of thorough examination are correct
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        <input type="checkbox" name="tick5"  <?php if ($t5 == "1") echo "checked"; ?>>
      </td>
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        Arrange for a thorough examination or test before the latest date or as prescribed
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        <input type="checkbox" name="tick6"  <?php if ($t6 == "1") echo "checked"; ?>>
      </td>
    </tr>
</tbody></table>
<br/>
<table style="background: #accfd1; width: 100%;border-collapse:collapse; text-align: center; font-size: medium; border-style: solid;">
<tbody><tr>
<td style="border-style: solid; border-color: dimgray; width: 50%;"><strong>Person performing tests or thorough examination </strong></td>
<td style="border-style: solid; border-color: dimgray; width: 50%;"><strong>Person receiving report of thorough examination </strong></td>
</tr>
<tr>
<td style="border: 1px solid; background-color: #accfd1; width: 50%;">Signature:
      <br/>
<canvas class="signature-pad" height="100" id="signature1" name="signature1" style="border:1px solid #000; background-color: white;" width="300"></canvas>
<br/>
<button onclick="clearSignature('signature1')" type="button">Clear</button>
</td>
<td style="border: 1px solid; background-color: #accfd1; width: 50%;">Signature:
      <br/>
<canvas class="signature-pad" height="100" id="signature2" name="signature2" style="border:1px solid #000; background-color: white;" width="300"></canvas>
<br/>
<button onclick="clearSignature('signature2')" type="button">Clear</button>
</td>
</tr>
</tbody></table>
<script>
 function enableSignaturePad(canvasId) {
  const canvas = document.getElementById(canvasId);
  const ctx = canvas.getContext('2d');
  let isDrawing = false;

  // Mouse events
  canvas.addEventListener('mousedown', e => {
    isDrawing = true;
    ctx.beginPath();
    ctx.moveTo(e.offsetX, e.offsetY);
  });

  canvas.addEventListener('mousemove', e => {
    if (isDrawing) {
      ctx.lineTo(e.offsetX, e.offsetY);
      ctx.stroke();
    }
  });

  canvas.addEventListener('mouseup', () => isDrawing = false);
  canvas.addEventListener('mouseleave', () => isDrawing = false);

  // 👉 Touch events
  canvas.addEventListener('touchstart', function(e) {
    e.preventDefault();
    isDrawing = true;
    const rect = canvas.getBoundingClientRect();
    ctx.beginPath();
    ctx.moveTo(e.touches[0].clientX - rect.left, e.touches[0].clientY - rect.top);
  });

  canvas.addEventListener('touchmove', function(e) {
    e.preventDefault();
    if (isDrawing) {
      const rect = canvas.getBoundingClientRect();
      ctx.lineTo(e.touches[0].clientX - rect.left, e.touches[0].clientY - rect.top);
      ctx.stroke();
    }
  });

  canvas.addEventListener('touchend', () => isDrawing = false);
}

function clearSignature(canvasId) {
  const canvas = document.getElementById(canvasId);
  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

enableSignaturePad('signature1');
enableSignaturePad('signature2');

  document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('today').value = today;
    
function saveSignatureData() {
  document.getElementById('signature1_data').value = document.getElementById('signature1').toDataURL();
  document.getElementById('signature2_data').value = document.getElementById('signature2').toDataURL();
}

document.querySelector("form").addEventListener("submit", saveSignatureData);
  
});

</script>
<input id="signature1_data" name="signature1_data" type="hidden"/>
<input id="signature2_data" name="signature2_data" type="hidden"/>

</div></div></div></div></main></div>

        <button type="submit">Save Changes</button>
  </form>

    <p><a href="<?php 
    $pdfPath = !empty($result['pdf_url']) ? $result['pdf_url'] : 'uploads/ga1_' . $result['token'] . '.pdf';
    echo htmlspecialchars($pdfPath) . '?t=' . time(); 
?>" target="_blank">
    View PDF
</a></p>


<div style="text-align:center; margin-top: 30px;">
    <h3>QR Code</h3>
    <img id="qrImage" src="<?php echo htmlspecialchars($result['qr_url']); ?>"
         alt="QR Code"
         style="max-width: 200px; height: auto; border: 1px solid #333; padding: 5px; background: #fff;">
    <br><br>
    <button id="printQrBtn">Print QR Code</button>
</div>

<script>
document.getElementById('printQrBtn').addEventListener('click', function() {
    const img = document.getElementById('qrImage');
    const refInput = document.getElementById('ref');
    const refValue = refInput ? refInput.value : '';

    const imgHtml = `<img src="${img.src}" style="max-width:300px; width:100%; height:auto;">`;
    const refHtml = `<div style="margin-top:10px; font-size:24px; font-weight:bold;">${refValue}</div>`;

    const printWindow = window.open('', 'Print QR Code', 'width=400,height=400');
    printWindow.document.write(`
        <html>
            <head>
                <title>Print QR Code</title>
                <style>
                    body {
                        margin: 0;
                        text-align: center;
                        font-family: Arial, sans-serif;
                    }
                </style>
            </head>
            <body>
                ${refHtml}
                ${imgHtml}
                <script>
                    window.onload = function() {
                        window.print();
                        window.onafterprint = function() {
                            window.close();
                        };
                    };
                <\/script>
            </body>
        </html>
    `);
    printWindow.document.close();
});
</script>
<script>
  function updateDate2() {
    const select = document.querySelector('select[name="purpose"]');
    const selectedValue = select.value;
    const dateInput = document.getElementById("date2");

    let monthsToAdd = 0;
    if (selectedValue === "12 Monthly") {
      monthsToAdd = 12;
    } else if (selectedValue === "6 Monthly") {
      monthsToAdd = 6;
    } else {
      dateInput.value = "";
      return;
    }

    const baseDate = new Date();
    baseDate.setMonth(baseDate.getMonth() + monthsToAdd);

    const day = baseDate.getDate();
    baseDate.setDate(Math.min(day, new Date(baseDate.getFullYear(), baseDate.getMonth() + 1, 0).getDate()));

    const yyyy = baseDate.getFullYear();
    const mm = String(baseDate.getMonth() + 1).padStart(2, '0');
    const dd = String(baseDate.getDate()).padStart(2, '0');
    const formattedDate = `${yyyy}-${mm}-${dd}`;

    dateInput.value = formattedDate;
  }

  document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('select[name="purpose"]').addEventListener("change", updateDate2);
    updateDate2();
  });
</script>

</body>
</html>

