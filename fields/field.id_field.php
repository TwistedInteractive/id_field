<?php
/**
 * Created by Symphony Extension Developer.
 * Part of 'ID Field' extension.
 * 2013-02-04
 */

if (!defined('__IN_SYMPHONY__')) die('<h2>Symphony Error</h2><p>You cannot directly access this file</p>');

Class FieldID_Field extends Field {

	public function canToggle()
	{
		return true;
	}

	public function getToggleStates()
	{
		return array('save_ids' => __('Re-save ID\'s'));
	}

	public function toggleFieldData($data, $newState, $entry_id = null)
	{
		$data['value'] = $entry_id;
		return $data;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		$this->_name = __('ID Field');

		// Set defaults:
		$this->set('show_column', 'no');
		$this->set('required', 'no');
		$this->set('location', 'main');
	}

	/**
	 * Creation of the data table:
	 * @return mixed
	 */
	public function createTable() {
		return Symphony::Database()->query("
			CREATE TABLE IF NOT EXISTS `tbl_entries_data_" . $this->get('id') . "` (
			  `id` int(11) unsigned NOT NULL auto_increment,
			  `entry_id` int(11) unsigned NOT NULL,
			  `value` int(11) NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");
	}

	/**
	 * Process the raw field data.
	 *
	 * @param mixed $data
	 *	post data from the entry form
	 * @param integer $status
	 *	the status code resultant from processing the data.
	 * @param string $message
	 *	the place to set any generated error message. any previous value for
	 *	this variable will be overwritten.
	 * @param boolean $simulate (optional)
	 *	true if this will tell the CF's to simulate data creation, false
	 *	otherwise. this defaults to false. this is important if clients
	 *	will be deleting or adding data outside of the main entry object
	 *	commit function.
	 * @param mixed $entry_id (optional)
	 *	the current entry. defaults to null.
	 * @return array
	 *	the processed field data.
	 */
	public function processRawFieldData($data, &$status, &$message=null, $simulate=false, $entry_id=null) {
		$status = self::__OK__;

		// Assuming your entry has a 'value'-column in it's data table:
		return array('value' => $entry_id);
	}

	/**
	 * Append the formatted XML output of this field as utilized as a data source.
	 *
	 * @param XMLElement $wrapper
	 *	the XML element to append the XML representation of this to.
	 * @param array $data
	 *	the current set of values for this field. the values are structured as
	 *	for displayPublishPanel.
	 * @param boolean $encode (optional)
	 *	flag as to whether this should be html encoded prior to output. this
	 *	defaults to false.
	 * @param string $mode
	 *	 A field can provide ways to output this field's data. For instance a mode
	 *  could be 'items' or 'full' and then the function would display the data
	 *  in a different way depending on what was selected in the datasource
	 *  included elements.
	 * @param integer $entry_id (optional)
	 *	the identifier of this field entry instance. defaults to null.
	 */
	public function appendFormattedElement(XMLElement &$wrapper, $data, $encode = false, $mode = null, $entry_id = null) {
		$wrapper->appendChild(new XMLElement($this->get('element_name'), $data['value']));
	}

	
}
