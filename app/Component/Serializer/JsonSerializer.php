<?php
declare(strict_types = 1);

namespace App\Component\Serializer;

use Hyperf\Contract\NormalizerInterface;
use Hyperf\Utils\Exception\InvalidArgumentException;

class JsonSerializer implements NormalizerInterface
{
    public function normalize($object)
    {
        try {
            return json_encode($object, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        } catch (\Throwable $exception) {
            throw new InvalidArgumentException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param mixed       $data
     * @param null|string $class
     *
     * @return mixed|array
     */
    public function denormalize($data, string $class = null) : array
    {
        $data   = sprintf('%s%s%s', pack('N', strlen($data)), $data, "\r\n");
        $strlen = strlen($data);
        return swoole_substr_json_decode($data, 4, $strlen - 6, true);
    }
}
