<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
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
    private $date_post;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     */
    private $topic;

    /**
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var Product[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="post")
     * @ORM\OrderBy({"date_comment" = "DESC"})
     */
    private $comments;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->date_post = new \DateTime();
        $this->topic = '';
        $this->content = '';
        $this->comments = new ArrayCollection();

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
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDatePost()
    {
        return $this->date_post;
    }

    /**
     * @param \DateTime $date_post
     * @return Post
     */
    public function setDatePost($date_post)
    {
        $this->date_post = $date_post;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param string $topic
     * @return Post
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getShorts(): ?string
    {
        $paragraphs = explode("\n", $this->content, 2);
        return reset($paragraphs);
    }

    /**
     * @return ArrayCollection|Product[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param ArrayCollection|Product[] $comments
     * @return Post
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    public function addComment(Comment $comment)
    {
        $this->comments->add($comment);
        $comment->setPost($this);

        return $this;
    }

}
