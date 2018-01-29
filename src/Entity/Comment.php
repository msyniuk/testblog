<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $date_comment;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     */
    private $author;

    /**
     *
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * Comment constructor.
     */
    public function __construct(    )
    {
        $this->date_comment = new \DateTime();
        $this->author = '';
        $this->text = '';

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Comment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateComment(): \DateTime
    {
        return $this->date_comment;
    }

    /**
     * @param \DateTime $date_comment
     * @return Comment
     */
    public function setDateComment(\DateTime $date_comment): Comment
    {
        $this->date_comment = $date_comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Comment
     */
    public function setAuthor(string $author): Comment
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     * @return Comment
     */
    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }



}