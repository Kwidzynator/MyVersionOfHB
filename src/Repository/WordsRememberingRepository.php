<?php

namespace App\Repository;

use App\Entity\WordsRemembering;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WordsRemembering>
 */
class WordsRememberingRepository extends ServiceEntityRepository
{
    private int $drawsCount = 0;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WordsRemembering::class);
    }

    /** at first, we want player to get a lot of new words
     * then its 50/50 new word means returning null chosen one is chosen one*/
    public function randomWord(): ?string
    {
        $this->drawsCount++;
        $random = 0;
        if($this->drawsCount >= 7){
            if($random = rand(0,1) == 0){
               return $word = $this->drawing();
            }
            else{
                return null;
            }
        }
        else {
            return $word = $this->drawing();
        }
    }

    /** over here we simply prepare our words to be drew */
    private function drawing() : ?string{
        $entityManager = $this->getEntityManager();


        $rnumber = rand(1, 360);

        try {
            $query = $entityManager->createQuery(
                'SELECT w.word
                 FROM App\Entity\Words w
                 WHERE w.id = :rnumber'
            );

            $query->setParameter('rnumber', $rnumber);
            $word = $query->getSingleResult();

            return $word['word'];
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    //    /**
    //     * @return WordsRemembering[] Returns an array of WordsRemembering objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('w.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?WordsRemembering
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
