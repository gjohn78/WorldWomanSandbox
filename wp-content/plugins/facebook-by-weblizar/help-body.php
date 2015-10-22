<style>
label {
	margin-right:10px;
}

#fb-msg {
	border: 1px #888888 solid; background-color: #C0CCFE; padding: 10px; font-size: inherit; font-weight: bold; font-family: inherit; font-style: inherit; text-decoration: inherit;
}
</style>
<script>
function SaveSettings(){
	var FacebookPageUrl = jQuery("#facebook-page-url").val();
	var ColorScheme = jQuery("#show-widget-header").val();	
	var Header = jQuery("#show-widget-header").val();
	var Stream = jQuery("#show-live-stream").val();
	var Width = jQuery("#widget-width").val();
	var Height = jQuery("#widget-height").val();
	var FbAppId = jQuery("#fb-app-id").val();
	if(!FacebookPageUrl) {
		jQuery("#facebook-page-url").focus();
		return false;
	}
	if(!FbAppId) {
		jQuery("#fb-app-id").focus();
		return false;
	}
	jQuery("#fb-save-settings").hide();
	jQuery("#fb-img").show();
	jQuery.ajax({
		url: location.href,
		type: "POST",
		data: jQuery("form#fb-form").serialize(),
		dataType: "html",
		//Do not cache the page
		cache: false,
		//success
		success: function (html) {
			jQuery("#fb-img").hide();
			jQuery("#fb-msg").show();
			
			setTimeout(function() {
				location.reload(true);
			}, 2000);
			
		}
	});
}
</script>

<?php
wp_enqueue_style('op-bootstrap-css', WEBLIZAR_FACEBOOK_PLUGIN_URL. 'css/bootstrap.min.css');
if(isset($_POST['facebook-page-url']) && isset($_POST['fb-app-id'])){
	$FacebookSettingsArray = serialize(
		array(
			'FacebookPageUrl' => $_POST['facebook-page-url'],
			'ColorScheme' =>	'',
			'Header' => $_POST['show-widget-header'],
			'Stream' => $_POST['show-live-stream'],
			'Width' => $_POST['widget-width'],
			'Height' => $_POST['widget-height'],
			'FbAppId' => $_POST['fb-app-id'],
			'ShowBorder' => 'true',
			'ShowFaces' => $_POST['show-fan-faces'],
			'ForceWall' => 'false'
		)
	);
	update_option("weblizar_facebook_shortcode_settings", $FacebookSettingsArray);
}
?>

