<?php
if(isset($_GET['pid'])):
	$product_id = (int) $_GET['pid'];
	$s_id = (int) $_GET['manage'];
	$row = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."alfieliate_products  WHERE product_id = '".$product_id."'", ARRAY_A);
	
 ?><BR><BR>
 	<a href="/wp-admin/admin.php?page=alfie-feed-plugin&manage=<?php echo $s_id;?>"> Go back</a>
 	<div class=updated style="margin-left:0px;">Over here you can edit the text of a particular product.</div>
				
<form name="alfie_insert" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<table width="893" height="167" style="border:1px solid gray;">

  
  <input type="hidden" name="oscimp_hidden" value="Y">
  <tr> 
    <td align="left"> <B>Productname</B></td>
    <td align="left"> 
   <input type="text" name="product_name" value="<?php echo trim($row['product_name']);?>"  autocomplete="off" style="width: 400px;">
    
   </td>
  </tr>
  
  <tr> 
    <td align="left"> <B>Url</B></td>
    <td align="left"> 
   <input type="text" name="producturl" value="<?php  echo $row['producturl'];?>"  autocomplete="off" style="width: 400px;">
    
   </td>
  </tr>
  
  <tr> 
    <td align="left"> <B>Imageurl</B></td>
    <td align="left"> 
    <input type="text" name="imageurl" value="<?php echo $row['imageurl'];?>" autocomplete="off"  autocomplete="off" style="width: 400px;">
    
   </td>
  </tr>
  
  <tr> 
    <td align="left"> <B>Price</B></td>
    <td align="left"> 
    <input type="text" name="price" value="<?php echo $row['price'];?>" autocomplete="off"  autocomplete="off" style="width: 400px;">
    
   </td>
  </tr>
  
  
  <tr> 
    <td align="left"> <B>Description</B></td>
    <td align="left"> 
    <textarea name="description" cols="45" rows="5"> <?php echo trim($row['description']);?></textarea>
    
   </td>
  </tr>
 
   <tr> 
    <td align="right"> 
    	
    
    </td>
    <td align="right"> 
    		<input type="submit" name="submit" value="Save and go back to overview" />
    		<input type="submit" name="submit" value="Save and stay on current page" />
   </td>
  </tr>
</table>
</form>

<?php if($_POST['oscimp_hidden'] == 'Y') {
	
	$action = $_POST['submit'];
	$product_name = $_POST['product_name'];
	$producturl = $_POST['producturl'];
	$imageurl = $_POST['imageurl'];
	$price = str_replace(",",".",$_POST['price']);
	$description = $_POST['description'];
	$sql = "UPDATE ".$wpdb->prefix."alfieliate_products SET
			product_name = '".$product_name."',
			producturl = '".$producturl."',
			imageurl = '".$imageurl."',
			price = '".$price."',
			description = '".$description."',
			allow_update = '0'
			WHERE product_id = '".$product_id."'";
	$wpdb->query($sql);
	if($action == "Save and go back to overview") {
		wp_redirect("admin.php?page=alfie-feed-plugin&manage=".$s_id);
	} else {
		wp_redirect("admin.php?page=alfie-feed-plugin&manage=".$s_id."&pid=".$product_id);
	}
	
	}
 endif;?>
