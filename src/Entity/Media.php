<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media", indexes={@ORM\Index(name="restaurant_id", columns={"restaurant_id"})})
 * @ORM\Entity
 */
class Media
{
    /**
     * @var int
     *
     * @ORM\Column(name="media_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mediaId;

    /**
     * @var int
     *
     * @ORM\Column(name="restaurant_id", type="integer", nullable=false)
     */
    private $restaurantId;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=256, nullable=false)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="url_file", type="string", length=256, nullable=false)
     */
    private $urlFile;

    public function getMediaId(): ?int
    {
        return $this->mediaId;
    }

    public function getRestaurantId(): ?int
    {
        return $this->restaurantId;
    }

    public function setRestaurantId(int $restaurantId): self
    {
        $this->restaurantId = $restaurantId;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getUrlFile(): ?string
    {
        return $this->urlFile;
    }

    public function setUrlFile(string $urlFile): self
    {
        $this->urlFile = $urlFile;

        return $this;
    }


}
