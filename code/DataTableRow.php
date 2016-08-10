<?php

class DataTableRow extends DataObject
{
	private static $db = array(
		'SortOrder' => 'Int',
	);

	private static $has_one = array(
		'DataTable' => 'DataTable'
	);
	
	private static $has_many = array(
		'DataTableColumns' => 'DataTableColumn',
	);

	private static $summary_fields = array(
		'GridFieldPreview' => 'Preview'
	);

	private static $default_sort = "SortOrder ASC";

	private static $singular_name = 'Row';
	
	function getCMSFields()
	{
		Requirements::css(DATATABLES_DIR."/css/DataTables_cms.css");		
		$fields = parent::getCMSFields();
		$fields->push( new HiddenField('SortOrder',null,$fields->dataFieldByName('SortOrder')->Value()) );
		$fields->push( new HiddenField('DataTableID',null,$fields->dataFieldByName('DataTableID')->Value()) );
		$fields->addFieldToTab('Root.Main', HeaderField::create('rowNumber',$this->RowNumber(),2) );
		$fields->removeByName('DataTableColumns');
		$fields->addFieldToTab('Root.Main', GridField::create(
			'DataTableColumns',
			'Columns',
			$this->DataTableColumns(),
			$gf_config = GridFieldConfig_RecordEditor::create()
		));
		if ($this->DataTable()->HeaderRow()->ID == $this->ID)
		{
			$gf_config->addComponent(
				new GridFieldSortableRows('SortOrder')
			);
		}
		$gf_config->removeComponentsByType('GridFieldAddNewButton')->addComponent(
			new GridFieldDataTableAddColumnButton()
		);
		return $fields;
	}

	public function canCreate($member = null) { return true; }
	public function canDelete($member = null) { return true; }
	public function canEdit($member = null)   { return true; }
	public function canView($member = null)   { return true; }

	public function onAfterWrite()
	{
		parent::onAfterWrite();
		if ($this->DataTableID)	$this->MatchRows();
	}
	
	public function GridFieldPreview()
	{
		$html = '<div class="dt"><div class="dt-row">';
		foreach($this->DataTableColumns() as $col)
		{
			$html .= '<div class="dt-col">'.$col->GridFieldPreview().'</div>';
		}
		$html .= '</div></div>';
		return $html;
	}
	
	public function __get($var)
	{
		if (preg_match("/^(GridFieldColumnPreview.?)/",$var))
		{
			return $this->ColumnPreview( preg_replace("/[^0-9]/","",$var) );
		}
		elseif ($var == 'GridFieldRowNumber' || $var == 'Title')
		{
			return $this->RowNumber();
		}
		return parent::__get($var);
	}
		
	public function RowNumber()
	{
		if ($this->DataTable()->FirstRowHeader)
		{
			if ( ($this->DataTable()->HeaderRow()) && ($this->DataTable()->HeaderRow()->ID == $this->ID) )
			{
				return 'Header';
			}
			return 'Row '.($this->SortOrder - 1);
		}
		return 'Row '.($this->SortOrder);
	}
	
	public function ColumnPreview($columnNumber)
	{
		return ($col = $this->DataTableColumns()->offsetGet($columnNumber)) ? $col->GridFieldPreview() : 'Missing';
	}
	
	public function UpdateColumns($parentRow=null)
	{
		if ($parentRow) 
		{
			$count = $parentRow->DataTableColumns()->Count();
			foreach($parentRow->DataTableColumns() as $parentColumn)
			{
				if (!$myColumn = $this->DataTableColumns()->find('ParentColumnID',$parentColumn->ID))
				{
					$myColumn = new DataTableColumn();
					$myColumn->ParentColumnID = $parentColumn->ID;
					$myColumn->DataTableRowID = $this->ID;
				}
				$myColumn->SortOrder = $parentColumn->SortOrder;
				$myColumn->write();
			}
			// remove orphaned columns
			foreach($this->DataTableColumns() as $col)
			{
				if (!$col->ParentColumn()->exists()) $col->delete();
			}
		}
		elseif (!$this->DataTableColumns()->Count())
		{
			$newColumn = new DataTableColumn();
			$newColumn->DataTableRowID = $this->ID;
			$newColumn->write();
		}
		return $this;
	}
	
	public function MatchRows()
	{
		if ($this->DataTableID) 
		{
			if (!$parentRow = $this->DataTable()->HeaderRow())
			{
				// no parent row, create a single column
				$this->UpdateColumns();
			}
			elseif ($parentRow->ID != $this->ID)
			{
				$this->UpdateColumns($parentRow);
			}
		}		
		return $this;
	}

}











