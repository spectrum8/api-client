<?php
namespace Spectrum8\ApiClient\Service;

/**
 * Class ApiService
 * @package Spectrum8\ApiClient\Service
 */
class ApiService extends BaseService
{
    /**
     * @return AvailabilityService
     */
    public function getAvailabilityService()
    {
        $service = new AvailabilityService();
        $service->initConnector([], $this->getConnector());
        return $service;
    }

    /**
     * @return InfoService
     */
    public function getInfoService()
    {
        $service = new InfoService();
        $service->initConnector([], $this->getConnector());
        return $service;
    }

    /**
     * @return OrderService
     */
    public function getOrderService()
    {
        $service = new OrderService();
        $service->initConnector([], $this->getConnector());
        return $service;
    }

    /**
     * @return PaymentService
     */
    public function getPaymentService()
    {
        $service = new PaymentService();
        $service->initConnector([], $this->getConnector());
        return $service;
    }

    /**
     * @return ReportingService
     */
    public function getReportingService()
    {
        $service = new ReportingService();
        $service->initConnector([], $this->getConnector());
        return $service;
    }

    /**
     * @return ServerService
     */
    public function getServerService()
    {
        $service = new ServerService();
        $service->initConnector([], $this->getConnector());
        return $service;
    }

    /**
     * @return ValidateService
     */
    public function getValidateService()
    {
        $service = new ValidateService();
        $service->initConnector([], $this->getConnector());
        return $service;
    }
}
