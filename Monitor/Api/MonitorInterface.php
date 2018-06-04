<?php

namespace Sandis\Monitor\Api;

use Magento\Framework\Exception\CouldNotDeleteException;

interface MonitorInterface
{
    /**
     * Just a test method
     *
     * @api
     * @return string Some test string.
     */
    public function test();

    /**
     * Get list of jobs that are running or pending
     *
     * @api
     * @return mixed
     */
    public function jobs();

    /**
     * Delete job by filename
     *
     * @param string $filename
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteJob($filename);

    /**
     * Get a list of running cron jobs
     *
     * @api
     * @return mixed
     */
    public function cronsRunning();

    /**
     * Get last executed cron job
     *
     * @api
     * @return mixed
     */
    public function cronsLast();

}
