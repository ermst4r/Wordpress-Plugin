<?php
function alfie_config()
{
	global $wpdb;
	$row = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."alfieliate_settings  WHERE setting_id = '1'", ARRAY_A);
	 ?>
	<BR><BR>
		<div class="updated" style="margin-left:0px;"> Fill here your API key and website id from 
			<a href="http://www.alfieliate.nl" target="_blank"> Alfieliate.nl </a> in order to make this plugin work.</div><BR><BR>
	<form name="alfie_insert" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<table width="893" height="167" style="border:1px solid gray;">

  
  <input type="hidden" name="oscimp_hidden" value="Y">
  <tr> 
    <td align="left"> <B>Website ID</B></td>
    <td align="left"> 
   <input type="text" name="website_id" value="<?php echo trim($row['website_id']);?>"  autocomplete="off" style="width: 400px;">
    
   </td>
  </tr>
  
  <tr> 
    <td align="left"> <B>API KEY</B></td>
    <td align="left"> 
   <input type="text" name="api_key" value="<?php  echo $row['api_key'];?>"  autocomplete="off" style="width: 400px;">
    
   </td>
  </tr>
  
  
   <tr> 
    <td align="right"> 
    	
    
    </td>
    <td align="right"> 
  
    		<input type="submit" name="submit" value="Save" />
   </td>
  </tr>
</table>
</form>
<?php 
if($_POST['oscimp_hidden'] == 'Y') {
	
	
	$website_id = $_POST['website_id'];
	$api_key = $_POST['api_key'];
	$sql = "UPDATE ".$wpdb->prefix."alfieliate_settings SET
			website_id = '".$website_id."',
			api_key='".$api_key."'
			WHERE setting_id = '1'";
	$wpdb->query($sql);
	wp_redirect("/wp-admin/admin.php?page=alfie-config");
	}

} ?>
