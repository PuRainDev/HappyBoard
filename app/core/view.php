<?php
namespace app\core;
class view
{
	
	function generate($content_view, $template_view, $data = null) {
		include 'app/views/'.$template_view;
	}
}