<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 14.01.15
 * Time: 21:19
 */
namespace Acme\BlogBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;


class PageController extends FOSRestController
{
    public function getPageAction($id)
    {
        return $this->container->get('doctrine.entity_manager')->getRepository('Page')->find($id);
    }

}
