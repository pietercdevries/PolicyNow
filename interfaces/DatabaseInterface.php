<?php

namespace interfaces;


interface IDatabase
{
    public function getDatabaseCredentials();
    public function connectDatabase();
    public function createTransaction();
    public function commitTransaction();
    public function rollbackTransaction();
    public function disconnectDatabase();
}