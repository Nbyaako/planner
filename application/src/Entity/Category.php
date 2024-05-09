<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]

class Category
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    
    private int $id;

    
    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    public function getName(): string {return $this->name;}
    public function setName(string $name): void {$this->name = $name;}
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    
    private ?string $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    
    private string $status;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

}