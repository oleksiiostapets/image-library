<?php

namespace App\Services;

use App\Models\Eloquent\ImageModel as ImageEntity;

class ImageService
{
    /**
     * @param array $params
     * @return ImageEntity
     */
    public function save($params)
    {
        $image = ImageEntity::create($params);

        return $image;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll(){
        return ImageEntity::paginate(4);
    }

}