<?php defined('SYSPATH') or die('No direct script access.');
/**
 * OAuth Token Request
 *
 * @package    Kohana/OAuth
 * @category   Request
 * @author     Kohana Team
 * @copyright  (c) 2010 Kohana Team
 * @license    http://kohanaframework.org/license
 * @since      3.0.7
 */
class Kohana_Oauth_Request_Token extends Oauth_Request {

	protected $name = 'request';

	// http://oauth.net/core/1.0/#rfc.section.6.3.1
	protected $required = array(
		'oauth_callback'         => TRUE,
		'oauth_consumer_key'     => TRUE,
		'oauth_signature_method' => TRUE,
		'oauth_signature'        => TRUE,
		'oauth_timestamp'        => TRUE,
		'oauth_nonce'            => TRUE,
		'oauth_version'          => TRUE,
	);

	public function execute(array $options = NULL)
	{
		return Oauth_Response::factory(parent::execute($options));
	}

} // End OAuth_Request_Token