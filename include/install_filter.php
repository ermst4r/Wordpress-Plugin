	<?php $match_id = (isset($_GET['match_id']) ? $_GET['match_id'] : 0);	?>
	
	<h2> 
		
		<?php if($match_id != 0 ): ?>
			Apply here for all the filters to create the matching. <BR><BR>When you applied for all the filters you can copy the shortcode. The matching will be generated automatically.
		<?php else : ?>
			Below you see the availble filters of Alfieliate.nl. Press install and paste the shortcode to a post to display the products on your blog.<BR><BR>
			
			That's It!
		<?php endif;?>
		
		</h2>
		
		
		<?php
		if(isset($_GET['msg'])) : ?>
		<div class="updated" style="margin-left:0;">
		Done! Paste the shortcode to a page or post.
		<BR>When you don't see the changed directly on the front-end you must restart your browser. 
			</div>
		<?php endif;?>
		<div style="width: 1200px; border:2px solid gray; padding:10px;margin-top:50px;">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th>Products</th>
			<th>Advertiser</th>
			<th>Filtername</th>
			<th>Branche</th>
			<th>Install</th>
			<th> Shortcode</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		
		
		if($match_id == 0 ): 
		foreach ($puck->getAcceptedFilters() as $key=>$values): 
		$installed = null;	
		$number_of_products =  $wpdb->get_var("SELECT COUNT(s_id) FROM ".$wpdb->prefix."alfieliate_products  WHERE s_id ='".(int) $values->s_id."'");
		
		?>
		<tr><td class="center"> <?php if($number_of_products != 0 ): ?>
					 <span title="<?php echo $number_of_products;?> products are availble"> <?php echo $number_of_products; ?></span>
					 <?php else : ?>
					 	<span title="Install filter first"> N/A </span>
					<?php endif;?></td>
			
			<td class="center"> <?php echo $values->webshop_name[0];?></td>
			<td class="center"> <?php echo $values->description[0];?>
				
				  </td>
				 
			<td class="center"> <?php echo $values->category[0];?></td>
			<td align="center">
			<?php if($number_of_products != 0): $installed = true; ?>
				<a href="javascript:confirmation('Do you wish to update the products?','/wp-admin/admin.php?page=alfie-feed-plugin&update=<?php echo $values->s_id;?>&match_id<?php echo $match_id;?>')"  title="Update all the products with new entries"> <img src="<?php echo $images;?>/update-icon.png"></a>
				<a title="Manage products / rewrite text etc.."  href="/wp-admin/admin.php?page=alfie-feed-plugin&manage=<?php echo $values->s_id;?>"> 
			<img src="<?php echo $images;?>/edit.png"></a> 
				<a title="Remove the filter"  href="javascript:confirmation('Do you want to remove the filter <?php echo $values->description[0];?> van <?php echo $values->webshop_name[0];?> ?','/wp-admin/admin.php?page=alfie-feed-plugin&del=<?php echo $values->s_id;?><?php echo (isset($_GET['match_id']) ? '&match_id='.$_GET['match_id'] : '' )?>')"> 
			<img src="<?php echo $images;?>/delete.gif">   </a> 
			
			<?php else : ?>
				
				<a  href="javascript:confirmation('Do you want install  <?php echo $values->description[0];?> van <?php echo $values->webshop_name[0];?> ?','/wp-admin/admin.php?page=alfie-feed-plugin&install=<?php echo $values->s_id;?><?php echo (isset($_GET['match_id']) ? '&match_id='.$_GET['match_id'] : '' )?>')"
					title="Installeer de filter"
					> 
			<img src="<?php echo $images;?>/Install.png">  </a> 
			<?php endif;?>	
			
			
			
			</td>
			<td align="center"> 
				<?php if($installed == true) {
						echo '<span title="Copy this code to your post to display the products"> [displayproducts id="'.$values->s_id.'"]</span>';
					} else {
						echo '<B title="install filter first">N/A</B>';
					} ?>
			 </td>
		</tr>
	
		<?php endforeach;?>
		<?php else : 	
		$teller = 0;			
		$code = '';
		foreach ($puck->getAcceptedFilters() as $key=>$values): 
		$installed = null;	
		$number_of_products =  $wpdb->get_var("SELECT COUNT(s_id) FROM ".$wpdb->prefix."alfieliate_products  WHERE s_id ='".(int) $values->s_id."'");
		if($values->match_id[0] == $match_id): 
			
			
		?>
		<tr>
			<td class="center"> <?php if($number_of_products != 0 ): ?>
					 <span title="<?php echo $number_of_products;?> products are availble"> <?php echo $number_of_products; ?></span>
					 <?php else : ?>
					 	<span title="Install filter first"> N/A </span>
					<?php endif;?></td>
			
			<td class="center"> <?php echo $values->webshop_name[0];?></td>
			
			<td class="center"> <?php echo $values->description[0];?> </td>
			<td class="center"> <?php echo $values->category[0];?></td>
			<td align="center">
			<?php if($number_of_products != 0): $installed = true; ?>
				<a href="javascript:confirmation('Do you wish to update the products?','/wp-admin/admin.php?page=alfie-feed-plugin&update=<?php echo $values->s_id;?>&match_id=<?php echo $match_id;?>')"  title="Update all the products with new entries"> <img src="<?php echo $images;?>/update-icon.png"></a>
				<a title="Manage products / rewrite text etc.."  href="/wp-admin/admin.php?page=alfie-feed-plugin&manage=<?php echo $values->s_id;?>"> 
			<img src="<?php echo $images;?>/edit.png"></a> 
				<a title="Remove the filter"  href="javascript:confirmation('Do you want to remove the filter <?php echo $values->description[0];?> van <?php echo $values->webshop_name[0];?> ?','/wp-admin/admin.php?page=alfie-feed-plugin&del=<?php echo $values->s_id;?><?php echo (isset($_GET['match_id']) ? '&match_id='.$_GET['match_id'] : '' )?>')"> 
			<img src="<?php echo $images;?>/delete.gif">   </a> 
			
			<?php else : ?>
				
				<a  href="javascript:confirmation('Do you want install  <?php echo $values->description[0];?> van <?php echo $values->webshop_name[0];?>? ','/wp-admin/admin.php?page=alfie-feed-plugin&install=<?php echo $values->s_id;?><?php echo (isset($_GET['match_id']) ? '&match_id='.$_GET['match_id'] : '' )?>')"
					title="Install the filter"
					> 
			<img src="<?php echo $images;?>/Install.png">  </a> 
			<?php endif;?>	
			
			
			
			</td>
			<td align="center"> 
				<?php if($installed == true) {
					
					
						$code =  '<span title="Copy this code to your post to display the products"> [displayproducts id="'.$values->s_id.'"]</span>';
					
					} else {
						echo '<B title="install filter first">N/A</B>';
					} ?>
			 </td>
		</tr>
		<?php $teller++; endif;?> 
		<?php endforeach;?>
		
		<?php endif;?>
		
	</tbody>
	
