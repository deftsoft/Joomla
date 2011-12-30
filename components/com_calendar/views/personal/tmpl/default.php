<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.utilities.date' );
#get the document object to get the current page title
$document=JFactory::getDocument();
#get the current page heading of the menu item if it is not empty
$page_heading= $this->escape($this->params->get('page_heading')); ?>
<h1>
<?php 
if(!empty($page_heading))
  {echo $page_heading; }
  else{echo $document->getTitle();}
  ?>
</h1>

<script language="Javascript" type="text/javascript">
function loadLayout() { 
	var destination= self.location; 
	
	for(var i = 0; i<document.layout.select.length; i++){
	  if(document.layout.select[i].selected) {
		destination=document.layout.select[i].value }
	  }
	window.location = destination;
}
</script>
<?php 
#check that only logged in user can view the calendar
if(!empty($this->userid))
  {
?>
 <a href="<?php echo JRoute::_('index.php?option=com_calendar&view=tags&layout=edit'); ?>"><legend><?php echo JText::_( 'Edit Personal Tags'); ?></legend></a>
 <form action="" method="post" class="filter" id="form2" name="layout">
  <label>View Events by:
    <select name="select" id="select">
      <option value="<?php echo JRoute::_('&layout=list'); ?>" onclick="loadLayout()">List</option>
      <option selected="selected">Calender</option>
    </select>
  </label>
</form>


 <?php
//This gets today's date
$date = new JDate();
$date = $date->toUnix();

//This puts the day, month, and year in seperate variables
$day = date('d', $date);

if(JRequest::getInt('month')) $month = $_GET['month'];
else $month = date('m', $date);

if(JRequest::getInt('month')) $year = $_GET['year'];
else $year = date('Y', $date);

//Here we generate the first day of the month
$first_day = mktime(0,0,0,$month, 1, $year) ;

//This gets us the month name
$title = date('F', $first_day) ; 

//Here we find out what day of the week the first day of the month falls on 
$day_of_week = date('D', $first_day) ; 



//Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero

switch($day_of_week) { 
	case "Mon": $blank = 0; break;
	case "Tue": $blank = 1; break; 
	case "Wed": $blank = 2; break; 
	case "Thu": $blank = 3; break;
	case "Fri": $blank = 4; break; 
	case "Sat": $blank = 5; break;
	case "Sun": $blank = 6; break;
}

//We then determine how many days are in the current month
$days_in_month = cal_days_in_month(0, $month, $year) ;

//Here we start building the table heads
if ($month == 1) {
	$prevMonth = 12;
	$nextMonth = 2;
	$prevYear = $year - 1;
	$nextYear = $year;
} elseif ($month == 12) {
	$prevMonth = 11;
	$nextMonth = 1;
	$prevYear = $year;
	$nextYear = $year + 1;
} else {
	$prevMonth = $month - 1;
	$nextMonth = $month + 1;
	$prevYear = $year;
	$nextYear = $year;
}
$prevLink = JRoute::_('&year=' . $prevYear . '&month=' . $prevMonth);
$nextLink = JRoute::_('&year=' . $nextYear . '&month=' . $nextMonth);
echo "<table border='0' cellpadding='0' cellspacing='0' class='calendar'>
	  <tr>
        <td class='button alignLeft title'><a href='$prevLink'>&laquo; Prev</a></td>
        <td colspan='5' nowrap='nowrap' class='alignCenter title'><h3>$title $year</h3></td>
        <td class='button alignRight title'><a href='$nextLink'>Next &raquo;</a></td>
      </tr>
	  <tr>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        <th>Saturday</th>
        <th>Sunday</th>
      </tr>";

//This counts the days in the week, up to 7
$day_count = 1;

echo "<tr>";

//first we take care of those blank days
while ( $blank > 0 ) {
	echo "<td class='blank'>&nbsp;</td>"; 
	$blank = $blank-1; 
	$day_count++;
} 

//sets the first day of the month to 1 
$day_num = 1;

//count up the days, untill we've done all of them in the month
while ( $day_num <= $days_in_month ) {
	echo "<td valign='top'>";
	echo "<h5>" . $day_num . "</h5><div>";
	foreach($this->events as $event) 
	{
		$event_date = strtotime($event->date);
		$event_month = date('m', $event_date);
		$event_day = date('j', $event_date);
		if ($day_num == $event_day && $month == $event_month) {
			echo "<p><a href='" . JRoute::_('&view=event&id=' . $event->id) . "'>" . $event->name . "</a></p>";
		}
	}
	echo "</div></td>"; 

	$day_num++; 

	$day_count++;

	//Make sure we start a new row every week
	if ($day_count > 7) {
		echo "</tr><tr>";
		$day_count = 1;
	}
} 

//Finaly we finish out the table with some blank details if needed
while ( $day_count >1 && $day_count <=7 ) {
	echo "<td class='blank'>&nbsp;</td>";
	$day_count++; 
}

echo "</tr></table>"; 
#end of check 
 }else{echo '<p>You must be logged in to view your personal calendar. Please <a href="index.php?option=com_users&view=login">login</a> or <a href="index.php?option=com_users&view=registration">register</a>.</p>';}
?>