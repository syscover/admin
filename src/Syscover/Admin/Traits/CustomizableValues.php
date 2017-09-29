<?php namespace Syscover\Admin\Traits;

trait CustomizableValues
{
    public function __get($name)
    {
        if($this->hasAttribute($name))
        {
            return $this->attributes[$name];
        }
        else
        {
            $data = json_decode($this->data, true);

            if(array_key_exists($name, $data['customFields']))
            {
                return $data['customFields'][$name];
            }

            return null;
        }
    }
}
