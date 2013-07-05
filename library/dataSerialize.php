<?php
namespace library;


final class dataSerialize
{
	public static function export(&$content, $lifetime = null)
	{
		$file = '<?php'.PHP_EOL;
		if( ! is_null($lifetime) && is_numeric($lifetime) ){
			$lifetime += CURRENT_TIMESTAMP;
			$file .= "\$lifetime = {$lifetime};". PHP_EOL;
		}
		$file .= 'return '. var_export($content, true) .';'. PHP_EOL;

		return $file;
	}

	public static function import($filename)
	{
		if( is_file($filename) ){
			$contents = include $filename;
			if( ! isset($contents['lifetime']) || 
				$contents['lifetime'] > CURRENT_TIMESTAMP ){
				return $contents;
			}
		}
		return false;
	}

	public static function rfc2397($file)
	{
		$mime = mime_content_type($file);
		$content = file_get_contents($file);
		// $base64 = base64_encode($content);

		return "data:{$mime};charset=utf-8,{$content}";
	}
}
