<section>
	<div class="warrper">
       <div class="middle-content">
       		<div class="price-salonier">
            	<h1>Try any of our plans. Free for thirty days.</h1>
            	<div id="pricing-table" class="clear">
                    <?php if(count($dataProvider->getData())>0):?>
                    <?php 
                        $this->widget('zii.widgets.CListView', array(
                       'dataProvider'=>$dataProvider,
                       'itemView'=>'_pricingplans',
                        'ajaxUpdate'=> false,
                        'enablePagination' => false,
                         'viewData' => array( 'count'=>count($dataProvider->getData()) ), 
                         'cssFile'=> Yii::app()->theme->baseUrl.'/style.css',
                    )); 
                
                endif;?>
                </div>
            </div>
       </div>
    </div>

</section>
<script type="text/javascript">
    $("#plan_0").hover(function(){
        $("#plan_1").removeClass('planactive');
    });
    
    $("#plan_2").hover(function(){
        $("#plan_1").removeClass('planactive');
    });
    $("#pricing-table").live('mouseleave',function(){
        $("#plan_1").addClass('planactive');
    });

</script>