<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/invoice.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/invoice_print.css" media="print" />

<!--[if IE ]>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome-ie7.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/invoice_ie.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.PrintArea.js"></script>
<?php 
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
//  $cs->registerScriptFile($baseUrl.'/js/jquery.PrintArea.js',CClientScript::POS_HEAD);
  $cs->registerCssFile($baseUrl.'/css/invoice_print.css', 'print');?>
<?php //Yii::app()->clientScript->registerScriptFile('jquery.PrintArea.js'); ?>
<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl. '/css/invoice_print.css', 'print'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/invoice_print.css" media="print" />
<![endif]-->
  <!-- Le fav and touch icons -->
  <input type="hidden" class="hidden_pro_id">
<div class="popup">
	<!--<h1>Invoice</h1>-->
    <!--<div class="heading-img"><img src="images/heading-img.png" alt="" /></div>-->
        
    <div class="popup-content">
    	<form>
<!--        	<input type="text" class="textbox" />-->
<!--                <input type="button" value="Add" class="add" />-->
        
   <?php $products = 'e. g. shampoo';
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'attribute' => 'products',
            'model' => $order,
            'sourceUrl' => array('appointmentbook/products'),
            'options' => array(
                'minLength' => '2',
                'select' => 'js: function(e,u){
                    var a = $("#search-products").val(u.item["id"]);
                    $(".hidden_pro_id").val(u.item["id"]);
                    $(".totbut").click(function(){
                    var price = u.item["price"];
                    var product = u.item["value"];
//                    alert(u.item["id"]);
                    //$(".itembody").after("<div><div class=\'product\'>"+product+"</div><div class=\'productprice\'>"+price+"</div><hr></div>");
                    
                    
        }); 
                    }',
                
                
                'success' => 'js:function(event,resp){
                    
                    var prices = new Array();
                    prices.push(resp)
//                    console.log(prices);
                    $(".temp").val(prices);
                }',
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
                'class' => 'textbox',
                'id' => 'search-products',
                'value' => $products,
                'onblur'=>"if(this.value==''){this.value='e. g. shampoo'}", 
                'onclick'=>"if(this.value=='e. g. shampoo'){this.value=''}"
            ),
        ));
                
//                echo $form->textField($model, 'nearby', array('size' => 40, 'maxlength' => 150, 'id' => 'search-service', 'class' => 'required service_field', 'value' => $servicenearby)); ?>

    
     <!--<input type="button" value="Add" class="add" />-->
    <input id="button" class="totbut" type="button" value="Add" >
</form>
    
<div class="itembody">
    <table width="98%" border="0" cellspacing="5" cellpadding="0" id="dynatable">
         
    <?php
        $arrprice = array();
        foreach($orderdetails as $detail)
		{
		    $bookedorders['duration'] += $detail->service_duration;
		    $servicesid = (int)$detail->service_id;
                    $duration = $detail->service_duration.' mins';
		    $services = $detail->service_name;
                    $order_id=$detail->customer_order_id;
		    $price = '<span class="WebRupee">Rs. </span><span class="priced">'.$detail->service_price.'</span>';
                    $rate = $detail->service_price;
                    $arrprice[] = $detail->service_price;?>
                     <tr class="dynamic">
                    <td width="70%" class="border-btm" id="<?php echo $servicesid; ?>"><?php echo $services;?>
                    <td width="10%" class="border-btm" id="<?php echo $servicesid; ?>"><input id="<?php echo $servicesid; ?>" class="multi" value="1" name="multi" size="3" maxlength="3" >
                    <td width="15%" class="border-btm"><?php echo $price; ?></td>
                    <td width="5%">
                        <input id="<?php echo $services ;?>" name="<?php echo $rate; ?>" class="remove" type="button">
                    </td>
                    </tr>
                   <?php }?>
                    <?php  $subtotal = array_sum($arrprice); ?>
                    <tr class="dynamic">
                    </tr>
                    <tr>
                     <td width="70%" class="border-btm">Taxes: <span class="taxspan"></span><input id="tax" class="tax" value="<?php echo $usersettings->tax ;?>" name="taxation" size="3" maxlength="6" >%</td>
                     <td></td>
                     <td width="10%"class="border-btm"><label class="taxprice"><span class="WebRupee">Rs. </span>0</label></td>
                     
                   </tr>
                    <tr>
                        <td class="border-btm">Vat:  <span class="vatspan" ></span><input id="vat" class="vat" value="<?php echo $usersettings->vat ;?>" name="vatation" size="3" maxlength="6" >%</td>
                        <td></td>
                        <td class="border-btm"><label class="vatprice"><span class="WebRupee">Rs. </span>0</label></td>
                      
                    </tr>
                    <tr>
                     <td class="border-btm">Total</td>
                     <td></td>
                     <td class="border-btm"><input id="total" class="total" value="<?php echo $subtotal; ?>" disabled =" disabled" size="4" type="hidden">
                         <label class="finalrate"><span class="WebRupee">Rs. </span><?php echo $subtotal; ?></label>
                     </td>
                     
                   </tr>
        </table>
