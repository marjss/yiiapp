<div class="search-page">
    <h1 class="heading">Find and Book beauty wellness professionals near you</h1>

     <?php $this->widget('Salonssearch'); ?>
     <div class="f-professionals"><span>Featured Professionals</span></div>
     <div class="salon-scheduling">
        <div class="searchsalon-results">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$model->getFeaturedsalon(),
            'itemView'=>'_featuredsalon',
         )); ?>
    </div>
     </div>
</div>
    <?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'details',
                'options'=>array(
                    'title'=>Yii::t('Featured','Featured Salons'),
                    'autoOpen'=>false,
                    'model'=>false,
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));?>
    
   
    <?php  $this->endWidget('zii.widgets.jui.CJuiDialog');  ?>