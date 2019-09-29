<?php namespace controllers;

require_once( dirname( __DIR__ ).'/DAL/databaseConnection.php' );

use databaseConnection;
use interfaces\IDatabase;
use mysqli;

class databaseController implements IDatabase {

    private mysqli $connection;
    private databaseConnection $databaseConnection;

    public function getDatabaseCredentials()
    {
        $databaseConnection = new databaseConnection();
    }

    public function connectDatabase()
    {
        // Create connection
        $this->connection = new mysqli( $this->databaseConnection->DatabaseHost, $this->databaseConnection->DatabaseUsername, $this->databaseConnection->DatabasePassword );

        // Remove sensitive data from memory
        unset( $this->databaseConnection->DatabaseUsername );
        unset( $this->databaseConnection->DatabasePassword );
        unset( $this->databaseConnection->DatabaseHost );

        // Check connection
        if ( $this->connection->connect_error )
        {
            die( "Connection failed: ".$this->connection->connect_error );
        }
    }

    public function createTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commitTransaction()
    {
        $this->connection->commit();
    }

    public function rollbackTransaction()
    {
        $this->connection->rollback();
    }

    public function disconnectDatabase()
    {
        $this->connection->close();
        unset( $databaseConnection );
    }
}