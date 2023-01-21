<?php

declare(strict_types=1);

namespace Merjn\Speedy\Player\Domain\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'players')]
class Player
{
    #[Column(type: 'integer')]
    #[Id]
    #[GeneratedValue(strategy: 'IDENTITY')]
    private readonly int $id;

    #[Column(type: 'string')]
    private readonly string $username;

    #[Column(type: 'string')]
    private readonly string $password;

    #[Column(type: 'string')]
    private readonly string $email;

    #[Column(type: 'string')]
    private readonly string $gender;

    #[Column(type: 'string')]
    private readonly string $figure;

    #[Column(type: 'string')]
    private readonly string $motto;

    public function __construct(
        string $username,
        string $password,
        string $email,
        string $gender,
        string $figure,
        string $motto
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->gender = $gender;
        $this->figure = $figure;
        $this->motto = $motto;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}