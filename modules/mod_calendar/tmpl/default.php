<?php
defined('_JEXEC') or die;
	  //$nameLimit=$params->get('name');
	  //$detailsLimit=$params->get('details');
?>
<div class="upcoming-events">
	<h3>Upcoming Events</h3>
	<?php foreach($items as $item): ?>
	<div class="block">
	    <a href="<?php echo JRoute::_('index.php?option=com_calendar&view=event&id=' . $item->id); ?>" class="link">View Event</a>
	    <a href="#" class="name"><?php echo  $item->name;?></a>
	    <p><?php echo $item->details;
		 ?></p>
	    <div class="info">
		    <div class="location">Location: <?php echo $item->location; ?></div>
		    <div class="date">Date: <?php echo date('l jS F, Y',strtotime($item->date)); ?></div>
	    </div>
    </div>
    <?php endforeach; ?>
</div>                                                                                                                                                                        