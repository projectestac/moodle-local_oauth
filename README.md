# OAuth2 Server Plugin for Moodle

It provides an [OAuth2](https://tools.ietf.org/html/rfc6749 "RFC6749") server so that a user can use its Moodle account to log in to your application.
Oauth2 Library has been taken from https://github.com/bshaffer/oauth2-server-php

## Requirements
* #### Moodle 2.8 o higher installed
* #### Admin account

## Instalation steps
1. Clone this repository in a directory named "oauth".  `$ git clone https://github.com/cognitivabrasil/moodle-local_oauth.git oauth`

2. Compress it to a _.zip_ file.

3. Log in to Moodle as an administrator.

4. Search a block named _Administration_ and look for _Site Administration > Plugins > Install Plugins_.

5. Choose the _.zip_ file and hit the button _Install Plugin from the ZIP file_.

6. Make sure the directory *path_to_moodle/local/* has writing permissions for moodle. If the validation is ok, install it.

7. Go to *Site Administration > Server > OAuth provider settings*

8. Click *Add new client*

9. Fill in the form. Your Client Identifier and Client Secret (which will be given later) will be used for you to authenticate. The Redirect URL must be the URL mapping to your client that will be used.

## How to use 

1. From your application, redirect the user to this URL: `http://moodledomain.com/local/oauth/login.php?client_id=EXAMPLE&response_type=code` *(remember to replace the URL domain with the domain of Moodle and replace EXAMPLE with the Client Identifier given in the form.)*

2. The user must log in to Moodle and authorize your application to use its basic info.

3. If it went all ok, the plugin should redirect the user to something like: `http://yourapplicationdomain.com/foo?code=55c057549f29c428066cbbd67ca6b17099cb1a9e` *(that's a GET request to the Redirect URL given with the code parameter)*

4. Using the code given, your application must send a POST request to `http://moodledomain.com/local/oauth/token.php`  having the following parameters: `{'code': '55c057549f29c428066cbbd67ca6b17099cb1a9e', 'client_id': 'EXAMPLE', 'client_secret': 'codeGivenAfterTheFormWasFilled', 'grant_type': 'authorization_code',   'scope': 'user_info'}`. 

5. If the correct credentials were given, the response should a JSON be like this: `{"access_token":"79d687a0ea4910c6662b2e38116528fdcd65f0d1","expires_in":3600,"token_type":"Bearer","scope":"user_info","refresh_token":"c1de730eef1b2072b48799000ec7cde4ea6d2af0"}`

6. Finally, send a POST request to `http://moodledomain.com/local/oauth/user_info.php` passing the access token as a parameter, like: `{'access_token':'79d687a0ea4910c6662b2e38116528fdcd65f0d1'}`. 

7. If the token given is valid, a JSON containing the user information is returned. Ex: `{"id":"22","username":"foobar","idnumber":"","firstname":"Foo","lastname":"Bar","email":"foo@bar.com","lang":"en","phone1":"5551619192"}`



**This plugin has been tested on Moodle 2.8 and Moodle 3.0**


## Contributors
Apart from people in this repository, also have contributed:

- [igorpf] (https://github.com/igorpf)

