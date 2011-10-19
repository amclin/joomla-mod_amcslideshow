<?php

/**
 * @version		$Id$
 * @package		AMC Slideshow
 * @copyright	Copyright (C) 2010 Anthony McLin
 * @license		GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

//Unique identifier for this gallery to allow multiple galleries on one page
$token = uniqid();

// Build the slideshow object and image list
echo "\n<div id=\"gallery_$token\" style='height: ". $params->get('height'). "px; width: " .$params->get('width'). "px;'>\n";
foreach($images as $image)
{
	echo "	<div class=\"slide\">\n";
//	echo "		<h3>Item Title</h3>\n";
//	echo "		<p>Item description</p>\n";
//	echo "		<a href=\"mypage1.html\" title=\"open image\" class=\"open\"></a>\n";
	echo "		<img src=\"" . JURI::base() . $image->folder . "/" . $image->name . "\" class=\"full\" />\n";
//	echo "		<img src=\"images/brugges2006/1-mini.jpg\" class=\"thumbnail\" />\n";
	echo "	</div>\n";
}

// Build a list of parameters
$slideshowparams = array('timed','showArrows','showCarousel','embedLinks','useHistoryManager','showInfopane');


// Start the slideshow
?>
<script type="text/javascript">
	window.addEvent('domready',function(){
		//Slideshow using clientcide simplecarousel
		 carousel = new SimpleCarousel($('gallery_<?php echo $token ?>'), $$('#gallery_<?php echo $token ?> div.slide'), $$('#gallery_<?php echo $token ?> .button'), {
			slideInterval: 			5500,
			transitionDuration: 	2000,
			autoplay:				true,
			rotateAction: 			'click'
		});		
	});
</script>
</div>