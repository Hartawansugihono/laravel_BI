<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class ProductService
{
    /** @var Product $model */
    private $model;
    
    /**
     * constructor
     */
    public function __construct()
    {
        $this->model = resolve(Product::class);
    }

    /**
     * @param array $request
     */
    public function all($request = []): LengthAwarePaginator
    {
        /** @var int $pagination */
        $pagination = config('app.pagination');
        
        /** @var Builder $query */
        $query = $this->model;

        /** @var string|array $with */
        if (!empty($request['with'])) $query = $query->with($with);

        return $query->orderBy('name', 'asc')->paginate($pagination);
    }

    /**
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        /** @var Product $data */
        $data = $this->model->create($data);

        return $data;
    }
 
    /**
     * get id
     *
     * @param integer $id
     * @return \App\Models\Admin
     */
    public function find($id)
    {
        $data = $this->model->findOrFail($id);
        return $data;
    }
    
    /**
     * @param array $request
     * @param int $id
     * @throws ModelNotFoundException
     */
    public function update($request, $id): bool
    {
        /** @var Product $data */
        $data = $this->model->findOrFail($id);

        /** @var bool $response */
        $response = false;

        DB::transaction(function () use (&$response, $request, $data) {
            $data->fill($request);

            /** @var bool $response */
            $response = $data->save();
        });

        return $response;
    }
 
    /**
     * delete row
     *
     * @param integer $id
     * @return boolean
     */
    public function delete($id)
    {
        $data = $this->model->find($id);
        
        $data->delete();
        return $data;
    }
}