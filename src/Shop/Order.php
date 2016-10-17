<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-09-26
 * Time: 19:40
 */

namespace Shop;

class Order
{

    private $id;
    private $user_id;
    private $status_id;

    public function __construct($user_id, $status_id)
    {
        $this->id = null;
        $this->user_id = $user_id;
        $this->status_id = $status_id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     * @return Order
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     * @return Order
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->status_id;
    }

    /**
     * @param mixed $status_id
     * @return Order
     */
    public function setStatusId($status_id)
    {
        $this->status_id = $status_id;
        return $this;
    }



}
