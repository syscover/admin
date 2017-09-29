<?php namespace Syscover\Admin\Traits;

trait CustomizableValues
{
    public function __get($name)
    {
        if(
            isset($this->data['customFields']) &&
            is_array($this->data['customFields']) &&
            array_key_exists($name, $this->data['customFields'])
        )
        {
            return $this->data['customFields'][$name];
        }
        
        return parent::__get($name);
    }
}
