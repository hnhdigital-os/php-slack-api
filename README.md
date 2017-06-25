```
   _____ _            _    
  / ____| |          | |   
 | (___ | | __ _  ___| | __
  \___ \| |/ _` |/ __| |/ /
  ____) | | (_| | (__|   < 
 |_____/|_|\__,_|\___|_|\_\

```
Access your Slack Team's API through PHP objects.

[![Latest Version](https://img.shields.io/github/release/bluora/php-slack-api.svg?style=flat-square)](https://github.com/bluora/php-slack-api/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/bluora/php-slack-api.svg?style=flat-square)](https://packagist.org/packages/bluora/php-slack-api)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/bluora/php-slack-api/blob/master/LICENSE.md)

This package has been adapted from [cleentfaar/slack](https://github.com/cleentfaar/slack) by H&H|Digital, an Australian botique developer. Visit us at [hnh.digital](http://hnh.digital).

### 1.0.0 release
Please note that from the 1.0.0 release this package's namespace (and folder structure) will change from CL\Slack to Bluora\SlackApi.

From v1.0.0.0 all the payloads and responses will be matched with the Slack API and missing api methods (listed below) will be completed.

### Documentation

- [Getting started](https://github.com/bluora/php-slack-api/blob/master/src/CL/Slack/Resources/doc/getting-started.md) - Before you use this library, you need to generate a token or setup oAuth.
- [Installation](https://github.com/bluora/php-slack-api/blob/master/src/CL/Slack/Resources/doc/installation.md) - Information on installing this library through composer or as a git submodule.
- [Usage](https://github.com/bluora/php-slack-api/blob/master/src/CL/Slack/Resources/doc/usage.md) - A few simple examples on how to access the Slack API using this library
- [API methods](https://github.com/bluora/php-slack-api/blob/master/src/CL/Slack/Resources/doc/methods/index.md) - Detailed information on each of Slack's API methods and how to access them using this library's `Payload` classes.
- [Events](https://github.com/bluora/php-slack-api/blob/master/src/CL/Slack/Resources/doc/events.md) - Examples for listening to events fired by the `ApiClient`


### Features
- Access all of Slack's API methods with dedicated payload classes (see [usage documentation](https://github.com/bluora/php-slack-api/blob/master/src/CL/Slack/Resources/doc/usage.md))
- Payloads and responses follow the same definitions as described in the [official documentation](https://api.slack.com) (with a few exceptions where I think it would make a better distinction).
- Data between you and Slack is serialized using the [JMS Serializer](http://jmsyst.com/libs/serializer) package,
allowing fully spec-ed PHP objects to be used for working with the API.
- Code has been highly abstracted to support re-use in more specific implementations (see [SlackBundle](https://github.com/cleentfaar/CLSlackBundle))

### Missing methods

The following methods have not yet been implemented, why not contribute and add some yourself?
- files.delete
- pins.add
- pins.list
- pins.remove
- reactions.add
- reactions.get
- reactions.list
- reactions.remove
- team.accessLogs
- team.info


### Related packages

- [Slack for Laravel](https://github.com/bluora/laravel-slack-api) - Laravel integration with this library package.

### FAQ

###### Why am I getting a cURL 60 error when attempting to connect to the Slack API?

Under the hood this library uses [Guzzle](https://github.com/guzzle/guzzle) to connect to the Slack API, and Guzzle's 
default method for sending HTTP requests is cURL.

The full error code is *CURLE_SSL_CACERT: Peer certificate cannot be authenticated with known CA certificates* and may 
be due, especially on Windows or OS X, to [Guzzle not being able to find an up to date CA certificate bundle on the operating system](http://docs.guzzlephp.org/en/latest/faq.html#why-am-i-getting-an-ssl-verification-error).

To fix this you first create the Guzzle client manually using an alternative CA cert bundle, or [disabling peer verification](http://guzzle.readthedocs.org/en/latest/clients.html#verify) (not recommended for security reasons), and pass it to the API Client.

```php
$client = new \GuzzleHttp\Client();
$client->setDefaultOption('verify', 'C:\Program Files (x86)\Git\bin\curl-ca-bundle.crt');

// continue as normal, using the client above

$apiClient =  new ApiClient('api-token-here', $client);
```

If you get a different error code you can look at the [list of cURL error codes](http://curl.haxx.se/libcurl/c/libcurl-errors.html), or consult the [Guzzle documentation](http://docs.guzzlephp.org/en/latest/) directly.

## Contributing

Please see [CONTRIBUTING](https://github.com/bluora/php-slack-api/blob/master/CONTRIBUTING.md) for details.

## Credits

* [Cas Leentfaar](https://github.com/cleentfaar)
* [Rocco Howard](https://github.com/therocis)
* [All Contributors](https://github.com/bluora/php-slack-api/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/bluora/php-slack-api/blob/master/LICENSE) for more information.

