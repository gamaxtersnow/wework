<?php

namespace WeWork\Api;

use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\AuthUrlTrait;
use WeWork\Traits\CorpIdTrait;
use WeWork\Traits\HttpClientTrait;
use WeWork\Traits\RedirectUrlTrait;
use WeWork\Traits\SecretTrait;

class Agent
{
    use HttpClientTrait, AgentIdTrait, CorpIdTrait, SecretTrait,AuthUrlTrait,RedirectUrlTrait;

    /**
     * 获取应用
     *
     * @return array
     */
    public function get(): array
    {
        return $this->httpClient->get('agent/get', ['agentid' => $this->agentId]);
    }

    /**
     * 设置应用
     *
     * @param array $json
     * @return array
     */
    public function set(array $json): array
    {
        return $this->httpClient->postJson('agent/set', array_merge(['agentid' => $this->agentId], $json));
    }

    /**
     * 获取应用列表
     *
     * @return array
     */
    public function list(): array
    {
        return $this->httpClient->get('agent/list');
    }
    public function getLoginAuthUrl(string $state,string $scope='snsapi_privateinfo'):string {
        return $this->authUrl.'?appid='.$this->corpId.'&redirect_uri='.$this->redirectUrl.'&response_type=code&scope='.$scope.'&state='.$state.'&agentid='.$this->agentId.'&connect_redirect=1#wechat_redirect';
    }
}
