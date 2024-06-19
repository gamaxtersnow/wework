<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class Approval
{
    use HttpClientTrait;

    /**
     * 获取模板详情
     * @param array $query 查询参数数组
     * @return array 返回从服务器获取的模板详情数据
     */
    public function getTemplateDetail(array $query): array
    {
        return $this->httpClient->postJson('oa/gettemplatedetail', $query);
    }

    /**
     * 申请事件
     * @param array $query 查询参数数组
     * @return array 返回申请事件的结果数据
     */
    public function applyEvent(array $query): array
    {
        return $this->httpClient->postJson('oa/applyevent', $query);
    }

    /**
     * 获取审批信息
     * @param array $query 查询参数数组
     * @return array 返回从服务器获取的审批信息
     */
    public function getApprovalInfo(array $query): array
    {
        return $this->httpClient->postJson('oa/getapprovalinfo', $query);
    }

    /**
     * 获取审批数据
     * @param array $query 查询参数数组
     * @return array 返回从服务器获取的审批数据
     */
    public function getApprovalData(array $query): array
    {
        return $this->httpClient->postJson('oa/getapprovaldata', $query);
    }

    /**
     * 获取审批详情
     * @param array $query 查询参数数组
     * @return array 返回从服务器获取的审批详情数据
     */
    public function getApprovalDetail(array $query): array
    {
        return $this->httpClient->postJson('oa/getapprovaldetail', $query);
    }

    /**
     * 创建审批模板
     * @param array $query 查询参数数组
     * @return array 返回创建审批模板的结果数据
     */
    public function approvalCreateTemplate(array $query): array
    {
        return $this->httpClient->postJson('oa/approval/create_template', $query);
    }

    /**
     * 更新审批模板
     * @param array $query 查询参数数组
     * @return array 返回更新审批模板的结果数据
     */
    public function approvalUpdateTemplate(array $query):array
    {
        return $this->httpClient->postJson('oa/approval/update_template', $query);
    }
    /**
     * 查询审批单当前状态
     * @param array $query
     * @return array
     */
    public function getOpenApprovalData(array $query):array
    {
        return $this->httpClient->postJson('corp/getopenapprovaldata', $query);
    }

    /**
     * 高级--设置审批单审批信息
     * @param array $query
     * @return array
     */
    public function setAdvancedApprovalDetail(array $query):array
    {
        return $this->httpClient->postJson('advanced_feature/set_approval_detail', $query);
    }

    /**
     * 高级--批量获取申请单ID
     * @param array $query
     * @return array
     */
    public function getAdvancedApplyIdList(array $query):array
    {
        return $this->httpClient->postJson('advanced_feature/get_apply_id_list', $query);
    }

    /**
     * 高级--获取申请单详细信息
     * @param array $query
     * @return array
     */
    public function getAdvancedApprovalInfo(array $query):array
    {
        return $this->httpClient->postJson('advanced_feature/get_approval_info', $query);
    }
}
