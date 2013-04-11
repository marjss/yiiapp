<style>
    .newserv{
        color: black !important;
    }
</style>
<div class="salon-search">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
     
    <?php 
                function CityFromIP($ipAddr)
                        {
                        //function to find country and city from IP address
                        //verify the IP address
                        ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
                        $key= "6424402f02c2d32d2c01a868599e501dac1e299481ac0efe05b7c8a06ab41cb2" ;//API key to be used
                        
                        //get the JSON result from ipinfodb.com or Use hostip.info
                        //$json = file_get_contents("http://api.hostip.info/get_json.php?ip=".$ipAddr."&position=true");
                        $json= file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=".$key."&ip=".$ipAddr."&format=json");
                        $data=  CJSON::decode($json);
                  
                        return $data;
                        }
    
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.form.js');
    $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.validate.js');

    if ($_POST['Merservices']['name']) {
        $servicename = $_POST['Merservices']['name'];
    } else {
        $servicename = 'e.g. Hair Cut';
    }
    if ($_POST['Merservices']['nearby']) {
        $servicenearby = $_POST['Merservices']['nearby'];
    } else {
        $servicenearby = 'e.g. Raja Park';
    } 
    
    ?> 
     <?php 
     $criteria2= new CDbCriteria;
//     $criteria2->limit = 5;
     
     $criteria = new CDbCriteria;
//     $criteria->select = 'name,id';
//     $criteria->limit = 5;
//     $criteria->distinct = true;
     $criteria->group = 'name';
//     echo'<pre>';
//     print_r($criteria);
//     echo '</pre>';
     $models= CategoryService::model()->findAll();
     
     $users = UserDetails::model()->findAll();
     $out1 = array();
	foreach ($users as $c) {
	 $out1[] = array(
                        'label' => $c->name,  
                        'value' => $c->name,
                        'id' => $c->id,
                        'category'=>'Business',);}
            $out = array();
        foreach ($models as $d) {
        $out[] = array(
			'label' => $d->title,  
			'value' => $d->title,
			'id' => $d->id, 
                        'category'=>'Services',
				
			    );}
            $datas=  CJSON::encode($out+$out1);?>
<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        // Code that uses jQuery's $ can follow here.
         $(function(){
           var serv = $("#service_autocomplete").val();
           var near = $('#search-service').val();
           var city = $('#Merservices_city').val();
            $("#service_autocomplete").focusin(function(){
           if(serv = 'e.g. Hair Cut'){
               $("#service_autocomplete").addClass('newserv'); }
            });
            $("#service_autocomplete").focusout(function(){
           if(serv = 'e.g. Hair Cut'){
               alert(serv);
               $("#service_autocomplete").removeClass('newserv'); }else {alert("hello");}
            });
            $("#search-service").focusin(function(){
           if(near = 'e.g. Raja Park'){
               $("#search-service").addClass('newserv'); }
            });
            $("#search-service").focusout(function(){
           if(near = 'e.g. Raja Park'){
               $("#search-service").removeClass('newserv'); }
            });
           if(serv != 'e.g. Hair Cut'){$("#service_autocomplete").addClass('newserv'); }
           if(near != 'e.g. Raja Park'){$("#search-service").addClass('newserv');}
           if(near != 'Select City'){$("#Merservices_city").addClass('newserv');}
       });
        $.widget( "custom.catcomplete", $.ui.autocomplete, {
            _renderMenu: function( ul, items ) {
                var that = this,
                
                currentCategory = "";
                $.each( items, function( index, item ) {
                    if (index < 10 ){
                        
                        if ( item.category != currentCategory ) {
                            ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
                            currentCategory = item.category;
                        }
                        that._renderItemData( ul, item );}
                });
            }
        });
        
        $(function() {
            var data = <?php echo $datas; ?>;
            $( "#service_autocomplete" ).catcomplete({
                delay: 500,
                source: data,
                select: 
                    function( event, ui ) {
                    //    alert(ui.item.value);
                    jQuery("#service_autocomplete").val(ui.item["id"]);
                }
                
            });
        });
    });
