<?php

/*
 * This file is part of Alt Three Sentry.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AltThree\Sentry;

use AltThree\Logger\LoggerTrait;
use Exception;
use Psr\Log\LoggerInterface;
use Raven_Client as Sentry;

/**
 * This is the logger class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 * @author James Brooks <james@alt-three.com>
 */
class Logger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * The sentry client instance.
     *
     * @var \Raven_Client
     */
    protected $sentry;

    /**
     * Create a new logger instance.
     *
     * @param \Raven_Client $sentry
     *
     * @return void
     */
    public function __construct(Sentry $sentry)
    {
        $this->sentry = $sentry;
    }

    /**
     * Log a message to the logs.
     *
     * @param string $level
     * @param mixed  $message
     * @param array  $context
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $level = $this->getSeverity($level);

        $this->sentry->extra_context($context);

        if ($message instanceof Exception) {
            $this->sentry->getIdent($this->sentry->captureException($message, ['level' => $level]));
        } else {
            $msg = $this->formatMessage($message);
            $this->sentry->getIdent($this->sentry->captureMessage($msg, [], ['level' => $level]));
        }

        $this->sentry->context->clear();
    }

    /**
     * Get the severity for the logger.
     *
     * @param string $level
     *
     * @return string
     */
    protected function getSeverity($level)
    {
        switch ($level) {
            case 'warning':
            case 'notice':
                return Sentry::WARNING;
            case 'info':
            case 'debug':
                return Sentry::INFO;
            default:
                return Sentry::ERROR;
        }
    }
}
