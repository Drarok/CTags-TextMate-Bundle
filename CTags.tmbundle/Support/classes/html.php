<?php

class HTML
{
	public static function tag($tag, array $attribs = array())
	{
		$html = '<' . $tag;
		
		foreach ($attribs as $attrib => $value) {
			if ($value === null) {
				// Ignore null values.
				continue;
			}
			
			$html .= ' ' . $attrib . '="' . htmlentities($value) . '"';
		}
		
		$html .= '>' . PHP_EOL;
		
		return $html;
	}
}