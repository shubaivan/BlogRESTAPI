<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 14.01.15
 * Time: 22:18
 */
namespace Acme\BlogBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Acme\BlogBundle\Handler\PageHandlerInterface;


class PageHandler implements PageHandlerInterface

{
    // ..
    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
    }

    // ...
    public function get($id)
    {
        return $this->repository->find($id);
    }
}