# FreeMobileSMS
PHP classes to send messages via Free Mobile API

# About

Every subscriber of the Free Mobile service can have an access to the SMS API.
This API allows you to receive SMS on your mobile phone. The purposes can be multiple : alarms, notifications, ...
These PHP classes allows you to use this service (you must be a Free mobile subscriber and you must activate the option).
Note that you cannot send SMS to other persons.

# Usage

```

use FreeMobileSMS\Client;
//...

$login    = 'login';
$password = 'password';

$fMobileClient = new Client($login, $password);
$result = $fMobileClient->send('Hello you !');
```

Use the login and password provided by Free Mobile.

