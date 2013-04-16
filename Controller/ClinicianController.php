<?php
// src/Codopenex/ClinicianBaseBundle/Controller/ClinicianController.php

namespace Codopenex\ClinicianBaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Codopenex\ClinicianBaseBundle\Entity\Clinician;
use Codopenex\ClinicianBaseBundle\Form\ClinicianType;
use Codopenex\ClinicianBaseBundle\Form\SearchType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

/**
 * Clinician controller 
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
     * Show a Clinician entry
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

        return $this->render('CodopenexClinicianBaseBundle:Clinician:create.html.twig', array(
            'clinician' => $clinician,
            'form'    => $form->createView()
        ));
	}
	
    /**
     * Show/edit a Clinician entry
     */
    public function editAction($id)
    {
		$request = $this->getRequest();
		
		if (is_null($id)) {
			$postData = $request->get('clinician');
			$id = $postData['id'];
    	}
		
        $em = $this->getDoctrine()->getEntityManager();

        $clinician = $em->getRepository('CodopenexClinicianBaseBundle:Clinician')->find($id);
		$form    = $this->createForm(new ClinicianType(), $clinician);
		
        if ($request->getMethod() == 'POST') {
        $form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()
                ->getEntityManager();
				$em->persist($clinician);
				$em->flush();
	
				return $this->redirect($this->generateUrl('CodopenexClinicianBaseBundle:Clinician'));
			}
		}
	
		return $this->render('CodopenexClinicianBaseBundle:Clinician:edit.html.twig', array(
			'clinician' => $clinician,
			'form' => $form->createView()
		));

    }
	
	/**
     * Show/update a Clinician entry
     */
    public function updateAction($id)
    {
		$request = $this->getRequest();
		
		if (is_null($id)) {
			$postData = $request->get('clinician');
			$id = $postData['id'];
    	}
		
        $em = $this->getDoctrine()->getEntityManager();

        $clinician = $em->getRepository('CodopenexClinicianBaseBundle:Clinician')->find($id);
		$form    = $this->createForm(new ClinicianType(), $clinician);
				
        if ($request->getMethod() == 'POST') {
        	$form->bindRequest($request);

			if ($form->isValid()) {
				$em = $this->getDoctrine()
                ->getEntityManager();
				$em->merge($clinician);
				$em->flush();
	
				return $this->redirect($this->generateUrl('CodopenexClinicianBaseBundle_clinician_edit', array('id' => $id)));
			}
		}
		
		return $this->render('CodopenexClinicianBaseBundle:Clinician:edit.html.twig', array(
			'form' => $form->createView()
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
	
	/**
     * Search for Clinicians
     */
    public function searchAction()
    {
		if($this->getRequest())
		{
			$request = $this->getRequest();
		}
		$em = $this->getDoctrine()->getEntityManager();

		$form = $this->createForm(new SearchType($em));
		
		$clinician_results = array();
		
		if ($request->getMethod() == 'POST') {
			
        	$form->bindRequest($request);

			if ($form->isValid()) {
				
				$data = $form->getData();
				
				foreach($data as $k => $v)
				{
					if($k == 'specialties')
					{
						$this->search_specialty_id = $v->getId();
					}
				}
				
				$query = $em->createQuery('SELECT c, s										   
										   FROM CodopenexClinicianBaseBundle:Clinician c 
										   JOIN c.specialties s
										   WHERE s.id = ' . $this->search_specialty_id); 

				try
				{
					$clinician_results = $query->getResult();
				} catch (\Doctrine\Orm\NoResultException $e) {
					//Handle No Result Exception here
					echo 'No Results Found Exception - ' . $e;
				}
				
				//return $this->redirect($this->generateUrl('CodopenexClinicianBaseBundle_clinician_edit', array('id' => $id)));
			}
		}
		
        return $this->render('CodopenexClinicianBaseBundle:Clinician:search.html.twig', array(
            'form' => $form->createView(),
			'clinician_results' => $clinician_results,
        ));
    }
}