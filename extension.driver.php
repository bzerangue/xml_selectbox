<?php

	Class extension_xml_selectbox extends Extension{
	
		public function about(){
			return array('name' => 'Field: XML Select Box',
						 'version' => '0.3.3',
						 'release-date' => '2010-06-02',
						 'author' => array('name' => 'Nick Dunn',
										   'website' => 'http://nick-dunn.co.uk',
										   'email' => 'nick@nick-dunn.co.uk')
				 		);
		}
		
		/* the function call at line 17 subscribes this extension to that particular delegate, and when that delegate is fired, it'll call the method specified here (initializeAdmin()). this simply allows us to add JS and CSS stuff to the HEAD */
		
				public function getSubscribedDelegates() {
					return array(
						array(
							'page' => '/backend/',
							'delegate' => 'InitaliseAdminPageHead',
							'callback' => 'initializeAdmin'
						)
					);
				}
		
				public function initializeAdmin($context) {
					$page = $context['parent']->Page;
					$assets_path = '/extensions/xml_selectbox/assets/';
		
					// load autocomplete JS
					$page->addScriptToHead(URL . $assets_path . 'xml_selectbox.js', 900);
		
					// load autocomplete styles
					$page->addStylesheetToHead(URL . $assets_path . 'xml_selectbox.css', 'screen', 100);
				}
		
		
		public function uninstall(){
			$this->_Parent->Database->query("DROP TABLE `tbl_fields_xml_selectbox`");
		}

		public function install(){
			return $this->_Parent->Database->query("CREATE TABLE `tbl_fields_xml_selectbox` (
			  `id` int(11) NOT NULL auto_increment,
			  `field_id` int(11) NOT NULL,
			  `field_type` enum('select','autocomplete') NOT NULL default 'select',
			  `allow_multiple_selection` enum('yes','no') NOT NULL default 'no',
			  `xml_location` varchar(255) NOT NULL default '',
			  `item_xpath` varchar(255) NOT NULL default '',
			  `text_xpath` varchar(255) NOT NULL,
			  `value_xpath` varchar(255) default NULL,
			  `cache` int(11) NOT NULL default 0,
			  PRIMARY KEY (`id`)
			) TYPE=MyISAM");
		}
			
	}

