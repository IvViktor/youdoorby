<?php
/**
 * @version     $Id: pagination.php 10822 2009-10-09 16:16:00Z tcp $
 * @package     Joomla
 * @copyright   Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
/**
 * This is a file to add template specific chrome to pagination rendering.
 *
 * pagination_list_footer
 *   Input variable $list is an array with offsets:
 *       $list[limit]       : int
 *       $list[limitstart]  : int
 *       $list[total]       : int
 *       $list[limitfield]  : string
 *       $list[pagescounter]    : string
 *       $list[pageslinks]  : string
 *
 * pagination_list_render
 *   Input variable $list is an array with offsets:
 *       $list[all]
 *           [data]     : string
 *           [active]   : boolean
 *       $list[start]
 *           [data]     : string
 *           [active]   : boolean
 *       $list[previous]
 *           [data]     : string
 *           [active]   : boolean
 *       $list[next]
 *           [data]     : string
 *           [active]   : boolean
 *       $list[end]
 *           [data]     : string
 *           [active]   : boolean
 *       $list[pages]
 *           [{PAGE}][data]     : string
 *           [{PAGE}][active]   : boolean
 *
 * pagination_item_active
 *   Input variable $item is an object with fields:
 *       $item->base    : integer
 *       $item->link    : string
 *       $item->text    : string
 *
 * pagination_item_inactive
 *   Input variable $item is an object with fields:
 *       $item->base    : integer
 *       $item->link    : string
 *       $item->text    : string
 *
 * This gives template designers ultimate control over how pagination is rendered.
 *
 * NOTE: If you override pagination_item_active OR pagination_item_inactive you MUST override them both
 */

function pagination_list_footer($list)
{
    // Initialize variables
    $lang =& JFactory::getLanguage();
    $html = "<div class=\"list-footer\">\n";

    if ($lang->isRTL())
    {
        $html .= "\n<div class=\"counter\">".$list['pagescounter']."</div>";
        $html .= $list['pageslinks'];
        $html .= "\n<div class=\"limit\">".JText::_('Display Num').$list['limitfield']."</div>";
    }
    else
    {
        $html .= "\n<div class=\"limit\">".JText::_('Display Num').$list['limitfield']."</div>";
        $html .= $list['pageslinks'];
        $html .= "\n<div class=\"counter\">".$list['pagescounter']."</div>";
    }

    $html .= "\n<input type=\"hidden\" name=\"limitstart\" value=\"".$list['limitstart']."\" />";
    $html .= "\n</div>";

    return $html;
}
//ФУНКЦИЯ В КОТОРОЙ ВЫВОДЯТСЯ ВСЕ ССЫЛКИ В ПАГИНАЦИИ
function pagination_list_render($list)
{
    // Initialize variables
    $numlr = 1; //колличество позиций страниц в начале ленты и в конце
    $numpos = 5; //колличество позиций ленты вообще
    $lang =& JFactory::getLanguage();


    //===========================ПАГИНАЦИ ОФОРМЛЕНА В ВИДЕ ТАБЛИЦЫ С ОДНОЙ СТРОКОЙ============================================================================
    $html = '<table class="contentpagination"><tr>';
// Reverse output rendering for right-to-left display
    if($lang->isRTL()){ $list['pages'] = array_reverse( $list['pages'] ); }
        //===================================ЗДЕСЬ ВЫВОДИТСЯ ССЫЛКА НА КНОПКУ ПРЕДИДУЩИАЯ СТРАНИЦА В ПАГИНАЦИИ
    $html .= '<td align="right" width="49%">';
//  $html .= '&laquo;';
//  $html .= '&#38;#171;';
//  $html .= $list['start']['data'];
    $html .= $list['previous']['data'];
    $html .= '</td>';
    $html .= '<td align="center">';
    //========================================ЗДЕСЬ ВЫВОДЯТСЯ ССЫЛКИ НА СТРАНИЦЫ В ПАГИНАЦИИ
    if(count($list['pages'])>$numpos) { // если страниц больше чем позиций в ленте - разбиваем троеточием
        for($i=1; $i<=count($list['pages']); $i++){
            if(!$list['pages'][$i]['active']) {
                if($i > $numlr){
                    for($j=1; $j<=$numlr; $j++){ $html .= $list['pages'][$j]['data']; }
                }else{
                    for($j=1; $j<$i; $j++){ $html .= $list['pages'][$j]['data']; }
                }
            //=================================ЗДЕСЬ ВЫВОДИТСЯ ТРОЕТОЧИЕ
                if(($numlr+1) < ($i-1)){ $html .= '...'; }
                if((count($list['pages']) - $numlr) <= $i){
                    for($j=(count($list['pages'])-$numlr-2); $j<$i; $j++){ $html .= $list['pages'][$j]['data']; }
                }else{
                    if($i > ($numlr+1)){ $html .= $list['pages'][$i-1]['data']; }
                }
                //==============================ЗДЕСЬ ВЫВОДИТСЯ ТЕКУЩАЯ КНОПКА В ПАГИНАЦИИ
                $html .= '<span class="activ">';
                $html .= $list['pages'][$i]['data'];
                $html .= '</span>';
                if(($numlr+1) >= $i){
                    for($j=($i+1); $j<=($numlr+3); $j++){ $html .= $list['pages'][$j]['data']; }
                }else{
                    if($i < (count($list['pages'])-$numlr)){ $html .= $list['pages'][$i+1]['data']; }
                }
                //================================ЗДЕСЬ ВЫВОДИТСЯ ЕЩЕ ОДНО ТРОЕТОЧИЕ
                if((count($list['pages']) - $numlr) > ($i+1)){ $html .= '...'; }
                if($i <= (count($list['pages'])-$numlr)){
                    for($j=(count($list['pages'])-$numlr+1); $j<=count($list['pages']); $j++){ $html .= $list['pages'][$j]['data']; }
                }else{
                    for($j=$i+1; $j<=count($list['pages']); $j++){ $html .= $list['pages'][$j]['data']; }
                }
                }
        }
    } else {
        foreach( $list['pages'] as $page ){
            if(!$page['active']) {
                $html .= '<span class="activ">';
            }
            $html .= $page['data'];
            if(!$page['active']) {
                $html .= '</span>';
            }
        }
    }
    $html .= '</td>';
    //================================================ЗДЕСЬ ВЫВОДИТСЯ КНОПКА СЛЕДУЮЩАЯ СТРАНИЦА В ПАГИНАЦИИ
    $html .= '<td align="left" width="49%">';
    $html .= $list['next']['data'];
//  $html .= $list['end']['data'];
//  $html .= '&raquo;';
    $html .= '</td>';
    $html .= '</tr></table>';
    //===============================================ЗАКОНЧИЛАСЬ ОТРИСОВКА ТАБЛИЦЫ ПАГИНАЦИИ
    return $html;
}

function pagination_item_active(&$item) {
    return "&nbsp;<a href=\"".$item->link."\" title=\"".$item->text."\">".$item->text."</a>&nbsp;";
}

function pagination_item_inactive(&$item) {
    return "&nbsp;<a href=\"".$item->link."\" title=\"".$item->text."\">".$item->text."</a>&nbsp;";
}
?>