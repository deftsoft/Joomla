<?php
defined('_JEXEC') or die('Restricted access');
require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
$contentconfig = &JComponentHelper::getParams( 'com_content' );

$db		=& JFactory::getDBO();
$user		=& JFactory::getUser();
$userId		= $user->get('id');
$count		= $params->get('count', 0);
$catid		= $params->get('catid');
$secid		= trim( $params->get('secid') );
$columns	= trim( $params->get('columns',3) );
$html			= trim( $params->get('html','{intro}') );
$maxintro	= trim( $params->get('maxintro'),'' );
$maxtitle = trim( $params->get('maxtitle'),'' );
$featured	= $params->get('featured', 'show');
$display	= $params->get('display', 'div');
$aid		= $user->get('aid', 0);

$contentConfig = &JComponentHelper::getParams( 'com_content' );
$access		= !$contentConfig->get('show_noauth');

$nullDate	= $db->getNullDate();

$date =& JFactory::getDate();
$now = $date->toMySQL();

$where		= 'a.state = 1'
	. ' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
	. ' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )'
	;

// User Filter
switch ($params->get( 'user_id' ))
{
	case 'by_me':
		$where .= ' AND (created_by = ' . (int) $userId . ' OR modified_by = ' . (int) $userId . ')';
		break;
	case 'not_me':
		$where .= ' AND (created_by <> ' . (int) $userId . ' AND modified_by <> ' . (int) $userId . ')';
		break;
}

// Ordering
switch ($params->get( 'ordering' )) {
	case 'm_dsc':
		$ordering		= 'a.modified DESC, a.created DESC';
		break;
	case 'c_dsc':
	default:
		$ordering		= 'a.created DESC';
		break;
}

if ($catid) {
    if(is_array($catid)){
        if($catid[0] != 0)
            $catCondition = ' AND cc.id in ('.join(',',$catid).')';
    }
    else{
        $catCondition = ' AND (cc.id = '.$catid.')';
    }
}

// Content Items only
$query = 'SELECT a.*, ' .
	' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
	' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
	' FROM #__content AS a' .
	($featured == 'only' ? ' LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id' : '').
	($featured == 'hide' ? ' LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id' : '').
	' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
	' WHERE '. $where;
        if($access){
            $groups	= implode(',', $user->getAuthorisedViewLevels());
            $query .= ' AND a.access IN ('.$groups.')';
        }
	$query .= ($catid ? $catCondition : '').
	($featured == 'only' ? ' AND f.content_id  = a.id ' : '').
	($featured == 'hide' ? ' AND f.content_id IS NULL ' : '').
	' AND cc.published = 1' .
	' ORDER BY '. $ordering;
$db->setQuery($query, 0, $count);
$rows = $db->loadObjectList();

if ($display == "div") echo "<div class='".$params->get('moduleclass_sfx')."'>" ;
if ($display == "ul") echo "<ul class='".$params->get('moduleclass_sfx')."'>" ;
$c=1;
if (count($rows) > 0) {
	$i=0;
	foreach ( $rows as $row ) {
			$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug));
		$ini=strpos(strtolower($row->introtext),'<img');
		if ($ini === false) $img = '';
		else {
			$ini = strpos($row->introtext,'src="',$ini)+5;
			$fin = strpos($row->introtext,'"',$ini);
			$img = substr($row->introtext,$ini,$fin-$ini);
			$fin = strpos($row->introtext,'>',$fin);
		}
		
		$intro=strip_tags($row->introtext);
			if (!empty($maxintro)) $intro = trim(substr($intro,0,$maxintro)).'...';
		
		$title = htmlspecialchars($row->title);
			if (!empty($maxtitle)) if (strlen(htmlspecialchars($row->title)) > $maxtitle) $title = trim(substr(htmlspecialchars($row->title),0,50)).'...';
			
		$created = $row->created;
		
		$hold = $html;
		$hold = str_replace( '{link}', $link, $hold );
		$hold = str_replace( '{title}', $title, $hold );
		$hold = str_replace( '{author}', $row->created_by, $hold );
		$hold = str_replace( '{created}', $created, $hold );
		$hold = str_replace( '{intro}', $intro, $hold );
		$hold = str_replace( '{introimage}', $img, $hold );
		$hold = str_replace( '{featureimage}', $img, $hold );
		
		echo $hold.'';
		$i++;
	}
}
if ($display == "div") echo "</div>" ;
if ($display == "ul") echo "</ul>" ;
?>