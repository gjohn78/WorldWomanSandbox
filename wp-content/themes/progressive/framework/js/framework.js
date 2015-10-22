/* 
 * Framework scripts
 */

jQuery(document).ready(function($) {
	
	$('#import-sample-data').click( function() {
		
		if (confirm($(this).data('confirm'))) {
			document.location = $(this).data('import-url');
		}
	});
	
	$("#update-nav-menu").on("click", ".edit-menu-button-icon", function(event) {
		$nav_item_id = $(this).attr('data-id');
		tb_show("Shortcodes", popupurl + "?custom_popup_items=1&shortcode=custom_icon&width=630&pb_item_id=" + $nav_item_id + '&builder=edit-menu-item-icon&callback=insert_nav_icon');
	});
	
	$("#update-nav-menu").on("click", ".edit-menu-remove-icon", function(event) {
		$nav_item_id = $(this).attr('data-id');
		jQuery('#edit-menu-item-icon_' + $nav_item_id).val('');
		jQuery('#edit-menu-preview-icon-' + $nav_item_id).html('');
	});
	
	$( document ).ajaxComplete(function() {
		$('.icons-dropdown.wpb_el_type_dropdown').find('select').each( function(){
			$(this).select2({
				formatResult: ts_formatIconDropdownShortcode,
				formatSelection: ts_formatIconDropdownShortcode,
				escapeMarkup: function(m) { return m; }
			});
		});
	});
});

var insert_nav_icon = function(field, nav_item_id, data) {	
	
	icon = data[0][0][0].icon;
	
	if (icon.indexOf("fa-") != -1) {
		icon = 'fa ' + icon;
	}
	
	jQuery('#edit-menu-preview-icon-' + nav_item_id).html('<i class="' + icon + '"></i>');
	jQuery('#edit-menu-item-icon_' + nav_item_id).val(icon);
	return false;
	
}

var ts_formatIconDropdownShortcode = function(item) {
						
	if (item.text.indexOf("icon-") >= 0) {

		item_text = item.text.replace('icon-','');
		item_class = item.text.replace('icon-','icon icon-');
		return '<i class="' + item_class + '"></i> ' + item_text;
	}
	return item.text;
}
