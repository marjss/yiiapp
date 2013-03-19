<?php
    if($count < 4){ $width = (int)((100/$count) - 2); } else{ $width = (int)((100/4) - 2); }
?>
<div class="plan <?php if($index == 1){ echo 'planactive'; } ?>" style="width:<?php echo $width; ?>%;margin:5px;" id="plan_<?php echo $index; ?>">
    <h3><?php echo $data->name; ?></h3>
    <div class="price"><span class="WebRupee">Rs</span> <?php echo (int)$data->cost; ?><span class="valtype">/<?php echo $data->validity_type; ?></span></div>
    
    <div class="stylist">
            <?php if($data->stylists == 0) {echo "<span class='ulstylist'>10<sup>+</sup></span>"; } else { echo '<span class="stylistcount">'.$data->stylists.'</span>'; }; ?>
        <br/>
        Stylists
    </div>
    <h2 class="clients">Unlimited Customers</h2>
    
   <div class="try"><?php echo CHtml::link('Try it',Yii::app()->request->baseUrl.'/signup?plan='.$data->id);?></div>                           
</div>

