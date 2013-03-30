 <?php //echo Yii::app()->session['layout'];  ?>
<script type="text/javascript"> 
jQuery(document).ready(function($) 
{
$(".list").click(function(){
    $('.grid').removeClass('opac');
   $('.list').addClass('opac');
});
$(".grid").click(function(){
    $('.list').removeClass('opac');
   $('.grid').addClass('opac');
})
    
//----------List Click Function-----------------//
$(".layouts .list").click(function () {
    $('.bookbutton').css('visibility','visible');
     <?php Yii::app()->session['layout']='straightDown';?>
            jQuery(function() {
                var jQuerycontainer = jQuery('.items');
                jQuerycontainer.find('.view ').each(function() {
                    jQuery(this).addClass('large');
                });
                jQuerycontainer.isotope({
                    layoutMode: '<?php echo Yii::app()->session['layout'];?>',
                    itemSelector: '.view',
                    straightDown: {
                        columnWidth: 50
                    } 
                });
                $(document).ajaxComplete(function() {
                    jQuery(".layouts .list").click();
                });
                jQuerycontainer.find('.view').removeClass('small');
                jQuery(this).addClass('large');});
       return false; });
        
        
//-----------------Grid Click Function---------------//   
        $(".layouts .grid").click(function () {
        $('.bookbutton').css('visibility','hidden');
        
       <?php Yii::app()->session['layout']='masonry';?>
            jQuery(function() {
                var jQuerycontainer = jQuery('.items');
                jQuerycontainer.find('.view ').each(function() {
                    jQuery(this).addClass('small');
                });
                jQuerycontainer.isotope({ 
                    layoutMode: '<?php echo Yii::app()->session['layout'];?>',
                    itemSelector: '.view',
                    
                    masonry: {
                        columnWidth: 50
                    }
                });
                $(document).ajaxComplete(function() {
                   jQuery(".layouts .grid").click();
                });
                jQuerycontainer.find('.view').removeClass('large');
                jQuery(this).addClass('small');
                jQuerycontainer.isotope('reLayout');
                
            }); 
     return false;   });
      });
</script>

<div class="search-page">
<h1 class="heading">Find and Book beauty wellness professionals near you</h1>
     <?php //$layout= 'width:500px'; ?>
     <?php $this->widget('Salonssearch'); ?>
    <div class="layouts">
        <div class="btn-group" data-toggle="buttons-radio" >
  <button type="button" class="list" data-toggle="button">
   <input type="radio" name="is_private" value="0" />
  </button>
  <button type="button" class="grid" data-toggle="button">
    
    <input type="radio" name="is_private" value="1" />
  </button>
             
</div>
</div>
<!--     <div class="list"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl."/images/list-icon.png";?>" /></a></div>
      <div class="grid"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl."/images/grid-icon.png";?>" /></a></div>-->
    </div>
<?php   
?>
    <div class="searchsalon-results">
        <?php $this->widget('ext.isotope.Isotope',array(
            'dataProvider'=>$model->newsearchsalons(),
            'itemView'=>'_searchsalon',
            'template' => '{items}{pager}',
            'itemSelectorClass'=>'view',
            'options'=>array(
                'layoutMode' => Yii::app()->session['layout'],
                ), // options for the isotope jquery
           'infiniteScroll'=>true, // default to true
           'infiniteOptions'=>array(
                                    'loading' => array(
                                                 'msgText' => 'Loading More Results ...',
                                                 'finishedMsg' => 'Reached End of Page!')
                                    ),
            )); ?>
       <div class="ads">
            <a href="http://affiliates.icubeswire.com/z/3747/iwire635/">
                <img src="http://affiliates.icubeswire.com/42/635/3747/" alt="weekend offer" border="0" width="250">
            </a>
            <a href="http://www.officeyes.com/" title="Officeyes">
                <img src="http://img.directtrack.com/icubes/3465.gif" width="250" alt="" border="0">
            </a>
           <a href="http://linksredirect.com?pub_id=123CL104&amp;url=http%3A//www.freecultr.com/" title="Freecultr">
                <img src="http://img.directtrack.com/icubes/3405.gif" width="250" alt="" border="0">
            </a>
            <a href="http://www.slassy.com" title="Slassy">
                <img src="http://img.directtrack.com/icubes/3483.gif" width="250" alt="" border="0">
            </a>
        </div>
         <div class="clear"></div> 
         
    </div>

</div>

<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
<script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8cvb2pD-gdpMCnEJpTQ-dsVm61Aftjc8&sensor=false"> </script>
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
