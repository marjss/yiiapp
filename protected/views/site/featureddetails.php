<style>
.home{width: 30em;margin-bottom: 1em;}
.home li{float: left;  width: 10em; margin-top: 10px;}
br{clear: left;}
.listcontainer{float: left; margin-bottom: 18px;margin-top: 10px; width: 31em;}
</style>
<div class="searchsalon-results" style="background: #ffffff; float: left;">
<div class="avtar">
        <div class="img">
            <?php if($model->avtar):?>
                <?php $avtarimage = Yii::app()->request->baseUrl."/".$model->avtar;?>
            <?php else:?>
                <?php $avtarimage = Yii::app()->request->baseUrl."/avtar/no-image.png";?>
            <?php endif;?>
            <?php echo CHtml::image($avtarimage);?>
        </div>
        
    </div>
<div class="spa-details">
        <div class="spa-name"><?php echo $model->name;?></div>
        <div class="span-contact"><?php echo $model->mobile_no; ?></div>
        <div class="span-address"><?php echo $model->address;?><br /><?php echo $model->city;?></div>
        
        <div class="listcontainer">
            <div class="spa-name">Services</div>
            <ul class="home">
            <?php foreach ($services as $service) {
          echo '<li>';  echo $service->name; echo '</li>';
            } ?>
            </ul> 
        
        
        <div class="s-action" style="margin: 0 0 0 0;">
        <?php if($users->onlinebooking):?>
        
            <?php echo CHtml::link('Request Appointments', "#", array('id'=>'viewmap-'.$users->id,'class'=>'request-app', 'onclick'=>'showpopup('.$users->id.')')); ?>
            <?php //echo CHtml::link('Book Appointments', array("/site/index/", array('id'=>$users->username)), array('id'=>'viewmap-'.$users->id,'class'=>'book-app')); ?>
        <?php else:?>
            <?php echo CHtml::link('Request Appointments', "#", array('id'=>'viewmap-'.$users->id,'class'=>'request-app', 'onclick'=>'showpopup('.$users->id.')')); ?>
        <?php endif;?>
    </div>
            </div>
</div>
    
</div>

<script type="text/javascript">
function showmap(merId)
{
    var url = "<?php echo Yii::app()->request->baseUrl; ?>/site/gmap";
		  jQuery.post( url, { merchant_id: merId},
				function( data ) {
                var obj 	= 	jQuery.parseJSON(data);
                var lat         =   parseFloat(obj.lat);
                var long        =   parseFloat(obj.long);
                var salonname   =   obj.saloonname;
                var address     =   obj.address;
                var city        =   obj.city;
                var state       =   obj.state;
                
                EGMapContainer2_init(lat,long,salonname, address, city, state)
               
            }
            
        );
    
}
function EGMapContainer2_init(clat,clong,salonname, address, city,state)
{
        jQuery("#rvmap").dialog("open");
        
        var mapaddress = address+', '+city+', '+state+', india';
        geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': mapaddress}, function(results, status) {
           if (status == google.maps.GeocoderStatus.OK)
           {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                   map: map,
                   position: results[0].geometry.location,
                   icon: image,
                   title:salonname 
                });
                var contentString = '<div class="map_location_desc">'+
                                '<div class="user_img">'+salonname+'</div>'+
                                '<div class="user_name">'+address+'</div>'+
                                '<div class="other_info"><span>'+city+'</span>, <span>'+state+'</span></div>'+'</div>';
                var infowindow = new google.maps.InfoWindow({content: contentString});
                infowindow.open(map,marker);
           }
              else
           {
              alert("Geocode was not successful for the following reason: " + status);
           }
        });
        // Require only of want to style the map
        var styles = [{stylers: [{ saturation: -100 }]}];
        var styledMap = new google.maps.StyledMapType(styles);
        var mapOptions = {
           zoom: 15,
           mapTypeControlOptions: { mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'] }
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        
        

        var image = new google.maps.MarkerImage('http://deemtech.net/corporate/wp-content/uploads/2012/12/arrow.png',null,null,null,new google.maps.Size(40, 64));
        
        
        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');
        
        
        
      jQuery("#ui-dialog-title-rvmap").html(salonname);
     
}


function showpopup(merchantid)
{
    
    jQuery("#merchant-id").val(merchantid);
    jQuery("#div_com_form .errorMessage").hide();
    jQuery("#update_info").hide();
    jQuery("#div_com_form").show();
    jQuery("#contactname").val('Name');
    jQuery("#mobileno").val('Mobile No');
    jQuery("#subject").val('Subject');
    jQuery("#contactemail").val('Email');
    jQuery("#date").val('Date');
    jQuery("#msgbox").val('Message');
    jQuery("#contacts").dialog("open");
}
</script>