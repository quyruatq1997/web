<?php
class ControllerExtensionModuleFacebookComments extends Controller {
	private $error = array(); 
	private $version = '3.3';
	
	public function index() {   
		$this->load->language('extension/module/facebook_comments');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('facebook_comments', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title') . ' ' . $this->version;
		$data['text_edit'] = $this->language->get('text_edit');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_light'] = $this->language->get('text_light');
		$data['text_dark'] = $this->language->get('text_dark');
		$data['text_social'] = $this->language->get('text_social');
		$data['text_reverse_time'] = $this->language->get('text_reverse_time');
		$data['text_time'] = $this->language->get('text_time');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_app_id'] = $this->language->get('entry_app_id');
		$data['entry_color_scheme'] = $this->language->get('entry_color_scheme');
		$data['entry_num_posts'] = $this->language->get('entry_num_posts');
		$data['entry_order_by'] = $this->language->get('entry_order_by');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['help_app_id'] = $this->language->get('help_app_id');
		$data['help_color_scheme'] = $this->language->get('help_color_scheme');
		$data['help_num_posts'] = $this->language->get('help_num_posts');
		$data['help_order_by'] = $this->language->get('help_order_by');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$this->update_check();
		
		if (isset($this->error['update'])) {
			$data['error_update'] = $this->error['update'];
		} else {
			$data['error_update'] = '';
		}
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['app_id'])) {
			$data['error_app_id'] = $this->error['app_id'];
		} else {
			$data['error_app_id'] = '';
		}	

		if (isset($this->error['app_id'])) {
			$data['error_app_id'] = $this->error['app_id'];
		} else {
			$data['error_app_id'] = '';
		}

		if (isset($this->error['num_posts'])) {
			$data['error_num_posts'] = $this->error['num_posts'];
		} else {
			$data['error_num_posts'] = '';
		}		
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_extension'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', 'SSL')
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/facebook_comments', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/facebook_comments', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('extension/module/facebook_comments', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['app_id'])) {
			$data['app_id'] = $this->request->post['app_id'];
		} elseif (!empty($module_info)) {
			$data['app_id'] = $module_info['app_id'];
		} else {
			$data['app_id'] = '';
		}	

		if (isset($this->request->post['color_scheme'])) {
			$data['color_scheme'] = $this->request->post['color_scheme'];
		} elseif (!empty($module_info)) {
			$data['color_scheme'] = $module_info['color_scheme'];
		} else {
			$data['color_scheme'] = '';
		}	

		if (isset($this->request->post['num_posts'])) {
			$data['num_posts'] = $this->request->post['num_posts'];
		} elseif (!empty($module_info)) {
			$data['num_posts'] = $module_info['num_posts'];
		} else {
			$data['num_posts'] = '';
		}

		if (isset($this->request->post['order_by'])) {
			$data['order_by'] = $this->request->post['order_by'];
		} elseif (!empty($module_info)) {
			$data['order_by'] = $module_info['order_by'];
		} else {
			$data['order_by'] = '';
		}			
		
		if (isset($this->request->post['status'])){
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/facebook_comments.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/facebook_comments')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}	
		
		if (utf8_strlen($this->request->post['app_id']) < 3) {
			$this->error['app_id'] = $this->language->get('error_app_id');
		}

		if (utf8_strlen($this->request->post['num_posts']) < 1 || !is_numeric($this->request->post['num_posts']) || $this->request->post['num_posts'] < 1 ) {
			$this->error['num_posts'] = $this->language->get('error_num_posts');
		}		
				
		return !$this->error;	
	}
	
	private function update_check() {
		if (extension_loaded('curl')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_URL, 'https://www.oc-extensions.com/api/v1/update_check');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'v='.$this->version.'&ex=4&e='.urlencode($this->config->get('config_email')));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'OCX-Adaptor: curl'));
			curl_setopt($ch, CURLOPT_REFERER, HTTP_CATALOG);
			
			if (function_exists('gzinflate')) {
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
			}
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$result = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			
			if ($http_code == 200) {
				$result = json_decode($result);
				
				if ( isset($result->version) && ($result->version > $this->version) ) {
						$this->error['update'] = 'A new version of ' . $this->language->get('heading_title') . ' is available: v' . $result->version . '. You can go to <a target="_blank" href="' . $result->url . '">extension page</a> to see the Changelog.';
				}
			}
		} else {
			if (!$fp = @fsockopen('ssl://www.oc-extensions.com', 443, $errno, $errstr, 20)) {
				return false;
			}

			socket_set_timeout($fp, 20);
			
			$data = 'v='.$this->version.'&ex=4&e='.$this->config->get('config_email');
			
			$headers = array();
			$headers[] = "POST /api/v1/update_check HTTP/1.0";
			$headers[] = "Host: www.oc-extensions.com";
			$headers[] = "Referer: " . HTTP_CATALOG;
			$headers[] = "OCX-Adaptor: socket";
			if (function_exists('gzinflate')) {
				$headers[] = "Accept-encoding: gzip";
			}	
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			$headers[] = "Accept: application/json";
			$headers[] = 'Content-Length: '.strlen($data);
			$request = implode("\r\n", $headers)."\r\n\r\n".$data;
			fwrite($fp, $request);
			$response = $http_code = null;
			$in_headers = $at_start = true;
			$gzip = false;
			
			while (!feof($fp)) {
				$line = fgets($fp, 4096);
				
				if ($at_start) {
					$at_start = false;
					
					if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
						return false;
					}
					
					$http_code = $m[2];
					continue;
				}
				
				if ($in_headers) {

					if (trim($line) == '') {
						$in_headers = false;
						continue;
					}

					if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
						continue;
					}
					
					if ( strtolower(trim($m[1])) == 'content-encoding' && trim($m[2]) == 'gzip') {
						$gzip = true;
					}
					
					continue;
				}
				
                $response .= $line;
			}
					
			fclose($fp);
			
			if ($http_code == 200) {
				if ($gzip && function_exists('gzinflate')) {
					$response = substr($response, 10);
					$response = gzinflate($response);
				}
				
				$result = json_decode($response);
				
				if ( isset($result->version) && ($result->version > $this->version) ) {
						$this->error['update'] = 'A new version of ' . $this->language->get('heading_title') . ' is available: v' . $result->version . '. You can go to <a target="_blank" href="' . $result->url . '">extension page</a> to see the Changelog.';
				}
			}
		}
	}	
}
?>