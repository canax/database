<?php

namespace Anax\Database;

use \Anax\Common\ConfigureInterface;
use \Anax\Common\ConfigureTrait;
use \Anax\Database\Exception\BuildException;
use \Anax\Database\QueryBuilderTrait;

/**
 * Build SQL queries by method calling.
 */
class DatabaseQueryBuilder extends Database implements ConfigureInterface
{
    use QueryBuilderTrait,
        ConfigureTrait {
        configure as protected loadConfiguration;
    }



    /**
     * Constructor creating a PDO object connecting to a choosen database.
     *
     * @param array $options containing details for connecting to the database.
     */
    public function __construct($options = [])
    {
        parent::__construct($options);
        $this->setDefaultsFromConfiguration();
    }



    /**
     * Load and apply configurations.
     *
     * @param array|string $what is an array with key/value config options
     *                           or a file to be included which returns such
     *                           an array.
     *
     * @return void
     */
    public function configure($what)
    {
        $this->loadConfiguration($what);
        parent::setOptions($this->config);
        $this->setDefaultsFromConfiguration();
    }



    /**
     * Update builder settings from active configuration.
     *
     * @return void
     */
    private function setDefaultsFromConfiguration()
    {
        if ($this->options['dsn']) {
            $dsn = explode(':', $this->options['dsn']);
            $this->setSQLDialect($dsn[0]);
        }

        $this->setTablePrefix($this->options['table_prefix']);
    }



    /**
     * Execute a SQL-query and ignore the resultset.
     *
     * @param string $query  the SQL statement
     * @param array  $params the params array
     *
     * @return boolean returns TRUE on success or FALSE on failure.
     */
    public function execute($query = null, $params = [])
    {
        if (is_array($query)) {
            $params = $query;
            $query = null;
        }

        if (!$query) {
            $query = $this->getSQL();
        }

        var_dump($query);
        var_dump($params);

        return parent::execute($query, $params);
    }
}
