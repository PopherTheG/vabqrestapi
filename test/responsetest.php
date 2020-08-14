<?php

  require_once('../model/Response.php');

  $response = new Response();
  $response->setSuccess(true);
  $response->setHttpStatusCode(201);
  $response->addMessage("Test Message 1");
  $response->send();
  exit;