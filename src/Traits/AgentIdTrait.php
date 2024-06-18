<?php

namespace WeWork\Traits;

trait AgentIdTrait
{
    /**
     * @var string
     */
    protected string $agentId;

    /**
     * @param string $agentId
     */
    public function setAgentId(string $agentId): void
    {
        $this->agentId = $agentId;
    }
}
