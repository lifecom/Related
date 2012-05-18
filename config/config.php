<?php

/* ---------------------------------------------------------------------------
 * @Plugin Name: Related
 * @Description: Plugin to display a list of related topics
 * @Author URI: http://chiliec.ru
 * @LiveStreet Version: 0.5.1
 * @Plugin Version:	1.0.0
 * @Taken From: PSNet Similarpopup plugin
 * ----------------------------------------------------------------------------
 */
 
$config = array ();

// Количество похожих топиков для показа
$config ['Show_Topics_Count'] = 5;      // число

// По какому параметру сортировать записи
// Возможные значения: rating, date
$config ['Order_By'] = 'rating';        // строка

// Как сортировать топики в выдаче
// 0 - по возрастанию, 1 - по убыванию
$config ['Order_By_Direction'] = 1;     // число

return $config;

?>