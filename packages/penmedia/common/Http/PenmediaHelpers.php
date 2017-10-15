<?php 

namespace Penmedia\Common\Http;

use File;
use url;

class PenmediaHelper 
{
	/*
	 * To get image as html format
	 *
	 */
    public static function getImageHtml( $filename ) {
    	$path = base_path() . '/public/uploads/' . $filename;

	    if( !File::exists( $path ) ) {
	        // return response()->json(['message' => 'Image not found.'], 404);
	    }
		$response = '<img src="'. url( '/uploads/' . $filename ) . '" width="240" />';
	    return $response;
    }
}