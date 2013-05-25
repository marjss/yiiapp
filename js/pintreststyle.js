/* Author: Sudhanshu
 * Author Url: http://deemtech.com
 * About: Pintrest style JScript to load the Isotope results in list and grid with resized content 
 * Script Ver.: 1.0 beta
 */

//         jQuery.noConflict();
            jQuery(document).ready(function($) {
                
                
 ///----------List Click Function-----------------//
            $(".layouts .list").click(function () {
             jQuery(function() {
    var jQuerycontainer = jQuery('.items');
//      jQuerycontainer.addClass('clickable');
        jQuerycontainer.find('.view ').each(function() {
        jQuery(this).addClass('large');
     });
     jQuerycontainer.isotope({
         layoutMode: 'straightDown',
        itemSelector: '.view',
        straightDown: {
      columnWidth: 100
                        } 
    });
    $(document).ajaxComplete(function() {
        jQuery(".layouts .list").click();
    });
//    jQuerycontainer.isotope('reLayout');
    jQuerycontainer.find('.view').removeClass('small');
        jQuery(this).addClass('large');});
});
                            
                
///-----------------Grid Click Function---------------///   
$(".layouts .grid").click(function () {
jQuery(function() {
    var jQuerycontainer = jQuery('.items');
//    jQuerycontainer.addClass('clickable');
     jQuerycontainer.find('.view ').each(function() {
         jQuery(this).addClass('small');
     });
     jQuerycontainer.isotope({ 
          layoutMode: 'masonry',
        itemSelector: '.view',
        
        masonry: {
            columnWidth: 100
//            infiniteScroll:false,
//            appendClass: 'small'
//            columnHeight:100
        }
        
       
    });
    $(document).ajaxComplete(function() {
        jQuery(".layouts .grid").click();
    });
    jQuerycontainer.find('.view').removeClass('large');
        jQuery(this).addClass('small');
        jQuerycontainer.isotope('reLayout');
    
}); 
    });
                            });
               
