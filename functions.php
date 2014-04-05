<?php
/*
 *  This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

 
 function getComparedProducts($id,$type)
	{
		global $wpdb;
		
		if($type == HOTELS) {
			
			return $wpdb->get_results( 
					"
					SELECT * 
					FROM ".$wpdb->prefix."alfieliate_products
					WHERE visible='1'
					AND product_name LIKE '%".$id."%'
					GROUP BY feed_id
					ORDER BY price ASC
					");
		} else {
			
			return $wpdb->get_results( 
					"SELECT * 
					FROM ".$wpdb->prefix."alfieliate_products
					WHERE visible='1'
					AND ean = '".$id."'
					GROUP BY `feed_id`
					ORDER BY price ASC");
			
		}
		
	}

function StringLength($string,$length=45){
		$string = utf8_decode(strip_tags($string));
		if(strlen($string)>$length) {
			return substr(strip_tags(trim($string)), 0,$length)."...";
		} else {
			return strip_tags(trim($string));
		}
 	}

function getProduct($internal_id)
{
	global $wpdb;
	return $wpdb->get_row( 
			"
			SELECT * 
			FROM ".$wpdb->prefix."alfieliate_products
			WHERE visible='1'
			AND internal_id = '".$internal_id."' 
			");
}



function getProductByPrimId($prim_id,$start_price='',$end_price = '')
{
	global $wpdb;
	if($start_price!= '' ) {
		return $wpdb->get_row( 
			"
			SELECT * 
			FROM ".$wpdb->prefix."alfieliate_products
			WHERE visible='1'
			AND prim_id = '".$prim_id."' 
			AND pricerange BETWEEN {$start_price} AND {$end_price}
			");
		} else {
			return $wpdb->get_row( 
			"
			SELECT * 
			FROM ".$wpdb->prefix."alfieliate_products
			WHERE visible='1'
			AND prim_id = '".$prim_id."' 
			");
		}
}

function firstProducts($s_id)
{
	global $wpdb; 
	return $wpdb->get_results( 
			"
			SELECT * 
			FROM ".$wpdb->prefix."alfieliate_products
			WHERE visible='1'
			AND s_id = '".$s_id."' 
			LIMIT 0,10
			");
}


function getPriceRange($s_id,$start_price='',$end_price = '')
{
	global $wpdb;
	
	return $wpdb->get_results( 
			"
			SELECT * 
			FROM ".$wpdb->prefix."alfieliate_products
			WHERE visible='1'
			AND s_id = '".$s_id."' 
			AND pricerange BETWEEN {$start_price} AND {$end_price}
			");
	
	
}



?>