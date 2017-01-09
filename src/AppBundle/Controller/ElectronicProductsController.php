<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ElectronicProductsController
 * @package AppBundle\Controller
 */
class ElectronicProductsController extends FOSRestController implements ClassResourceInterface
{
  /**
  * @Rest\Get("/product/{id}")
  */
  public function idAction($id)
  {
    $container = $this->get('app.product_entity_repository');
    $product = $container->createFindOneByIdQuery($id)->getSingleResult();
    if ($product === null) {
      return new View("product not found", Response::HTTP_NOT_FOUND);
    }
    return $product;
  }
}
