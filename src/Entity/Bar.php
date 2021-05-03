<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BarRepository::class)
 */
class Bar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    private string $name;

    /**
     * @ORM\ManyToOne(targetEntity=Foo::class, inversedBy="bars")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private ?Foo $foo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFoo(): ?Foo
    {
        return $this->foo;
    }

    public function setFoo(?Foo $foo): self
    {
        $this->foo = $foo;

        return $this;
    }
}
