<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant")
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @var int
     *
     * @ORM\Column(name="restaurant_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $restaurantId;

    /**
     * @var int
     *
     * @ORM\Column(name="restaurant_name", type="string", length="256",nullable=false)
     */
    private $restaurantName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="date", nullable=false)
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="date", nullable=false)
     */
    private $updateAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $userId;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $cityId;

    public function getRestaurantId(): ?int
    {
        return $this->restaurantId;
    }

    public function getRestaurantName(): ?string
    {
        return $this->restaurantName;
    }

    public function setRestaurantName(string $restaurantName): self
    {
        $this->restaurantName = $restaurantName;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    /**
     * @param \DateTime $createAt
     * @return Restaurant
     */
    public function setCreateAt(\DateTime $createAt): Restaurant
    {
        $this->createAt = $createAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateAt(): \DateTime
    {
        return $this->updateAt;
    }

    /**
     * @param \DateTime $updateAt
     * @return Restaurant
     */
    public function setUpdateAt(\DateTime $updateAt): Restaurant
    {
        $this->updateAt = $updateAt;
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
     * @return Restaurant
     */
    public function setUserId(User $userId): Restaurant
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return City
     */
    public function getCityId(): City
    {
        return $this->cityId;
    }

    /**
     * @param City $cityId
     * @return Restaurant
     */
    public function setCityId(City $cityId): Restaurant
    {
        $this->cityId = $cityId;
        return $this;
    }




}
