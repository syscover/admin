<?php namespace Syscover\Admin\Traits;

trait CustomizableValues
{
    public function __get($name)
    {
        // return attribute
        if(array_key_exists($name, $this->getAttributes()))
        {
            return $this->getAttribute($name);
        }
        // return relation
        elseif(array_key_exists($name, $this->getRelations()))
        {
            return $this->getRelation($name);
        }
        else
        {
            if(isset($this->data) && array_key_exists($name, $this->data['customFields']))
            {
                $data = json_decode($this->data, true);
                return $data['customFields'][$name];
            }

            return null;
        }
    }
}
