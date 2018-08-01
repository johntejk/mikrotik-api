<?php

namespace MikrotikAPI\Util;

/**
 * A simple wrapper/alternate class to maintain compatibility with ResultUtil
 *
 * @author A S M Saief info@asmsaief.com <http://asmsaief.com>
 * @copyright   Copyright (c) 2016, Robotic Systems.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class SimpleResult {

    private $result = [];

    public function __construct($result) {
        $this->result = $result;
    }

    public function getResultArray() {
        return $this->result;
    }

    public function size() {
        return count($this->result);
    }
}
