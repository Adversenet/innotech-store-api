<?php

declare(strict_types=1);

namespace Application\Category\Handler;

use Application\Category\Command\DeleteCategoryCommand;
use Domain\Category\Repository\CategoryRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * class DeleteCategoryHandler
 */
#[AsMessageHandler]
final class DeleteCategoryHandler
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ){
    }

    public function __invoke(DeleteCategoryCommand $command): void
    {
        $this->repository->delete($command->_entity);
    }
}