</script>
    <div class="search-form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'search-form',
        'action' => Yii::app()->request->baseUrl . '/search',
        'enableAjaxValidation' => true,
            )
    );
    ?>  <ul>
            <li>
             <?php   echo $form->textField($model, 'name', array('size' => 40, 'maxlength' => 150, 'id' => 'service_autocomplete', 'class' => 'service_field', 'value' => $servicename,'onblur'=>"if(this.value==''){this.value='e.g. Hair Cut'}", 'onclick'=>"if(this.value=='e.g. Hair Cut'){this.value=''}")); ?>
                <!--<input id="service_autocomplete" class="service_field">-->
               
        <?php
        /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'attribute' => 'name',
            'model' => $model,
            'sourceUrl' => array('merservices/find'),
            'options' => array(
                'minLength' => '2',
                'select' => 'js: function(e,u){
                    jQuery("#service_autocomplete").val(u.item["id"]);
                    }',
                
                
                'complete' => 'js:function(){}',
                'open' => 'js:function(event, ui){
                    $("ul.ui-autocomplete li a").each(function(){
                    var htmlString = $(this).html().replace(/,/g, "<br>");
                    htmlString = htmlString.replace(/,/g, "<br>");
                    $(this).html(htmlString);
                    });}',
            ),
            'htmlOptions' => array(
                'size' => 45,
                'maxlength' => 45,
                'class' => 'service_field',
                'id' => 'service_autocomplete',
                'value' => $servicename,
            ),
        )); */
        ?>
            </li>
            <li>
                <?php 
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'attribute' => 'nearby',
            'model' => $model,
            'sourceUrl' => array('merservices/near'),
            'options' => array(
                'minLength' => '2',
                'select' => 'js: function(e,u){
                    jQuery("#search-service").val(u.item["id"]);
                    }',
                
                
                'complete' => 'js:function(){}',
                'open' => 'js:function(event, ui){
                    $("ul.ui-autocomplete li a").each(function(){
                    var htmlString = $(this).html().replace(/,/g, "<br>");
                    htmlString = htmlString.replace(/,/g, "<br>");
                    $(this).html(htmlString);
                    });}',
            ),
            'htmlOptions' => array(
                'size' => 45,
                'maxlength' => 45,
                'class' => 'required service_field',
                'id' => 'search-service',
                'value' => $servicenearby,
                'onblur'=>"if(this.value==''){this.value='e.g. Raja Park'}", 
                'onclick'=>"if(this.value=='e.g. Raja Park'){this.value=''}"
            ),
        ));
                
//                echo $form->textField($model, 'nearby', array('size' => 40, 'maxlength' => 150, 'id' => 'search-service', 'class' => 'required service_field', 'value' => $servicenearby)); ?>
            </li>
            <li>
                <div class="cities">
                <?php 
                    if($city)                                                   //If the session has the saved city by the user.
                        {
                            $output= Citylist::model()->getCitylist($city);
                            echo CHTML::dropDownList('Merservices[city]', $output, Citylist::model()->getCitylistDropDown(), array('prompt' => 'Select City')); 
                        }
                    else{                                                       //Default city load by the users IP Address. 
                        $ip= $_SERVER['REMOTE_ADDR'];
                        $ipAddr = '122.176.83.11' ;                             //Constant IP Address for the debugging purpose.Mark Comment while not testing.
                        $citydata= CityFromIP($ip);                         //Change the $ipAddr to $ip  while running the real world application
                        $city1= $citydata['cityName'];                          //Replace cityName to city in case of hostip.info
                        $output= Citylist::model()->getCitylist($city1);
                        echo CHTML::dropDownList('Merservices[city]', $output, Citylist::model()->getCitylistDropDown(), array('prompt' => 'Select City'));  
                        }?>
                </div>
            </li>
            <li>
                <?php echo CHtml::submitButton('SEARCH'); ?>
            </li>
        </ul>

<?php $this->endWidget(); ?>
    </div>
</div>
<script type="text/javascript">
    jQuery.noConflict();
jQuery(document).ready(function($) {
// Code that uses jQuery's $ can follow here.
//    $('input.service_field').focus(function(){
//        
//        if($(this).val() == this.defaultValue){$(this).val('');$(this).css("color","#CCCCCC");}
//    }).blur(function(){
//        if($(this).val() == ''){$(this).val(this.defaultValue);$(this).css("color","#CCCCCC");}
//    });
    $('#Merservices_city').focus(function(){
        $(this).css("color","#000000");
    }).blur(function(){
        if($(this).val() == '')
        {
            $(this).css("color","#CCCCCC");
        }
    });
    function searchsalons()
    {
        if(jQuery("#search-form").validate())
        {
            alert('hi');
        }
        return false;
    }});
</script>
