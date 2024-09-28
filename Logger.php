<?php

namespace Symfony\Component\Process;

class Logger
{
    private $logs = [];

    private function formatMessage($level, $message)
    {
        $timestamp = date('Y-m-d H:i:s');
        return "[$timestamp] [$level] $message";
    }

    public function info($message)
    {
        $formattedMessage = $this->formatMessage('INFO', $message);
        $this->logs[] = $formattedMessage;
    }

    public function error($message)
    {
        $formattedMessage = $this->formatMessage('ERROR', $message);
        $this->logs[] = $formattedMessage;
    }

    public function getLogs()
    {
        return $this->logs;
    }

    public function clearLogs()
    {
        $this->logs = [];
    }
}
