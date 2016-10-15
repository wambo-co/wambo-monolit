<?php
namespace Wambo\Frontend\Model;

use Wambo\Product\Model\ProductExtensionInterface;

class FrontendProductExtension implements ProductExtensionInterface
{
    /**
     * @var Slug
     */
    private $slug;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $summary;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * FrontendProductExtension constructor.
     * @param Slug $slug
     * @param string $title
     * @param string $summery
     * @param string $description
     * @param string $image
     */
    public function __construct(
        Slug $slug,
        string $title,
        string $summery,
        string $description,
        string $image
    )
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->summary = $summery;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * @return Slug
     */
    public function getSlug() : Slug
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSummery() : string
    {
        return $this->summary;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImage() : string
    {
        return $this->image;
    }
}