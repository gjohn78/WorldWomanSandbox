<?php

$output = $title = $color = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer"),
	'color' => '',
	'url_color' => '',
	'xcolor' => '',
				), $atts));

if (!empty($color)) {
	$color = 'style="background:' . $color . ' !important;color:#fff !important;"';
	$url_color = 'style="color:#fff !important;"';
	$xcolor = 'xcolor';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts);
$output .= "\n\t\t\t" . '<div class="' . sanitize_html_classes($css_class) . '">';
$output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header ' . sanitize_html_classes($xcolor) . '" ' . $color . ' ><a ' . $url_color . ' href="#' . sanitize_title($title) . '">' . $title . '</a></h3>';
$output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content vc_clearfix">';
$output .= ($content == '' || $content == ' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t\t" . '</div>';
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;
