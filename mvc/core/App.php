<?php
class App
{
    protected $_controller = 'hotel';
    protected $_action = 'show';
    protected $_param = null;

    public function __construct()
    {
        //CONTROLLER
        //check if have controller
        if(isset($_GET['controller'])){
        if (file_exists('mvc/controllers/' . $_GET['controller'] . '.php')) {
            $this->_controller = $_GET['controller'];
        }
    }
        require_once 'mvc/controllers/' . $this->_controller . '.php';
        $this->_controller = new $this->_controller;

        //ACTION
        //check if it have action inside controller
        if(isset($_GET['action']))
        if (method_exists($this->_controller, $_GET['action'])) {
            $this->_action = $_GET['action'];
        }

        //PARAM
        $this->_param = $this->paramProcess();

        //
        call_user_func_array([$this->_controller, $this->_action], $this->_param);
    }

    public function paramProcess()
    {
        if (isset($_GET['param'])) {
            return explode("/", filter_var(trim($_GET['param'])));
        }
        return [];
    }
}
