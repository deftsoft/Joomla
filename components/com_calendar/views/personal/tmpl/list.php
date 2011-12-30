 <?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?><title> </title>

<h2 class="intro">Events</h2>
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
<form action="" method="post" class="filter" id="form2" name="layout">
  <label>View Events by:
    <select name="select" id="select">
      <option selected="selected">List</option>
      <option value="<?php echo JRoute::_('&layout=default'); ?>" onClick="loadLayout()">Calender</option>
    </select>
  </label>
</form>

<?php
echo "<div class='calendarList'>";
foreach($this->listevents[0] as $event) {

	$month = date('M', strtotime($event->date));
	$day = date('d', strtotime($event->date));
	$name = $event->name;
	$details = $event->details;
	$link = JRoute::_('index.php?view=event&id=' . $event->id);
	
	echo "<div class='calenderItem'>
			<div class='calenderDate'>
				<h6 class='month'>$month</h6>
				<h6 class='day'>$day</h6>
			</div>
			<h4>$name</h4>
			<p>$details<a href='$link'>Read more...</a></p>
		  </div>";
}
echo "</div>";
echo $this->listevents[1]->getListFooter();