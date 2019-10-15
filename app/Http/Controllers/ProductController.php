<?php


namespace App\Http\Controllers;

use App\ErrorContent;
use App\ErrorMessage;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return response()->json($product, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('createProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ErrorMessage
     */
    public function store(Request $request) {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|gte:0'
        ]);
        if($validatedData->fails()) {
            $responseError = new ErrorMessage();
            array_push($responseError->errors, new ErrorContent(
                "ERROR-1", "Unprocessable Entity"
            ));
            return response()->json($responseError, 422);
        }else{
            $product = Product::create($request->all());
            return response()->json($product, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $responseError = new ErrorMessage();
        $product = Product::find($id);

        if(!$product) {
            array_push($responseError->errors, new ErrorContent(
                "ERROR-2", "Not Found"
            ));

            return response()->json($responseError, 404);
        }else{
            return response()->json($product, 200);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$product = Product::findOrFail($id);
       // return view('editProduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->route('id');
        $responseError = new ErrorMessage();
        $product = Product::find($id);
        if(!$product) {
            array_push($responseError->errors, new ErrorContent(
                "ERROR-2", "Not Found"
            ));
            return response()->json($responseError, 404);
        }else{
            $validatedData = Validator::make($request->all(), [
                'price' => 'numeric|gte:0'
            ]);
        }
        if($validatedData->fails()) {
            array_push($responseError->errors, new ErrorContent(
                "ERROR-1", "Unprocessable Entity"
            ));
            return response()->json($responseError, 422);
        }else{
            $product->update($request->all());
            return response()->json($product, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responseError = new ErrorMessage();
        $product = Product::find($id);

        if(!$product) {
            array_push($responseError->errors, new ErrorContent(
                "ERROR-2", "Not Found"
            ));

            return response()->json($responseError, 404);
        }else{
            $product->delete();
            return response()->json(null, 204);
        }

    }
}
