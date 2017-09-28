<?php

namespace AppBundle\Entity\Repository;
use Doctrine\ORM\EntityRepository;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VbaPostRepository
 *
 * @author Luis Miguens <lmiguens@consolidador.com>
 */
class VbaPostRepository extends EntityRepository {
    //put your code here
    
     // Partial
    public function findPostsPartial($limit = 6, $offset = 0) {

        return $this->getEntityManager()->createQuery(
                                'SELECT p
                FROM AppBundle:VbaPost p
                ORDER BY p.createdAt DESC')
                        ->setMaxResults($limit)->setFirstResult($offset)->getResult();
    }
}
