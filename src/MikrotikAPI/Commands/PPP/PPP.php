<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Roar\Roar;
use MikrotikAPI\Commands\PPP\Active,
    MikrotikAPI\Commands\PPP\Secret,
    MikrotikAPI\Commands\PPP\AAA,
    MikrotikAPI\Commands\PPP\Profile;

/**
 * Description of Mapi_Ppp
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class PPP {

    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method for call class Profile
     * @return Object of Profile class
     */
    public function profile() {
        return new Profile($this->roar);
    }

    /**
     * This method for call class Secret
     * @return Object of Secret
     */
    public function secret() {
        return new Secret($this->roar);
    }

    /**
     * This method for call class Aaa
     * @access public
     * @return object of Aaa class
     */
    public function AAA() {
        return new AAA($this->roar);
    }

    /**
     * This method for call class Active
     * @return Object of Active class
     */
    public function active() {
        return new Active($this->roar);
    }

}
