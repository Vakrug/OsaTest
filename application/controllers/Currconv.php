<?php

class Currconv extends CI_Controller {
    
        private string $currconv_api_key;
    
        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
                $this->currconv_api_key = $this->config->item('currconv_api_key');
        }
        
        public function index()
        {
                $this->load->view('templates/header');
                $this->load->view('currconv/index');
                $this->load->view('templates/footer');
        }
        
        private function list_json() {
            $json = file_get_contents("https://free.currconv.com/api/v7/currencies?apiKey={$this->currconv_api_key}");
            
            $results = json_decode($json, true);
            
            return $results['results'];
        }
        
        public function list() {
                $data['list'] = $this->list_json();
            
                $this->load->view('templates/header');
                $this->load->view('currconv/list', $data);
                $this->load->view('templates/footer');
        }
        
        public function calculator() {
            
                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('from', 'From', 'required');
                $this->form_validation->set_rules('to', 'To', 'required');
                $this->form_validation->set_rules('amount', 'Amount', 'required');
                
                $data['result'] = '';
                $data['curr_list'] = $this->list_json();

                if ($this->form_validation->run())
                {
                    $from_Currency = urlencode($this->input->post('from'));
                    $to_Currency = urlencode($this->input->post('to'));
                    $query = "{$from_Currency}_{$to_Currency}";

                    $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$this->currconv_api_key}");
                    $obj = json_decode($json, true);

                    $val = floatval($obj["$query"]);

                    $total = $val * $this->input->post('amount');
                    
                    $data['result'] = number_format($total, 2, '.', '');
                }
            
            
                $this->load->view('templates/header');
                $this->load->view('currconv/calculator', $data);
                $this->load->view('templates/footer');
        }
}