

                    <?php if($review){
                        foreach($review as $rev){?>
                        <div class="deals">
                          <div class="content">
                            <div class="revtitle"><h2><?php echo $rev->name; ?></h2><sup class="revspan">wrote:</sup></div>
                        <div class="review"><?php echo $rev->review; ?></div>
                        <div class="valid"><span class="revspan2">On: <?php echo date('d-m-Y', $rev->date);?></span></div>
                        <div class="rating"><span class="rates">Rating:</span>
                       <?php $this->widget('CStarRating',array( 'name'=>'rating'.$rev->id,
                                            'maxRating'=>5,//max value
                                            'value'=>$rev->rating,
                                            'readOnly'=>true,

                                        ));?>
                        </div>
                        </div></div>  
                        <?} ?>
                   <?php }else{?><div class="deals">
                          <div class="content"><h2>No Reviews right now !</h2></div></div> <?php } ?>
                    <?php echo CHtml::button('Your Review', array('id'=>'viewmap-'.$users->id,'class'=>'button', 'onclick'=>'showpopup1('.$users->id.')')); ?>
                   <?php $this->widget('AjaxPager', array(
                                            'pages' => $pages,
                                                'maxButtonCount'=>4,
                                'id'=>'link_pager'.$rev->id
                                            
                       
                                    )) ?>
                       
                  <!--</div>-->
                   
<script type="text/javascript">
function showpopup1(merchantid)
{
   
    jQuery("#merchant-id").val(merchantid);
    jQuery("#div_com_forms .errorMessage").hide();
    jQuery("#update_infos").hide();
    jQuery("#div_com_forms").show();
    jQuery("#name").val('Name');
    jQuery("#email").val('Email');
//    jQuery("#date").val('Date');
    jQuery("#review").val('Review');
    jQuery("#reviewform").dialog("open");
}
</script>
