<?php

class DataTableColumn extends DataObject
{
	private static $db = array(
		'SortOrder' => 'Int',
		'Align' => "Enum('Left,Center,Right','Left')",
		'Content' => 'Text'
	);

	private static $has_one = array(
		'ParentColumn' => 'DataTableColumn',
		'DataTableRow' => 'DataTableRow',
	);

	private static $summary_fields = array(
		'ParentColumn.Content' => 'Header',
		'GridFieldPreview' => 'Preview'
	);

	private static $default_sort = "SortOrder ASC";
	
	private static $singular_name = 'Column';

	function getCMSFields()
	{
		$fields = parent::getCMSFields();
<<<<<<< HEAD
		if ($this->ParentColumn()->Exists())
=======
		if ($this->ParentColumnID && $this->ParentColumn()->Exists())
>>>>>>> f028dd8... ## [0.0.1]
		{
			$fields->insertBefore( HeaderField::create('parent',$this->ParentColumn()->Content,2), 'Align');
		}
		$fields->push( new HiddenField('SortOrder',null,$fields->dataFieldByName('SortOrder')->Value()) );
		$fields->push( new HiddenField('DataTableRowID',null,$fields->dataFieldByName('DataTableRowID')->Value()) );
		$fields->push( new HiddenField('ParentColumnID',null,$fields->dataFieldByName('ParentColumnID')->Value()) );
		
<<<<<<< HEAD
		$fields->replaceField('Align', OptionSetField::create('Align','Text Align',$this->relObject('Align')->enumValues()) );
=======
>>>>>>> f028dd8... ## [0.0.1]
		return $fields;
	}

	public function canCreate($member = null) { return true; }
	public function canDelete($member = null) { return true; }
	public function canEdit($member = null)   { return true; }
	public function canView($member = null)   { return true; }

	public function GridFieldPreview()
	{
		return ($this->Content) ? $this->relObject('Content')->Summary() : '[ Empty ]';
	}
<<<<<<< HEAD
	
	public function __get($var)
	{
		if ($var == 'Title')
		{
			return 'Column '.$this->ColumnNumber();
		}
		return parent::__get($var);
	}
	
	public function ColumnNumber()
	{
		if ($this->ParentColumn()->Exists())
		{
			return $this->ParentColumn()->SortOrder;
		}
		return $this->SortOrder;
	}
=======
>>>>>>> f028dd8... ## [0.0.1]
}