<?php  
class ControllerModuleTop1ePopupWelcome extends Controller {
	protected function index($setting) {
		
    	$this->document->addScript('catalog/view/javascript/top1e_popupwellcom/jquery.fancybox.js');
				if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/top1e_popupwellcom/jquery.fancybox.css')) {
                        $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/top1e_popupwellcom/jquery.fancybox.css');
                } else {
                        $this->document->addStyle('catalog/view/theme/default/stylesheet/top1e_popupwellcom/jquery.fancybox.css');
                }
				
		$this->data['popupmessage'] = html_entity_decode($setting['popupdescription'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/top1e_popupwelcome.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/top1e_popupwelcome.tpl';
		} else {
			$this->template = 'default/template/module/top1e_popupwelcome.tpl';
		}
		
		$this->render();
	}
}
?>