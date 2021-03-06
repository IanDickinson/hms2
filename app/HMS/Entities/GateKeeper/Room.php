<?php

namespace HMS\Entities\GateKeeper;

use Doctrine\Common\Collections\ArrayCollection;

class Room
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Floor
     */
    protected $floor;

    /**
     * @var Light[]|ArrayCollection
     */
    protected $lights;

    public function __construct()
    {
        $this->lights = new ArrayCollection();
    }

    /**
     * Gets the value of id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Floor
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param Floor $floor
     *
     * @return self
     */
    public function setFloor(Floor $floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * @return Light[]|ArrayCollection
     */
    public function getLights()
    {
        return $this->lights;
    }

    /**
     * @param Light[]|ArrayCollection $lights
     *
     * @return self
     */
    public function setLights($lights)
    {
        $this->lights = $lights;

        return $this;
    }
}
