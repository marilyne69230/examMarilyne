<?php

namespace App\Command;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:delete-comment',
    description: 'supprimer tout les commentaires avec le nom Pokémon',
)]
class SetAdminCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private CommentRepository $commentRepository
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('app:delete-pokemon-comments');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($comments as $comment) {
            $this->entityManager->remove($comment);
        }

        $this->entityManager->flush();
        $output->writeln("C'est OK");
        
        $output->writeln("C'est pas OK");
        




        return Command::SUCCESS;
    }
}

