<?php
// src/Codopenex/ClinicianBaseBundle/Controller/PageController.php

namespace Codopenex\ClinicianBaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Import new namespaces
//use Xperedon\BlogBundle\Entity\Enquiry;
//use Xperedon\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{	
	public function dashboardAction()
    {
        return $this->render('CodopenexClinicianBaseBundle:Page:dashboard.html.twig');
    }
}