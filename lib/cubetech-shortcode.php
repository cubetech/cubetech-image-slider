<?php
function cubetech_image_slider_shortcode($atts)
{
	extract(shortcode_atts(array(
		'orderby' 		=> 'menu_order',
		'order'			=> 'asc',
		'numberposts'	=> 999,
		'offset'		=> 0,
		'poststatus'	=> 'publish',
	), $atts));
	
	$return = '';	

	$return .= '<div class="cubetech-image-slider-container">';
	$return .= '<div id="left_arrow"></div><div class="cubetech-image-slider-inner">';
	if ( get_option('cubetech_image_slider_show_groups') != false )
		$return .= '<h2>' . $tax->name . '</h2>';
	
	$args = array(
		'posts_per_page'  	=> 999,
		'numberposts'     	=> $numberposts,
		'offset'          	=> $offset,
		'orderby'         	=> $orderby,
		'order'           	=> $order,
		'post_type'       	=> 'cubetech_imgslider',
		'post_status'     	=> $poststatus,
		'suppress_filters' 	=> true,
	);
		
	$posts = get_posts($args);
	
	$return .= cubetech_image_slider_content($posts);
	
	
	
	if ( get_option('cubetech_image_slider_show_hr') != false )
		$return .= '<hr />';
	
	$return .= '</div><div id="right_arrow"></div></div>';
		
	return $return;

}

add_shortcode('cubetech-image-slider', 'cubetech_image_slider_shortcode');

function cubetech_image_slider_content($posts) {

	$contentreturn = '<ul class="cubetech-image-slider">';
	$slidercontent = '<div class="cubetech-image-slider-content">';
	
	$i = 0;
	
	foreach ($posts as $post) {
	
		
		$post_meta_data = get_post_custom($post->ID);
		
		
		
		$terms = wp_get_post_terms($post->ID, 'cubetech_image_slider_group');
		$function = $post_meta_data['cubetech_image_slider_function'][0];
		$edu = $post_meta_data['cubetech_image_slider_edu'][0];
		$mail = $post_meta_data['cubetech_image_slider_mail'][0];
		$phone = $post_meta_data['cubetech_image_slider_phone'][0];
		
		$titlelink = array('', '');
		$title = '<h3 class="cubetech-image-slider-title">' . $post->post_title . '</h3>';
		
		
		
		$image = wp_get_attachment_image($post_meta_data['cubetech_image_slider_image'][0],array(400,400));
		
		
		//print_r($image_meta);
		//$image = wp_get_attachment_image(get_post_meta($image_meta['_wp_attached_file'][0]));
	//	print_r($image);
		$secondimage = false;
		
		$link = '';

		if(isset($post_meta_data['cubetech_image_slider_externallink'][0]) && $post_meta_data['cubetech_image_slider_externallink'][0] != '')
			$link = '<span class="cubetech-image-slider-link"><a href="' . $post_meta_data['cubetech_image_slider_externallink'][0] . '" target="_blank">' . get_option('cubetech_image_slider_link_title') . '</a></span>';
		elseif ( $post_meta_data['cubetech_image_slider_links'][0] != '' && $post_meta_data['cubetech_image_slider_links'][0] != 'nope' && $post_meta_data['cubetech_image_slider_links'][0] > 0 )
			$link = '<span class="cubetech-image-slider-link"><a href="' . get_permalink( $post_meta_data['cubetech_image_slider_links'][0] ) . '">' . get_option('cubetech_image_slider_link_title') . '</a></span>';

		$args = array(
		    'post_type' => 'attachment',
		    'numberposts' => null,
		    'post_status' => null,
		    'post_parent' => $post->ID,
		    'exclude' => get_post_thumbnail_id($post->ID),
		);
		$attachments = get_posts($args);
			
		if ( count($attachments) > 0 ) {
			foreach($attachments as $a) {
				$attachments = (Array)$a;
				break;
			}
		}
		
		$contentreturn .= '
		<li class="cubetech-image-slider-icon cubetech-image-slider-slide-' . $i . '">
			' . $image . '
		</li>';
		
		$i++;
	}
	
	
	return $contentreturn . '</ul> ';
	
}
?>