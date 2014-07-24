<?php

namespace Kata\Bergmann\CommonCsrfToken;

class CommonCsrfTokenBo
{
	const TOKEN_NAME = 'form_token';

    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

	public function generateAndStoreToken($formName)
	{
        $token = $this->generateToken();

        $this->storeToken($formName, $token);

		return $token;
	}

	public function isValidToken($formName, $token)
	{
		if ($this->session->get($this->getTokenName($formName)) == $token) {
			return true;
		}

        return false;
	}

    private function generateToken()
    {
        return sha1(uniqid(null, true));
    }

    private function storeToken($formName, $token)
    {
        $this->session->set($this->getTokenName($formName), $token);
    }

    private function getTokenName($formName)
    {
        return $formName . '_' . self::TOKEN_NAME;
    }
}
