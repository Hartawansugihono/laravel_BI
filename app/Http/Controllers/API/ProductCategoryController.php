<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryCollection;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $service;

    /**
     * Constructor
     * 
     * @param $masterAdminService
     */
    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->service = $productCategoryService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ProductCategoryCollection::collection($this->service->all( $request->all() ));
        // return response()->json($this->service->all( $request->all() ));
    }
}
