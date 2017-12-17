<?php namespace Syscover\Admin\Traits;

trait CustomizableValues
{
    public function __get($name)
    {
        $data = $this->getAttribute('data');

        if(
            isset($data['customFields']) &&
            is_array($data['customFields']) &&
            array_key_exists($name, $data['customFields'])
        )
        {
            return $data['customFields'][$name];
        }

        return parent::__get($name);
    }

    public function __isset($name)
    {
        $data = $this->getAttribute('data');

        if(
            isset($data['customFields']) &&
            is_array($data['customFields']) &&
            array_key_exists($name, $data['customFields'])
        )
        {
            return true;
        }

        return parent::__isset($name);
    }
}
