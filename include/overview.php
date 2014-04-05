<div class="box" style="width:200px;float:left;">
       
        <div class="box-content box-category">
        	<div id="filtergroup">
			<div class="box-heading2">Prijs 
 </div>
			<ul>	
			<div class="layout-slider" style="width: 100%; margin-top:20px; font-size:14px;">
       		<span style="display: inline-block; width: 100px; padding: 0 5px; margin-left:5px;"><input id="Slider1" type="slider" name="price" value="0;1000" /></span> </div>
			</ul>
		</div>
        <?php 
        $attribute_counter = 0;
		$attributes = $puck->getAttributes($i,$feed_id,$s_id);
		foreach($attributes as $key=>$values) : ?>
		<div id="filtergroup">
			<div class="box-heading2"><?php echo $key;?></div>
			<ul>
				<?php foreach($values as $a_id=>$childs) :?>
				<li>  <input type="checkbox" id="check-<?php echo $attribute_counter;?>" value="<?php echo $a_id;?>" class="checkbox">  	<label for="check-<?php echo $attribute_counter;?>" > <?php echo $childs;?></label></li>
				<?php $attribute_counter++; endforeach;?>
			</ul>
		</div>
	<?php  endforeach;?>
</div>
</div>
	
	<!--Product Grid Start-->
      <div id="loader" align="center" style="display:none;"> <BR><img src="<?php echo $images;?>ajax-loader.gif"> </div>
      <div class="product-grid" style="float:left; width: 300px;margin-left:20px; ">
      
      </div>