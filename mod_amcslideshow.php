<?php

/**
 * @version		$Id$
 * @package		AMC Slideshow
 * @copyright	Copyright (C) 2010 Anthony McLin
 * @license		GNU/GPL
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$link 	 = $params->get( 'link' );
$recursive = $params->get('subfolders');

$folder	= modAMCSlideshowHelper::getFolder($params);
$images	= modAMCSlideshowHelper::getImages($params, $folder, $recursive);

if (!count($images)) {
	echo JText::_( 'No images ');
	return;
}

//Radomize the images
if($params->get('randomize') != '0')
{
	shuffle($images);
}

require(JModuleHelper::getLayoutPath('mod_amcslideshow'));