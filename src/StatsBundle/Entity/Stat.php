<?php

namespace StatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Stat
 *
 * @ORM\Table(name="stats")
 * @ORM\Entity
 */
class Stat
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metric;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $info;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;

    public function __construct($metric, $value, $info)
    {
        $this->metric = $metric;
        $this->value = $value;
        $this->info = $info;
    }

    public function add($value)
    {
        $this->value += $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
