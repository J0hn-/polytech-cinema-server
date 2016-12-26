<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\MovieRepository")
 * @ExclusionPolicy("all")
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="smallint", nullable=true)
     * @Expose
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releaseDate", type="date", nullable=true)
     * @Expose
     */
    private $releaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Expose
     */
    private $title;

    /**
     * @var Director
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Director")
     * @ORM\JoinColumn(name="fk_director", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Expose
     */
    private $director;

    /**
     * @var Genre
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Genre")
     * @ORM\JoinColumn(name="fk_genre", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Expose
     */
    private $genre;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Movie
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return Movie
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set director
     *
     * @param \CoreBundle\Entity\Director $director
     *
     * @return Movie
     */
    public function setDirector(\CoreBundle\Entity\Director $director = null)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return \CoreBundle\Entity\Director
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set genre
     *
     * @param \CoreBundle\Entity\Genre $genre
     *
     * @return Movie
     */
    public function setGenre(\CoreBundle\Entity\Genre $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \CoreBundle\Entity\Genre
     */
    public function getGenre()
    {
        return $this->genre;
    }
}
