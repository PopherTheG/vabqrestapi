<?php
  // controller for connecting to database

  class DB {
    // two connections for handling database load (setting: one database for reading, another for writing)
    private static $writeDBConnection;
    private static $readDBConnection;

    public static function connectWriteDB() {
      // connect only if there is NO connection
      if (self::$writeDBConnection === null) {
        self::$writeDBConnection = new PDO('mysql:host=localhost;dbname=esldb;charset=utf8', 'root', '');
        self::$writeDBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$writeDBConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
      }

      return self::$writeDBConnection;
    }

    public static function connectReadDB() {
      // connect only if there is NO connection
      if (self::$readDBConnection === null) {
        self::$readDBConnection = new PDO('mysql:host=localhost;dbname=esldb;charset=utf8', 'root', '');
        self::$readDBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$readDBConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
      }

      return self::$readDBConnection;
    }

  }