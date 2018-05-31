<?php namespace Syscover\Admin\Traits;

trait CustomizableValues
{
    public function __get($name)
    {
        $data = $this->getAttribute('data');

        if(
            isset($data['custom_fields']) &&
            is_array($data['custom_fields']) &&
            array_key_exists($name, $data['custom_fields'])
        )
        {
            return $data['custom_fields'][$name];
        }

        return parent::__get($name);
    }

    public function __isset($name)
    {
        $data = $this->getAttribute('data');

        if(
            isset($data['custom_fields']) &&
            is_array($data['custom_fields']) &&
            array_key_exists($name, $data['custom_fields'])
        )
        {
            return true;
        }

        return parent::__isset($name);
    }
}
