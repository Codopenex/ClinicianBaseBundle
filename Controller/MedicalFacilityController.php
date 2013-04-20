<?php
// src/Codopenex/ClinicianBaseBundle/Controller/MedicalFacilityController.php

namespace Codopenex\ClinicianBaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Codopenex\ClinicianBaseBundle\Entity\MedicalFacility;
use Codopenex\ClinicianBaseBundle\Form\MedicalFacilityType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

/**
 * MedicalFacility controller.
 */
class MedicalFacilityController extends Controller
{
	/**
     * Make form for new MedicalFacility
     */
	public function newAction()
    {
		$medical_facility = new MedicalFacility();
		
		$form   = $this->createForm(new MedicalFacilityType(), $medical_facility);
		
		return $this->render('CodopenexClinicianBaseBundle:MedicalFacility:form.html.twig', array(
            'medical_facility' => $medical_facility,
            'form'   => $form->createView()
        ));	
	}
	
	/**
     * Show a MedicalFacility entry
     */
	public function createAction()
    {
        $medical_facility  = new MedicalFacility();
        $request = $this->getRequest();
        $form    = $this->createForm(new MedicalFacilityType(), $medical_facility);
        $form->bindRequest($request);
		
		if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($medical_facility);
            $em->flush();


            return $this->redirect($this->generateUrl('CodopenexClinicianBaseBundle_medical_facilities', array()));
        }

        return $this->render('CodopenexClinicianBaseBundle:MedicalFacility:create.html.twig', array(
            'medical_facility' => $medical_facility,
            'form'    => $form->createView()
        ));
	}
	
    /**
     * Show a MedicalFacility entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $medical_facility = $em->getRepository('CodopenexClinicianBaseBundle:MedicalFacility')->find($id);

        if (!$medical_facility) {
            throw $this->createNotFoundException('Unable to find Medical Facility.');
        }

        return $this->render('CodopenexClinicianBaseBundle:MedicalFacility:show.html.twig', array(
            'medical_facility'      => $medical_facility
        ));
    }
	
	/**
     * Show All Medical Facilities
     */
    public function medical_facilitiesAction()
    {
		$request = $this->getRequest();
    	$page = $request->query->get('page'); // get a $_GET parameter
		
		$medical_facilities = $this->getMedicalFacilitiesRepo($page);
		
        return $this->render('CodopenexClinicianBaseBundle:MedicalFacility:medical_facilities.html.twig', array(
            'medical_facilities'      => $medical_facilities
        ));
    }
	
	/**
     * Get Medical Facilities from repository and return pagerfanta object
     */
	private function getMedicalFacilitiesRepo($page = NULL)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$medical_facilities = $em->getRepository('CodopenexClinicianBaseBundle:MedicalFacility')->getMedicalFacilities();
		
		//Needs rethink as throws not found if there are no Medical Facilities
        //if (!$medical_facilities) {
            //throw $this->createNotFoundException('Unable to find Medical Facilities.');
        //}
		
		$adapter = new ArrayAdapter($medical_facilities);
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
		
		// return pagerfanta to medical_facilitiesAction
		return $pagerfanta;		
	}
}