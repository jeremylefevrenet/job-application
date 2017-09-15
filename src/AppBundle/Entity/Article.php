<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     * @Assert\Length(max=100)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="amountHT", type="float")
     * @Assert\GreaterThan(0)
     * @Assert\Regex("/^([^0-9\-\.]{0,})(.*)/")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $amountHT;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation", type="date")
     */
    private $creation;

    public function __construct() {
        $this->creation = new \Datetime();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Article
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
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set amountHT
     *
     * @param float $amountHT
     *
     * @return Article
     */
    public function setAmountHT($amountHT)
    {
        $this->amountHT = $amountHT;

        return $this;
    }

    /**
     * Get amountHT
     *
     * @return float
     */
    public function getAmountHT()
    {
        return $this->amountHT;
    }
    
    /**
     * Get amountVAT1
     *
     * @return float
     */
    public function getAmountVAT1()
    {
        return $this->amountHT * 1.17;
    }
    
    
    /**
     * Get amountVAT1
     *
     * @return float
     */
    public function getAmountVAT2()
    {
        return $this->amountHT * 1.03;
    }
    
    private static function calculateAmount() {}

    /**
     * Set creation
     *
     * @param \DateTime $creation
     *
     * @return Article
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;

        return $this;
    }

    /**
     * Get creation
     *
     * @return \DateTime
     */
    public function getCreation()
    {
        return $this->creation;
    }
}

