<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->events as $i => $event): ?>
        <tr class="row<?php echo $i % 2; ?>">
                <td>
                        <?php echo JHtml::_('grid.id', $i, $event->id); ?>
                </td>
                <td>
                        <?php echo "<a href='" . JRoute::_('index.php?option=com_calendar&task=event.edit&id=' . $event->id) . "'>" . $event->name . "</a>"; ?>
                        <p class="smallsub"><?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $event->alias);?></p>
                </td>
                <td align="center">
				     <?php #condition to check wheather the status is verified or not to show the respective image 
					  if(!empty($event->verified)){$img='tick.png'; $task='verify';}else{$img='publish_x.png';$task='unverify';}?>
					<a href="<?php echo JRoute::_('index.php?option=com_calendar&task=events.EditEventStatus&id='.$event->id.'&status='.$task.'') ?>" ><img src="templates/bluestork/images/admin/<?php echo $img;?>" /></a>
				</td>
                <td align="center">
                        <?php echo date("F j, Y",strtotime($event->date)); ?>
                </td>
                <td></td>
				<td>
                        <?php echo $event->id; ?>
                
				</td>
        </tr>
<?php endforeach; ?>