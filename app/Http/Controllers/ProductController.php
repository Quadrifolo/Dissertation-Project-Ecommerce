<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Translation;
use App\CurrencyRate;
use App\AttributeValue;
use DB;

class ProductController extends Controller
{
// Shop Catalog View
    public function index(){

      
     // $translationId = request('translation_id');
  
     // $translationName = null;

     




// 

  // Checks To Get Products Which Are English
      $products = DB::table('products')->where('locale', '=', 'EN')->get();
      
// Query To Find Conversion Rates For US And JPY  from Model Accessor     
      $rateUS = CurrencyRate::find(3); 
      $rate = CurrencyRate::find(2);

      // The 
$converter = $rate->Rates;

$converterUs = $rateUS->Rates;

       

    //  $Size = DB::table('Attributes')->where('code', '=' , 'size')->get();
   //   $Color = DB::table('Attributes')->where('code', '=', 'color')->get();

    
      



      $categoryId = request('category_id');
       $categoryName = null;
      

      
      if($categoryId ) { 

        
        $category = Category::find($categoryId);
        $categoryName = ucfirst($category->name);
        
        
        $products = $category->allproducts();
}
    
    
         /* if($translationId) {

        $translation= Translation::find($translationId);
        $translationName = ucfirst($translation->name);
 
          
         $products=$translation->allproducts();

     }*/
    

       return view('shop.index', ['products' => $products , 'category' =>category::all() ,]);

       }
       
 


  

     

      //dd($currency);
    
    
    //  public function show($locale, $name)
      //{

    public function show($id)
    {


 // Gets Product Info For Item Selected 
        $products = Product::find($id);
        
// Getting Attributes Which Correspond To That Product 
     
                            
                $size = DB::table('attribute_values')->where('product_id', '=' , $products->id)->get('name');

// Stock Management
                $stock = DB::table('attribute_values')->where('product_id', '=' , $products->id)->get('stock');
  //dd($products);
            if ($stock >= "1" ) { 
                $stockValue= "In Stock"; 
            }else {

              $stockValue = "Product Unavailable";

            } 




  // $Color = DB::table('attribute_values')->where('attribute_id', '=', '2')->get();
       
      
         return view('shop.product',['products' => $products , 'size'=> $size, 'stockValue'=>$stockValue ]);

    }



    public function id(Product $product) { 

      session()->push('products.recently_viewed', $product->getKey());

      return view('product.show', compact('product'));

  }




  public function search(Request $request) {

//    dd($request->all());


//Categories Code For List 
$categoryId = request('category_id');
$categoryName = null;

if($categoryId ) { 

 $category = Category::find($categoryId);
 $categoryName = ucfirst($category->name);
 }

$rateUS = CurrencyRate::find(3); 
$rate = CurrencyRate::find(2);

// The Rates For A Conversion  



// Query For Search Bar Functionality 
    $query = $request->input('query');

    $products = DB::table('products')
    ->where('name', 'LIKE',"%$query%")
    ->orWhere('jp_name', 'LIKE', "%$query%")
    ->orWhere('ng_name', 'LIKE',"%$query%" )
    ->get();
    
    

    return view('shop.index', ['products' => $products , 'category' => category::all(), 'converter'=>$converter , 'converterUS'=>$converterUS ]);

  }


  public function addToCart(Request $request)
  {
      $product = $this->productRepository->findProductById($request->input('productId'));
      $options = $request->except('_token', 'productId', 'price', 'qty');
  
      Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);
  
      return redirect()->back()->with('message', 'Item added to cart successfully.');
  }
    //
}

