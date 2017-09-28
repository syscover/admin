<?php namespace Syscover\Admin\Traits;

trait Slugable
{
    /**
     *  Function to check if slug exists
     *
     * @access  public
     * @param   string          $slug
     * @param   string          $field
     * @param   integer|string  $id
     * @return  string          $slug
     */
    public function checkSlug($slug, $id = null, $field = "slug")
    {
        $instance   = new static;

        $query = $instance->where($field, $slug);
        if($id !== null) $query->whereNotIn($instance->getKeyName(), [$id]);
        $n = $query->count();

        if($n > 0)
        {
            $suffix = 0;
            while($n > 0)
            {
                $suffix++;
                $slug = $slug . '-' . $suffix;

                $query = $instance->where($field, $slug);
                if($id !== null) $query->whereNotIn($instance->getKeyName(), [$id]);
                $n = $query->count();
            }
        }

        return $slug;
    }
}

