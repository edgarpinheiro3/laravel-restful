<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;
    private $totalPage = 15;

    public function __construct(Product $product){
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = $this->product->paginate($this->totalPage);

        return response()->json(['data' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validate = validator($data, $this->product->rules());

        if ( $validate->fails() ) {
            $messages = $validate->messages();

            return response()->json(['validate.error', $messages]);
        }

        if ( !$insert = $this->product->create($data) )

            return response()->json(['error' => 'error_insert'], 500);


        return response()->json($insert);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$product = $this->product->findOrFail($id);
        if ( !$product = $this->product->find($id) )

            return response()->json(['error', 'product_not_found']);

        return response()->json(['data' => $product]);
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
        $data = $request->all();

        $validate = validator($data, $this->product->rules($id));

        if ( $validate->fails() ) {
            $messages = $validate->messages();

            return response()->json(['validate.error', $messages]);
        }

        if ( !$product = $this->product->find($id) )

            return response()->json(['error', 'product_not_found']);

        if ( !$update = $product->update($data) )

            return response()->json(['error', 'product_not_update'], 500);

        //PUT
        return response()->json(['response' => $update]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ( !$product = $this->product->find($id) )

            return response()->json(['error', 'product_not_found']);
        
            if ( !$delete = $product->delete() )

            return response()->json(['error', 'product_not_delete'], 500);

        //DELETE
        return response()->json(['response' => $delete]);


    }

    public function search(Request $request)
    {

        $data = $request->all();

        $validate = validator($data, $this->product->rulesSearch());

        if ( $validate->fails() ) {
            $messages = $validate->messages();

            return response()->json(['validate.error', $messages]);
        }

        $products = $this->product->search($data, $this->totalPage);
        
        return response()->json(['data' => $products]);


    }
}
