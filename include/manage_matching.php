<?php
function manage_matching()
{
	global $puck;
	$table_dir = WP_PLUGIN_URL.'/alfieliate/media/';
	?>
		<style type="text/css" title="currentStyle">
			@import "<?php echo $table_dir;?>/css/demo_page.css";
			@import "<?php echo $table_dir;?>css/jquery.dataTables.css";
		

		</style>
		<script type="text/javascript" language="javascript" src="<?php echo $table_dir;?>js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo $table_dir;?>js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example1').dataTable();
			} );
		</script>
	 <BR><BR><a href="/wp-admin/admin.php?page=alfie-feed-plugin"> Go back</a>
			<h2> Here you see match collections. Click Continue to install all the filters to generate the matching.<BR>
				If you don't see all the filters from Alfieliate it means you didnt apply for all the filters. You can do dit at affliate.nl
		</h2>
		<div style="width: 1200px; border:2px solid gray; padding:10px;margin-top:50px;">
		<table cellpadding="2" cellspacing="2" border="0" class="display" id="example1" width="100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Action</th>
		
		</tr>
	</thead>
	<tbody>
		<?php
		if(!$puck->getAcceptedFilters()) {
				wp_redirect("/wp-admin/admin.php?page=alfie-config");
			}
		
		 foreach($puck->getmatching()  as $key=>$values):
			?>
		<tr>
	
				<td align="center"> <?php echo $values->match_name[0];?></td>
				<td align="center"> <a href="/wp-admin/admin.php?page=alfie-feed-plugin&match_id=<?php echo $values->match_id;?>">Continue to make matching </a></td>
			
						

		</tr>
		<?php endforeach;?>
	</tbody>
	</table>
<?php } ?>
