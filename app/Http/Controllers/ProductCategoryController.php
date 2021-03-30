<?php

namespace App\Http\Controllers;

use App\Services\ProductCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

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
        return Inertia::render(
            'Product/Category/index', 
            [
                'data' => $this->service->all()
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
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();
  
        $this->service->create($request->all());
  
        return redirect()->back()
                    ->with('message', 'Product Category Created Successfully.');
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
        ])->validate();
  
        $this->service->update($request->all(), $id);
        
        return redirect()->back()
                ->with('message', 'Product Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        
        return redirect()->back()->with('message', 'Product Category deleted successfully.');
    }
}
