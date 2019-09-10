<?php
defined('_EXEC') or die;

/**
 *
 * @package Valkyrie.Libraries
 *
 * @since 1.0.0
 * @version 1.0.0
 * @license You can see LICENSE.txt
 *
 * @author David Miguel Gómez Macías < davidgomezmacias@gmail.com >
 * @copyright Copyright (C) CodeMonkey - Platform. All Rights Reserved.
 */

class Layout
{
    /**
     *
     * @var object
     */
    private $framework;

    /**
     *
     * @var object
     */
    private $security;

    /**
     *
     * @var object
     */
    private $render;

    /**
     *
     * @var object
     */
    private $language;

    /**
     *
     * @var object
     */
    private $format;

    /**
     *
     * @var string
     */
    private $controller;

    /**
     *
     * @var string
     */
    private $method;

    /**
     *
     * @var string
     */
    private $params;

    /**
     *
     * @var string
     */
    private $route;

    /**
	 * Constructor.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->framework = new Framework();
        $this->security = new Security();
        $this->render = new Render();
        $this->language = new Language();
        $this->format = new Format();

        $this->load_page();
    }

    /**
     * Imprime todo el contendio ya procesado.
     *
     * @final
     *
     * @return  string
     */
    public function execute()
    {
        ob_start("ob_gzhandler");

		$this->load_controller();

		if ( !defined('_title') )
			define('_title', Configuration::$web_page . ' - ' . Framework::PRODUCT);

		if ( !defined('_lang') )
			define('_lang', Configuration::$lang_default);

		$buffer = ob_get_contents();

		$buffer = $this->render($buffer);

		ob_end_clean();

		return $buffer;
    }

    /**
     * Prepara las variables a partir de la url para solicitar el controlador y metodos.
     *
     * @return void
     */
    private function load_page()
    {
        if ( Configuration::$url_friendly === true && isset($_SERVER['PATH_INFO']) )
        {
            $url = str_replace('-', '_', $_SERVER['PATH_INFO']);
            $url = explode('/', $url);

            unset($url[0]);

            $this->controller = (isset($url[1])) ? ucwords( Security::clean_string($url[1]) ) : 'Index';
            $this->method     = (isset($url[2])) ? strtolower( Security::clean_string($url[2]) ) : 'index';

            unset($url[1]);
            unset($url[2]);

            foreach ( $url as $param )
                $this->params .= $param . '/';

            $this->params = ( isset($url[3]) )? substr($this->params, 0, -1) : '';

            unset($url);
        }
        elseif ( Configuration::$url_friendly === false && isset($_GET['c']) )
        {
            $this->controller = (isset($_GET['c']))? ucwords( Security::clean_string($_GET['c']) ) : 'Index';
            $this->method     = (isset($_GET['m']))? strtolower( Security::clean_string($_GET['m']) ) : 'index';
            $this->params     = (isset($_GET['p']))? $_GET['p'] : '';
        }

        if ( empty($this->controller) )
            $this->controller = 'Index';

        if ( empty($this->method) )
            $this->method = 'index';
    }

    /**
     * Obtiene la informacion del controlador solicitado.
     *
     * @return  void
     */
    private function load_controller()
	{
        $path = Security::DS(PATH_CONTROLLERS . $this->controller . CONTROLLER_PHP . '.php');

		if ( file_exists($path) )
		{
			require_once $path;

            $controller = $this->controller . CONTROLLER_PHP;
			$controller = new $controller();

			if ( isset($this->method) )
			{
				if ( method_exists($controller, $this->method) )
				{
                    if ( file_exists(Security::DS(PATH_MY_LIBRARIES . 'Route_vkye' . CLASS_PHP)) )
                    {
                        $this->route = new Route_vkye('/' . $this->controller . '/' . $this->method);

                        $this->route->on_change_start();
                    }

					if ( isset($this->params) )
						$controller->{$this->method}($this->params);
					else
						$controller->{$this->method}();

                    if ( file_exists(Security::DS(PATH_MY_LIBRARIES . 'Route_vkye' . CLASS_PHP)) )
                        $this->route->on_change_end();
				}
				else
                    Errors::http('404', '{method_does_exists}');
			}
			else
                $controller->index();
		}
		else
            Errors::http('404', '{controller_does_exists}');
	}

    /**
     * Renderiza todo el buffer remplazando placeholder.
     *
     * @param   string    $buffer    Buffer pre-cargado.
     *
     * @return  string
     */
    private function render( $buffer )
    {
        if ( file_exists(Security::DS(PATH_MY_LIBRARIES . 'Placeholders_vkye' . CLASS_PHP)) )
        {
            $placeholders = new Placeholders_vkye( $buffer );
            $buffer = $placeholders->run();
        }

        $buffer = Language::get_lang($buffer);
        $buffer = $this->render->placeholders($buffer);
        $buffer = $this->render->paths($buffer);

        if ( Configuration::$compress_html === true )
			$buffer = preg_replace(array('//Uis', "/[[:blank:]]+/"), array('', ' '), str_replace(array("\n", "\r", "\t"), '', $buffer));

		return $buffer;
    }
}
