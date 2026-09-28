# OAuth2 Server Plugin for Moodle

It provides an [OAuth2](https://tools.ietf.org/html/rfc6749 "RFC6749") server so that a user can use its Moodle account to log in to your application.
Oauth2 Library has been taken from https://github.com/bshaffer/oauth2-server-php

## Requirements
* #### Moodle 2.8 or higher installed
* #### Admin account

## Installation steps
1. Clone this repository in a directory named "oauth".  `$ git clone https://github.com/projectestac/moodle-local_oauth.git oauth`

2. Compress it to a _.zip_ file.

3. Log in to Moodle as an administrator.

4. Search a block named _Administration_ and look for _Site Administration > Plugins > Install Plugins_.

5. Choose the _.zip_ file and hit the button _Install Plugin from the ZIP file_.

6. Make sure the directory *path_to_moodle/local/* has writing permissions for moodle. If the validation is ok, install it.

7. Go to *Site Administration > Server > OAuth provider settings*

8. Click *Add new client*

9. Fill in the form. Your Client Identifier and Client Secret (which will be given later) will be used for you to authenticate. The Redirect URL must be the URL mapping to your client that will be used.

## How to use

1. From your application, redirect the user to this URL: `https://moodledomain.com/local/oauth/login.php?client_id=EXAMPLE&response_type=code&redirect_uri=https%3A%2F%2Fyourapplicationdomain.com%2Ffoo&scope=user_info&state=RANDOM` *(remember to replace the URL domain with the domain of Moodle and replace EXAMPLE with the Client Identifier given in the form.)* The parameters `redirect_uri`, `scope` and `state` are optional but recommended:
   * `redirect_uri` must match exactly the Redirect URL given in the form. If it is omitted, the registered one is used (only possible when the client has a single Redirect URL).
   * `scope` must be one of the scopes given in the form.
   * `state` is a random value that your application must check when the user is redirected back, to prevent CSRF attacks.

2. The user must log in to Moodle and authorize your application to use its basic info.

3. If it went all ok, the plugin should redirect the user to something like: `https://yourapplicationdomain.com/foo?code=55c057549f29c428066cbbd67ca6b17099cb1a9e&state=RANDOM` *(that's a GET request to the Redirect URL given with the code parameter and, if it was sent, the state parameter)*. The code expires after 30 seconds and can be used only once.

4. Using the code given, your application must send a POST request to `https://moodledomain.com/local/oauth/token.php` having the following parameters: `{'code': '55c057549f29c428066cbbd67ca6b17099cb1a9e', 'client_id': 'EXAMPLE', 'client_secret': 'codeGivenAfterTheFormWasFilled', 'grant_type': 'authorization_code', 'redirect_uri': 'https://yourapplicationdomain.com/foo'}`. The `redirect_uri` parameter is required if it was sent in step 1, and must have the same value. Instead of sending `client_id` and `client_secret` as parameters, your application can send them in an `Authorization: Basic` header.

5. If the correct credentials were given, the response should be a JSON like this: `{"access_token":"79d687a0ea4910c6662b2e38116528fdcd65f0d1","expires_in":3600,"token_type":"Bearer","scope":"user_info"}`. The access token expires after one hour. Refresh tokens are not issued: when the access token expires, the user must be authorized again.

6. Finally, send a request to `https://moodledomain.com/local/oauth/user_info.php` passing the access token in one of these ways (only one at a time):
   * In an `Authorization: Bearer 79d687a0ea4910c6662b2e38116528fdcd65f0d1` header (recommended).
   * As a parameter of a POST request, like: `{'access_token':'79d687a0ea4910c6662b2e38116528fdcd65f0d1'}`.
   * As a parameter of a GET request: `https://moodledomain.com/local/oauth/user_info.php?access_token=79d687a0ea4910c6662b2e38116528fdcd65f0d1`.

   Note: if Apache runs PHP through PHP-FPM (`mod_proxy_fcgi`), the `Authorization` header is not passed to PHP by default. Add `CGIPassAuth On` to the Apache configuration of the Moodle directory.

7. If the token given is valid, a JSON containing the user information is returned. Ex: `{"id":"22","username":"foobar","idnumber":"","firstname":"Foo","lastname":"Bar","email":"foo@bar.com","lang":"en","phone1":"5551619192","auth":"manual","country":"foo","description":"bar"}`

   The token must have at least one of the scopes given in the form for the client (if the client has no scope, `user_info` is required). Otherwise, a JSON with an OAuth2 error is returned:
   * `401 invalid_token`: the token is missing, invalid or expired, is not associated with a user (e.g. it was obtained with the `client_credentials` grant type), or its client no longer exists.
   * `403 insufficient_scope`: the token has none of the scopes of the client.
   * `404 user_not_found`: the user associated with the token does not exist or has been deleted.

Note: If testing in Postman, you need to set encoding to `x-www-form-urlencoded` for POST requests.



**This plugin has been tested on Moodle 2.8, Moodle 3.0 and Moodle 4.5**


## Contributors
Apart from people in this repository, also have contributed:

- [igorpf](https://github.com/igorpf)

