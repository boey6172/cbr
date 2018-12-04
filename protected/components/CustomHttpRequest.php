<?php
class CustomHttpRequest extends CHttpRequest {

    // protected function createCsrfCookie()
    // {
        // $cookie=new CHttpCookie($this->csrfTokenName,sha1(uniqid(mt_rand(),true)));
        // $cookie->secure = true; //Here is where you make your cookie secure
        // if(is_array($this->csrfCookie))
        // {
            // foreach($this->csrfCookie as $name=>$value)
                // $cookie->$name=$value;
        // }
        // return $cookie;
    // }
	
	public $noValidationRoutes = array();
	private $_csrfToken;
 
public function getCsrfToken()
{
    if($this->_csrfToken===null)
    {
        $session = Yii::app()->session;
        $csrfToken=$session->itemAt($this->csrfTokenName);
        if($csrfToken===null)
        {
            $csrfToken = sha1(uniqid(mt_rand(),true));
            $session->add($this->csrfTokenName, $csrfToken);
        }
        $this->_csrfToken = $csrfToken;
    }
 
    return $this->_csrfToken;
}

	
	
	public function validateCsrfToken($event )
	{
		if($this->getIsPostRequest())
		{
			// only validate POST requests
			$session=Yii::app()->session;
			if($session->contains($this->csrfTokenName) && isset($_POST[$this->csrfTokenName]) )
			{
				$tokenFromSession=$session->itemAt($this->csrfTokenName);
				$tokenFromPost=$_POST[$this->csrfTokenName];
				$valid=$tokenFromSession===$tokenFromPost;
			}
			else
				$valid=false;
			if(!$valid)
				throw new CHttpException(400,Yii::t('yii','The CSRF token could not be verified.'));
		}
	}

      protected function normalizeRequest()
    {
        parent::normalizeRequest();
        if($this->enableCsrfValidation)
        {
            $url=Yii::app()->getUrlManager()->parseUrl($this);
            if (in_array($url, $this->noValidationRoutes))
            {
                Yii::app()->detachEventHandler('onBeginRequest',array($this,'validateCsrfToken'));
            }
        }
    }

	
}
?>