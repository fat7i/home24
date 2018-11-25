<?php

namespace App\Models;

use Core\Abstracts\AbstractModel;


class Product extends AbstractModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Soft delete flag
     * @var bool
     */
    protected $softDelete = true;


    /**
     * Get All Products
     *
     * @return array
     */
    public function all()
    {
        // Get total products for pagination
        $totalProducts = $this->select('COUNT(id) AS `total`')
            ->from('products p')
            ->where('p.deleted_at IS NULL')
            ->fetch();

        if ($totalProducts) {
            $this->pagination->setTotalItems((int) $totalProducts['total']);
            $this->pagination->paginate();
        }else{
            return null;
        }

        // We Will get the current page
        $currentPage = $this->pagination->page();

        // We Will get the items Per Page
        $limit = $this->pagination->itemsPerPage();

        // Set our offset
        $offset = $limit * ($currentPage - 1);


        $rows = $this->select('p.id', 'p.title', 'p.description', 'p.created_at')
            ->from('products p')
            ->where('p.deleted_at IS NULL')
            ->orderBy('p.created_at', 'DESC')
            ->limit($limit, $offset)
            ->fetchAll();

        $products = [];

        foreach ($rows as $row) {
            $row['user'] = $this->user($row['id']);
            $row['categories'] = $this->categories($row['id']);
            $products[] = $row;
        }


        $output['current_page'] = $this->pagination->page();

        $output['data'] = $products;

        $output['per_page'] = $this->pagination->itemsPerPage();

        $output['total'] = (int) $this->pagination->totalItems();

        $output['last_page'] = $this->pagination->last();

        return $output;
    }

    /**
     * Get Categories array for product by product id
     *
     * @param int $id
     * @return array
     */
    private function categories(int $id)
    {
        return $this->select('c.id', 'c.title')
            ->from('products p')
            ->join('LEFT JOIN category_product cp on p.id = cp.product_id')
            ->join('LEFT JOIN categories c ON cp.category_id = c.id')
            ->where('p.id = ?', $id)
            ->fetchAll();
    }

    /**
     * Get owner user for a product by product id
     *
     * @param int $id
     * @return array
     */
    private function user(int $id)
    {
        return $this->select('u.id', 'u.email', 'u.name')
            ->from('products p')
            ->join('LEFT JOIN users u ON p.user_id=u.id')
            ->where('p.id = ?', $id)
            ->fetchAll();
    }

    /**
     * Get one product by id
     *
     * @param int $id
     * @return null
     */
    public function getOne (int $id)
    {
        $output = $this->select('p.id', 'p.title', 'p.description', 'p.created_at')
            ->from('products p')
            ->where('p.id = ? AND p.deleted_at IS NULL', $id)
            ->fetch();

        if (!$output) return null;

        $output['user'] = $this->user($output['id']);
        $output['categories'] = $this->categories($output['id']);

        return $output;
    }

    /**
     * Create product
     *
     * @return object Product
     */
    public function create()
    {
        $product_id = $this->data('title', $this->request->post('title'))
            ->data('description', $this->request->post('details'))
            ->data('user_id', get_user_id_from_token())
            ->insert($this->table)->lastId();

        $this->sync($product_id, $this->request->post('categories'));

        return $this->getOne($product_id);
    }

    /**
     * Synchronize categories for product
     *
     * @param int $id product id
     * @param array $categories
     */
    private function sync(int $id, array $categories)
    {

        $this->where('product_id = ?', $id)->delete('category_product');

        foreach ($categories as $category_id)
            $this->data('product_id', $id)
                ->data('category_id', $category_id)
                ->insert('category_product');
    }

    /**
     * Update product by id
     *
     * @param int $id
     * @return object Product
     */
    public function update(int $id)
    {
        if ($this->exists($id)) {
            $this->data('title', $this->request->post('title'))
                ->data('description', $this->request->post('details'))
                ->data('user_id', get_user_id_from_token())
                ->where('id=?', $id)
                ->update($this->table);

            $this->sync($id, $this->request->post('categories'));

            return $this->getOne($id);

        } else {
            return null;
        }
    }
}