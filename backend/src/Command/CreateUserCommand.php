<?php
namespace App\Command;

use App\Entity\User;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Vytvoří nového uživatele'
)]
class CreateUserCommand extends Command
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            ->addArgument('firstName', InputArgument::REQUIRED)
            ->addArgument('middleName', InputArgument::REQUIRED)
            ->addArgument('lastName', InputArgument::REQUIRED)
            ->addArgument('dialNumber', InputArgument::REQUIRED)
            ->addArgument('phoneNumber', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $contact = new Contact(null, 
            $input->getArgument("firstName"), 
            $input->getArgument("middleName"), 
            $input->getArgument("lastName"), 
            $input->getArgument("dialNumber"), 
            $input->getArgument("phoneNumber"), 
            $input->getArgument("email"), 
        );
        $this->em->persist($contact);

        $user = new User($contact);
        $user->setPassword($input->getArgument('password'));

        $this->em->persist($user);
        $this->em->flush();

        $output->writeln('Uživatel vytvořen: '.$user->getEmail());
        return Command::SUCCESS;
    }
}
