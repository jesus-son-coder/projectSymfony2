<?php
namespace TechCorp\FrontBundle\Repository;

use Doctrine\ORM\EntityRepository;

class StatusRepository extends EntityRepository
{
    public function getStatusesAndUsers()
    {
        return $this->_em->createQuery('SELECT s FROM TechCorpFrontBundle:Status s');
    }
}

