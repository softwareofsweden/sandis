<?php

namespace Sandis\Monitor\Model;

use Sandis\Monitor\Api\MonitorInterface;

class Monitor implements MonitorInterface
{

    /**
     * @var \Sandis\Monitor\Helper\Data
     */
    protected $data;

    public function __construct(
        \Sandis\Monitor\Helper\Data $data
    )
    {
        $this->data = $data;
    }

    public function test()
    {
        return "Hello World!";
    }

    public function jobs()
    {
        return array(
            array(
                'type' => 'image',
                'status' => 'running',
                'duration' => '186',
                'filename' => 'Images_20180605103321'
            ),
            array(
                'type' => 'products',
                'status' => 'pending',
                'duration' => '0',
                'filename' => 'Products_20180605103414'
            ),
        );
    }

    public function deleteJob($filename)
    {
        try {
            // DELETE FROM eoh_erpplug_process WHERE filename = ...
            // delete file on disk...
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__(
                'Could not delete the job: %1',
                $exception->getMessage()
            ));
        }

        return true;
    }

    public function cronsRunning()
    {
        return $this->data->query("SELECT * FROM cron_schedule WHERE status = 'running'");
    }

    public function cronsLast()
    {
        return $this->data->query("SELECT * FROM cron_schedule WHERE finished_at IS NOT NULL ORDER BY finished_at DESC LIMIT 1");
    }

}