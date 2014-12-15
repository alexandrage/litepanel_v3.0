<?php
/*
* @LitePanel
* @Version: 1.0.1
* @Date: 29.12.2012
* @Developed by QuickDevel
*/
class captchaController extends Controller {
	public function index() {
		$this->load->library('captcha');
		
		$captchaLib = new captchaLibrary();
		
		$this->session->data['captcha'] = $captchaLib->getCode();
		$captchaLib->showImage();
		return null;
	}
}
?>