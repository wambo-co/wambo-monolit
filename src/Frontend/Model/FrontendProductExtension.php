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
     * FrontendProductExtension constructor.
     * @param Slug $slug
     * @param string $title
     */
    public function __construct(Slug $slug, string $title, string $summery, string $description)
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->summary = $summery;
        $this->description = $description;
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
}