<?php session_start();
function docall() {

$a_id = (isset($_POST['a_id']) ? $_POST['a_id'] : NULL);
$s_id = (isset($_POST['s_id']) ? $_POST['s_id'] : NULL);
$feed_id = (isset($_POST['f']) ? $_POST['f'] : NULL);
$i = (isset($_POST['i']) ? $_POST['i'] : NULL);
$website_id = (isset($_POST['w']) ? $_POST['w'] : NULL);
if(isset($_POST['p'])) {
	$price = explode(";",$_POST['p']);
}

$start_price = '';
$end_price = '';
if(isset($_POST['p'])) {
	$start_price = $price[0];
	$end_price = $price[1];
}

// return the price... only
if($a_id != NULL ) {
	$products = null;
	$vorige_element = 0;
	$new_values = array();
	$post_array = array(
	        'f' => $feed_id,
	        'i' => $i,
	        'w'=>$website_id,
	        'delete'=>(int)$_GET['delete'],
	        'a_id[]'=>end($a_id)
	       
	 );	
	foreach($a_id as $values)  {
		if($values != "undefined")
		$post_array['a_id'][] = (int) $values;
	}
	$postdata = http_build_query(
	    $post_array
	);
	$opts = array('http' =>
	    array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => $postdata
	    )
	);
	$context  = stream_context_create($opts);
	$json_decode =  json_decode(file_get_contents("http://www.twngtool.nl/whitelabel/ajax/process/type/getproducts",false,$context));
	if(count($json_decode) == 0) {
		echo "Loading..."; 
		exit; 
	}
	
	foreach($json_decode as $values) {
		$_SESSION['prim_id'][end($a_id)][] = $values;
	}
	
	// bereken de element
	if(count($a_id) == 1 ){
		$vorige_element = 0;
	} else {
		$vorige_element = count($a_id) - 2;
	}
	
	if(isset($_POST['delete'])) {
		unset($_SESSION['prim_id'][$_POST['delete']]);
		if(count($a_id)>=1) {
			foreach($json_decode as $values) {
				$_SESSION['prim_id'][end($a_id)][] = $values;
			}
		}
	}
	if(!isset($_SESSION['prim_id'][end($a_id)])) {
		foreach($json_decode as $values) {
			$_SESSION['prim_id'][end($a_id)][] = $values;
		}
	}
	
	if(isset($_SESSION['prim_id'][$a_id[$vorige_element]])) {
			foreach($_SESSION['prim_id'][$a_id[$vorige_element]] as $values) {
			if(in_array($values,$_SESSION['prim_id'][end($a_id)])) {
				$new_values[] = $values;
			}
		}
	} 
	$new_values = array_unique($new_values); 
	foreach($new_values as  $values) {
		
		$get_products  = getProductByPrimId($values,$start_price,$end_price);
		if(isset($get_products->prim_id)) {
			$products[$get_products->prim_id]['label_id'] = $get_products->label_id;
			$products[$get_products->prim_id]['productname'] = $get_products->product_name;
			$products[$get_products->prim_id]['internal_id'] = $get_products->internal_id;
			$products[$get_products->prim_id]['imageurl'] =  $get_products->imageurl;
			$products[$get_products->prim_id]['price'] =  $get_products->price;
			$products[$get_products->prim_id]['ean'] = $get_products->ean;
			
		}
	}
} else {
	if(isset($_POST['firstload'])) {
		$get_products  = firstProducts($s_id);
	} else {
		$get_products  = getPriceRange($s_id,$start_price,$end_price);
	}
	foreach($get_products as  $values) {
		
			$products[$values->prim_id]['label_id'] = $values->label_id;
			$products[$values->prim_id]['productname'] = $values->product_name;
			$products[$values->prim_id]['internal_id'] = $values->internal_id;
			$products[$values->prim_id]['imageurl'] =  $values->imageurl;
			$products[$values->prim_id]['price'] =  $values->price;
			$products[$values->prim_id]['ean'] = $values->ean;
			
	}
}

?>
	<?php
	if(count($products) != 0): 
	 foreach($products as $key=>$product):
	 if($product['productname']!= NULL):
	 ?>
        <div style="width: 100%;">
          <div class="image"><img src="<?php echo $product['imageurl'];?>" alt="<?php echo $product['product_name'];?>" height="100" /></div>
          
          <?php 
			if(strpos($_SERVER['QUERY_STRING'],"?") ==false)
			{ ?>
			<a style="color:#483224;" href="<?php echo the_permalink();?>?&product=<?php echo $product['internal_id'];?>"> <B> <?php echo $product['productname'];?> </B></a>
			<?php } else { ?>
			<a style="color:#483224;" href="<?php echo the_permalink();?>?product=<?php echo $product['internal_id'];?>"><?php echo $product['productname'];?>  </a>
			<?php } ?>
			
          
          <div class="price" style="color:black;color:red; margin-bottom:14px;"> <B> &euro;<?php echo $product['price'];?> </B> </div>
          
          <?php
          $compared_products = array();
		  $is_compare_product = false;
			
			if($product['label_id'] == HOTELS) {
				if($product['productname'] != '') {
					$compared_products= getComparedProducts($product['productname'],$product['label_id']);
				}
				
			} else {
					
				if($product['ean'] !='') {
				$compared_products= getComparedProducts($product['ean'],$product['label_id']);
				}
			}
			
   	if(count($compared_products)!= 0 ): ?>
      		<table cellpadding="5" width="200"> 
      	  	<?php foreach($compared_products as $values): 
      	  		if($values->price !="0.00") :
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
          <?php 
			if(strpos($_SERVER['QUERY_STRING'],"?") ==false)
			{ ?>
			<a href="<?php echo the_permalink();?>?&product=<?php echo $product['internal_id'];?>" class="css3button" style="color:white;text-decoration: none;"> More information </a><BR><BR>
			<?php } else { ?>
			<a href="<?php echo the_permalink();?>?product=<?php echo $product['internal_id'];?>" class="css3button" style="color:white;text-decoration: none;"><B>More information </B>  </a><BR><BR>
			<?php } ?>
        
        
        
        </div><BR><BR>
        	<?php endif;?>
        <?php endforeach;?>
        <?php else: ?>
        	<h2> Er zijn geen resultaten gevonden. Verfijn uw resultaten en probeer het nogmaals.</h2>
        	<?php endif;?>
<?php

die();
}?>