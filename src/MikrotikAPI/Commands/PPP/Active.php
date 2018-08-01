<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Roar\Roar;

/**
 * Description of Active
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Active {

    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to display all ppp active
     * @return type array
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/active/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP Active To Set, Please Your Add PPP Active";
        }
    }

    /**
     * This method is used to delete ppp active
     * @param type $id string
     * @return type array
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ppp/active/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
    * This method is used to delete ppp active
    * get Id By name
    * @param type $name string not array
    * @return type array
    *
    */

    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/active/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            $rsArray = $rs->getResultArray();
            foreach ($rsArray as $Id) {
                return $Id['.id'];
            }
        }
    }

}
