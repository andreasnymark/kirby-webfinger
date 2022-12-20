# Kirby 3  Webfinger plugin

A [Kirby 3](https://getkirby.com) [Webfinger](https://webfinger.net) plugin. Basic setup enables Mastodon endpoint, but other endpoints can be enabled via config.

**Version tested:** 3.7.5

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-webfinger`.

### Git submodule

	git submodule add https://github.com/andreasnymark/kirby-webfinger.git site/plugins/kirby-webfinger

## Basic setup

**site/config/config.php**

	'webfinger.username' => 'andreasnymark',
	'webfinger.instance' => 'mastodon.xyz',

This enables the Mastodon endpoint.

## Custom/multiple setup

Custom setup can be used in combination with basic setup. The Mastodon endpoint is default if used. Otherwise the first in `webfinger.resources` will be default.

Test your endpoints with `example.com/.well-known/webfinger?resource=acct:first@example.social`

**site/config/config.php**

	'webfinger.resources' => [
		[
			'subject' => 'acct:first@example.social',
			'aliases' => [
				'https://example.social/users/first',
			],
			'links' => [
				[
					'rel' => '…',
					'href' => '…',
					'type' => '…'
				],
			]
		],
		[
			'subject' => 'acct:second@example.social',
			'aliases' => [
				'https://example.social/users/second',
			],
			'links' => [
				[
					'rel' => '…',
					'href' => '…',
					'type' => '…'
				],
			]
		],
	],

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please create [a new issue](issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

You are prohibited from using this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.


