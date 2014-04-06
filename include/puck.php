<?php
class puck 
{
	private $api_url;
	private $domain;
	private $website_id;
	private $api_key;
	private $wpdb;
	
	public function __construct($domain='twngtool.nl',$website_id,$api_key='')
	{
		$this->api_key = $api_key;
		$this->domain = $domain;
		$this->website_id = $website_id;
		$this->wpdb = &$wpdb;
	}
	
	
	public function getAcceptedFilters()
	{
		
		$data =  file_get_contents("http://".$this->domain."/whitelabel/api/getacceptedfiltersfromwebsite/apikey/{$this->api_key}/id/".$this->website_id);
		return json_decode($data);
	}
	
	public function getproducts($s_id)
	{
		
		$data =  file_get_contents("http://".$this->domain."/whitelabel/api/getproductstbyfilter/apikey/{$this->api_key}/id/".$s_id);
		return json_decode($data);
		
	}
	
	public function getmatching()
	{

		$data =  file_get_contents("http://".$this->domain."/whitelabel/api/getmatchings/apikey/{$this->api_key}");
		return json_decode($data);
	}
	
	public function getproduct($id ,$internal_id = 0)
	{
	
		$data =  file_get_contents("http://".$this->domain."/whitelabel/api/getproduct/apikey/{$this->api_key}/id/".$id."/internal_id/".$internal_id);
		return json_decode($data);
	}
	
	public function getproductbybrand($id)
	{
		
		$data =  file_get_contents("http://".$this->domain."/whitelabel/api/getproductsbyattributename/apikey/{$this->api_key}/id/".$id);
		return json_decode($data);
	}
	
	public function getAttributes($i,$feed_id,$s_id)
	{
		
		$data =  file_get_contents($this->getAttributeRequestUrl($i,$feed_id,$s_id));
		return json_decode($data);
	}
	
	public function getAttributeRequestUrl($i,$feed_id,$s_id)
	{
		return "http://".$this->domain."/whitelabel/product/getproduct/apikey/{$this->api_key}/type/api/i/".$i."/w/".$this->website_id."/f/".$feed_id."/s_id/".$s_id;
		
	}
	
	
	
	
	
	
	
	
	
}
