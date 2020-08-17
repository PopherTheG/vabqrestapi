<?php 

  require_once('Response.php');

  class ContentException extends Exception { }

  class Content {
    private $_id;
    private $_setID;
    private $_sName;
    private $_sSentences;
    // private $_decomposedSSentences = array(); // holds an array of sentence

    public function __construct($id, $setID, $sName, $sSentences) {
      $this->setID($id);
      $this->setSetID($setID);
      $this->setSName($sName);
      $this->setSSentences($sSentences);
    }

    public function getID() {
      return $this->_id;
    }

    public function getSetID() {
      return $this->_setID;
    }

    public function getSName() {
      return $this->_sName;
    }

    public function getSSentences() {
      return $this->_sSentences;
    }
    
    public function setID($id) {
      // throw error if id is null and is not not in range of INT data type
      if ($id === null || !is_numeric($id) || $id <= 0 || $id > 4294967295) {
        throw new ContentException("Content ID error");
      }

      $this->_id = $id;
    }

    public function setSetID($setID) {
      // throw error if setID is null and is not not in range of INT data type
      if ($setID === null || !is_numeric($setID) || $setID <= 0 || $setID > 4294967295) {
        throw new ContentException("Content set ID error");
      }

      $this->_setID = $setID;

    }

    public function setSName($sName) {
      // throw error if sName is not in range of TEXT data type character limit
      if ($sName === null || strlen($sName) < 0 || strlen($sName > 65535)) {
        throw new ContentException("Content sName error");
      }

      $this->_sName = $sName;
    }

    public function setSSentences($sSentences) {
      // throw error if sName is not in range of TEXT data type character limit
      if ($sSentences === null || strlen($sSentences) < 0 || strlen($sSentences > 16777215)) {
        throw new ContentException("Content sSentences error");
      }

      $this->_sSentences = $sSentences;
    }


    // helper methods


    public function decomposedSSentences() {
      $sentences = $this->getSSentences(); // get long string of sentences.Sentences are demilited by '|||'
      $sentencesArray = explode("|||", $sentences);
      $sentenceArray = array();
      /* 
        0 -> sentenceID
        1 -> dialogueConversation
        2 -> speaker
        3 -> englishText
        4 -> koreanText
        5 -> timeMarking
      */
      foreach($sentencesArray as $sentence) {
        $sentenceComponents = explode("||", $sentence);
        // $sentenceComponentsClean = str_replace("\r\n", "", $sentenceComponents);
        // $sentenceComponentsCleaner = str_replace("\\", "", $sentenceComponentsClean);
        $sentenceArray[] = [
          'sentenceID' => str_replace("\r\n  ", "", $sentenceComponents[0]),
          'dialogueConversation' => $sentenceComponents[1],
          'speaker' => $sentenceComponents[2],
          'englishText' => $sentenceComponents[3],
          'koreanText' => $sentenceComponents[4],
          'timeMarking' => $sentenceComponents[5],
        ];
      }
      return $sentenceArray;
    }

    // helper method to convert to array so it can be easily formatted to JSON
    public function returnContentAsArray() {
      $content = [
        'id' => $this->getID(),
        'setID' => $this->getSetID(),
        'sName' => $this->getSName(),
        'sSentences' => $this->decomposedSSentences()
      ];

      return $content;
    }
  }