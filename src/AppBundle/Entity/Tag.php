<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents a tag.
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity
 */
class Tag
{
    /**
     * The tag ID.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * The tag name.
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    protected $name;

    /**
     * The tag slug.
     *
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", unique=true)
     */
    protected $slug;

    /**
     * This represents the ManyToMany Posts-Tags relationship.
     *
     * @var Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    protected $posts;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Gets the ID.
     *
     * @return  integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the name.
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name.
     *
     * @param   string  $name
     * @return  Tag
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the slug.
     *
     * @return  string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the slug.
     *
     * @param   string  $slug
     * @return  Tag
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Gets the posts.
     *
     * @return  Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
