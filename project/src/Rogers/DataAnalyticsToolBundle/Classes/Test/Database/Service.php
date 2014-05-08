<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Test\Database;

class Service
{
    private $_repository;

    public function __construct(Repository $repository)
    {
        $this->_repository = $repository;
    }

    public function cleanDatabase($databaseName)
    {
        $this->_repository->cleanDatabase($databaseName);
    }

    public function populateDatabaseTableWithRows($databaseName, $tableName, Array $rows)
    {
        $this->_repository->populateDatabaseTableWithRows($databaseName, $tableName, $rows);
    }
}