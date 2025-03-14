<?php

declare(strict_types=1);

namespace Application\Category\Handler;

use Application\Category\Command\CreateCategoryCommand;
use Application\Category\Service\MetaScrapperServiceInterface;
use Application\Shared\Mapper;
use Domain\Category\Entity\Category;
use Domain\Category\Exception\NonUniqueTitleException;
use Domain\Category\Repository\CategoryRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


/**
 * class CreateCategoryHandler
 */
#[AsMessageHandler]
final class CreateCategoryHandler
{
    public function __construct(
        private CategoryRepositoryInterface $repository,
        private  MetaScrapperServiceInterface $metaScrapperService
    ){
    }

    public function  __invoke(CreateCategoryCommand $command): void
    {
        if ($this->repository->isUniqueTitle($command->title)) {
            throw new NonUniqueTitleException();
        }
        if ($command->title === null) {
            $command->title = uniqid();
        }

        $category = Mapper::getHydratedObject($command, new Category());
        $category->setMeta(
            $this->metaScrapperService->getMeta((string) $command->title)
        );
        $this->repository->save($category);
    }
}