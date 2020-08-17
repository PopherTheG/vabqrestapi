<?php

  require_once('db.php');
  require_once('../model/Content.php');
  require_once('../model/Response.php');

  // connect to database
  try {
    $writeDB = DB::connectWriteDB();
    $readDB = DB::connectReadDB();
  } catch (PDOException $ex) {
    error_log("Connection error - " . $ex, 0); // store error in PHP error log file
    $response = new Response();
    $response->setHttpStatusCode(500);
    $response->setSuccess(false);
    $response->addMessage("Database connection error");
    $response->send();
    exit;
  }

  // (check) goal route to get individual content /content.php?contentid=1
  // goal make it RESTful 

  if (array_key_exists("contentid", $_GET)) {

    $contentid = $_GET['contentid'];
    if ($contentid === '' || !is_numeric($contentid)) {
      $response = new Response();
      $response->setHttpStatusCode(400);
      $response->setSuccess(false);
      $response->addMessage("Content ID cannot be blank or not numeric");
      $response->send();
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      // get a content by contentid
      try {
        $query = $readDB->prepare('select id, set_id, sName, sSentences from tblcontent where id = :contentid'); // : this is a placeholder, this will be binded with a variable. Also stops sql injection
        $query->bindParam(':contentid', $contentid, PDO::PARAM_INT); //bind the parameter
        $query->execute();

        // chech results
        $rowCount = $query->rowCount();

        if ($rowCount === 0) {
          $response = new Response();
          $response->setHttpStatusCode(404);
          $response->setSuccess(false);
          $response->addMessage("Content not found");
          $response->send();
          exit;
        }

        $contentArray = array(); // will hold contents if there are more than one content returned
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $content = new Content($row['id'], $row['set_id'], $row['sName'], $row['sSentences']);
          $contentArray[] = $content->returnContentAsArray(); 
        }

        $returnData = array();
        $returnData['rows_returned'] = $rowCount;
        $returnData['contents'] = $contentArray;

        $response = new Response();
        $response->setHttpStatusCode(200);
        $response->setSuccess(true);
        $response->toCache(true);
        $response->setData($returnData);
        $response->send();
        exit;
      } catch (PDOException $ex) {
        error_log("Database query error - " . $ex, 0); // store error in PHP error log file
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage("Failed to get content");
        $response->send();
        exit;
      } catch (ContentException $ex) {
        $response = new Response();
        $response->setHttpStatusCode(500);
        $response->setSuccess(false);
        $response->addMessage($ex->getMessage());
        $response->send();
        exit;
      }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    } elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

    } else {
      // you can't POST in this route
      $response = new Response();
      $response->setHttpStatusCode(405);
      $response->setSuccess(false);
      $response->addMessage("Request method not allowed");
      $response->send();
      exit;
    }
  }