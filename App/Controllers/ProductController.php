<?php

namespace App\Controllers;

use App\Models\Product;
use Core\Abstracts\AbstractController;


class ProductController extends AbstractController
{
    /**
     * Get all products
     * @return string
     */
    public function index()
    {
        $product = new Product();

        return $this->json($product->all());
    }

    /**
     * Show a product by id
     *
     * @param $id
     * @return string
     */
    public function show($id)
    {
        $product = new Product();

        return $this->json($product->getOne($id));
    }

    /**
     * Create product
     *
     * @return string
     */
    public function store()
    {
        if ($this->isValidInputs()) {

            $product = new Product();
            $output = $product->create();

            return $this->json($output, 201);
        } else {

            $this->errors['errors'] = $this->validator->flattenMessages();
            return $this->json($this->errors, 400);
        }
    }

    /**
     * Update product
     *
     * @param $id
     * @return string
     */
    public function update($id)
    {
        if ($this->isValidInputs()) {

            $product = new Product();
            $output = $product->update($id);

            return $this->json($output);
        } else {

            $this->errors['errors'] = $this->validator->flattenMessages();
            return $this->json($this->errors, 400);
        }

    }

    /**
     * Delete product by id
     *
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        $product = new Product();
        return $this->json($product->delete($id), 204);
    }

    /**
     * Validate the inputs
     *
     * @return bool
     */
    private function isValidInputs()
    {
        $this->validator->required('title');
        $this->validator->required('description');
        $this->validator->required('categories')->isArray('categories');

        return $this->validator->passes();
    }
}