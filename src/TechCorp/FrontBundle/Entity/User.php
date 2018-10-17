<?php

namespace TechCorp\FrontBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TechCorp\FrontBundle\Entity\Status;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package TechCorp\FrontBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


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
     * @ORM\OneToMany(targetEntity="Status", mappedBy="user")
     */
    protected $statuses;

    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(
     *     name="friends",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     * )
     */
    private $friends;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="friends")
     */
    private $friendsWithMe;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    protected $comments;

    public function __construct()
    {
        parent::__construct();

        $this->statuses = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->friendsWithMe = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * Add statuses
     *
     * @param \TechCorp\FrontBundle\Entity\Status $statuses
     * @return User
     */
    public function addStatus(\TechCorp\FrontBundle\Entity\Status $statuses)
    {
        $this->statuses[] = $statuses;

        return $this;
    }

    /**
     * Remove statuses
     *
     * @param \TechCorp\FrontBundle\Entity\Status $statuses
     */
    public function removeStatus(\TechCorp\FrontBundle\Entity\Status $statuses)
    {
        $this->statuses->removeElement($statuses);
    }

    /**
     * Get statuses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * Add friends
     *
     * @param \TechCorp\FrontBundle\Entity\User $friends
     * @return User
     */
    public function addFriend(\TechCorp\FrontBundle\Entity\User $friends)
    {
        $this->friends[] = $friends;

        return $this;
    }

    /**
     * Remove friends
     *
     * @param \TechCorp\FrontBundle\Entity\User $friends
     */
    public function removeFriend(\TechCorp\FrontBundle\Entity\User $friends)
    {
        $this->friends->removeElement($friends);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * Add friendsWithMe
     *
     * @param \TechCorp\FrontBundle\Entity\User $friendsWithMe
     * @return User
     */
    public function addFriendsWithMe(\TechCorp\FrontBundle\Entity\User $friendsWithMe)
    {
        $this->friendsWithMe[] = $friendsWithMe;

        return $this;
    }

    /**
     * Remove friendsWithMe
     *
     * @param \TechCorp\FrontBundle\Entity\User $friendsWithMe
     */
    public function removeFriendsWithMe(\TechCorp\FrontBundle\Entity\User $friendsWithMe)
    {
        $this->friendsWithMe->removeElement($friendsWithMe);
    }

    /**
     * Get friendsWithMe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * hasFriend friend
     *
     * @param \TechCorp\FrontBundle\Entity\User $friend
     * @return boolean
     */
    public function hasFriend(\TechCorp\FrontBundle\Entity\User $friend)
    {
        return $this->friends->contains($friend);
    }

    /**
     * canAddFriend friend
     *
     * @param \TechCorp\FrontBundle\Entity\User $friend
     * @return boolean
     */
    public function canAddFriend(\TechCorp\FrontBundle\Entity\User $friend)
    {
        return $this != $friend && !$this->hasFriend($friend);
    }

    /**
     * Add comments
     *
     * @param \TechCorp\FrontBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\TechCorp\FrontBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \TechCorp\FrontBundle\Entity\Comment $comments
     */
    public function removeComment(\TechCorp\FrontBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }


}
