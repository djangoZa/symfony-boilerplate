<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Test\Database\Gateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Metadata\Metadata;

class Ioffice extends AbstractGateway
{
    private $_dbAdapter;

    public function __construct(\Zend\Db\Adapter\Adapter $dbAdapter)
    {
        $this->_dbAdapter = $dbAdapter;
    }

    public function cleanDatabase()
    {
        $metadata = new Metadata($this->_dbAdapter);
        $tableNames = $metadata->getTableNames();
        foreach ($tableNames as $tableName) {
            $this->_dbAdapter->query("TRUNCATE TABLE `$tableName`;", Adapter::QUERY_MODE_EXECUTE);
        }
    }

    public function populateDatabaseTableWithRows($tableName, Array $rows)
    {
        foreach ($rows as $row)
        {
            $sql = new Sql($this->_dbAdapter);
            $insert = $sql->insert($tableName);
            $insert->values($row);
            $sqlString = $sql->getSqlStringForSqlObject($insert);
            $this->_dbAdapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);
        }
    }
}