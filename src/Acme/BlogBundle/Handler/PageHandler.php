<?php
namespace Acme\BlogBundle\Handler;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Acme\BlogBundle\Model\PageInterface;
use Acme\BlogBundle\Form\PageType;
use Acme\BlogBundle\Exception\InvalidFormException;
class PageHandler implements PageHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;
    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }
    /**
     * Get a list of Pages.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0, $orderby = null)
    {
        return $this->repository->findBy(array(), $orderby, $limit, $offset);
    }
    /**
     * Get a Page.
     *
     * @param mixed $id
     *
     * @return PageInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }
    /**
     * Create a new Page.
     *
     * @param array $parameters
     *
     * @return PageInterface
     */
    public function post(array $parameters)
    {
        $page = $this->createPage();
        return $this->processForm($page, $parameters, 'POST');
    }
    /**
     * Processes the form.
     *
     * @param PageInterface $page
     * @param array $parameters
     * @param String $method
     *
     * @return PageInterface
     *
     * @throws \Acme\BlogBundle\Exception\InvalidFormException
     */
    private function processForm(PageInterface $page, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new PageType(), $page, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {
            $page = $form->getData();
            $this->om->persist($page);
            $this->om->flush($page);
            return $page;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    private function createPage()
    {
        return new $this->entityClass();
    }
}