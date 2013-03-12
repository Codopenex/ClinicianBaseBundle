<?php
// src/Codopenex/ClinicianBaseBundle/Controller/ClinicianController.php

namespace Codopenex\ClinicianBaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Codopenex\ClinicianBaseBundle\Entity\Clinician;
use Codopenex\ClinicianBaseBundle\Form\ClinicianType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

/**
 * ClinicianBase controller.
 */
class ClinicianController extends Controller
{
	/**
     * Make form for new clinician
     */
	public function newAction()
    {
		$clinician = new Clinician();
		
		$form   = $this->createForm(new ClinicianType(), $clinician);
		
		return $this->render('CodopenexClinicianBaseBundle:Clinician:form.html.twig', array(
            'clinician' => $clinician,
            'form'   => $form->createView()
        ));	
	}
	
	/**
     * Show a ClinicianBase entry
     */
	public function createAction()
    {
        $clinician  = new Clinician();
        $request = $this->getRequest();
        $form    = $this->createForm(new ClinicianType(), $clinician);
        $form->bindRequest($request);
		
		if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($clinician);
            $em->flush();


            return $this->redirect($this->generateUrl('CodopenexClinicianBaseBundle_clinicians', array()));
        }

        return $this->render('CodopenexClinicianBaseBundle:Clinicians:create.html.twig', array(
            'clinician' => $clinician,
            'form'    => $form->createView()
        ));
	}
	
    /**
     * Show a ClinicianBase entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $clinician = $em->getRepository('CodopenexClinicianBaseBundle:Clinician')->find($id);

        if (!$clinician) {
            throw $this->createNotFoundException('Unable to find Clinician.');
        }

        return $this->render('CodopenexClinicianBaseBundle:Clinician:show.html.twig', array(
            'clinician'      => $clinician
        ));
    }
	
	/**
     * Show All Clinicians
     */
    public function cliniciansAction()
    {
		$request = $this->getRequest();
    	$page = $request->query->get('page'); // get a $_GET parameter
		
		$clinicians = $this->getCliniciansRepo($page);
		
        return $this->render('CodopenexClinicianBaseBundle:Clinician:clinicians.html.twig', array(
            'clinicians'      => $clinicians
        ));
    }
	
	/**
     * Get Clinicians from repository and return pagerfanta object
     */
	private function getCliniciansRepo($page = NULL)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$clinicians = $em->getRepository('CodopenexClinicianBaseBundle:Clinician')->getClinicians();
		
		//Needs rethink as throws not found if there are no Clinicians
        //if (!$clinicians) {
            //throw $this->createNotFoundException('Unable to find Clinicians.');
        //}
		
		$adapter = new ArrayAdapter($clinicians);
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
		
		// return pagerfanta to cliniciansAction
		return $pagerfanta;		
	}
}