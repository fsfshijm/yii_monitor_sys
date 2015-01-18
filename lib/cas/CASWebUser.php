<?php

include_once('CAS.php');
include_once('CASUserIdentity.php');

class CASWebUser extends CWebUser
{
	private $_identity;
	public $casVersion;
	public $serverHost;
	public $serverPort;
	public $serverName;
	public $isProxy;
	public $clientPort;
	public $rootUrl;

	public function loginRequired() {
		$app=Yii::app();
		$request=$app->getRequest();

		if(!$request->getIsAjaxRequest())
			$this->setReturnUrl($request->getUrl());
		elseif(isset($this->loginRequiredAjaxResponse)) {       
			Yii::app()->end();
		}

		try{
			$this->CASAuthentication();
			$this->setUser();
			Yii::app()->getRequest()->redirect($this->rootUrl.Yii::app()->user->returnUrl, true, 302); 
		}
		catch (Exception $e) {
			throw new CHttpException(400, 'Invalid request or server has some problems. Please contract with administrator');
		}

	}

	public function CASAuthentication() {
		try{
			// phpCAS::setDebug();
			if(($this->isProxy) && isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
				if(!strpos($_SERVER['HTTP_X_FORWARDED_HOST'], ':')) {
					$_SERVER['HTTP_X_FORWARDED_HOST'] .= ":";
					$_SERVER['HTTP_X_FORWARDED_HOST'] .= $this->clientPort;
				}
			}
			phpCAS::client(CAS_VERSION_2_0, $this->serverHost, $this->serverPort, $this->serverName);
			phpCAS::setNoCasServerValidation();
			phpCAS::forceAuthentication();
		} catch(Exception $e) {
			throw $e;                        
		}
	}

	public function setUser() {
		$this->getIdentity();
		Yii::app()->user->login($this->_identity);
	}

	public function getIdentity() {
		if($this->_identity == null){
			$this->_identity = new CASUserIdentity(phpCAS::getUser(), '');    
			$this->_identity ->authenticate();
		}
	}

	public function logout($destroySession = true) {
		phpCAS::client(CAS_VERSION_2_0, $this->serverHost, $this->serverPort, $this->serverName);
		phpCAS::logout(array('service'=>'not null'));
	}
}
