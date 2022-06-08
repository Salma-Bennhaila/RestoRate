<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReviewsRepository;

/**
 * Reviews
 *
 * @ORM\Table(name="reviews")
 * @ORM\Entity(repositoryClass=ReviewsRepository::class)
 */
class Reviews
{
    /**
     * @var int
     *
     * @ORM\Column(name="reviews_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reviewsId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=true)
     */
    private $message;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var Restaurant
     *
     * @ORM\ManyToOne(targetEntity="Restaurant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resraurant_id", referencedColumnName="restaurant_id")
     * })*
     */
    private $resraurantId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     *
     */
    private $userId;

    public function getReviewsId(): ?int
    {
        return $this->reviewsId;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Restaurant
     */
    public function getResraurantId(): Restaurant
    {
        return $this->resraurantId;
    }

    /**
     * @param Restaurant $resraurantId
     * @return Reviews
     */
    public function setResraurantId(Restaurant $resraurantId): Reviews
    {
        $this->resraurantId = $resraurantId;
        return $this;
    }

    /**
     * @return User
     */
    public function getUserId(): User
    {
        return $this->userId;
    }

    /**
     * @param User $userId
     * @return Reviews
     */
    public function setUserId(User $userId): Reviews
    {
        $this->userId = $userId;
        return $this;
    }



}
