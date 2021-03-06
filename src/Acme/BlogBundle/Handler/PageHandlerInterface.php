<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 14.01.15
 * Time: 22:19
 */
namespace Acme\BlogBundle\Handler;

use Acme\BlogBundle\Model\PageInterface;

interface PageHandlerInterface
{
    /**
     * Get a Page given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return PageInterface
     */
    public function get($id);
    /**
     * Post Page, creates a new Page.
     *
     * @param array $parameters
     *
     * @return PageInterface
     */
    public function post(array $parameters);
}