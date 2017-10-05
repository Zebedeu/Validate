<?php

/**
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * Copyright (c) 2017.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace Validate;


use Ballybran\Exception\Exception;

class Validate extends ValidateTypes
{


    /** @var array $_currentItem The immediately posted item */
    private $_currentItem = null;

    /** @var array $_postData Stores the Posted Data */
    private $_postData = array ();

    /** @var object $_val The validator object */
    private $_val = array ();

    /** @var array $_error Holds the current forms errors */
    private $_error = array ();

    /** @var string $_method The Method POST, GET and PUT for form */
    private $_method;

    private  $theValue;
    private  $theType;
    private  $theDefinedValue;
    private  $theNotDefinedValue;

    /**
     * __construct - Instantiates the validator class
     *
     */
    public function __construct()
    {
        $this->_val = new Val();

    }

    public function getMethod()
    {
        $this->_method;
    }

    /**
     * @param mixed $method
     * @return Validate
     */
    public function setMethod($method)
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * post - This is to run $_POST or GET
     *
     * @param string $field - The HTML fieldname to post
     */
    public function post($field, $theType = null, $theDefinedValue = "", $theNotDefinedValue = "")
    {
       // $this->theType = $theType;
       // $this->theDefinedValue = $theDefinedValue;
       // $this->theNotDefinedValue = $theNotDefinedValue;
        if ($this->_method == "POST") {

            $this->_postData[$field] = $_POST[$field];
            $this->_currentItem = $field;

        }

        if ($this->_method == "GET") {

            $this->_postData[$field] = $_GET[$field];
            $this->_currentItem = $field;
        }

        if ($this->_method == "COOKIE") {

            $this->_postData[$field] = $_COOKIE[$field];
            $this->_currentItem = $field;
        }
        return $this;
    }

    /**
     * getPostDate - Return the posted data
     *
     * @param mixed $fieldName
     *
     * @return mixed String or array
     */

    public function getPostData($fieldName = false)
    {
        if( $this->is_validLength() ) {
            return false;
        }
        if ($fieldName)
        {
            if (isset($this->_postData[$fieldName]))
                return $this->_postData[$fieldName];

            else
                return false;
        }
        else 
        {
            
            return $this->_postData;
        }

    }

    /**
     * val - This is to validate
     *
     * @param string $typeOfValidator A method from the Form/Val class
     * @param string $arg A property to validate against
     */
    public function val($typeOfValidator, $arg = null)
    {
        if (! $arg == null && $this->_val instanceof val )
            $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);
        else
        $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);

        if ($error)
            $this->_error[$this->_currentItem] = $error;

        return $this;
    }
    
     /**
     * is_valid method
     *
     * @return boolean
     *
     * @throws Exception
     */
    public function is_validLength() : bool {

        if(! empty($this->_error)) {
            return true;
        }else {
            return false;
        }

    }
    /**
     * submit - Handles the form, and throws an exception upon error.
     *
     * @return boolean
     *
     * @throws Exception
     */

    public function is_validTypes(): bool {

        if(! empty(self::getSQLValueString($this->_postData , $this->theType, $this->theDefinedValue, $this->theNotDefinedValue ) ) )  {
            return true;
        } else {
            return false;
        }
        return $this;
    }

    /**
     * submit - Handles the form, and throws an exception upon error.
     *
     * @return boolean
     *
     * @throws Exception
     */
    public function submit()
    {
        if (empty($this->_error))
        {
            return true;
        }
        else
        {
            $str = '';
            foreach ($this->_error as $key => $value)
            {
                $str .= $key . ' => ' . $value . "\n";
            }

            echo("Error Processing Request $str");
            
        }
    }

}