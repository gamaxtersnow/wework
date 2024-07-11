<?php

namespace WeWork;

use WeWork\Bridge\Cache;
use WeWork\Bridge\Log;
use WeWork\Qrcode\WxQrcode;
use Doctrine\Common\Collections\ArrayCollection;
use Endroid\QrCode\QrCode;
use GuzzleHttp\Client;
use WeWork\Crypt\WXBizDataCrypt;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;
use WeWork\ApiCache\JsApiTicket;
use WeWork\ApiCache\Ticket;
use WeWork\ApiCache\Token;
use WeWork\Crypt\WXBizMsgCrypt;
use WeWork\Http\ClientFactory;
use WeWork\Http\HttpClient;

class App extends ContainerBuilder
{
    private ArrayCollection $config;
    private array $apiServices = [
        'agent'      => Api\Agent::class,
        'appChat'    => Api\AppChat::class,
        'batch'      => Api\Batch::class,
        'checkIn'    => Api\CheckIn::class,
        'corp'       => Api\Corp::class,
        'crm'        => Api\CRM::class,
        'department' => Api\Department::class,
        'invoice'    => Api\Invoice::class,
        'media'      => Api\Media::class,
        'menu'       => Api\Menu::class,
        'message'    => Api\Message::class,
        'tag'        => Api\Tag::class,
        'user'       => Api\User::class,
        'oa'      => Api\Approval::class,
        'session' => Api\Session::class
    ];
    public function __construct(array $config)
    {
        parent::__construct();

        $this->config = new ArrayCollection($config);

        $this->registerServices();
    }
    private function registerServices(): void
    {
        $this->_registerLogger();
        $this->_registerHttpClient();
        $this->_registerCache();
        $this->_registerToken();
        $this->_registerQrCode();
        $this->_registerQwQrCode();
        $this->_registerWXBizDataCrypt();
        $this->_registerCallback();
        $this->_registerHttpClientWithToken();

        foreach ($this->apiServices as $id => $class) {
            $this->_registerApi($id, $class);
        }

        $this->_registerJsApiTicket();
        $this->_registerTicket();
        $this->_registerJssdk();
    }
    private function _registerLogger(): void
    {
        $this->register('logger', Log::class);
    }
    private function _registerHttpClient(): void
    {
        $this->register('client', Client::class)
            ->addArgument(new Reference('logger'))
            ->setFactory([ClientFactory::class, 'create']);

        $this->register('http_client', HttpClient::class)
            ->addArgument(new Reference('client'));
    }
    private function _registerCache(): void
    {
        $this->register('cache', Cache::class);
    }
    private function _registerToken(): void
    {
        $this->register('token', Token::class)
            ->addMethodCall('setCorpId', [$this->config->get('corp_id')])
            ->addMethodCall('setSecret', [$this->config->get('secret')])
            ->addMethodCall('setCache', [new Reference('cache')])
            ->addMethodCall('setHttpClient', [new Reference('http_client')]);
    }

    private function _registerCallback(): void
    {
        $this->register('request', Request::class)
            ->setFactory([Request::class, 'createFromGlobals']);

        $this->register('crypt', WXBizMsgCrypt::class)
            ->setArguments([$this->config->get('token'), $this->config->get('aes_key'), $this->config->get('corp_id')]);

        $this->register('callback', Callback::class)
            ->setArguments([new Reference('request'), new Reference('crypt')]);
    }

    /**
     * @return void
     */
    private function _registerHttpClientWithToken(): void
    {
        $this->register('client_with_token', Client::class)
            ->setArguments([new Reference('logger'), new Reference('token')])
            ->setFactory([ClientFactory::class, 'create']);

        $this->register('http_client_with_token', HttpClient::class)
            ->addArgument(new Reference('client_with_token'));
    }

    /**
     * @param string $id
     * @param string $class
     *
     * @return void
     */
    private function _registerApi(string $id, string $class): void
    {
        $api = $this->register($id, $class)
            ->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);

        if (in_array($id, ['agent', 'menu', 'message'])) {
            $api->addMethodCall('setAgentId', [$this->config->get('agent_id')]);
        }
        if ($id == 'agent') {
            $api->addMethodCall('setAgentId', [$this->config->get('agent_id')])
                ->addMethodCall('setCorpId', [$this->config->get('corp_id')])
                ->addMethodCall('setSecret', [$this->config->get('secret')])
                ->addMethodCall('setAuthUrl', [$this->config->get('oauth_url')])
                ->addMethodCall('setRedirectUrl', [$this->config->get('redirect_url')]);
        }
        if($id == 'session') {
            $api->addMethodCall('setWxBizDataCrypt', [new Reference('wx_biz_data_crypt')]);
        }
    }

    /**
     * @return void
     */
    private function _registerJsApiTicket(): void
    {
        $this->register('jsApiTicket', JsApiTicket::class)
            ->addMethodCall('setSecret', [$this->config->get('secret')])
            ->addMethodCall('setCache', [new Reference('cache')])
            ->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);
    }

    /**
     * @return void
     */
    private function _registerTicket(): void
    {
        $this->register('ticket', Ticket::class)
            ->addMethodCall('setCache', [new Reference('cache')])
            ->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);
    }

    /**
     * @return void
     */
    private function _registerJssdk(): void
    {
        $this->register('jssdk', JSSdk::class)
            ->addMethodCall('setCorpId', [$this->config->get('corp_id')])
            ->addMethodCall('setJsApiTicket', [new Reference('jsApiTicket')])
            ->addMethodCall('setTicket', [new Reference('ticket')]);
    }
    private function _registerQrCode(): void
    {
        $this->register('qrcode', QrCode::class)
            ->setArguments(['']);
    }
    private function _registerQwQrCode(): void
    {
        $this->register('wx_qrcode', WxQrcode::class)
            ->addMethodCall('setQrCodeClient', [new Reference('qrcode')]);
    }
    public function _registerWXBizDataCrypt(): void
    {
        $this->register('wx_biz_data_crypt', WXBizDataCrypt::class)
            ->addMethodCall('setAppId', [$this->config->get('app_id')]);
    }
}
