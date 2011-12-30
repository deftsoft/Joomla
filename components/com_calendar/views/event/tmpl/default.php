<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//echo "<pre>";
//print_r($this->eventtags);
foreach($this->eventtags as $eventtags)
  
   {
      echo $eventtags->name;
	  echo "<br>";    
   }
  

?>

<h1><?php echo $this->event['name'] ?></h1>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>Event Location:</strong></td>
    <td><?php echo $this->event['location'] ?> (<a target="_blank" href="http://maps.google.com.au/maps?q=<?php echo $this->event['location'] ?>&nbsp;Australia">Google Maps</a>)</td>
  </tr>
  <tr>
    <td><strong>Event Date:</strong></td>
    <td><?php echo date('l jS F, Y',strtotime($this->event['date'])) ?> </td>
  </tr>
  <tr>
    <td colspan="2"><p class="button"><a href="<?php echo $this->event['website'] ?>" target="_blank">Visit Event Website</a></p></td>
  </tr>
</table>
<p><?php echo $this->event['details'] ?></p>
<h4>Contact Details</h4>
<p><?php echo $this->event['contact_details'] ?></p>