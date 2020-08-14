<?php

  // structure for the responses
  class Response {
    private $_success;
    private $_httpStatusCode;
    private $_messages = array(); // optional
    private $_data; // optional
    private $_toCache = false;
    private $_responseData = array();

    // set to true or false
    public function setSuccess($success) {
      $this->_success = $success;
    }

    // set to any http status code
    public function setHttpStatusCode($httpStatusCode) {
      $this->_httpStatusCode = $httpStatusCode;
    }

    // add any string message
    public function addMessage($message) {
      $this->_messages[] = $message;
    }

    // add any data
    public function setData($data) {
      $this->_data = $data;
    }

    // set to true or false
    public function toCache($toCache) {
      $this->_toCache = $toCache;
    }

    public function send() {
      header('Content-type: application/json;charset=utf-8');
      
      if ($this->_toCache == true) {
        // if user wants to cache the response, cache it for 60 seconds
        header('Cache-control: max-age=60');
      } else {
        header('Cache-control: no-cache, no-store');
      }

      if (($this->_success !== false && $this->_success !== true) || (!is_numeric($this->_httpStatusCode))) {
        // if _success and _httpStatusCode variable is of invalid value.
        http_response_code(500);
        
        // build reponse
        $this->_responseData['statusCode'] = 500;
        $this->_responseData['success'] = false;
        $this->addMessage('Response creaetion error');
        $this->_responseData['messages'] = $this->_messages;
      } else {
        http_response_code($this->_httpStatusCode);
        
        //build response
        $this->_responseData['statusCode'] = $this->_httpStatusCode;
        $this->_responseData['success'] = $this->_success;
        $this->_responseData['messages'] = $this->_messages;
        $this->_responseData['data'] = $this->_data;
      }

      //return it to browser as JSON
      echo json_encode($this->_responseData);
    }
  }