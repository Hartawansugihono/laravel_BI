<?php

namespace App\Http\Controllers;

use App\Services\ProductCategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductController extends Controller
{
    protected $service;

    /**
     * Constructor
     * 
     * @param $masterAdminService
     */
    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render(
            'Product/index', 
            [
                'data' => $this->service->all(),
                'category' => resolve(ProductCategoryService::class)->all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => ['required'],
            'product_category_id'   => ['required', 'exists:product_categories,id'],
            'price'                 => ['required', 'integer'],
            'amount'                => ['required', 'integer'],
            'qty'                   => ['required', 'integer']
        ]);
  
        $this->service->create($request->only(['name', 'product_category_id', 'price', 'qty', 'amount']));
  
        return redirect()->back()
                    ->with('message', 'Product Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'price' => ['required', 'integer'],
            'amount' => ['required', 'integer'],
            'qty' => ['required', 'integer']
        ])->validate();
  
        $this->service->update($request->only(['name', 'product_category_id', 'price', 'qty', 'amount']), $id);
        
        return redirect()->back()
                ->with('message', 'Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        
        return redirect()->back()->with('message', 'Product deleted successfully.');
    }
}
