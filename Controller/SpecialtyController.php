<?php
// src/Codopenex/ClinicianBaseBundle/Controller/SpecialtyController.php

namespace Codopenex\ClinicianBaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Codopenex\ClinicianBaseBundle\Entity\Specialty;
use Codopenex\ClinicianBaseBundle\Form\SpecialtyType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

/**
 * Specialty controller.
 */
class SpecialtyController extends Controller
{
	/**
     * Make form for new Specialty
     */
	public function newAction()
    {
		$specialty = new Specialty();
		
		$form   = $this->createForm(new SpecialtyType(), $specialty);
		
		return $this->render('CodopenexClinicianBaseBundle:Specialty:form.html.twig', array(
            'specialty' => $specialty,
            'form'   => $form->createView()
        ));	
	}
	
	/**
     * Show a Specialty entry
     */
	public function createAction()
    {
        $specialty  = new Specialty();
        $request = $this->getRequest();
        $form    = $this->createForm(new SpecialtyType(), $specialty);
        $form->bindRequest($request);
		
		if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($specialty);
            $em->flush();


            return $this->redirect($this->generateUrl('CodopenexClinicianBaseBundle_specialties', array()));
        }

        return $this->render('CodopenexClinicianBaseBundle:Specialty:create.html.twig', array(
            'specialty' => $specialty,
            'form'    => $form->createView()
        ));
	}
	
    /**
     * Show a Specialty entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $specialty = $em->getRepository('CodopenexClinicianBaseBundle:Specialty')->find($id);

        if (!$specialty) {
            throw $this->createNotFoundException('Unable to find Specialty.');
        }

        return $this->render('CodopenexClinicianBaseBundle:Specialty:show.html.twig', array(
            'specialty'      => $specialty
        ));
    }
	
	/**
     * Show All Specialties
     */
    public function specialtiesAction()
    {
		$request = $this->getRequest();
    	$page = $request->query->get('page'); // get a $_GET parameter
		
		$specialties = $this->getSpecialtiesRepo($page);
		
        return $this->render('CodopenexClinicianBaseBundle:Specialty:specialties.html.twig', array(
            'specialties'      => $specialties
        ));
    }
	
	/**
     * Get Specialties from repository and return pagerfanta object
     */
	private function getSpecialtiesRepo($page = NULL)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$specialties = $em->getRepository('CodopenexClinicianBaseBundle:Specialty')->getSpecialties();
		
		//Needs rethink as throws not found if there are no Specialties
        //if (!$specialties) {
            //throw $this->createNotFoundException('Unable to find Specialties.');
        //}
		
		$adapter = new ArrayAdapter($specialties);
		$pagerfanta = new Pagerfanta($adapter);
		$pagerfanta->setMaxPerPage(3);    // We fix the number of results to 3 in each page.

		// if $page doesn't exist, we fix it to 1
		if(!$page)
		{
			$page = 1;
		}

		try
		{
			$pagerfanta->setCurrentPage($page);
		}
		catch (NotValidCurrentPageException $e)
		{
			throw new NotFoundHttpException();
		}
		
		// return pagerfanta to specialtiesAction
		return $pagerfanta;		
	}
}