<?php namespace Pathologic\Debugmail;

class Plugin
{
    protected $modx;
    protected $config = [];

    public function __construct(\DocumentParser $modx)
    {
        $this->modx = $modx;
        $this->loadConfig();
        $this->run();
    }

    public function run()
    {
        $keys = [
            'email_method',
            'smtp_auth',
            'smtp_secure',
            'smtp_host',
            'smtp_port',
            'smtp_username',
            'smtppw'
        ];
        if (!empty($this->config) && count(array_intersect_key(array_flip($keys), $this->config)) === count($keys)) {
            $password = &$this->config['smtppw'];
            $password = trim($password);
            $password = base64_encode($password) . substr(str_shuffle('abcdefghjkmnpqrstuvxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 7);
            $password = str_replace('=','%',$password);
            $this->modx->config = array_merge($this->modx->config, $this->config);
        }
    }

    protected function loadConfig()
    {
        $filename = MODX_BASE_PATH . 'assets/plugins/debugmail/config.php';
        if (is_readable($filename) && ($config = require($filename))) {
            $this->config = array_merge($this->modx->event->params, $config);
        }
    }
}