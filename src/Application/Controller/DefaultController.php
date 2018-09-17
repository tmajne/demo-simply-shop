<?php

declare(strict_types = 1);

namespace App\Application\Controller;

use Doctrine\DBAL\Connection;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    private const DEFAULT_LIMIT = 10;

    /** @var Connection */
    private $dbal;

    /**
     * @param Connection $dbal
     */
    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        /*
         * TODO:
         * Below we don't see example when we use Q from CQRS.
         * This is only "Symfony way programing" when we need receive some data from repository.
         * I must to do this in that way because in specification I read that I should use KnpPaginator.
         * Of course we can use array for Knp but in this case (array) we have a lot of problems,
         * for example: automatically pagination.
         */

        $query = $this->dbal->createQueryBuilder();
        $query->select('p.*')
            ->from('product', 'p')
            ->orderBy('p.id', 'DESC');

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', self::DEFAULT_LIMIT)
        );

        return $this->render('default/index.html.twig', [
                'pagination' => $pagination
            ]
        );
    }
}
