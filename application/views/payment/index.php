
<body onload="onLoadSubmit()" >
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form id="frm" style="displa:none">
    <input type="hidden" name="name" id="name" placeholder="Enter your name" value="<?=$save->product?>"/><br/><br/>
    <input type="hidden" name="amt" id="amt" placeholder="Enter amt" value="<?=$save->total?>"/><br/><br/>
    <input type="hidden" name="orderid" id="orderid" placeholder="Enter amt" value="<?=$save->orderid?>"/><br/><br/>
    
   <!--<input type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()"/>-->
    
</form>
 

<script>
     
    function onLoadSubmit(){
       var name = jQuery('#name').val();
       var amt = jQuery('#amt').val();
       var orderid = $('#orderid').val();
        
         jQuery.ajax({
               url :'<?=base_url("home/updateCheckOut")?>',
               data : "amt="+amt+"&name="+name+"&orderid="+orderid,
               type : 'post',
               success:function(result){
                   var options = {
                        "key": "rzp_test_0YUFmZ3pYn2NBh", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "9gates",
                        "description": "Test Transaction",
                        "image": "https://brandhype.co.in/9gates/public/img/logo1.png",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'<?=base_url("home/paymentCheckOut")?>',
                               data:"payment_id="+response.razorpay_payment_id+"&orderid="+orderid,
                               success:function(result){
                                   window.location.href="<?=base_url()?>home/thank_you";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    };
</script>

</body>