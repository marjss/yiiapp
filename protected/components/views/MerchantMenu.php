  <div class="left-menu">
    <div class="menu">
      <ul>
        <li><?php echo CHtml::link('Appointments',Yii::app()->request->baseUrl.'/users/appointment/',array('class'=>'icon-1'));?></li>
        <li><?php echo CHtml::link('<span  id="Searchlist1">Services</span>','javascript:void(0)',array('class'=>'icon-2'));?>
          <div class="sub-menu" id="Searchlist11" style="">
            <ul>
              <li><?php echo CHtml::link('Manage',Yii::app()->request->baseUrl.'/merservices/admin');?></li>
              <li><?php echo CHtml::link('Create New',Yii::app()->request->baseUrl.'/merservices/create');?></li>
            </ul>
          </div>
        </li>
         <li><?php echo CHtml::link('<span  id="Searchlist2">Seats</span>','javascript:void(0)',array('class'=>'icon-3'));?>
          <div class="sub-menu" id="Searchlist21" style="">
            <ul>
              <li><?php echo CHtml::link('Manage',Yii::app()->request->baseUrl.'/merseats/admin');?></li>
              <li><?php echo CHtml::link('Create New',Yii::app()->request->baseUrl.'/merseats/create');?></li>
            </ul>
          </div>
        </li>
          <li><?php echo CHtml::link('<span  id="Searchlist3">Timings</span>','javascript:void(0)',array('class'=>'icon-3'));?>
          <div class="sub-menu" id="Searchlist31" style="">
            <ul>
              <li><?php echo CHtml::link('Manage',Yii::app()->request->baseUrl.'/mertimings/admin');?></li>
            </ul>
          </div>
        </li>
        <li><?php echo CHtml::link('<span  id="Searchlist4">Holidays</span>','javascript:void(0)',array('class'=>'icon-3'));?>
          <div class="sub-menu" id="Searchlist41" style="">
            <ul>
              <li><?php echo CHtml::link('Manage',Yii::app()->request->baseUrl.'/merholidays/admin');?></li>
              <li><?php echo CHtml::link('Create New',Yii::app()->request->baseUrl.'/merholidays/create');?></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
<script>
jQuery("#Searchlist1").click(function(){
	jQuery("#Searchlist11").toggle();
	
	});
jQuery("#Searchlist2").click(function(){
	jQuery("#Searchlist21").toggle();
	
	});
jQuery("#Searchlist3").click(function(){
	jQuery("#Searchlist31").toggle();
	
	});
jQuery("#Searchlist4").click(function(){
	jQuery("#Searchlist41").toggle();
	
	});
</script>