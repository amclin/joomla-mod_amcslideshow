<?php

/**
 * @version		$Id$
 * @package		AMC Slideshow
 * @copyright	Copyright (C) 2010 Anthony McLin
 * @license		GNU/GPL
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Helper class for AMC Slideshow Module
 */
class modAMCSlideshowHelper {

	/**
	 * Get the list of images in a specified folder
	 * @var	object	Joomla parameters object
	 * @var string Path to folder
	 */
	function getImages(&$params, $folder, $recursive)
	{
		$type 		= $params->get( 'type', 'jpg' );

		$files	= array();
		$images	= array();

		$dir = JPATH_BASE.DS.$folder;

		// check if directory exists
		if (is_dir($dir))
		{
			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != '.' && $file != '..' && $file != 'CVS' && $file != '.svn' && $file != 'index.html' ) {
						$files[] = $file;
					}
				}
			}
			closedir($handle);

			$i = 0;
			foreach ($files as $img)
			{
				//If the item is an image, add it to the list
				if (!is_dir($dir .DS. $img))
				{
					if (eregi($type, $img)) {
						$images[$i]->name 	= $img;
						$images[$i]->folder	= str_replace(DS,'/',$folder);
						++$i;
					}
				} else {
					//If the item is a folder, do a recursive run of this function to find images in subfolders and add them to the list
					if($recursive == 1)
					{
						$subfolder = $folder . DS . $img;
						$subimages = modAMCSlideshowHelper::getImages($params, $subfolder, $recursive);
						foreach($subimages as $subimage)
						{
							$images[$i]->name = $subimage->name;
							$images[$i]->folder = str_replace(DS,'/',$subimage->folder);
							++$i;
						}
					}
				}
			}
		}
		sort($images);
		return $images;
	}


	/**
	 * Function to find a folder
	 * @var	object	Joomla parameters object
	 * @return	string	The full path to the folder
	 */
	function getFolder(&$params)
	{
		$folder 	= $params->get( 'folder' );

		$LiveSite 	= JURI::base();

		// if folder includes livesite info, remove
		if ( JString::strpos($folder, $LiveSite) === 0 ) {
			$folder = str_replace( $LiveSite, '', $folder );
		}
		// if folder includes absolute path, remove
		if ( JString::strpos($folder, JPATH_SITE) === 0 ) {
			$folder= str_replace( JPATH_BASE, '', $folder );
		}
		$folder = str_replace('\\',DS,$folder);
		$folder = str_replace('/',DS,$folder);

		return $folder;
	}
}