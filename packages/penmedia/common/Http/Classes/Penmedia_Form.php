<?php

namespace Penmedia\Common\Http\Classes;

use App;
use Former\Facades\Former;

class Penmedia_Form
{
	public static function horizontal_open()
	{
		if (App::environment() == 'production')
			return Former::secure_open();
		else
			return Former::horizontal_open();
	}

	public static function open_for_files()
	{
		if (App::environment() == 'production')
			return Former::secure_open_for_files();
		else
			return Former::open_for_files();		
	}

	public static function vertical_open()
	{
		if (App::environment() == 'production')
			return Former::secure_vertical_open();
		else
			return Former::vertical_open();
	}

	public static function close()
	{
		return Former::close();
	}

	public static function getErrors($errors, $aFields)
	{
		$aErrors = array();
		if (isset($errors))
		{
			foreach ($aFields as $field) {
				$str = $errors->first($field);
				if (strlen($str)) $aErrors[] = $str;
			}
			return implode(', ', $aErrors);
		}

		return '';
	}
}