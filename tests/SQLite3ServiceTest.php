<?php

/**
 * Created by PhpStorm.
 * User: ralphy
 * Date: 16/05/17
 * Time: 21:46
 */
class SQLite3ServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * tests simples portant sur une connexion en mémoire
     * et quelques opération arithmétique
     */
    public function testConnectionMemory() {
        $cnx = new \Services\SQLite3Service();
        $cnx->config(array(
            'file' => ':memory:'
        ));
        $result = $cnx->query('select 1 + 1 as "x"');
        $this->assertEquals(2, (int) $result[0]['x']);
        $result = $cnx->query('select 4 * 1000 as "x"');
        $this->assertEquals(4000, (int) $result[0]['x']);
        $result = $cnx->query('select 1 - 1 as "x", 5 / 2 as "y"');
        $this->assertEquals(0, (int) $result[0]['x']);
        $this->assertEquals(2, (int) $result[0]['y']);
    }

    public function testBindings() {
        $cnx = new \Services\SQLite3Service();
        $cnx->config(array(
            'file' => ':memory:'
        ));
        $result = $cnx->query('select :a + :b as "x"', array(
            'a' => 5,
            'b' => 6
        ));
        $this->assertEquals(11, (int) $result[0]['x']);
    }
}