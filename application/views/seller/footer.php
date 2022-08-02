
<!--Footer wrapper start-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">&copy; 2019 Iking.in. All Rights Reserved.</div>
    </div>
  </div>
</footer>
<!--Footer wrapper end-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<?php /*?><script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script><?php */?>
<script src="<?php echo base_url(); ?>sellercss/assets/js/bootstrap.js"></script>
<?php /*?><script type="text/javascript" src="<?php echo base_url();?>assets/plugins/date-time-picker/js/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/date-time-picker/js/bootstrap-datetimepicker.min.js"></script><?php */?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>sellercss/assets/multiselct-cs-js/prettify.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>sellercss/assets/multiselct-cs-js/jquery.multiselect.js"></script>
<script src="<?php echo base_url(); ?>sellercss/assets/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
$(function(){
	$("#attr_id").multiselect();
	    $('#menu1').change(function(){
		  var keyword = $('#menu1').val();	
						
				$.ajax({
					url: "<?php echo base_url(); ?>admin/choose_category",
					async: false,
					type: "POST", 
					data: {term:keyword},
					dataType: "html",
					success: function(data) {
					$('#category').html(data);
					//alert(data);
				    }
				})
			});
			
			
			$('#category').change(function(){
				var keyword = $('#category').val();
				$.ajax({
					url: "<?php echo base_url(); ?>admin/choose_subcategory",
					async: false,
					type: "POST", 
					data: {term:keyword},
					dataType: "html",
					success: function(data) {
					$('#subcategory').html(data);
					//alert(data);
				    }
				})
			});
			
			$("#tags").autocomplete({
									
			          source: function(request, response) 
					  {
	  	                $.ajax({
						url: "<?php echo base_url(); ?>seller/auto-product-list",
						data: { term: $('#tags').val()},
						dataType: "json",
						type: "POST",
						success: function(data)
						{
							response(data);			
						}
					   });
					},
					select: function( event, ui ) 
					{
						$('#product_id').val(ui.item.lable);
					}
				});
			
			$("#m_product").click(function(){
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>seller/filter-manage-product",
				data:{product_id:$("#product_id").val(),status:$("#status").val()},
				success: function(response){
					$("#result").html(response);
				}
			});
		});

			$("#v_order").click(function(){
				var formdata = $("#target").serialize();
				$.ajax({
					type:"POST",
					url:"<?php echo base_url(); ?>seller/filter-view-orders",
					data:formdata,
					success: function(response){
						$("#result").html(response);
					}
				});
			});

			$('#category').change(function(){
				var keyword2 = $('#menu1').val();	
				var keyword = $('#category').val();
				$.ajax({
					url: "<?php echo base_url(); ?>seller/choose-color-size",
					async: false,
					type: "POST", 
					data: {menu_id:keyword2,cat_id:keyword},
					dataType: "html",
					success: function(data) {
					$('#colorsize').html(data);
					
				    }
				})
			});
			
			$('#subcategory').change(function(){
				var keyword = $('#subcategory').val();
				$.ajax({
					url: "<?php echo base_url(); ?>admin/choose_attribute",
					async: false,
					type: "POST", 
					data: {menu_id:$("#menu1").val(),cat_id:$("#category").val(),subcat_id:$("#subcategory").val()},
					dataType: "html",
					success: function(data) {
					
					$("#atrr_result").html(data);
					//alert(data);
				    }
				})
			});
			
			
			$('#state').change(function()
			{
				var keyword = $('#state').val();				
			    $.ajax({
				url: "<?php echo base_url(); ?>seller/list_search1", 
				async: false,
				type: "POST", 
				data: {term:keyword},
				dataType: "html", 
				success: function(data) {
					$('#city').html(data);		
					//alert(data);			
			    }
			 })
			});
				
			$('#city').change(function()
			{
				var keyword = $('#city').val();
				$.ajax({
					url: "<?php echo base_url(); ?>seller/list_search2", 
					async: false,
					type: "POST", 
					data: {term:keyword},
					dataType: "html",
					success: function(data) {
				    	$('#area').html(data);
				    }
				  })
			});	
			
			$('#area').change(function()
						{
							
							var keyword = $('#area').val();
							  
							  $.ajax({
								url: "<?php echo base_url(); ?>admin/list_search4", //The url where the server req would we made.
								async: false,
								type: "POST", //The type which you want to use: GET/POST
								data: "keyword2="+keyword, //The variables which are going.
								dataType: "html", //Return data type (what we expect).
					//This is the function which will be called if ajax call is successful.
								success: function(data) {
					//data is the html of the page where the request is made.
								 //alert(data);
								 $('#market').html(data);
					             }
					          })
					});
			
			$('#bt').change(function()
			{
				var keyword = $('#bt').val();				
			    $.ajax({
				url: "<?php echo base_url(); ?>seller/cat_type", 
				async: false,
				type: "POST", 
				data: {term:keyword},
				dataType: "html", 
				success: function(data) {
					$('#chk').html(data);		
					//alert(data);			
			    }
			 })
			});
			
				
});
</script>
<!--<script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker();
            $('#datetimepicker2').datetimepicker({
           viewMode: 'years'
        });
        $('#datetimepicker3').datetimepicker({
            viewMode: 'years',
           format: 'MM/YYYY'
        });
        });
</script>
-->

<script type="text/javascript">
        	$("#product_name").bind("keyup", changed).bind("change", changed);
			function changed() {
			    $("#product_url").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
			}
			
			$("#surl").bind("keyup", changed2).bind("change", changed2);
			function changed2() {
			    $("#surl").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
			}
			function valid()
			{
				 if ($('#mem').is(':checked')) {
						
						return true;
					}
					alert('Please accept memorandum of Undertaking');
					return false;
			}
			function update_weight(id)
			{
                
				$('#modalbody').load('<?php echo base_url();?>seller/update-weight-charges/'+id,function(result){
					$('#myModal').modal({show:true});
					});
		   }
		   function update_pincode(id)
			{
                
				$('#modalbody').load('<?php echo base_url();?>seller/update-shipping-charges/'+id,function(result){
					$('#myModal').modal({show:true});
					});
		   }
 </script>
 
 <script type="text/javascript">
 var options = [];

$( '#atrr_id a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();
      
   console.log( options );
   return false;
});

 </script>
 
 <script>
$(document).ready(function() {
        $('#datePicker').datepicker({
		    format: 'yyyy-mm-dd',
			autoclose: true
		});
		
		$('#datePicker2').datepicker({
		    format: 'yyyy-mm-dd',
			autoclose: true
		});
		$("#total_order").click(function(){
			var formdata = $("#target").serialize();
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>seller/filter-total-orders",
				data:formdata,
				success: function(response){
					$("#result").html(response);
				}
			});
		});
		$("#total_sell").click(function(){
			var formdata = $("#target2").serialize();
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>seller/filter-top-selling",
				data:formdata,
				success: function(response){
					$("#result").html(response);
				}
			});
		});
		
		
});
 </script>
 
       
</body>
</html>
