<?php
/**
 * Visual Composer Eelement: Team Member
 * 
 */
add_shortcode('team', 'ts_team_func');

function ts_team_func($atts)
{
    extract(shortcode_atts(array(
    'name'        =>  'Mett Rayan',  
		'designation' =>  '',
		'about'       =>  '',
		'member_img'  =>  '',
    'email'       => '',
    'phone'    => '',
    'facebook'    => '',
    'twitter'     => '',
    'gplus'       => '',
    'linkedin'    => '',

	),
	$atts));

  ob_start();
         
?>  
    <div class="rotation employee">
      <div class="default">
        <div class="image">
          <?php
           if(!empty($member_img)){
              
                $attachment_id = $member_img;
                $image_attributes = wp_get_attachment_image_src( $attachment_id,"full"); // returns an array
                $thumb = '';
				if (isset($image_attributes[0])) {
					$thumb = $image_attributes[0];
				}
                
              }else{
                $thumb    =  get_xv_resizer('',270,270);
              }
                echo "<img src='".esc_url($thumb)."' alt='".esc_attr($name)."'>";
          ?>
        </div>
        <div class="description">
          <div class="vertical">
            <h3 class="name"><?php echo esc_html($name); ?></h3>
            <div class="role"><?php echo esc_html($designation); ?></div>  
          </div>
        </div>
      </div>

      <div class="employee-hover">
        <h3 class="name"><?php echo esc_html($name); ?></h3>
        <div class="role"><?php echo esc_html($designation); ?></div>
        <div class="image">
          <?php  echo "<img src='".esc_url($thumb)."' alt='".esc_attr($name)."'>"; ?>
        </div>
        <div>
          <p><?php echo wp_kses_post($about); ?></p>
            <div class="contact"><b><?php _e('Email','progressive'); ?>: </b><?php echo esc_html($email); ?></div>
            <div class="contact"><b><?php _e('Phone','progressive'); ?>: </b><?php echo esc_html($phone); ?></div>
        </div>

          <div class="social">
            <?php 
              if(!empty($facebook)) { 
                echo "<div class='item'><a class='sbtnf sbtnf-rounded color color-hover icon-facebook' href='".esc_url($facebook)."'></a></div>";
              }
              if(!empty($twitter)) { 
                echo "<div class='item'><a class='sbtnf sbtnf-rounded color color-hover icon-twitter' href='".esc_url($twitter)."'></a></div>";
              }
              if(!empty($gplus)) { 
                echo "<div class='item'><a class='sbtnf sbtnf-rounded color color-hover icon-gplus' href='".esc_url($gplus)."'></a></div>";
              }
              if(!empty($linkedin)) { 
                echo "<div class='item'><a class='sbtnf sbtnf-rounded color color-hover icon-linkedin' href='".esc_url($linkedin)."'></a></div>";
              }   
            ?>
          </div>
      </div><!-- .employee-hover -->
    </div>
 
<?php

    $output = ob_get_contents();

    ob_end_clean();
    
    return $output;
}