<?php

declare(strict_types = 1);

namespace App\Application\Controller\Admin;

use App\Application\Command\CreateProduct;
use App\Application\Form\ProductFormType;
use App\Application\Generator\IdentityGenerator;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ProductController extends AbstractController
{
    /** @var CommandBus */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function createProduct(Request $request): Response
    {
        $form = $this->createForm(ProductFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->handle(new CreateProduct(IdentityGenerator::uuid(), $form->getData()));
                $this->addFlash('success', 'Product has been added');
                return $this->redirectToRoute('index');
            } catch (Throwable $e) {
                //TODO: of course this is not good solution for error message
                $this->addFlash('danger', $e->getMessage());
                return $this->redirectToRoute('index');
            }
        }

        return $this->render(
            'admin/create_product.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
}