</table><BR><BR>
<h2 align="center"> 
	<?php if($code !=''):?>
	COPY THIS SHORTCODE:  <?php echo $code;?>
	<?php endif;?>
	</h2>
<?php 

	// lets install the content
	if(isset($_GET['install'])){
		$s_id = (int) $_GET['install'];
		$wpdb->query("DELETE FROM ".$wpdb->prefix."alfieliate_products WHERE s_id='".$s_id."' AND allow_update ='1'");
		$get_products = $puck->getproducts($s_id);
		foreach($get_products as $values) {
			$sql = "INSERT INTO 
			".$wpdb->prefix."alfieliate_products 
			(identifier,feed_id,s_id,prim_id,
			product_name,price,description,imageurl,
			producturl,internal_id,ean,pricerange,
			webshop_name,webshop_logo,label_id) 
			VALUES(
			'".(isset($values->identifier)  ?  $values->identifier : '')."',
			'".(isset($values->feed_id)  ?  $values->feed_id : '')."',
			'".(isset($values->s_id)  ?  $values->s_id : '')."',
			'".(isset($values->prim_id)  ?  $values->prim_id : '')."',
			'".(isset($values->productname)  ?  trim(strip_tags($values->productname)) : '')."',
			'".str_replace(",",".",$values->price)."',
			'".(isset($values->description)  ?  trim(strip_tags($values->description)) : '')."',
			'".(isset($values->imageurl)  ?  $values->imageurl : '')."',
			'".(isset($values->producturl)  ?  $values->producturl : '')."',
			'".(isset($values->internal_id)  ?  $values->internal_id : '')."',
			'".(isset($values->ean)  ?  $values->ean : '')."',
			'".(isset($values->pricerange)  ?  $values->pricerange : '')."',
			'".(isset($values->webshop_name)  ?  $values->webshop_name : '')."',
			'".(isset($values->webshop_logo)  ?  $values->webshop_logo : '')."',
			'".(isset($values->label_id)  ?  $values->label_id : '')."'
			)";
			$wpdb->query($sql); 
		} 
		if($match_id != 0 ) {
			wp_redirect("/wp-admin/admin.php?page=alfie-feed-plugin&match_id={$match_id}&msg=1");
		} else {
			wp_redirect("/wp-admin/admin.php?page=alfie-feed-plugin&msg=1");
		}
		
		
	}
	
	if(isset($_GET['del'])) {
		$s_id = (int) $_GET['del'];
		$wpdb->query("DELETE FROM ".$wpdb->prefix."alfieliate_products WHERE s_id='".$s_id."'");
		if($match_id != 0 ) {
			wp_redirect("/wp-admin/admin.php?page=alfie-feed-plugin&match_id={$match_id}");
		} else {
			wp_redirect("/wp-admin/admin.php?page=alfie-feed-plugin");
		}
		
		
	}
	