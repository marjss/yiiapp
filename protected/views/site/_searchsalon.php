<div class="view <?php echo ($index % 2) ? 'odd' : 'even';?> "  >
    <?php $merchant = Users::model()->findByPK($data['user_id']);?>
    <div class="avtar">
        <div class="img">
            <?php if($data['avtar']):?>
                <?php $avtarimage = Yii::app()->request->baseUrl."/".$data['avtar'];?>
            <?php else:?>
                <?php $avtarimage = Yii::app()->request->baseUrl."/avtar/no-image.png";?>
            <?php endif;?>
            <?php echo CHtml::image($avtarimage);?>
        </div>
        
    </div>
    <div class="spa-details">
        <div class="spa-name"><?php echo $data['name'];?></div>
        <div class="span-contact"><?php echo $data['mobile_no']?></div>
        <div class="span-address"><?php echo $data['address']?><br /><?php echo $data['city']?></div>
        <div class="view-map">
            <?php echo CHtml::link('view map', "javascript:void(0)", array('id'=>'viewmap-'.$data['user_id'],'class'=>'viewmap', 'onclick'=>'showmap('.$data['user_id'].')')); ?>
        </div>
    </div>
    <!--<div class="s-action">-->
        <?php if($merchant->onlinebooking):?>
            <?php //echo CHtml::link('Request Appointments', "#", array('id'=>'viewmap-'.$data['user_id'],'class'=>'request-app', 'onclick'=>'showpopup('.$data['user_id'].')')); ?>
            <?php //echo CHtml::link('Book Appointments', array("/site/index/", array('id'=>$merchant->username)), array('id'=>'viewmap-'.$merchant_id,'class'=>'book-app')); ?>
        <?php else:?>
            <?php //echo CHtml::link('Request Appointments', "#", array('id'=>'viewmap-'.$data['user_id'],'class'=>'request-app', 'onclick'=>'showpopup('.$data['user_id'].')')); ?>
        <?php endif;?>
    <!--</div>-->
    
    <div class="clear"></div>
    
</div>