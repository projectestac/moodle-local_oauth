<?php

namespace local_oauth;

defined('MOODLE_INTERNAL') || die();

use OAuth2\ResponseType\AccessToken;
use OAuth2\Storage\ClientInterface;

/**
 * Access token response type that only issues refresh tokens to the clients that can use them.
 *
 * A refresh token is issued only if the "refresh_token" grant type is allowed for the client (see the Grant Types
 * field of the client). Otherwise, the token could not be used and would only be stored.
 */
class access_token extends AccessToken {

    /** @var ClientInterface */
    protected $clientstorage;

    /**
     * @param \OAuth2\Storage\AccessTokenInterface $tokenstorage Storage of the access tokens.
     * @param \OAuth2\Storage\RefreshTokenInterface $refreshstorage Storage of the refresh tokens.
     * @param ClientInterface $clientstorage Storage of the clients, to check their grant types.
     * @param array $config Configuration (access_lifetime, refresh_token_lifetime...).
     */
    public function __construct($tokenstorage, $refreshstorage, ClientInterface $clientstorage, array $config = []) {
        parent::__construct($tokenstorage, $refreshstorage, $config);
        $this->clientstorage = $clientstorage;
    }

    public function createAccessToken($client_id, $user_id, $scope = null, $includeRefreshToken = true) {
        if ($includeRefreshToken && !$this->clientstorage->checkRestrictedGrantType($client_id, 'refresh_token')) {
            $includeRefreshToken = false;
        }
        return parent::createAccessToken($client_id, $user_id, $scope, $includeRefreshToken);
    }
}
