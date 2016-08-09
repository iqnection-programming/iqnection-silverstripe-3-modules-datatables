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
		if ($this->ParentColumnID && $this->ParentColumn()->Exists())
		{
			$fields->insertBefore( HeaderField::create('parent',$this->ParentColumn()->Content,2), 'Align');
		}
		$fields->push( new HiddenField('SortOrder',null,$fields->dataFieldByName('SortOrder')->Value()) );
		$fields->push( new HiddenField('DataTableRowID',null,$fields->dataFieldByName('DataTableRowID')->Value()) );
		$fields->push( new HiddenField('ParentColumnID',null,$fields->dataFieldByName('ParentColumnID')->Value()) );
		
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
}