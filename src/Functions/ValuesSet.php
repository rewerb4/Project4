<?php
namespace Functions;

class ValuesSet{
	protected 	$username;
	private 	$password;
	protected 	$fname;
	protected 	$lname;
	protected 	$email;
	protected 	$twitter;
	protected 	$registrationDate;

	public function __construct ($param_username, $param_password)
	{
        		$this->username = $param_username;
        		$this->password = $param_password;
	}
	public function getUsername () {
        		return $this->username;
	}

	public function getPassword () {
        		return $this->password;
	}

	public function getFirstName () {
        		return $this->fname;
	}

	public function setFirstName ($param_fname) {
        		$this->fname = $param_fname;
        	}

	public function getLastName () {
        		return $this->lname;
	}

	public function setEmail ($param_email) {
        		$this->email = $param_email;
        	}

	public function getEmail () {
        		return $this->email;
	}

	public function setTwitterName($param_twitter) {
        		$this->twitter = $param_twitter;
        	}

	public function getTwitterName () {
        		return $this->twitter;
	}

	public function setLastName ($param_lname) {
        		$this->lname = $param_lname;
        	}




}