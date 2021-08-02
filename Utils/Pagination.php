<?php
namespace App\Utils;

class Pagination extends TemplateBuilder
{
	public static function getPagination($last, $page = 0, $uri = ''){
		if(!isset($uri))
			$uri = explode($_SERVER['REQUEST_URI'],'?');
		$as = '';
		$order_by = '';

        if(isset($_REQUEST['sort']))
        	$as = htmlspecialchars($_REQUEST['sort']);
        if(isset($_REQUEST['by']))
        	$order_by = htmlspecialchars($_REQUEST['by']);

		self::view('Pagination', [
			'first_link' => $uri .'?'. http_build_query([
				"page" 	=> 0,
				"sort" 	=> $as,
				"by" 	=> $order_by
			]),
			'prev_link' => $uri .'?'. http_build_query([
				"page" 	=> $page - 1 >= 0 ? $page - 1 : 1,
				"sort" 	=> $as,
				"by" 	=> $order_by 

			]),
			'next_link' => $uri .'?'. http_build_query([
				"page" 	=> $page + 1 <= $last ? $page + 1 : $last,
				"sort" 	=> $as,
				"by" 	=> $order_by 
			]),
			'current' => $page,
			'last' => $last,
			'last_link' => $uri .'?'. http_build_query([
				"page" 	=> $last,
				"sort" 	=> $as,
				"by" 	=> $order_by 
			])
		]);
	}
}
?>