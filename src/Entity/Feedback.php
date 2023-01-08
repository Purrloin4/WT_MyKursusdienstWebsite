<?php

namespace App\Entity;

use App\Repository\FeedbackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeedbackRepository::class)]
#[ORM\Table('feedback')]
class Feedback {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", nullable: false)]
    private ?int $id = null;

    #[ORM\Column(type: "text", nullable: false)]
    private ?string $text = null;

    #[ORM\Column(type: "string",length: 50, nullable: false)]
    private ?string $author = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private ?\DateTime $created = null;

    /**
     * Entity constructor must have no parameters
     */
    public function __construct() {
        $this->created = new \DateTime();
    }

    /**
     * @return int|null unique id from the database
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string content of the feedback
     */
    public function getText(): string {
        return $this->text;
    }

    /**
     * @param string $text content of the feedback
     * @return Feedback current feedback object
     */
    public function setText(string $text): Feedback {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string feedback author
     */
    public function getAuthor(): string {
        return $this->author;
    }

    /**
     * @param string $author feedback author
     * @return Feedback current feedback object
     */
    public function setAuthor(string $author): Feedback {
        $this->author = $author;
        return $this;
    }

    /**
     * @return \DateTime creation time of the feedback
     */
    public function getCreated(): \DateTime {
        return $this->created;
    }

}
