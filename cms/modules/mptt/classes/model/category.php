<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Category extends Model_MPTT 
{
	protected $_table_name = 'categories';
	protected $path_calculation_enabled = TRUE;
	
	public function labels()
	{
		return array(
			'name'				=> __('Category name'),
			'path_part'			=> __('Slug'),
			'pid'			=> __('Parent'),
		);
	}
	
	public function rules() 
	{
		$rules = array(
			'name' => array(
				array('not_empty'),
				array('max_length', array(':value', 255))
			),
			'path_part' => array(
				array('not_empty'),
				array('max_length', array(':value', 100))
			)
		);
		return $rules;
	}
	
	public function filters()
	{
		return array(
			$this->path_part_column => array(
				array('URL::title'),
				array('strtolower')
			),
			$this->path_column => array(
				array('URL::title'),
				array('strtolower')
			),
			$this->left_column => array(
				array('intval')
			),
			$this->right_column => array(
				array('intval')
			),
			$this->level_column => array(
				array('intval')
			),
			$this->scope_column => array(
				array('intval')
			)
		);		
	}
	
	public function form_columns()
	{
		return array(
			'id' => array(
				'type' => 'input',
				'editable' => FALSE,
				'length' => 10
			),
			'pid' => array(
				'type' => 'select',
				'choices' => array($this, '_get_categories')
			)
		);
	}
	
	protected function _get_categories()
	{
		$categories = ORM::factory('category')->full_tree()->as_array('id');
		
		$data = array();
		foreach ($categories as $id => $category)
		{
			if($this->loaded() AND $this->id == $id) continue;
			$data[$id] = str_repeat('- - ', $category->lvl) . $category->name;
		}

		return $data;
	}
}
