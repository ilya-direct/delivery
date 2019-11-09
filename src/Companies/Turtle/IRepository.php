<?php


namespace Delivery\Companies\Turtle;


interface IRepository
{
    /**
     * @return float
     * @throws RepositoryException
     */
    public function getBasePrice(): float ;
}
