<?php

namespace MikrotikAPI\Commands\IP\Firewall;

use MikrotikAPI\Roar\Roar;
use MikrotikAPI\Commands\IP\Firewall\Filter,
    MikrotikAPI\Commands\IP\Firewall\NAT,
    MikrotikAPI\Commands\IP\Firewall\Mangle,
    MikrotikAPI\Commands\IP\Firewall\ServicePort,
    MikrotikAPI\Commands\IP\Firewall\Connection,
    MikrotikAPI\Commands\IP\Firewall\AddressList,
    MikrotikAPI\Commands\IP\Firewall\Layer7Protocol;

/**
 * Description of Firewall
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class Firewall {

    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\Filter
     */
    public function filter() {
        return new Filter($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\NAT
     */
    public function NAT() {
        return new NAT($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\Mangle
     */
    public function mangle() {
        return new Mangle($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\ServicePort
     */
    public function servicePort() {
        return new ServicePort($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\Connection
     */
    public function connection() {
        return new Connection($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\AddressList
     */
    public function addressList() {
        return new AddressList($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Firewall\Layer7Protocol
     */
    public function layer7Protocol() {
        return new Layer7Protocol($this->roar);
    }

}
