<div class="landing_header">

                <div class="blk">
                    <h1><a href="#">  <?php echo $model->name; ?></a></h1>

                    <div class="logo"> <a href="#"><img src="<?php 
                    if($model->avtar){ echo Yii::app()->request->baseUrl.'/'.$model->avtar;}else{echo Yii::app()->request->baseUrl."/avtar/no-image.png" ;} ?>" width="135" height="59"> </a></div>
                </div>

            </div>

            <div class="landing_page">

                <div class="landing_page_left"> 

                    <div class="landing_left">
                        <div class="landing_leftblk">

                            <div class="landing_leftblkbg">

                                <div class="landing_leftbgblk">
                                    <h2> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/home_icon.jpg" width="25" height="22">  Address: </h2>

                                    <p>   <?php echo $model->address; ?>  </p>

                                </div>


                            </div>
                            <div class="landing_leftblkbg">

                                <div class="landing_leftbgblk">
                                    <h2> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/email_icon.jpg" alt="" >  Email: </h2>

                                    <a href="mailto:<?php echo $users->email; ?> "><?php echo $users->email; ?>  </a>

                                </div>


                            </div>
                            <div class="landing_leftblkbg">

                                <div class="landing_leftbgblk">
                                    <h2> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/phone_icon.jpg" alt="">  Phone:: </h2>

                                    <p><?php echo  $model->mobile_no?></p>



                                </div>


                            </div>
                                <?php echo CHtml::button('Request Appointment', array('id'=>'viewmap-'.$users->id,'class'=>'button', 'onclick'=>'showpopup('.$users->id.')')); ?>
                            <!--<input name="" type="button" class="button" value="Book Appointment">-->

                        </div>
                    </div>
                    <div class="landing_left_shadow"> </div>


                </div>

                <div class="landing_page_left"> 

                    <div class="landing_left">
                        <div class="landing_leftblk">

                            <div class="landing_leftblkbg">

                                <div class="landing_leftbgblk">
                                    <h2> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/watch_icon.jpg" alt="" >  Working Hours: </h2>


                                </div> 

                                <div class="hournav">
                                    <ul> <?php if($time){
                                        
                                    foreach($time as $t) { ?>
                                        <?php echo $time->opening_at;
                                        $tmo = explode(":", $t->opening_at);
                                        $tco = explode(":", $t->closing_at);
                                        ?>
                                        <li> <?php  echo date("l", strtotime($t->day)) ;  ?> <span> <?php echo $tmo[0].':'.$tmo[1].'-'.$tco[0].':'.$tco[1];} ?></span> </li>
                                     <?php }else{
                                        echo '<div class="No-Time">No Time Filled by the salon</div>';?>
                                        
                                        <?php }?></ul>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="landing_right_shadow"> </div>
                </div>


            </div>
            
            <div class="tabingblock">
                <div class="tab_bg">
                    <ul class="shadetabs" id="countrytabs">
                        <li class="curve"><a class=""  href="#country1" >  Photos              </a></li>
                        <li><a  href="#country2" class=""> Reviews        </a></li>
                        <li><a  href="#country3" class="">  Offers     </a></li>
                        <li><a  href="#country4" class="">   Menu   </a></li>
                        <li><?php echo CHtml::link('Map', "#country5", array('id'=>'viewmap-'.$users->id,'class'=>'viewmap', 'onclick'=>'showmap('.$users->id.')')); ?></li>
                    </ul> </div>
                <div class="clear"> </div>                    

                <div class="tabcontent" id="country1">

                    <div class="tab_photo"> 
                        <?php if($gallery){?>
                        <ul><?php $pathh = Yii::app()->request->baseUrl.'/gallery/'.$users->username;
                                foreach($gallery as $g) { ?>
                            <li><?php $this->widget('application.extensions.fancybox.EFancyBox', array(
                                                        'target'=>'a[rel=gallery]',
                                                        'config'=>array(),
                                                                                )
                                                );?> 
                                
                                <a rel="gallery" href="<?php echo $pathh.'/'. $g->image; ?>" >  <img src="<?php echo $pathh.'/'. $g->image; ?>" width="111" height="103"> </a> </li>
                        <?php } } else { echo '<div class="No-Time">Coming Soon!</div>'; }?>    
                        </ul>
                       
                    </div>


                </div>
                <div class="tabcontent" id="country2">
                  <div class="No-Time">No Reviews !</div>
                   </div>
                <div class="tabcontent" id="country3" >
                     <?php 
                     if($deals){
                         $path = Yii::app()->request->baseUrl.'/offer/'; 
                     foreach ($deals as $deal) { ?>
                    <div class="deals">
                        <div class="image">
                            <img src="<?php echo Yii::app()->request->baseUrl.'/'.$deal->image?>">
                        </div>
                        <div class="content">
                        <div class="title"><h2><?php echo $deal->title; ?></h2></div>
                        <div class="description"><?php echo $deal->description; ?></div>
                        <div class="valid">Valid Till: <?php echo date('l jS F (d-m-Y)', strtotime($deal->valid));?></div>
                        </div>
                    </div>
                  <?php  }?>
                    <?php }else{echo '<div class="No-Time">No Offers available right now !</div>';}?>
                </div>
                
                <div class="tabcontent" id="country4" >
                    <?php 
            if($services){?>
                    <div class="mservices-wrapper">
                    <div class="merchant-services">
                    <div class="mservices" id="m-service">
                   
		<?php 
               
                foreach($categoryservice as $cat_service):?>
				<?php $cat_id	=	$cat_service->id;?>
				
				<?php $services	=	$this->getMerchantServices($users->id, $cat_id);?>
				<?php $servicecounter = 0;?>
				<?php //echo "<pre>"; print_r($services);die;?>
				<?php if($services):?>
				<div class="category-service"><?php echo $cat_service->title?></div>
				<ul>
				<?php foreach($services as $service):?>
						<li>
								<div class="service-label">
										<span class="service"><?php echo $service->name?></span>
										<span class="service-detail">
												<?php
												if($service->duration >= 60)
												{
														$duration = ($service->duration / 60). ' hrs';
												}
												else
												{
														$duration = $service->duration. ' mins';
												}
												?>
												<?php echo $duration.' / Rs. '.$service->price;?>
										</span>
										<?php $label = $service->name.' ('.$service->duration.') Rs '.$service->price;?>
										<?php //echo $label;?>
								</div>
								
								<div class="clear"></div>
						</li>
						<?php $servicecounter++;?>
				<?php endforeach;?>
				</ul>
				<?php endif;?>
		<?php endforeach;?>
			</div>	
		</div>
		<?php //endif;?>
		</div>
            <?php 
          
           }else{ echo '<div class="No-Time">No Services Registered!</div>';} ?>
                </table>
             
                </div>
                <div class="tabcontent" id="country5"  >
                   <?php $this->widget('RVMap');?>
               
            </div>

            </div>
