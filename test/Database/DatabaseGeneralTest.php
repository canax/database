<?php

namespace Anax\Database;

use PHPUnit\Framework\TestCase;

/**
* Test the database class, general tests.
*/
class DatabaseGeneralTest extends TestCase
{
    /**
     * Test create the database object.
     */
    public function testCreateDatabaseObject()
    {
        $db = new Database();
        $this->assertInstanceOf(Database::class, $db);
    }
}
