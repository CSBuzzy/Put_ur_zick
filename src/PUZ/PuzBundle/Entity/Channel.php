<?php

namespace PUZ\PuzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="channel")
 * @ORM\Entity(repositoryClass="PUZ\PuzBundle\Repository\ChannelRepository")
 *
 */
class Channel
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
     * @ORM\Column(name="title_channel", type="string", length=255)
     *
     */
    private $title_channel;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="channel")
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="channels")
     */
    private $users;


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
     * Set titleChannel
     *
     * @param string $titleChannel
     *
     * @return Channel
     */
    public function setTitleChannel($titleChannel)
    {
        $this->title_channel = $titleChannel;

        return $this;
    }

    /**
     * Get titleChannel
     *
     * @return string
     */
    public function getTitleChannel()
    {
        return $this->title_channel;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add message
     *
     * @param \PUZ\PuzBundle\Entity\Message $message
     *
     * @return Channel
     */
    public function addMessage(\PUZ\PuzBundle\Entity\Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \PUZ\PuzBundle\Entity\Message $message
     */
    public function removeMessage(\PUZ\PuzBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add user
     *
     * @param \PUZ\PuzBundle\Entity\User $user
     *
     * @return Channel
     */
    public function addUser(\PUZ\PuzBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \PUZ\PuzBundle\Entity\User $user
     */
    public function removeUser(\PUZ\PuzBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
