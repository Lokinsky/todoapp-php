<?php
namespace App\Utils;
/**
 * Шаблонизатор
 */
class TemplateBuilder
{
	public static function view($template, $params = [], $is_component = FALSE, $view = NULL)
    {
        /**
         * Создания представления.
         * @return view.php
         * 
         * Представления хранятся в /views/<name>.view.php
         */
        if(!$view) $view = explode("\\", get_called_class())[count(explode("\\", get_called_class()))-1];
        $dir = $_SERVER['DOCUMENT_ROOT'] . sprintf('/views/%s',$view);

        if($is_component) $dir = sprintf('%s/%s',$dir, 'components');
        $file = sprintf('%s/%s.view.php',$dir,$template);
        
        if(
            array_search(sprintf('%s.view.php',$template), array_values(scandir($dir))) 
        ){
            extract($params);
            include $file;
        }
         
    }

}
?>