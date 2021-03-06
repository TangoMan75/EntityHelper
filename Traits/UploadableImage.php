<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Trait UploadableImage
 *
 * 1. Requires entity to own "Categorized", "Timestampable", "Illustrable" and
 * "Sluggable" traits.
 * 2. Requires entity to be marked with "Uploadable" annotation.
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait UploadableImage
{

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $image;

    /**
     * @Vich\UploadableField(mapping="image_upload", fileNameProperty="imageFileName")
     * @Assert\File(maxSize="2M", mimeTypes={
     *     "image/gif",
     *     "image/jpeg",
     *     "image/jpg",
     *     "image/png"
     * })
     * @var File
     */
    protected $imageFile;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $imageFileName;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * imageFile property is not persisted!
     *
     * @return String
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * imageFile property is not persisted!
     *
     * @param File|null $imageFile
     *
     * @return $this
     */
    public function setImageFile(File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->modified = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return String
     */
    public function getImageFileName()
    {
        return $this->imageFileName;
    }

    /**
     * Generates file name from slug
     *
     * @return String|null
     */
    public function getImagePrettyFileName()
    {
        // Returns string left part before last dash
        return substr($this->slug, 0, strrpos($this->slug, '-')).'.'
               .$this->getImageExtension();
    }

    /**
     * Retrieve file extension
     *
     * @return String|null
     */
    public function getImageExtension()
    {
        return end(explode('.', $this->imageFileName));
    }

    /**
     * @param String $imageFileName
     *
     * @return $this
     */
    public function setImageFileName($imageFileName)
    {
        $this->imageFileName = $imageFileName;

        if ($imageFileName) {
            $this->setImage('/uploads/images/'.$imageFileName);
            if ( ! $this->link) {
                $this->link = '/uploads/images/'.$imageFileName;
            }
        } else {
            // Remove deleted file from database
            if ($this->link == $this->image) {
                $this->link = null;
            }
            $this->setImage(null);
        }

        return $this;
    }

    /**
     * Delete image file and cached thumbnail
     * @ORM\PreRemove()
     */
    public function deleteImageFile()
    {
        if ($this->hasCategory('photo') || $this->hasCategory('thetas')) {
            // Get thumbnail path
            $path = __DIR__."/../../../web/media/cache/thumbnail"
                    .$this->getImage();

            // Delete file if exists
            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}
