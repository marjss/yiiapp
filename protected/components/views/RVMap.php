<?php 
   $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
     'id'=>"rvmap",
     'cssFile'=>'jquery-ui-1.8.7.custom.css',
     'theme'=>'redmond',
     'themeUrl'=>Yii::app()->request->baseUrl.'/css/ui',
     'options'=>array(
         'title'=>'Salon Location',
         'autoOpen'=>false,
         'modal'=>true,
         'width'=>512,
     ),
   ));

?>

<div id="map_canvas" style="width:496px; height:496px"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>