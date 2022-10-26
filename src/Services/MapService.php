<?php

namespace Armd\Mapping\Services;

class MapService
{
    public function Map($inputArray, $configArray): array
    {
        return $this->replace($inputArray, $configArray);
    }

    private function replace($inputArray, $configArray, $key = null)
    {
        foreach ($configArray as $key => $value) {
            if (key_exists($key, $inputArray)) {
                if (key_exists('value', $value) && key_exists('child', $value)) {
                    $inputArray[$value['value']] =
                        $this->replace($inputArray[$key], $value['child'], $key);
                    unset($inputArray[$key]);
                } else if (key_exists('child', $value)) {
                    $inputArray[$key] =
                        $this->replace($inputArray[$key], $value['child'], $key);
                } else if (key_exists('value', $value)) {
                    $inputArray[$value['value']] = $inputArray[$key];
                    unset($inputArray[$key]);
                } else {
                    continue;
                }
            }
        }

        return $inputArray;
    }
}
