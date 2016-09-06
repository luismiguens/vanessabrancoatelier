<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VbaType
 */
class VbaType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $work;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->work = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add work
     *
     * @param \AppBundle\Entity\VbaWork $work
     * @return VbaType
     */
    public function addWork(\AppBundle\Entity\VbaWork $work)
    {
        $this->work[] = $work;

        return $this;
    }

    /**
     * Remove work
     *
     * @param \AppBundle\Entity\VbaWork $work
     */
    public function removeWork(\AppBundle\Entity\VbaWork $work)
    {
        $this->work->removeElement($work);
    }

    /**
     * Get work
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWork()
    {
        return $this->work;
    }
}
