<?php
namespace App\Utils;
/**
 * 
 */
class ObjectExt
{
	
	protected function get_object_properties($object, $only_keys = false){
		if($only_keys) return array_keys(get_object_vars($object));
		else return get_object_vars($object);
	}
	public static function session($key)
	{
		if(array_search($key, array_keys($_SESSION))) return $_SESSION[$key];
		else return false;
	}
}

?>