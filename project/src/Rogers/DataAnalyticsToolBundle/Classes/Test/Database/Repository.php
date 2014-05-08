<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Test\Database;

class Repository
{
    protected $_iOfficeGateway;

    public function __construct(Gateway\Ioffice $iOfficeGateway)
    {
        $this->_iOfficeGateway = $iOfficeGateway;
    }

    public function cleanDatabase($databaseName)
    {
        switch ($databaseName) {
            case 'ioffice':
                $this->_iOfficeGateway->cleanDatabase();
                break;
            default:
                throw new \Exception("$databaseName database does not exist and therefore cannot be cleaned");
        }
    }

    public function populateDatabaseTableWithRows($databaseName, $tableName, Array $rows)
    {
        switch ($databaseName) {
            case 'ioffice':
                $this->_iOfficeGateway->populateDatabaseTableWithRows($tableName, $rows);
                break;
            default:
                throw new \Exception("$databaseName database does not exist and therefore could not be populated");
        }
    }
}