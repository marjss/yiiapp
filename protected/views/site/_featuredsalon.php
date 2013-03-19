<?php $merchant_id = $data->id;?>
<?php $user_details = UserDetails::model()->findByAttributes(array('user_id'=>$merchant_id));?>
<div class="f-salons">
    <div class="avtar">
        <div class="img">
            <input type="hidden" name ="hidd" id="hidd" value="<?php echo $user_details->user_id;?>" class="hidd">
           
            <?php if($user_details->avtar):?>
                <?php $avtarimage = Yii::app()->request->baseUrl."/".$user_details->avtar;?>
            <?php else:?>
                <?php $avtarimage = Yii::app()->request->baseUrl."/avtar/no-image.png";?>
            <?php endif;?>
            <?php $imgg = CHtml::image($avtarimage);
            echo CHtml::Link($imgg,
        $this->createUrl(('site/details'),array('id'=>$data->id))
//        array(
//            'success'=>'function(r){
//                $("#details").html(r).dialog("open"); 
//                return false;}'
//        )
                    ); ?>
        </div>
        <div class="spa-name"><?php $dets =  $user_details->name;
        echo CHtml::Link($dets,
        $this->createUrl(('site/details'),array('id'=>$data->id))
//        array(
//            'success'=>'function(r){
//                $("#details").html(r).dialog("open"); 
//                return false;}'
//        )
                );?>
        </div>
    </div>
</div>
    