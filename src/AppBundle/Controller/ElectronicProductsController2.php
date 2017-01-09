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
    $singleresult = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);
    if ($singleresult === null) {
    return new View("no products found", Response::HTTP_NOT_FOUND);
    }
    return $singleresult;
  }

  /**
  * @Rest\Get("/products")
  */
  public function getAction()
  {
    $restresult = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
    if ($restresult === null) {
      return new View("no products listed", Response::HTTP_NOT_FOUND);
    }
    return $restresult;
  }

  /**
  * @Rest\Post("/product/")
  */
  public function postAction(Request $request)
  {
    $category = new Category();
    $category->setName($request->get('category'));

    $product = new Product;
    $name = $request->get('name');
    $sku = $request->get('sku');
    $price = $request->get('price');
    $quantity = $request->get('quantity');
    $created_at = new\DateTime('now');

    if(empty($name) || empty($category) || empty($sku) || empty($price) || empty($quantity))
    {
     return new View("empty fields not allowed", Response::HTTP_NOT_ACCEPTABLE);
    }
    $product->setName($name);
    $product->setCategory($category);
    $product->setSku($sku);
    $product->setPrice($price);
    $product->setQuantity($quantity);
    $product->setCreatedAt($created_at);

    $em = $this->getDoctrine()->getManager();
    $em->persist($category);
    $em->persist($product);
    $em->flush();

    return new View("Product Added", Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/product/{id}")
  */
  public function updateAction($id,Request $request)
  {
    $name = $request->get('name');
    $sku = $request->get('sku');
    $price = $request->get('price');
    $quantity = $request->get('quantity');
    $modified_at = new\DateTime('now');
    $category = new Category();
    $category->setName($request->get('category'));
    $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);
    $em = $this->getDoctrine()->getManager();
    if (empty($product)) {
      return new View("product not found", Response::HTTP_NOT_FOUND);
    }else{
      $product->setName($name);
      $product->setCategory($category);
      $product->setSku($sku);
      $product->setPrice($price);
      $product->setQuantity($quantity);
      $product->setCreatedAt($modified_at);
      $em->persist($category);

      $em->flush();
      return new View("Product Updated", Response::HTTP_OK);
    }
    return new View("Product not updated", Response::HTTP_NOT_ACCEPTABLE);
  }

  /**
  * @Rest\Delete("/product/{id}")
  */
  public function deleteAction($id)
  {
    $data = new Product;
    $em = $this->getDoctrine()->getManager();
    $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);
    if (empty($product)) {
      return new View("product not found", Response::HTTP_NOT_FOUND);
    }else {
      $em->remove($product);
      $em->flush();
    }
    return new View("product deleted successfully", Response::HTTP_OK);
  }
}
