<?php

/**
 *
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2016.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 *
 */


use Ballybran\Helpers\Routing\Routes;

ini_set('display_errors', 1);
error_reporting(E_ALL);

// require_once "Ballybran/Config/config.php";
// require_once "Ballybran/Config/autoload.php";

require 'vendor/knut7/framework/src/Ballybran/Config/Config.php';
require 'vendor/autoload.php';

/**
 *
 * Load the Bootstrap!
 *
 */

Routes::route();