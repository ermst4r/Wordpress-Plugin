
	<style>
	.css3button {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #ffffff;
	padding: 12px 12px;
	margin-top:26px;
	
	color:white;
	background: -moz-linear-gradient(
		top,
		#57b907 0%,
		#438e05);
	background: -webkit-gradient(
		linear, left top, left bottom,
		from(#57b907),
		to(#438e05));
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	border: 1px solid #489906;
	-moz-box-shadow:
		0px 2px 5px rgba(000,000,000,0.4),
		inset 0px 0px 0px rgba(255,255,255,0.7);
	-webkit-box-shadow:
		0px 2px 5px rgba(000,000,000,0.4),
		inset 0px 0px 0px rgba(255,255,255,0.7);
	box-shadow:
		0px 2px 5px rgba(000,000,000,0.4),
		inset 0px 0px 0px rgba(255,255,255,0.7);
	text-shadow:
		0px -1px 0px rgba(000,000,000,0.4),
		0px 1px 0px rgba(255,255,255,0.3);
}
</style>

 	<script>
	var formData = new Array();
	var finalData = '';
	var raw_price = '';
	var firstload='';
	<?php if(isset($_GET['start_price'])): ?>
	var price = '&p=<?php echo (isset($_GET['start_price']) ? $_GET['start_price'] : 0);?>;<?php echo (isset($_GET['end_price']) ? $_GET['end_price'] : 1000);?>&';
	<?php else : ?>
	var price = '';
	<?php endif;?>
	var click_checkbox_value = '';
	// Run the script on DOM ready:
	$(function(){
		// load
			$.ajax({
			context: document.body,
			type: "POST",
			data: "i=<?php echo $i;?>&action=docall&f=<?php echo $feed_id;?>&w=<?php echo $website_id;?>&s_id=<?php echo $s_id;?>&firstload=y",
	     	url: "/wp-admin/admin-ajax.php",
				beforeSend: function (data) {  
					//$(".pagination").hide();
                     $("#loader").show();
                },
		        success: function (data) {       
		        	if(data=="0") { 
		        	 	alert("please reload restart your browser to view the results");	
		        	 }
		        	$("#loader").hide();
		        	//$(".pagination").hide();
		            $(".product-grid").html('');
    				$(".product-grid").html(data);
    				//document.documentElement.scrollTop = 0; 
		        }
			});
			
			
		$('.checkbox').click(function() {
			click_checkbox_value = $(this).val();
			finalData = '';
			if(this.checked==true) { 
				if(formData.indexOf(click_checkbox_value) == -1) { 
					formData[$(".checkbox:checked").length-1]= click_checkbox_value;
				}
			} else { 
				i = formData.indexOf(click_checkbox_value);
				finalData+= '&delete='+click_checkbox_value+"&";
				formData.splice(i,1);
			}

			for(x=0; x<formData.length; x++)
			{
				finalData += "a_id[]="+formData[x]+"&";
				
			}
			if(formData.length == 0 ) { 
				firstload += "&firstload=y";   
			}
			finalData = finalData.substring(0,finalData.length-1);
    		$.ajax({
			context: document.body,
			type: "POST",
			data: price+finalData+firstload+"&i=<?php echo $i;?>&action=docall&f=<?php echo $feed_id;?>&w=<?php echo $website_id;?>&s_id=<?php echo $s_id;?>", 
	     	url: "/wp-admin/admin-ajax.php",
				beforeSend: function (data) {  
                    $("#loader").show();
                },
		        success: function (data) {       
		        	 if(data=="0") { 
		        	 	alert("please reload restart your browser to view the results");	
		        	 }
		        	 
		        	$("#loader").hide();
		        	//$(".pagination").hide();
		            $(".product-grid").html('');
    				$(".product-grid").html(data);
    				//document.documentElement.scrollTop = 0; 
		        }
			});
    	});
    	
    	// price slider
		jQuery("#Slider1").slider({ from: 0, to: 1000, step: 4, smooth: true, round: 0, dimension: "&nbsp;&euro;", skin: "plastic" 
         ,callback: function( value ){
           	raw_price = value;
           	price = "&p="+value+"&";
         	$.ajax({
			context: document.body,
			type: "POST",
			cache:true,
			url: "/wp-admin/admin-ajax.php",
			action:'my_ajax', 
	        data: price+finalData+"&i=<?php echo $i;?>&f=<?php echo $feed_id;?>&action=docall&w=<?php echo $website_id;?>&s_id=<?php echo $s_id;?>",
	        beforeSend: function (data) {
	        			//$(".pagination").hide();
                       $("#loader").show();
                },
	           success: function (data) {
	           		$("#loader").hide();
	           		//$(".pagination").hide();
		           $(".product-grid").html('');
    			   $(".product-grid").html(data);
		        }
	        
	        });
         		
		}
      }
    );
		
	});
	</script>	