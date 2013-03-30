<?php $merchant_id = $data->id;?>
<?php $user_details = UserDetails::model()->findByAttributes(array('user_id'=>$merchant_id));?>
<div class="f-salonsf">
    <div class="avtar">
        <div class="imgs">
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
        <div class="spa-namef"><?php $dets =  $user_details->name;
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
<!--<div class="f-salons">
    <div class="avtar">
        <div class="img">
            <?php  /*echo Yii::app()->request->baseUrl
                    if($user_details->avtar):
             $avtarimage = Yii::app()->request->baseUrl."/".$user_details->avtar;
              else:
            $avtarimage = Yii::app()->request->baseUrl."/avtar/no-image.png";
             endif;
              echo CHtml::image($avtarimage); */?>
        </div>
        <div class="spa-name"><?php //echo $user_details->name;?></div>
    </div>
</div>-->