</div>

<input type="hidden" id = "temp" class="temp" name="temp" value = "0">
<input type="hidden" id = "temppro" class="temppro" name="temppro" value = "0"> 
<input type="hidden" id = "temppro" class="temp_pro_id" name="temp_pro_id" value = "0"> 

  
<!--   <input id="button" class="done" type="button" value="Done">-->
<div class="lowerbutton">
        <div class="print_button" style="display:none;">
        <a href="#" class="print"><i class="icon-print"></i> Print</a>
        </div>
        <a href="javascript:void(0);" id="cancel" class="cancel"><i class="icon-remove-sign"></i> Close</a>
        <a href="#" class="done"><i class="icon-ok-sign"></i> Done</a>
</div>
</div>
        
       
        
</div>
  <br>
 <div class="loyal gradient" >
     <div class ="customer_name border-btm "><center>Thank you for your precious time with us Mr./Mrs./Ms.- <strong><?php echo $customer->name;?></strong> </center></div>
     
     <div class="contact_number border-btm"><center>The contact Number of this customer is- <strong><?php echo $customer->mobile_no; ?></strong></center></div>
            <div class="life">Lifetime orders count of this customer is 
                <?php $i=0;foreach ($loyal  as $cust_ord){$i++;} echo $i;?>
            and total Paid amount is <span class="WebRupee">Rs. </span>
             <strong><?php $k=0;if($cash){foreach ($cash  as $amount){$k+= $amount->service_price;}} echo $k;?></strong>
             </div>
        </div>


