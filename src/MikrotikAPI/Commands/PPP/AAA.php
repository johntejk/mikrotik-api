<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Roar\Roar;

/**
 * Description  AAA
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class AAA {

    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to display all ppp aaa
     * @return type array
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ppp/aaa/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No PPP AAA To Set, Please Your Add PPP AAA";
        }
    }

    /**
     * This method is used to set ppp aaa
     * @param type $use_radius string
     * @param type $accounting string
     * @param type $interim_update string
     * @return type array
     */
    public function set($use_radius, $accounting, $interim_update) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ppp/aaa/set");
        $sentence->setAttribute("use-radius", $use_radius);
        $sentence->setAttribute("accounting", $accounting);
        $sentence->setAttribute("interim-update", $interim_update);
        $this->roar->send($sentence);
        return "Success";
    }

}
