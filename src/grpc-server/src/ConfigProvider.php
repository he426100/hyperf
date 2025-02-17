<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\GrpcServer;

use Hyperf\GrpcServer\Listener\RegisterProtocolListener;
use Hyperf\GrpcServer\Listener\RegisterServiceListener;
use Hyperf\ServiceGovernance\ServiceManager;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'listeners' => [
                RegisterProtocolListener::class,
                value(function () {
                    if (class_exists(ServiceManager::class)) {
                        return RegisterServiceListener::class;
                    }
                    return null;
                }),
            ],
        ];
    }
}
