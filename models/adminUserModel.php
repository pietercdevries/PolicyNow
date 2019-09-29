<?php

use \interfaces\IDatabase;

class adminUserModel implements IDatabase{

    public function connectDatabase($host, $user, $password)
    {
        // TODO: Implement connectDatabase() method.
    }

    public function createTransaction($transactionName)
    {
        // TODO: Implement createTransaction() method.
    }

    public function commitTransaction($transactionName)
    {
        // TODO: Implement commitTransaction() method.
    }

    public function rollbackTransaction($transactionName)
    {
        // TODO: Implement rollbackTransaction() method.
    }

    public function closeTransaction($transactionName)
    {
        // TODO: Implement closeTransaction() method.
    }

    public function disconnectDatabase()
    {
        // TODO: Implement disconnectDatabase() method.
    }

    public function getDatabaseCredentials()
    {
        // TODO: Implement getDatabaseCredentials() method.
    }
}