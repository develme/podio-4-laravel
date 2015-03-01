<?php

namespace DevelMe\Podio;

use Podio as PodioPHP;

/**
 * Podio
 * @package DevelMe\Podio\Podio
 * @version 1.0.0
 * @author Verron Knowles (Verron.Knowles@develme.com)
 */
class Podio
{
    /**
     * SessionManager
     *
     * @type DevelMe\Podio\SessionManager
     */
    protected $session;

    /**
     * Constructor
     *
     * @author Verron Knowles <Verron.Knowles@develme.com>
     * @return void
     */
    public function __construct($credentials)
    {
        PodioPHP::setup(
            $credentials['client_id'],
            $credentials['client_secret'],
            ['session_manager' => 'DevelMe\Podio\SessionManager']
        );

        $this->session = PodioPHP::$session_manager;
    }

    /**
     * Magic Call Method
     *
     * @author Verron Knowles <Verron.Knowles@develme.com>
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return forward_static_call_array(['Podio', $method], $arguments);
    }

    /**
     * Magic Get Method
     *
     * @author Verron Knowles <Verron.Knowles@develme.com>
     * @return mixed
     */
    public function __get($property)
    {
        return PodioPHP::$$property;
    }
    
    
}
