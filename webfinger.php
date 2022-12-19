<?php

return [
	'pattern' => '.well-known/webfinger',
	'action' => function() {
		$arr = [];
		$return = [];
		$query = get( 'resource' );

		/** Basic Mastodon setup */
		if ( $user = Config::get( 'webfinger.username' ) and $inst = Config::get( 'webfinger.instance' ) ) {
			$mast = new StdClass;

			/** Setup based on user and instance */
			$mast->subject = 'acct:' . $user . '@' . $inst;
			$mast->aliases[] = 'https://' . $inst . '/@' . $user;
			$mast->aliases[] = 'https://' . $inst . '/users/' . $user;
			$mast->links[] = [
				'rel' => 'http://webfinger.net/rel/profile-page',
				'type' => 'text/html',
				'href' => 'https://' . $inst . '/@' . $user,
			];
			$mast->links[] = [
				'rel' => 'self',
				'type' => 'application/activity+json',
				'href' => 'https://' . $inst . '/users/' . $user,
			];
			$mast->links[] = [
				'rel' => 'http://ostatus.org/schema/1.0/subscribe',
				'template' => 'https://' . $inst . '/authorize_interaction?uri={uri}',
			];

			$arr[] = $mast;
		}

		/** Custom Webfinger */
		if ( $resources = Config::get( 'webfinger.resources' ) and count( $resources ) > 0 ) {
			foreach ( $resources as $resource ) {
				$reso = new StdClass;

				$subject = $resource[ 'subject' ];
				$aliases = $resource[ 'aliases' ];
				$links = $resource[ 'links' ];

				$reso->subject = $subject;

				foreach ( $aliases as $a ) {
					$reso->aliases[] = $a;
				}

				foreach ( $links as $link ) {
					foreach ( $link as $key => $val ) {
						$reso->links[] = [
							$key => $val,
						];
					}
				}

				$arr[] = $reso;
			}
		}

		/** By default, return Mastodon/first. */
		$return = $arr[ 0 ];

		/** Return subject from query	*/
		foreach ( $arr as $a ) {
			if ( $query == $a->subject ) {
				$return = $a;
				break;
			}
		}

		/** returns Mastodon if no match */
		return Response::json( json_encode( $return, JSON_UNESCAPED_SLASHES ) );
	},
	'method' => 'GET',
];

?>
