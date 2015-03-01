<?php

namespace DevelMe\Podio;

use Illuminate\Session\SessionManager as LaravelSession;

/**
 * SessionManager
 * @package DevelMe\Podio\SessionManager
 * @version 1.0.0
 * @author Verron Knowles (Verron.Knowles@develme.com)
 */
class SessionManager implements Contracts\SessionManager
{
    /**
     * Laravel's Session Manager
     *
     * @type Illuminate\Session\SessionManager
     */
    protected $laravel_session;

    /**
     * Constructor
     *
     * @author Verron Knowles <Verron.Knowles@develme.com>
     * @return void
     */
    public function __construct()
    {
        $app = app();
        $this->laravel_session = $app['session'];

        if ($this->laravel_session->has('_develme_podio_oauth')) {
            $this->podio_oauth = unserialize($this->laravel_session->get('_develme_podio_oauth'));
            $this->podio_authtype = unserialize($this->laravel_session->get('_develme_podio_authtype'));
        }

    }

    /**
     * Set Podio Data
     *
     * @author Verron Knowles <Verron.Knowles@develme.com>
     * @return bool
     */
    public function set($podio_oauth, $podio_authtype)
    {
        $this->podio_oauth = $podio_oauth;
        $this->podio_authtype = $podio_authtype;

        // Save the session data for later
        $this->laravel_session->put('_develme_podio_oauth', serialize($this->podio_oauth));
        $this->laravel_session->put('_develme_podio_authtype', serialize($this->podio_authtype));
    }

    /**
     * Get Podio Data
     *
     * @author Verron Knowles <Verron.Knowles@develme.com>
     * @return PodioOAuth
     */
    public function get()
    {
        if (!isset($this->podio_oauth)) return new \PodioOAuth;

        return $this->podio_oauth;
    }

    /**
     * Destroy Podio Data
     *
     * @author Verron Knowles <Verron.Knowles@develme.com>
     * @return bool
     */
    public function destroy()
    {
        $this->podio_oauth = null;
        $this->podio_authtype = null;

        $this->laravel_session->forget('_develme_podio_oauth');
    }
}
