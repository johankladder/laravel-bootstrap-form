<?php
/**
 * Created by PhpStorm.
 * User: johankladder
 * Date: 29-9-17
 * Time: 15:34
 */

namespace JohanKladder\BootstrapTable;


class DataProvider
{

    private $entities;

    public function __construct(array $entities)
    {
        $this->entities = $entities;
    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities;
    }


    public static function create(array $entities)
    {
        return new DataProvider($entities);
    }

}