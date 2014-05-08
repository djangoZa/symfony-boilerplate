<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Test\Database\Gateway;

abstract class AbstractGateway
{
    abstract public function cleanDatabase();
    abstract public function populateDatabaseTableWithRows($tableName, Array $rows);
}