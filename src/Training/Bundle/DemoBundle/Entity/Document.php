<?php

namespace Training\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;

#[ORM\Entity]
#[ORM\Table(name: 'app_demo_document')]
class Document implements ExtendEntityInterface
{
    use ExtendEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(
        name: 'subject',
        type: 'string',
        length: 255,
        nullable: false
    )]
    private $subject;

    #[ORM\Column(
        name: 'description',
        type: 'string',
        length: 255,
        nullable: false
    )]
    private $description;

    #[ORM\Column(
        name: 'due_date',
        type: 'datetime',
        nullable: true
    )]
    private $dueDate;

    #[ORM\ManyToOne(targetEntity: Priority::class)]
    #[ORM\JoinColumn(name: 'priority_id', nullable: true, onDelete: 'SET NULL')]
    private $priority;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(?\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getPriority(): ?Priority
    {
        return $this->priority;
    }

    public function setPriority(?Priority $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
}