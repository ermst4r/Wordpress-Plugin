<style>
	
	.css3button {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #ffffff;
	padding: 12px 12px;
	margin-top:20px;
	
margin-bottom:40px;
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

<?php
$product = getProduct($_GET['product']);
$compared_products = array();
$is_compare_product = false;
if($product->label_id == HOTELS) {
	$compared_products= getComparedProducts($product->product_name,$product->label_id);
} else {
	$compared_products= getComparedProducts($product->ean,$product->label_id);
}



if(count($compared_products) >1) {
	$is_compare_product = true;
}
$prim_id = $product->prim_id;
$additional = $puck->getproduct($product->prim_id,0);

?>

    	 <h1 > <a href="<?php echo $product->producturl;?>" style="color:#483224;" target="_blank" title="<?php echo $product->product_name;?>"> <?php echo StringLength($product->product_name);?></a></h1>
    	 
    	<div class="left">
                                <div class="picture">
                                	
                                	<?php
          		$imagearray = getimagesize($product->imageurl);
									$breedte = $imagearray[0];
									$hoogte = $imagearray[1];?>
						<?php if($breedte > 400) : ?>
							 <img src="<?php echo $product->imageurl;?>" title="<?php echo StringLength($product->product_name);?>" alt="<?php echo StringLength($product->product_name);?>" id="image" height="350" width="300" style="padding:10px;" /></a>
							<?php else : ?>
							 <img src="<?php echo $product->imageurl;?>" title="<?php echo StringLength($product->product_name);?>" alt="<?php echo StringLength($product->product_name);?>" id="image" height="350" /></a>
							<?php endif;?>
                                   
                                                
                                                                       <div class="hidden">
                                       									
                                    </div>
                                    <div class="thumbs">
                                         <?php if(isset($additional->$prim_id->additionalimage)): ?>
							          <div class="image-additional"> 
							          	<?php foreach($additional->$prim_id->additionalimage as $values):?>
							          	<a href="<?php echo $values;?>" target="_blank"> 
							          		<img src="<?php echo $values;?>" width="62" title="#" alt="#" /></a> 
							          		<?php endforeach;?>
							          		<?php endif;?>
                                                                              </div>
                                </div>
                            </div>
                            <div class="right">
                               <BR>
                                   <div class="content more"> 
                           <?php echo $product->description;?>                           </div>
<br class="clear"/>
    
 <?php if($is_compare_product == true ): ?>
          	 <img src="<?php echo HOST_URL;?>upload/merchanticons/<?php echo $compared_products[0]->webshop_logo;?>" height="50" width="50">
          <?php else  : ?>
          	<?php if(isset($additional->$prim_id->webshop_logo)): ?>
	  		 <img src="<?php echo HOST_URL;?>upload/merchanticons/<?php echo $additional->$prim_id->webshop_logo;?>" height="50" width="50">
	  		 <?php endif;?>
  		<?php endif;?>

<BR><span class="bold">
 	                                   
    <span style="color:red; font-weight: bold;"> 
    	
    	<?php if($is_compare_product == true): ?>
          		  	&euro; <?php echo $compared_products[0]->price;?>
      		<?php else : ?>
      			  	&euro; <?php echo $product->price;?>
      		<?php endif;?>
   </span>
   <BR><BR><BR>
   	<a href="<?php echo $product->producturl;?>" target="_blank" class="css3button" style="color:white;text-decoration: none;" rel="nofollow"> More information </a>
   	<BR><BR><BR><BR>
   	<?php
   	if($is_compare_product == true): ?>
   
      		<div id="tab-shops" class="tab-content">
      			<B> Vergeleken bij de volgende webshops  </B><BR><BR>
      			<table cellpadding="5" width="200"> 
      	  	<?php foreach($compared_products as $values):
				if($values->price !='0.00'):
			 ?>
      	  		<tr>
      	  			
      	  			<td> <img src="<?php echo HOST_URL;?>upload/merchanticons/<?php echo $values->webshop_logo;?>" height="32" width="32"> </td>
      	  			<td>  <a href="<?php echo $values->producturl;?>" rel="no_follow" target="_blank">  <B style="text-decoration: underline;color:red">&euro;<?php echo $values->price;?></B> </a>  </td>
      	  		</tr>
      	  	
      	  			<?php endif;?>
      	  		<?php endforeach;?>
      	  		</table>
      	  </div>
      		
   	<?php endif;?>
   	<h1 style="color:#483224;">Specifications</h1>
 
	<table> 
	 <?php

         foreach($additional->$prim_id->specs as $key=>$values): ?>
        	<?php echo "<tr> <th colspan=2> ".$key."</th></tr>";
		
        		foreach($values as $attributes) {
        			echo "<tr>";
        			$attributes = array_unique($attributes);
        			foreach($attributes as $vals) {
        				echo "<td>".$vals."</td>";
        			}
        			
        		}
        	echo "</tr>";
			 endforeach;
			?>
			
			</table>
                                     
    
    <br><br>