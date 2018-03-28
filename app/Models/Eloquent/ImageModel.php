<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImageModel
 * @package App\Models
 */
class ImageModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'images';

    /**
     * @var array
     */
    protected $fillable = [
        'caption',
        'description',
        'alternative',
        'name',
        'mime',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'image_src',
        'thumb_src',
    ];

    /**
     * @return string
     */
    public function getImageSrcAttribute()
    {
        $s3 = \Storage::disk('s3');
        $s3Image = $s3->get($this->name);
        $imgData = base64_encode($s3Image);
        return 'data:data:'.$this->mime.';base64,'.$imgData;
    }

    /**
     * @return string
     */
    public function getThumbSrcAttribute()
    {
        $s3 = \Storage::disk('s3');
        $s3Image = $s3->get('thumb_200x200_'.$this->name);
        $imgData = base64_encode($s3Image);
        return 'data:data:'.$this->mime.';base64,'.$imgData;
    }
}
