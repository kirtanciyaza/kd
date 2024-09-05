<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Color\Color;
use Illuminate\Support\Facades\Response;
use Endroid\QrCode\Writer\PngWriter;


class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with('images')->get();


        return view('product.index',compact('product'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $productimage = new ProductImage();
                $productimage->product_id = $product->id;
                $productimage->image = $imageName;
                $productimage->save();
            }
        }

        return redirect()->route('product.index');
    }

    public function show(Request $request, $id)
    {

        $product = Product::with('images')->find($id);

        return view('product.show',compact('product'));

    }

    public function edit(Request $request , $id)
    {
        $product = Product::with('images')->find($id);

        return view('product.edit',compact('product'));
    }

    public function update(Request $request, $id)
{

    $product = Product::with('images')->findOrFail($id);

    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'desc' => 'nullable|string',
        'price' => 'required|numeric',
        'status' => 'required|string|in:Default,Yes,No',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'delete_images.*' => 'nullable|exists:product_images,id',
    ]);

    $product->update([
        'name' => $request->name,
        'desc' => $request->desc,
        'price' => $request->price,
        'status' => $request->status,
    ]);


    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $imageName,
            ]);
        }
    }


    if ($request->has('delete_images')) {
        foreach ($request->input('delete_images') as $imageId) {
            $image = ProductImage::find($imageId);
            if ($image) {

                $imagePath = public_path('images/' . $image->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }

                $image->delete();
            }
        }
    }

    return redirect()->route('product.index')->with('success', 'Product updated successfully!');
}

    public function delete(Request $request, $id)
    {

        $product = Product::with('images')->find($id);



        foreach ($product->images as $image){

                    $imagePath = public_path('images/' . $image->image);
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }

                    $image->delete();
        }


        $product->delete();

        return redirect()->route('product.index')->with('success', 'Selected images deleted successfully!');
    }

    public function qrcode($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $qrCode = new QrCode('productname:' . $product->name .'-'.'productdesc:'. $product->desc.'-'.'productprice'.$product->price);
        $qrCode->setSize(200);
        $qrCode->setForegroundColor(new Color(0, 255, 0)); // Green
        $qrCode->setBackgroundColor(new Color(0, 0, 0)); // Black

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        $filename = 'qrcode_' . $product->name . '.png';

    return Response::make($result->getString(), 200, [
        'Content-Type' => 'image/png',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
    }






}
