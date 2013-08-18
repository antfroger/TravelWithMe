<?php

namespace TWM\SiteBundle\Entity\File;

use Doctrine\ORM\Mapping as ORM;
use TWM\CommonBundle\Entity\File\File;

/**
 * @ORM\MappedSuperclass
 */
abstract class Photo extends File
{

    const DEFAULT_COMMMENT = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $comment;

    public function __construct($path = self::DEFAULT_PATH, $name = self::DEFAULT_NAME,
                                $comment = self::DEFAULT_COMMMENT)
    {
        parent::__construct($path, $name);

        $this->comment = $comment;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Photo
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

}