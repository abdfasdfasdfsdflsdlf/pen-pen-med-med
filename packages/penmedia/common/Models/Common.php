<?php

namespace Penmedia\Common\Models;

use Dwij\Laraadmin\Models\LAConfigs;
use Illuminate\Database\Eloquent\Model;

use Penmedia\Common\Http\PenmediaHelper;

class Common extends LAConfigs
{
    /* Get site logo */
    public static function getSiteLogo($key, $default = 'logo.png') {
    	$logo = self::getByKey( $key );
		
		if($logo) {
			return $logo;
		} else {
			return PenmediaHelper::getImageHtml( $default );
		}
	}
}
