<?php

namespace Controllers;

use \Core\Controller;
use \Models\Users;

class HomeController extends Controller {

	private $user;
	private $arrayInfo;

	public function __construct() {
		$this->arrayInfo = array();
	}

	public function index() {

		$this->arrayInfo['hello'] = "Hello World in new MVC";
		$this->loadTemplate('home', $this->arrayInfo);
	}

}