<div class="block ui-tabs-panel active" id="option-general">		
	<div class="row">
		<div class="col-md-10">
			<div id="heading">
				<h2>Facebook Like Box [FBW] <?php _e( 'Shortcode Settings', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></h2>
			</div>
			<?php
			$FacebookSettings = unserialize(get_option("weblizar_facebook_shortcode_settings"));
			//load default values OR saved values
			$ForceWall = 'false';
			if ( isset( $FacebookSettings[ 'ForceWall' ] ) ) {
				$ForceWall = $FacebookSettings[ 'ForceWall' ];
			}

			$Header = 'true';
			if ( isset( $FacebookSettings[ 'Header' ] ) ) {
				$Header = $FacebookSettings[ 'Header' ];
			}

			$Height = 560;
			if ( isset( $FacebookSettings[ 'Height' ] ) ) {
				$Height = $FacebookSettings[ 'Height' ];
			}

			$FacebookPageUrl = 'https://www.facebook.com/pages/Weblizar/1440510482872657';
			if ( isset( $FacebookSettings[ 'FacebookPageUrl' ] ) ) {
				$FacebookPageUrl = $FacebookSettings[ 'FacebookPageUrl' ];
			}

			$ShowBorder = 'true';
			if ( isset( $FacebookSettings[ 'ShowBorder' ] ) ) {
				$ShowBorder = $FacebookSettings[ 'ShowBorder' ];
			}

			$ShowFaces = 'true';
			if ( isset( $FacebookSettings[ 'ShowFaces' ] ) ) {
				$ShowFaces = $FacebookSettings[ 'ShowFaces' ];
			}

			$Stream = 'true';
			if ( isset( $FacebookSettings[ 'Stream' ] ) ) {
				$Stream = $FacebookSettings[ 'Stream' ];
			}

			$Width = 292;
			if ( isset( $FacebookSettings[ 'Width' ] ) ) {
				$Width = $FacebookSettings[ 'Width' ];
			}

			$FbAppId = "488390501239538";
			if ( isset( $FacebookSettings[ 'FbAppId' ] ) ) {
				$FbAppId = $FacebookSettings[ 'FbAppId' ];
			}
			?>
			<form name='fb-form' id='fb-form'>
			<p>
				<p><label><?php _e( 'Facebook Page URL', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></label></p>
				<input class="widefat" id="facebook-page-url" name="facebook-page-url" type="text" value="<?php echo esc_attr( $FacebookPageUrl ); ?>">
			</p>
			<br>
			
			<p>
				<label><?php _e( 'Show Faces', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></label>
				<select id="show-fan-faces" name="show-fan-faces">
					<option value="true" <?php if($ShowFaces == "true") echo "selected=selected" ?>><?php _e( 'Yes', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></option>
					<option value="false" <?php if($ShowFaces == "false") echo "selected=selected" ?>><?php _e( 'No', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></option>
				</select>
			</p>
			<br>
			
			<p>
				<label><?php _e( 'Show Live Stream', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></label>
				<select id="show-live-stream" name="show-live-stream">
					<option value="true" <?php if($Stream == "true") echo "selected=selected" ?>><?php _e( 'Yes', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></option>
					<option value="false" <?php if($Stream == "false") echo "selected=selected" ?>><?php _e( 'No', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></option>
				</select>
			</p>
			<br>
			
			<p>
				<p><label><?php _e( 'Widget Width', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></label></p>
				<input class="widefat" id="widget-width" name="widget-width" type="text" value="<?php echo esc_attr( $Width ); ?>">
			</p>
			<br>
			
			<p>
				<p><label><?php _e( 'Widget Height', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></label></p>
				<input class="widefat" id="widget-height" name="widget-height" type="text" value="<?php echo esc_attr( $Height ); ?>">
			</p>
			<br>
			
			<p>
				<p><label><?php _e( 'Facebook App ID', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?> (<?php _e('Required', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?>)</label></p>
				<input class="widefat" id="fb-app-id" name="fb-app-id" type="text" value="<?php echo esc_attr( $FbAppId ); ?>">
				<?php _e('Get Your Own Facebook APP Id', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?>: <a href="http://weblizar.com/get-facebook-app-id/" target="_blank">HERE</a>
			</p>
			<br>
			
			<p>
				<input onclick="return SaveSettings();" type="button" class="button button-primary button-hero" id="fb-save-settings" name="fb-save-settings" value="SAVE">
			</p>
			<p>
				<div id="fb-img" style="display: none;"><img src="<?php echo WEBLIZAR_FACEBOOK_PLUGIN_URL.'images/loading.gif'; ?>" /></div>
				<div id="fb-msg" style="display: none;" class"alert">
					<?php _e( 'Settings successfully saved. Reloading page for generating preview below.', WEBLIZAR_FACEBOOK_TEXT_DOMAIN ); ?> 
				</div>
			</p>
			<br>
			</form>
			<?php
			if($FbAppId && $FacebookPageUrl) { ?>
			<div id="heading">
				<h2>Facebook Likebox Shortcode <?php _e( 'Preview', WEBLIZAR_FACEBOOK_TEXT_DOMAIN); ?></h2>
			</div>
			<p>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=<?php echo $FbAppId; ?>&version=v2.0";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
				<div class="fb-like-box" data-small-header="<?php echo $Header; ?>" data-height="<?php echo $Height; ?>" data-href="<?php echo $FacebookPageUrl; ?>" data-show-border="<?php echo $ShowBorder; ?>" data-show-faces="<?php echo $ShowFaces; ?>" data-stream="<?php echo $Stream; ?>" data-width="<?php echo $Width; ?>" data-force-wall="<?php echo $ForceWall; ?>"></div>
			</p>
			<?php } ?>
		</div>
	</div>
</div>

<!---------------- need help tab------------------------>
<div class="block ui-tabs-panel deactive" id="option-needhelp">		
	<div class="row">
		<div class="col-md-10">
			<div id="heading">
				<h2>Facebook Like Box Help Section</h2>
			</div>
			<p>Facebook By Weblizar plugin comes with 2 functionality.</p>
			<br>
			<p><strong>1 - Facebook Like Box Widget</strong></p>
			<p><strong>2 - Facebook Like Box Shoertcode [FBW]</strong></p>
			<br><br>
			
			<p><strong>Facebook Like Box Widget</strong></p>
			<hr>
			<p>You can use the widget to display your Facebook Like Box in any theme Widget Sections.</p>
			<p>Simple go to your <a href="<?php echo get_site_url(); ?>/wp-admin/widgets.php"><strong>Widgets</strong></a> section and activate available <strong>"Facebook By Weblizar"</strong> widget in any sidebar section, like in left sidebar, right sidebar or footer sidebar.</p>
			<br><br>
			
			<p><strong>Facebook Like Box Shoertcode [FBW]</strong></p>
			<hr>
			<p><strong>[FBW]</strong> shortcode give ability to display Facebook Like Box in any Page / Post with content.</p>
			<p>To use shortcode, just copy <strong>[FBW]</strong> shortcode and paste into content editor of any Page / Post.</p>
		
			<br><br>
			<p><strong>Q. What is Facebook Page URL?</strong></p>
			<p><strong> Ans. Facebook Page URL</strong> is your Facebook page your where you promote your business. Here your customers, clients, friends, guests can like, share, comment review your POST.</p>
			<br><br>
			<p><strong>Q. What is Facebook APP ID?</strong></p>
			<p><strong>Ans. Facebook Application ID</strong> used to authenticate your Facebook Page data & settings. To get your own Facebook APP ID please read our 4 Steps very simple and easy <a href="http://weblizar.com/get-facebook-app-id/" target="_blank"><strong>Tutorial.</p>
		</div>
	</div>
</div>

<!---------------- our product tab------------------------>
<div class="block ui-tabs-panel deactive" id="option-ourproduct">
	<div class="row-fluid pricing-table pricing-three-column">
		<div class="plan-name centre"> 
			<a href="http://weblizar.com" target="_new" style="margin-bottom:10px;textt-align:center"><img src="http://weblizar.com/wp-content/themes/home-theme/images/weblizar2.png"></a>
		</div>	
		<div class="plan-name">
			<h2>Weblizar Responsive WordPress Theme</h2>
			<h6>Get The Premium, And Create your website Beautifully.  </h6>
		</div>
		<div class="section container">
			<div class="col-lg-6">
				<h2>Premium Themes </h2><hr>
				<ol id="weblizar_product">
					<li><a href="http://weblizar.com/themes/enigma-premium/">Enigma </a> </li>
					<li><a href="http://weblizar.com/themes/weblizar-premium-theme/">Weblizar </a></li>					
					<li><a href="http://weblizar.com/themes/guardian-premium-theme/">Guardian </a></li>
					<li><a href="http://weblizar.com/plugins/green-lantern-premium-theme/">Green-lantern</a> </li>
					<li><a href="https://weblizar.com/themes/creative-premium-theme/">Creative </a> </li>
					<li><a href="https://weblizar.com/themes/incredible-premium-theme/">Incredible </a></li>
				</ol>
			</div>
			<div class="col-lg-6">
				<h2>Premium Plugins</h2><hr>
				<ol id="weblizar_product">
					<li><a href="http://weblizar.com/plugins/responsive-photo-gallery-pro/">Responsive Photo Gallery</a></li>
					<li><a href="http://weblizar.com/plugins/ultimate-responsive-image-slider-pro/">Ultimate Responsive Image Slider</a></li>
					<li><a href="http://weblizar.com/plugins/responsive-portfolio-pro/">Responsive Portfolio</a></li>
					<li><a href="http://weblizar.com/plugins/photo-video-link-gallery-pro//">Photo Video Link Gallery</a></li>
					<li><a href="http://weblizar.com/plugins/lightbox-slider-pro/">Lightbox Slider</a></li>
					<li><a href="http://weblizar.com/plugins/flickr-album-gallery-pro/">Flickr Album Gallery</a></li>
					<li><a href="https://weblizar.com/plugins/instagram-shortcode-and-widget-pro/">Instagram Shortcode &amp; Widget</a></li>
					<li><a href="https://weblizar.com/plugins/instagram-gallery-pro/">Instagram Gallery</a></li>
				</ol>
			</div>
		</div>	
		<div id="product_decs" class="section container">
			<p>Note: More details to click on weblizar Products site link are below given view site button.</p>	
		</div>
	</div>
	<div class="plan-name centre"> 
		  <a class="btn btn-primary btn-lg" target="_new" href="https://www.weblizar.com">View Site</a>		
	</div>
</div>