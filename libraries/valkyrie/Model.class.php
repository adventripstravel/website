<?php
defined('_EXEC') or die;

/**
*
* @package Valkyrie.Libraries
*
* @since 1.0.0
* @version 1.0.1
* @license You can see LICENSE.txt
*
* @author David Miguel Gómez Macías < davidgomezmacias@gmail.com >
* @copyright Copyright (C) CodeMonkey - Platform. All Rights Reserved.
*/

class Model
{
	/**
	*
	* @var object
	*/
	public $database;

	/**
	*
	* @var object
	*/
	public $security;

	/**
	*
	* @var object
	*/
	public $format;

	/**
	*
	* @var string
	*/
	public $_lang;

	/**
	* Constructor.
	*
	* @return  void
	*/
	public function __construct()
	{
		if ( Configuration::$db_state === true ) $this->database  = new Medoo;

		$this->security  = new Security;
		$this->format  	 = new Format;

		$this->_lang = Session::get_value('lang');

		if ( Format::check_path_admin() ) $this->system = new System();
	}

}
