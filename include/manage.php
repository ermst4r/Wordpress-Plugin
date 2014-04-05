<?php $s_id = (int) $_GET['manage'];
		$manage_query = $wpdb->get_results( 
		"
		SELECT * 
		FROM ".$wpdb->prefix."alfieliate_products
		WHERE visible='1'
		AND s_id = '".$s_id."' 
		");
  		
		 ?>
		 <BR><BR><a href="/wp-admin/admin.php?page=alfie-feed-plugin"> Go back</a>
			<h2> Edit text / remove the products of the filter. When an update is performed the changed products will not be affected.
		</h2>
		<div style="width: 1200px; border:2px solid gray; padding:10px;margin-top:50px;">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th>Productname</th>
			<th>Description</th>
			<th>Price</th>
			<th>Imageurl</th>
			<th>Action</th>
		
		</tr>
	</thead>
	<tbody>
		<?php foreach($manage_query as $values):?>
		<tr>
			<td> <a href="<?php echo $values->producturl;?>" target="_blank"> <?php echo $values->product_name;?> </a> </td>
				<td> <?php echo $values->description;?></td>
				<td> <?php echo $values->price;?> </td>
			<td> <a href="<?php echo $values->imageurl;?>" target="_blank"><img src="<?php echo $values->imageurl;?>" height="64" width="64"></a></td>
			<td>
				<a title="Manage products / rewrite text etc.."  href="/wp-admin/admin.php?page=alfie-feed-plugin&manage=<?php echo $values->s_id;?>&pid=<?php echo $values->product_id;?>"> 
			<img src="<?php echo $images;?>/edit.png"></a> 
				<a title="Remove the filter"  href="javascript:confirmation('Do you want to remove the product','/wp-admin/admin.php?page=alfie-feed-plugin&manage=<?php echo $values->s_id;?>&del=<?php echo $values->product_id;?>')"> 
			<img src="<?php echo $images;?>/delete.gif">   </a> 
			
				 </td>
						

		</tr>
		<?php endforeach;?>
	</tbody>
	</table>