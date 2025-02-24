<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Psr\Container\ContainerInterface;

#[Command]
class AppSeederCommand extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('app:seeder');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Call app seeder');
    }

    public function handle()
    {
        $this->call('db:seed', ['--path' => './seeders/sports_seeder.php']);
        $this->call('db:seed', ['--path' => './seeders/positions_seeder.php']);
        $this->call('db:seed', ['--path' => './seeders/users_seeder.php']);
    }
}
