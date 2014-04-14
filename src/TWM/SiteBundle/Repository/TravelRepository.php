<?php
/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TravelRepository
 * @package TWM\SiteBundle\Repository
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class TravelRepository extends EntityRepository
{

    /**
     * Gets the travels which are ongoing
     *
     * @return array
     */
    public function findOngoingTravels()
    {
        $now = new \DateTime();
        $now->setTime(0, 0);

        $query = $this
            ->createQueryBuilder('t')
            ->where('t.startedAt <= :date')
            ->andWhere('t.finishedAt >= :date')
            ->setParameter('date', $now)
            ->getQuery()
        ;

        return $query->getArrayResult();
    }
}
