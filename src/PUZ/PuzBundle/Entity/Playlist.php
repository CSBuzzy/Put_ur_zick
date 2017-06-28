<?php

namespace PUZ\PuzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist")
 * @ORM\Entity(repositoryClass="PUZ\PuzBundle\Repository\PlaylistRepository")
 *
 *  @Serializer\ExclusionPolicy("ALL")
 */
class Playlist
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
     * @ORM\Column(name="title_playlist", type="string", length=255)
     *
     *  @Serializer\Expose
     */
    private $title_playlist;

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
     * @ORM\ManyToMany(targetEntity="PUZ\PuzBundle\Entity\User")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Song", mappedBy="Playlist")
     */
    private $songs;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \PUZ\PuzBundle\Entity\User $user
     *
     * @return Playlist
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

    /**
     * Set titlePlaylist
     *
     * @param string $titlePlaylist
     *
     * @return Playlist
     */
    public function setTitlePlaylist($titlePlaylist)
    {
        $this->title_playlist = $titlePlaylist;

        return $this;
    }

    /**
     * Get titlePlaylist
     *
     * @return string
     */
    public function getTitlePlaylist()
    {
        return $this->title_playlist;
    }

    /**
     * Add song
     *
     * @param \PUZ\PuzBundle\Entity\Song $song
     *
     * @return Playlist
     */
    public function addSong(\PUZ\PuzBundle\Entity\Song $song)
    {
        $this->songs[] = $song;

        return $this;
    }

    /**
     * Remove song
     *
     * @param \PUZ\PuzBundle\Entity\Song $song
     */
    public function removeSong(\PUZ\PuzBundle\Entity\Song $song)
    {
        $this->songs->removeElement($song);
    }

    /**
     * Get songs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSongs()
    {
        return $this->songs;
    }
}
