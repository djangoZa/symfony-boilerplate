<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\User;
use Zend\Db\Sql\Sql;

class Gateway
{
    private $_dbAdapter;

    public function __construct(\Zend\Db\Adapter\Adapter $dbAdapter)
    {
        $this->_dbAdapter = $dbAdapter;
    }

    public function getUser(Array $options)
    {
        $sql = new Sql($this->_dbAdapter);
        $select = $sql->select();
        $select->from('users');
        $select->where($options);
        $select->limit(1);

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $row = $results->current();

        return $row;
    }
}