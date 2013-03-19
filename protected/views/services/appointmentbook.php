<?php
    $seats = Seats::model()->findAll();
    
    //echo "<pre>"; print_r($days); die;
?>

<div class="appbook">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
   <thead style="text-align:center;">
    <th style="background:none; border:none;">&nbsp;</th>
     <?php foreach($seats as $seat){  ?> 
	    <th><strong><?php echo $seat->name.'('.$seat->stylist->username.')'; ?></strong></th>
    <?php } ?>
  </thead>
   <?php 
	$k=12;
	$starttime = 9;
	$endtime = 19;
	for($i=$starttime;$i<=$endtime;$i++){ 
    ?>
   
    <tr>
	   <td  align="right" valign="top" style=" font-size:30px; width:100px;text-align:center;">
                <strong> 	
		    <?php 
			if($i<12 || $i==24){
			    if($i<12){
				    echo $i." <br /><span>AM</span>";
			    }
			    if($i==24){
				    echo ($i-$k)." <br /><span>AM</span>";
			    }
			}
			if($i>=12 && $i!=24){
			    if($i>=13){
				    echo ($i-$k)." <br /><span>PM</span>";
			    }
			    if($i==12){
			      echo $i." <br /><span>PM</span>";
			    }
			}
		    ?>
		</strong>
	    </td>
	

     <?php foreach($seats as $seat){  ?> 
	    <td>
		<ul class="box-link">
		    <li></li>
		    <li></li>
		    <li></li>
		    <li class="last"></li>
		</ul>
	    </td>
    <?php } ?>

    </tr>
   
    <?php } ?>
  
</table>

</div>







