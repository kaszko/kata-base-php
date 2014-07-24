<?php

namespace Kata\Bergmann\CommonCsrfToken;

class Session
{
	/** @var SessionHandlerInterface[] */
    private $sessionHandlers = array();

	public function addSessionHandler($name, SessionHandlerInterface $sessionHandler, $force = false)
	{
		if (!$force && array_key_exists($name, $this->sessionHandlers)) {
			throw new \Exception;
		}

		$this->sessionHandlers[$name] = $sessionHandler;
	}

	public function hasSessionHandler($namespace)
	{
		if (isset($this->sessionHandlers[$namespace])) {
            return true;
        }

        return false;
	}

    public function get($key, $namespace = 'default')
    {
        if (!$this->hasSessionHandler($namespace)) {
            throw new \Exception;
        }

        return $this->sessionHandlers[$namespace]->get($key);
    }

    public function set($key, $value, $namespace = 'default')
    {
        if (!$this->hasSessionHandler($namespace)) {
            throw new \Exception;
        }

        $this->sessionHandlers[$namespace]->set($key, $value);
    }

    public function write()
    {
        foreach ($this->sessionHandlers as $sessionHandler) {
            $sessionHandler->write();
        }
    }
}
