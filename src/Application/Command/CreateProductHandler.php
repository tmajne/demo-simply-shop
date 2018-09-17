<?php

declare(strict_types = 1);

namespace App\Application\Command;

use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\ValueObject\Identity;
use App\Domain\ValueObject\Money;
use Swift_Mailer;
use Swift_Message;
use Throwable;

class CreateProductHandler
{
    /** @var Swift_Mailer */
    private $mailer;

    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository, Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->productRepository = $productRepository;
    }

    /**
     * @param CreateProduct $command
     *
     * @throws Throwable
     */
    public function handle(CreateProduct $command): void
    {
        /*
         * TODO
         * Below is simple example creating objects.
         * When we have more complicated business logic we have to use domain service or use some domain factory.
         * We also should raise domain event "product.created"
         */

        $identity = $command->getIdentity();
        $dto = $command->getProductDto();

        $money = new Money(
            (int) $dto->price->amount,
            $dto->price->currency
        );

        $product = new Product(
            new Identity($identity),
            $dto->name,
            $dto->description,
            $money
        );

        $this->productRepository->add($product);

        $message = (new Swift_Message('New Product !!!'))
            // Both address should be getting from container, env is good bat container is better solution
            ->setFrom('send@example.com')
            ->setTo(getenv('ADMIN_ADDRESS'))
            // we also use twig template to render email body
            ->setBody("We have new product {$product->identity()}", 'text/html');
        $this->mailer->send($message);
    }
}
