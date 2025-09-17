<?php

namespace Training\Bundle\UserNamingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'app_user_naming_type')]
class UserNamingType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(
        name: 'title',
        type: 'string',
        length: 64,
        nullable: false
    )]
    private $title;

    #[ORM\Column(
        name: 'format',
        type: 'string',
        length: 255,
        nullable: false
    )]
    private $format;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }


}