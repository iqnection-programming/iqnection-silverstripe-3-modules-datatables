<?php

if(!defined('DATATABLES_DIR')) {
	define('DATATABLES_DIR', basename(__DIR__));
}

ShortcodeParser::get('default')->register('datatable', array('DataTable', 'ParseShortCode'));