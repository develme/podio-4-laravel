<?php

namespace DevelMe\Podio\Contracts;

/**
 * Interface SessionManager
 * @author Verron Knowles <Verron.Knowles@develme.com>
 */
interface SessionManager
{
    public function set($podio_oauth, $podio_authtype);
}

