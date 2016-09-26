<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-09-26
 * Time: 19:40
 */

namespace Shop;

class Order {

    private $id;
    private $user_id;
    private $status_id;

    public function __construct($user_id, $status_id) {
        $this->id = null;
        $this->user_id = $user_id;
        $this->status_id = $status_id;
    }

}
