<?php 






function alfie_option_page()
{
global $wpdb;
global $puck;
$table_dir = WP_PLUGIN_URL.'/alfieliate/media/';
$images = WP_PLUGIN_URL.'/alfieliate/images/';

?>
<script>
	function confirmation(msg,url) {
	var answer = confirm(msg)
	if (answer){
		window.location = url;
	} 
}
</script>

	<style type="text/css" title="currentStyle">
			@import "<?php echo $table_dir;?>/css/demo_page.css";
			@import "<?php echo $table_dir;?>css/jquery.dataTables.css";
		

		</style>
		
	
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>
		
		
		<?php
		if(isset($_GET['succes'])) {
			echo '<div class=updated style=margin-left:0> Updating done </div>';
		}
		if(isset($_GET['update'])) {
			$get_products = $puck->getproducts($_GET['update']);
			foreach($get_products as $values) {
				if(isset($values->prim_id)) {
				
					$number_of_products =  $wpdb->get_var("SELECT COUNT(product_id) FROM ".$wpdb->prefix."alfieliate_products  WHERE prim_id ='".$values->prim_id."' AND s_id = '".$values->s_id."'");
					if($number_of_products == 0 ) {
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
				}
				
				
		
			}
		if(isset($_GET['match_id'])) {
			wp_redirect("/wp-admin/admin.php?page=alfie-feed-plugin&match_id=".$_GET['match_id']."&succes=true");
		} else {
			wp_redirect("/wp-admin/admin.php?page=alfie-feed-plugin&succes=true");
		}
			
		}

		
		 if(isset($_GET['manage'])) {
			if(isset($_GET['succes'])) {
				echo "<div class=updated style=margin-left:0px;> Operation successful </div>";
			}
				if(isset($_GET['pid'])) {
					include 'editproduct.php';
				}
				if(!isset($_GET['pid'])) {
					include 'manage.php';
				}
				if(isset($_GET['del'])) {
					$pid = (int) $_GET['del'];
					$sql = "UPDATE ".$wpdb->prefix."alfieliate_products SET
							visible = '0'
							WHERE product_id = '".$pid."'";
					$wpdb->query($sql);
					wp_redirect("admin.php?page=alfie-feed-plugin&manage=".$_GET['manage']."&succes=true");
				}
				
				
			} else {
				 include 'install_filter.php';
				 
			}
		
	
}

?>






