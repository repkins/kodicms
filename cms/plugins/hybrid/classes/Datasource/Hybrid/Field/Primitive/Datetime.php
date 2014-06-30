<?php defined('SYSPATH') or die('No direct access allowed.');

class Datasource_Hybrid_Field_Primitive_Datetime extends Datasource_Hybrid_Field_Primitive_Date {
	
	protected $_format = 'Y-m-d H:i:s';
	
	public function get_type() 
	{
		return 'DATETIME NOT NULL';
	}
	
	public function fetch_headline_value( $value )
	{
		if(!empty($value))
		{
			return Date::format($value, 'j F Y H:i:s');
		}

		return parent::fetch_headline_value($value);
	}
}