<script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8cvb2pD-gdpMCnEJpTQ-dsVm61Aftjc8&sensor=false"> 
</script>
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
    
   
    jQuery("#date").val('Date');
    jQuery("#msgbox").val('Comment/Remark');
    jQuery("#contacts").dialog("open");
}
</script>
<script>
$(document).ready(function(){
  
$( ".tabingblock" ).tabs({
       
	fx: { opacity: 'toggle' },
        selected: 'country1',
	select: function(event, ui) {
		jQuery(this).css('height', jQuery(this).height());
		jQuery(this).css('overflow', 'hidden');
	},
	show: function(event, ui) {
		jQuery(this).css('height', 'auto');
		jQuery(this).css('overflow', 'visible');
	}
});

// $('.tabingblock').removeClass('ui-tabs'); 
// $('.tabingblock').removeClass('ui-tabs-nav');  
// $('.tabingblock').removeClass('ui-tabs-panel'); 
// $('.tabingblock').removeClass('ui-widget-header');
 $('tabingblock').removeClass('ui-widget ui-widget-content ui-corner-all');
  $('.tabcontent').removeClass('ui-tabs-panel ui-widget-content ui-corner-bottom');
 $('#countrytabs').removeClass('shadetabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all').addClass('shadetabs');
 $('#countrytabs li').removeClass('curve ui-state-default ui-corner-top ui-tabs-active ui-state-active').addClass('curve ');
 $('#countrytabs li').removeClass('curve ui-state-hover').addClass('curve');
 return false;
});
</script>