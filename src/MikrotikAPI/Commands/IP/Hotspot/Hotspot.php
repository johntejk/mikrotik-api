<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Roar\Roar;
use MikrotikAPI\Commands\IP\Hotspot\HotspotServer,
    MikrotikAPI\Commands\IP\Hotspot\HotspotServerProfiles,
    MikrotikAPI\Commands\IP\Hotspot\HotspotUsers,
    MikrotikAPI\Commands\IP\Hotspot\HotspotUserProfile,
    MikrotikAPI\Commands\IP\Hotspot\HotspotHosts,
    MikrotikAPI\Commands\IP\Hotspot\HotspotActive,
    MikrotikAPI\Commands\IP\Hotspot\HotspotIPBindings,
    MikrotikAPI\Commands\IP\Hotspot\HotspotCookie;

/**
 * Description of Hotspot
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class Hotspot {

    /**
     *
     * @var Roar
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Server
     */
    public function server() {
        return new HotspotServer($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\ServerProfiles
     */
    public function serverProfiles() {
        return new HotspotServerProfiles($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Users
     */
    public function users() {
        return new HotspotUsers($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\UserProfile
     */
    public function userProfiles() {
        return new HotspotUserProfile($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Active
     */
    public function active() {
        return new HotspotActive($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Hosts
     */
    public function hosts() {
        return new HotspotHosts($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\IPBindings
     */
    public function IPBinding() {
        return new HotspotIPBindings($this->roar);
    }

    /**
     * 
     * @return \MikrotikAPI\Commands\IP\Hotspot\Cookie
     */
    public function cookie() {
        return new HotspotCookie($this->roar);
    }

}
