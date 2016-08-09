<?php

class DataTableModelAdmin extends ModelAdmin
{
	private static $managed_models = array(
		'DataTable'
	);
	
	private static $url_segment = 'datatables';
	
	private static $menu_title = 'Data Tables';
	
	private static $menu_icon = 'iq-datatables/images/cms_icon.png';
	
	public $showImportForm = false;
	
	public function getEditForm($id=null,$fields=null)
	{
		$form = parent::getEditForm($id,$fields);
		$form->Fields()->dataFieldByName('DataTable')->getConfig()->removeComponentsByType('GridFieldExportButton')->removeComponentsByType('GridFieldPrintButton');
		return $form;
	}
	
}