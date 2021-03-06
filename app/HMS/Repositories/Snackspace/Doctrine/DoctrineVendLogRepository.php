<?php

namespace HMS\Repositories\Snackspace\Doctrine;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\EntityRepository;
use HMS\Entities\Snackspace\VendLog;
use HMS\Entities\Snackspace\VendingMachine;
use HMS\Entities\Snackspace\TransactionState;
use HMS\Repositories\Snackspace\VendLogRepository;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;

class DoctrineVendLogRepository extends EntityRepository implements VendLogRepository
{
    use PaginatesFromRequest;

    /**
     * Save VendLog to the DB.
     *
     * @param VendLog $vendLog
     */
    public function save(VendLog $vendLog)
    {
        $this->_em->persist($vendLog);
        $this->_em->flush();
    }

    /**
     * Paginate logs for a Machine.
     * Ordered by id DESC.
     *
     * @param VendingMachine $vendingMachine
     * @param int $perPage
     * @param string $pageName
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateByVendingMachine(VendingMachine $vendingMachine, $perPage = 15, $pageName = 'page')
    {
        $q = parent::createQueryBuilder('vendLog')
            ->where('vendLog.vendingMachine = :vendingMachine_id')
            ->orderBy('vendLog.id', 'DESC');

        $q = $q->setParameter('vendingMachine_id', $vendingMachine->getId())->getQuery();

        return $this->paginate($q, $perPage, $pageName);
    }

    /**
     * Paginate logs for a Machine where the transaction is pending.
     * Ordered by id DESC.
     *
     * @param VendingMachine $vendingMachine
     * @param int $perPage
     * @param string $pageName
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginatePeningByVendingMachine(VendingMachine $vendingMachine, $perPage = 15, $pageName = 'page')
    {
        $q = parent::createQueryBuilder('vendLog')
            ->innerJoin('vendLog.transaction', 'transaction', Join::WITH, 'transaction.status = :transaction_state')->addSelect('transaction')
            ->where('vendLog.vendingMachine = :vendingMachine_id')
            ->orderBy('vendLog.id', 'DESC');

        $q->setParameter('vendingMachine_id', $vendingMachine->getId())
            ->setParameter('transaction_state', TransactionState::PENDING);

        $q = $q->getQuery();

        return $this->paginate($q, $perPage, $pageName);
    }
}
