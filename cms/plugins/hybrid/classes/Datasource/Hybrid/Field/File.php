<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Datasource_Hybrid_Field_File extends Datasource_Hybrid_Field {

	public function __construct( array $data = NULL )
	{
		parent::__construct( $data );
		$this->family = Datasource_Hybrid_Field::FAMILY_FILE;
	}
}