<?php
namespace Wambo\Product\Service\Repository;

use Wambo\Frontend\Model\Slug;
use Wambo\Product\Model\Product;
use Wambo\Product\Service\Repository\Exception\RepositoryException;


/**
 * The ProductRepositoryInterface interface provides function for reading and writing Products from and to a storage.
 *
 * @package Wambo\Catalog
 */
interface ProductRepositoryInterface
{
    /**
     * Get all products
     *
     * @return Product[]
     *
     * @throws RepositoryException If fetching the products failed
     */
    public function getProducts();

    public function getProductBySlug(Slug $slug) : Product;

    public function getById(string $id);

    public function add(Product $product);

    public function remove(Product $product);
}