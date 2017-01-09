<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/", name="product_list")
     */
    public function listAction()
    {
      $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
      return $this->render('product/index.html.twig', $arrayName = array('products' => $products));
    }

    /**
     * @Route("/product/create", name="product_create")
     */
    public function createAction(Request $request)
    {
        $product = new Product;
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $name = $form['name']->getData();
          $category = $form['category']->getData();
          $sku = $form['sku']->getData();
          $price = $form['price']->getData();
          $quantity = $form['quantity']->getData();
          $created_at = new\DateTime('now');

          $product->setName($name);
          $product->setCategory($category);
          $product->setSku($sku);
          $product->setPrice($price);
          $product->setQuantity($quantity);
          $product->setCreatedAt($created_at);

          $em = $this->getDoctrine()->getManager();
          $em->persist($product);
          $em->flush();
          $this->addFlash('notice','Product Added');
          return $this->redirectToRoute('product_list');
        }
        return $this->render('product/create.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/product/edit/{id}", name="product_edit")
     */
    public function editAction($id, Request $request)
    {
      $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);

      $product->setName($product->getName());
      $product->setCategory($product->getCategory());
      $product->setSku($product->getSku());
      $product->setPrice($product->getPrice());
      $product->setQuantity($product->getQuantity());

      $form = $this->createForm(ProductType::class, $product);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
        $name = $form['name']->getData();
        $category = $form['category']->getData();
        $sku = $form['sku']->getData();
        $price = $form['price']->getData();
        $quantity = $form['quantity']->getData();
        $modified_at = new\DateTime('now');

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);

        $product->setName($name);
        $product->setCategory($category);
        $product->setSku($sku);
        $product->setPrice($price);
        $product->setQuantity($quantity);
        $product->setModifiedAt($modified_at);

        $em->flush();
        $this->addFlash('notice','Product Updated');
        return $this->redirectToRoute('product_list');
      }

      return $this->render('product/edit.html.twig', $arrayName = array('product' => $product, 'form' => $form->createView()));
    }

    /**
     * @Route("/product/delete/{id}", name="product_delete")
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);
        if($product === null){
          return $this->redirectToRoute('product_list');
        }
        $em->remove($product);
        $em->flush();
        $this->addFlash('notice','Produce Removed');
        return $this->redirectToRoute('product_list');
    }

    /**
     * @Route("/product/details/{id}", name="product_details")
     */
    public function detailsAction($id)
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);
        return $this->render('product/details.html.twig', $arrayName = array('product' => $product));
    }
}
