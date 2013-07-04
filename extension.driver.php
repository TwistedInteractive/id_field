<?php
/**
 * Created by Symphony Extension Developer.
 * 2013-02-04
 */

class Extension_Id_field extends Extension {

	/**
	 * About information
	 * For if you want to create a pre-2.3-extension
	 */
	public function about() {
		return array(
			'name'			=> 'ID Field',
			'version'		=> '1.0',
			'release-date'	=> '2013-02-04',
			'author'		=> array(
				array(
					'name' => 'Twisted Interactive',
					'website' => 'http://www.twisted.nl'
				)
			)
		);
	}

	/**
	 * Get the subscribed delegates
	 * @return array
	 */
	public function getSubscribedDelegates() {
		return array(

		);
	}


	/**
	 * Installation instructions
	 */
	public function install() {
		// Create field database:
		Symphony::Database()->query("
			CREATE TABLE IF NOT EXISTS `tbl_fields_id_field` (
				`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				`field_id` INT(11) UNSIGNED NOT NULL,
				PRIMARY KEY (`id`),
				KEY `field_id` (`field_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");
		
	}

	/**
	 * Uninstall instructions
	 */
	public function uninstall() {
		// Drop tables:
		Symphony::Database()->query("DROP TABLE `tbl_fields_id_field`");
		
	}

	/**
	 * Update instructions
	 * @param $previousVersion
	 *  The version that is currently installed in this Symphony installation
	 * @return boolean
	 */
	public function update($previousVersion) {
		if (version_compare($previousVersion, '1.1', '<')) {
			// Update from pre-1.1 to 1.1:

		}
	}

}
