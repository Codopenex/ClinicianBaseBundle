<?php
// src/Codopenex/ClinicianBaseBundle/Repository/ClinicianRepository.php

namespace Codopenex\ClinicianBaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ClinicianRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom !ACTUALLY IT WASN'T - NEED TO LOOK INTO WHY DOCTRINE NOT GENERATING!
 * repository methods below.
 */
class ClinicianRepository extends EntityRepository
{
	public function getClinicians()
	{
		$clinicians = $this->createQueryBuilder('c')
						 ->select('c')
						 ->getQuery()
						 ->getResult();
	
		return $clinicians;
	}
	
}