<div id="ajaxloaders" style="display:none;margin-top: -135px;position: relative;"><center><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ajax-loader.gif" /></center></div>
<script>
    $(document).ready(function() 
    {
        
     /**
      *Global Variables and Array
      */
//     $(".tax, .vat, .multi").attr('maxlength','6');
     
     var total =0;
     var pricearr = [<?php echo '"'.implode('","', $arrprice).'"' ?>];
     var sumarr = 0;
     jQuery(".appbook").css("opacity","0.5");
        $('.totbut').click(function(){
           var found = 0; 
           var checked= $.trim($('#search-products').val());
//            console.log(checked);
           $('#dynatable .dynamic').find('td').each(function(){
                  if($.trim($(this).text()) == checked){ 
                     found = true; 
                 }
             });
            
           if(found == false)
            {
            var subtotal = getPrice();
            if(subtotal){
                pricearr.push(subtotal);
                sumarr =  eval(pricearr.join("+"));
                $('#total').val(sumarr);
                $('.finalrate').html('<span class="WebRupee">Rs. </span>'+sumarr);
            }else{ 
                alert("Please Enter a Valid Product or Service") }
            }else{
                alert("Already exist in the current list.");}
                subtotal = 0;
    });
        $(document).on('change', '.multi', function(){
        if($(this).val()=='' && $(this).val()== '0' ){alert('please enter minimum 1.'); return false;}
        if(!isNaN ($(this).val()) && $(this).val()!='' && $(this).val()!= 0){
            var pro_id= $(this).attr('id');
        var multiplier = $(this).val();
        
        var fullprice= multiples(pro_id,multiplier);
        var remprice= $(this).parent().next().find('.priced').html();
        var whole = 0;
        var index= pricearr.indexOf(remprice);
        if(index !== -1)
        {
          pricearr[index] = ''+fullprice+''; 
        }
//        console.log(pricearr);
        if(fullprice){
            $(this).parent().next().find('.priced').html(fullprice);
            whole = eval(pricearr.join("+"))
             $('#total').val(whole);
             $('.finalrate').html('<span class="WebRupee">Rs. </span>'+whole);
            }
        } 
        
      });
     /**
      *Multiplies the product price with the input values.
      */
      function multiples(id,val){
      $('.popup').css("opacity","0.5");
      $("#ajaxloaders").show().css('z-index','9999 !important');
      var multiprice= 0;
      if($('.multi').val()!=0){
      $.ajax({
      url: '<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getmultipro',     //controller action url
      type: "POST",
      data: {pro_id: id},
      async: false,
                    success:function(resp){  
                        $('.popup').css("opacity","1");
                        $('#ajaxloaders').hide();
                                              var obj=0;
                                              obj =	jQuery.parseJSON(resp);
                                             
                                              if(obj.stock){
                                                 
                                                  if(checkBacklog(obj.id,val)){
                                                      
                                                  multiprice  = obj.price * +val;}else {return false;}
                                              }
                                              else{ multiprice  = obj.price * +val; } 
                      }, 
                    error:function(resp){ console.log(resp); }           
              });
        return multiprice;
        }
     }
     function checkBacklog(id,value){
     $('.popup').css("opacity","0.5");
     $("#ajaxloaders").show().css('z-index','9999 !important');
     var resp = 0;
            $.ajax({
            url: '<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/checkexistingStock',     //controller action url
            type: "POST",
            data: {pro_id: id,quantity:value},
            async: false,
           
                          success:function(response){
                              $('.popup').css("opacity","1");
                              $("#ajaxloaders").hide();
                              var obj=0;
                                    obj =	jQuery.parseJSON(response);
//                                    console.log(obj);
                              if(obj.final_result == 'true'){
                                  resp = 'true';
                                  $('.done').css('display','inline-block');
                              }else{
                                  var quantity= obj.stock;
                                  var name = obj.value;
                                  alert(name+' available stock is '+quantity); 
                                  resp = 'false';
                                  $('.done').css('display','none');
                                  return false;
                              }
                             }, 
                          error:function(resp){ alert("Internal Server Error 500!"); console.log(resp); }           
                    });
                    return resp ;
           }
     
      /**
      *Get the price and product name from the database uniquely identified by the merchant only.
      */
      function getPrice(){
      $('.popup').css("opacity","0.5");
      $("#ajaxloaders").show().css('z-index','9999 !important');
      var product = $('#search-products').val();
      var product_id= $('.hidden_pro_id').val();;
      var subprice = <?php echo $subtotal; ?>;
      var totalq = 0;
      var prices = 0;
      $.ajax({
      url: '<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getproducts',     //controller action url
      type: "POST",
      data: {product: product,product_id:product_id,subprice:subprice},
      async: false,
      
            success:function(resp){
                                    $('.popup').css("opacity","1");
                                    $("#ajaxloaders").hide();
                                    if ($('.dynamic').length <= 2) {
                                        $('.done').css('display','inline-block');
                                    }
                                    var obj=0;
                                    obj =	jQuery.parseJSON(resp);
                                    // console.log(pricearr);
                                    if(obj){
                                        var product_id= obj.id;     

                                        if(obj.stock){
                                            if(checkStock(product_id)=='true'){

                                                prices = obj.price;
                                                //console.log(prices);

                                                $('.temp').val(obj.price);
                                                $('.temp_pro_id').val(obj.id);
                                                $('#dynatable tr:first').after('<tr class="dynamic"><td class="border-btm" id="'+obj.id+'">'+product+'</td><td class="border-btm" id="'+obj.id+'"><input id="'+obj.id+'" class="multi" value="1" name="multi" size="3" maxlength="3" ></td><td class="border-btm" width="15%"><span class="WebRupee">Rs. </span><span class="priced">'+obj.price+'</span></td><td><input id="'+product+'" name="'+obj.price+'" class="remove" type="button"></td></tr>');
                                                                              }else{ return false;}
                                                      }else{ 

                                                              prices = obj.price;

                                                              $('.temp').val(obj.price);
                                                              $('.temp_pro_id').val(obj.id);
                                                              $('#dynatable tr:first').after('<tr class="dynamic"><td class="border-btm" id="'+obj.id+'">'+product+'</td><td class="border-btm" id="'+obj.id+'"><input id="'+obj.id+'" class="multi" value="1" name="multi" size="3" maxlength="3"></td><td class="border-btm" width="15%"><span class="WebRupee">Rs. </span><span class="priced">'+obj.price+'</span></td><td><input id="'+product+'" name="'+obj.price+'" class="remove" type="button"></td></tr>');
                                                           } 
                                              }
                                          }, 
            error:function(resp){ console.log(resp);}           
                });
      return prices;
      }
      /**
      *Check the live stock and return boolean true / false.
      */
      
            function checkStock(id){
            $('.popup').css("opacity","0.5");
            $("#ajaxloaders").show().css('z-index','9999 !important');
                          var resp = 0;
                          $.ajax({
                          url: '<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/stockcheck',
                          type:'POST',
                          data:{id:id},
                          async: false,
                          success:function(response){
                              $('.popup').css("opacity","1");
                              $("#ajaxloaders").hide();
                              if(response=='true'){resp = 'true';}else{alert('product is out of stock!');resp = 'false';return false;}
                          },
                          error:function(response){console.log(response);}
                          });
                          return resp;
            }               
    /**
     *Remove button click functionality to remove the existing product or service from the cart.
     */   
            $(document).on('click', '.remove', function(){ 
            var ele = $(this).attr('id');
            var remprice = $(this).parent().prev().find('.priced').html();
            var newprice = 0;
            var index = pricearr.indexOf(remprice);
            pricearr.splice(index, 1);
            newprice = removePro(remprice);
            console.log(pricearr);
            $('#total').val(newprice);
            $('.finalrate').html('<span class="WebRupee">Rs. </span>'+newprice);
            $(this).parent().parent().remove();
            if ($('.dynamic').length <= 1) {
                  alert("current invoice is Empty! PLease add some items.");
                  $('.finalrate').html('<span class="WebRupee">Rs. </span>'+0);
                  $('.done').css('display','none');
                  $('#total').val(0);
              }
            });
    /**
     *Done button click functionality to complete the order.
     */       
            $(document).on('click', '.done', function(e){
                doneconfirm();
                return false;
            });
    /**
     *On Done Button click.It disables the all button so after that no changes can be made.
     */        
        function doneconfirm(){
        var serials = [];
        var multipliers = [];
        var orderid=<?php echo $order_id; ?>;
//         var didConfirm = confirm("Are you sure? After confirmation, you cant edit the invoice.");
//          if (didConfirm == true){
        if(!isNaN ($('.tax').val()) && !isNaN ($('.vat').val())){
            $('tr.dynamic td:first-child').each(function() { serials.push($(this).attr('id'));});
            if(!isNaN ($('.multi').val())  ){
                $('tr.dynamic td:nth-child(2)').each(function() {
                    multipliers.push($(this).find('.multi').val());
                });
            }
            var multipliers = multipliers.join(',');
            var serials = serials.join(',');
            var addorder= $('.temp_pro_id').val();
         
            $.ajax({
                url: '<?php echo Yii::app()->request->baseUrl; ?>/users/confirmbill',     //controller action url to confirm the onvoice and return the total price
                type: "POST",
                data: {orderid:orderid,addorder:addorder,serials:serials},
                async: false,
                success:function(resp){
                    var obj = 0;
                    obj =	jQuery.parseJSON(resp);
//                    console.log(obj);
//                  resetgrid();
                },error:function(resp){console.log(resp);}
            });
            $.ajax({
                url: '<?php echo Yii::app()->request->baseUrl; ?>/users/stock',     //controller action url to Subtract the stock quantity if invoice contains some products
                type: "POST",
                data: {orderid:orderid,addorder:addorder,serials:serials,multipliers:multipliers},
                async: false,
                success:function(resp){
                    var obj = 0;
//                    obj =	jQuery.parseJSON(resp);
//                    console.log(obj);
                },error:function(resp){console.log(resp);}
            });
            
            if($('.tax').val() != 0){
                var taxvals = $('input[name=taxation]').val();
                var vatvals = $('input[name=vatation]').val();
                $('span.taxspan').html(taxvals).css('display','inline-block');
                $('span.vatspan').html(vatvals).css('display','inline-block');;
                $('#tax,#vat').css('display','none');
                $('.done').css('display','none');
//              $('.tax').replaceWith(' < input type="text" value="new_value_here" />');
                var newPrice = tax();
                $('#total').val(newPrice);
                $('.finalrate').html('<span class="WebRupee">Rs. </span>'+newPrice);
                $(this).attr("disabled", true);
                $('.totbut').attr("disabled", true);
                $('.remove').attr("disabled", true); 
                $('.multi').attr("disabled", true);
              }
            else{   $('.done').css('display','none');
                $(this).attr("disabled", true);
                $('.totbut').attr("disabled", true);
                $('.remove').attr("disabled", true);
                $('.multi').attr("disabled", true);
            }
        }else{alert('Please enter proper tax or vat value!');
            $('.print_button').css('display','none');
            return false;}
//            }else{}
    }
    /**
     *Round the value to the nearest integer.
     */ 
        function rounded(number){ 
                return Math.floor(Number(number)*100)/100; 
        };     
                
     /**
      *Remove the Product price from the list and return the subtracted price.
      */           
        function removePro(price){
            var total = $('#total').val();
            var newprice = 0;
            newprice = +total - +price;
        return newprice
    }
    
    /**
     *Calculate the tax value which is entered on the tax text box by the invoice generator.
     */
    function tax(){
                var tax = $('.tax').val();
                var vat = $('.vat').val();
                var aftertax = 0;
                var aftervat = 0;
                var newPrice = 0;
                var beforetax=  eval(pricearr.join("+"));
                beforetax = rounded(beforetax);
                aftertax = rounded(+beforetax * (+tax / 100));
                aftervat = rounded(+beforetax * (+vat / 100));
                aftertax = rounded(aftertax);
                aftervat = rounded(aftervat);
                newPrice = +beforetax + +aftertax + +aftervat;
                newPrice = rounded(newPrice);
                $('.taxprice').html('<span class="WebRupee">Rs. </span>'+aftertax);
                $('.vatprice').html('<span class="WebRupee">Rs. </span>'+aftervat);
                return newPrice;
                }

 $(document).on('keyup','.tax, .vat, .multi',function(e){
              s=$(this).val();
    if (!/^\d*\.?\d{0,2}$/.test(s)) $(this).val(s.substr(0,s.length-8));
    });
$(document).on('keyup','.multi',function(e){
           $('.multi').each(function(){
               m=$(this).val();
            if (!/^\d*\.?\d{0}$/.test(m)) $(this).val(m.substr(0,m.length-3));
            if (m <= 0) {
                alert("Please enter a value between 1 to 999");
                $('.popup').css("opacity","1");
                $("#ajaxloaders").hide();
                $(this).val(s.substr(0,s.length-1));
                $(this).val('1');
                $(this).focus();
                return false;
            }
           });
           
       });
       /**
        *print button click function makes a temporary stream and sends the data to print command
        **/
        $('.print').click(function() {
                       var win2;
                       //win2.document.write('<table style="width:600px;"><thead><th><td width="80%">Item</td><td width="20%">Price</td></th></thead><tbody>');
                       var style  = "<style>.WebRupee {font-family: 'WebRupee';}.printing{width:'100%';}            </style>";
                       var invoiceTable = style+'<table class="printing" width="100%"><tr><td style="width:70%">Item</td><td style="width:10%">Quantity</td><td style="width:20%">Price</td></tr>';
                       var rowData = '';
                       $('#dynatable tbody tr').each(function(i,obj){
                       var  item = $(this).find("td:first").html();

                       var  quantity = $(this).find("td:nth-child(2) input").val();
                       if(quantity == undefined){quantity = ' ';}
                        var price = $(this).find("td:nth-child(3)").html();
                         if(item!= null && price!=null){
                               rowData += '<tr>';
                               rowData += '<td>'+item+'</td><td>'+quantity+'</td><td>'+price+'</td>';
                               rowData += '</tr>';
                         }
                       });
                       invoiceTable += rowData + '</table>';

                       win2 = window.open('', 'Invoice', 'width=600,height=500');
                       win2.document.write(invoiceTable);

                       if(win2.print()){win2.close();}

       //    		return true;
                       //$(".itembody").printArea();
           });
}); 

</script>