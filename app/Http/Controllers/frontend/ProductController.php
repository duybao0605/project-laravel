<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\History;

use Image;
use Session;
use Mail;

 

class ProductController extends Controller
{
    public function show(){
    	$products = Product::all();
    	$Countproducts = Product::all()->count();
    	return view('frontend.product.list',compact('products','Countproducts'));
    }

    //Add
    public function showform(){
    	$getCategory = Category::All()->toArray();
      $getBrand = Brand::All()->toArray();

      return view('frontend.product.add',compact('getCategory','getBrand'));
    }
    public function add(ProductRequest $request){
    	$data = $request->all();

    	$product = new Product();

    	$product->name = $data['name'];
      $product->category = $data['category'];
      $product->brand = $data['brand'];
      $product->status = $data['status'];
      $product->company = $data['company'];
      $product->detail = $data['detail'];
      if($data['sale']){
        $product->sale = $data['sale'];
      }else{
        $product->sale = 0;
      }
      
      $product->price = $data['price'];

      $data2 = [];
      $request_img = [];
      foreach($request->file('image') as $image){
        $request_img[] = $image;
      }
      if(count($request_img) == 3){
    	  if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {   

                $name = $image->getClientOriginalName();
                $name_2 = "2".$image->getClientOriginalName();
                $name_3 = "3".$image->getClientOriginalName();

                //$image->move('upload/product/', $name);
                
                $path = public_path('upload/user/product_img/' . $name);
                $path2 = public_path('upload/user/product_img/' . $name_2);
                $path3 = public_path('upload/user/product_img/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(328, 380)->save($path2);
                Image::make($image->getRealPath())->resize(85, 84)->save($path3);
                
                $data2[] = $name;
            }
        }
      }else{
        return redirect()->back()->withErrors('qua so luong anh cho phep');
      }   


      $product->image=json_encode($data2);

      if($product->save()){
        return back()->with('success', 'Them san pham thanh cong');
      }

      
    }

    
    //Edit
    public function edit($id){
      $data = Product::find($id);
      $getCategory = Category::All()->toArray();
      $getBrand = Brand::All()->toArray();
      return view("frontend.product.edit",compact('data','getCategory','getBrand'));
    }

    public function update(Request $request, $id){
      $data = $request->all();

      $product = Product::findOrFail($id);
      $product->name = $data['name'];
      $product->price = $data['price'];
      $product->category = $data['category'];
      $product->brand = $data['brand'];
      $product->status = $data['status'];
      $product->company = $data['company'];
      $product->detail = $data['detail'];


        $data2 = [];

        if(isset($data['checkbox_image']) && isset($data['image'])){
          $checkbox_image = $data['checkbox_image'];
          
          $old_image = json_decode($product->image);
            foreach ($checkbox_image as $value) {
              unset($old_image[array_search( $value, $old_image)]);
            } 

              $request_img = [];
              foreach($request->file('image') as $image){
                $request_img[] = $image;
              }

              $new_image =[];
              // dd(count($old_image));
              // dd(count($request_img));
              if((count($request_img) < 3-count($old_image))){
                if($request->hasfile('image')){
                  foreach($request->file('image') as $image){
                      if(empty($old_image[0])){
                        $old_image[0] = $image;
                        $name = $image->getClientOriginalName();
                        $path = public_path('upload/user/product_img/' . $name);
                        Image::make($image->getRealPath())->save($path);
                      }else if(empty($old_image[1])){
                        $old_image[1] = $image;
                        $name_2 = "2".$image->getClientOriginalName();
                        $path2 = public_path('upload/user/product_img/' . $name_2);
                        Image::make($image->getRealPath())->resize(329 , 380)->save($path2);
                      }else{
                        $old_image[2] = $image;
                        $name_3 = "3".$image->getClientOriginalName();
                        $path3 = public_path('upload/user/product_img/' . $name_3);
                        Image::make($image->getRealPath())->resize(85 , 84)->save($path3);
                      }
                  }

                  ksort($old_image);
                  $data2 = [];
                  foreach ($old_image as $value) {
                    if (!is_string($value)) {
                      $name = $value->getClientOriginalName();
                      $data2[]= $name;
                    }else{
                      $data2[]= $value;
                    }
                    
                  }
                  $product->image=json_encode($data2);

                  if($product->save()){
                    return back()->with('success', 'Update san pham thanh cong');
                  }
                }
                
              }else{
                return redirect()->back()->withErrors('so luong hinh anh them va xoa khac nhau');

              }
        }else{
          return redirect()->back()->withErrors('ban chua chon hoac them hinh anh can update');
        }

    }

    //Delete
    public function delete($id){
        if (Product::where('id',$id)->delete()) {
          # code...
          return redirect()->back()->with('success',__('Delete Product succes'));
        }else{
          return redirect()->back()->withErrors('Delete Product error');
        }
        
        
    }

    //Index
    public function getProducts(){
      $getCategory = Category::All();
      $getBrand = Brand::All()->toArray();
    	$products = Product::all();

    	$allProduct =array();
    	foreach ($products as $product) {
    			array_push($allProduct, $product->created_at);
    			
		  }
    		
    	rsort($allProduct);
    	$six_Product = array_slice($allProduct, 0,6);

    	$newProducts =array();
    	foreach ($six_Product as $product_time) {
    		$product = Product::where('created_at',$product_time)->get();
    		array_push($newProducts, $product);
    	}
    	
    	return view('frontend.product.index',compact('newProducts','getCategory','getBrand'));
    }


    //Detail
    public function detail($id){
      $product = Product::find($id);
      return view('frontend.product.detail',compact('product'));

    }
    
    //AddToCart
    public function addCart(Request $request){
      $id = $_POST['id'];

      $product = Product::where('id',$id)->get();
      $item = [];
        // Session::flush();
        // dd(session()->all());
      foreach ($product as $product ) {
        $item['id'] = $product->id;
        $item['name'] = $product->name;
        $item['quantity'] = 1;
        $img = json_decode($product['image']);
        $item['image'] = $img[0];
        if($product->sale != 0){
          $sale_price = $product->price *((100-$product->sale)/100);
          $item['price'] = $sale_price;
        }else{
          $item['price'] = $product->price;
        }
        
      }
      
      $err = 0;
      $flag = 1;


      if(session()->has('cart')){
          $getSession = session()->get('cart');
          foreach ($getSession as $key => $value) {
            if($id == $value['id']){
              $getSession[$key]['quantity'] +=1;
              session()->put('cart',$getSession);
              $flag = 0; 
            } 
          }
      }

      if($flag == 1){
        session()->push('cart',$item);
      }

      return redirect()->back()->with('success',__('Add to cart succes'));


    }

    public function showCart(){
      if(session()->has('cart')){
        $cart = session()->get('cart');

        return view('frontend.product.cart',compact('cart'));
      }else{
        return view('frontend.product.cart');
      }


    }

    
    public function cart( Request $request){
      if(isset($_POST['up'])){
        if($_POST['up'] == true){
          $id = $_POST['id'];
          $getSession = session()->get('cart');

          foreach ($getSession as $key => $value) {
            if($id == $value['id']){
              $getSession[$key]['quantity'] +=1;
              session()->put('cart',$getSession);
            } 
          }
        }
      }
      if(isset($_POST['down'])){
        if($_POST['down'] == true){
          $id = $_POST['id'];
          $getSession = session()->get('cart');
          
          foreach ($getSession as $key => $value) {
            if($id == $value['id']){
              $getSession[$key]['quantity'] -=1;
              session()->put('cart',$getSession);
            } 
          }
        }
      }
      
      if(isset($_POST['delete'])){
        if($_POST['delete'] == true){
          $id = $_POST['id'];
          $getSession = session()->get('cart');

          foreach ($getSession as $key => $value) {
            if($id == $value['id']){
              unset($getSession[$key]);
              

            } 
          }
          session()->put('cart',$getSession);

        }
      }


    }



    public function sendMail(){
      //send mail
      
      if(Auth::check()){
        $to_name = Auth::user()->name;
        $to_email = Auth::user()->email;
      }
      $cart = session()->get('cart');

      $data = array("name"=>"thanh toan don ","body"); //body of mail.blade.php

      Mail::send('frontend.sendmail.sendmail',$data,function($message) use ($to_name,$to_email){

          $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
          $message->from($to_email,$to_name);//send from this mail
      });

      $cart = session()->get('cart');
      $tong = 0;
        foreach ($cart as $key => $value) { 
        $price = $value['price']*$value['quantity'];
        $tong += $price;
      };

      $history = new History();
      $history->email = Auth::user()->email;
      $history->phone = Auth::user()->phone;
      $history->name = Auth::user()->name;
      $history->id_user = Auth::user()->id;
      $history->price = $tong;

      $history->save();

      session()->forget('cart');

      return redirect()->back()->with('success',__('Thanh toan thanh cong'));

    }

    //Search
    
    public function search(Request $request){
      $search = $request->search;
      $searchProduct = Product::where('name','like','%'.$search.'%')->get();
      
      return view('frontend.product.search',compact('searchProduct'));
    }

    public function search_ad(Request $request){
      $getCategory = Category::All();
      $getBrand = Brand::All()->toArray();
      $data = $request->all();

      

      $product = Product::query();

      if ($data['key'] != null)
      {
         $product->where('name','like','%'.$data['key'].'%');
      }

      
      if ($data['price'] != 'null')
      {   
          $price = $data['price'];
          switch ($price) {
           case '1-100':
             $product->where('price','<',101);
             break;
           case '100-500':
             $product->whereBetween('price', [100, 500]);
           case '500-1000':
             $product->whereBetween('price', [500, 1000]);
  
           default:
             $product->where('price','>',1000);
             break;
         }
      }

      if ($data['category'] != "null")
      {
         $product->where('category',$data['category']);
      }
      if ($data['brand'] != "null")
      {
         $product->where('brand',$data['brand']);
      }


      $searchProduct = $product->orderBy('created_at')->paginate(6);

      return view('frontend.product.search_advanced',compact('getCategory','getBrand','searchProduct'));
      // $searchProduct = Product::where('name','like','%'.$search.'%')->get();
      
    }

    public function priceRage(){
      $priceRage = $_POST['priceRage'];

      $priceStart = $priceRage[0];
      $priceEnd = $priceRage[1];


      $searchPriceProduct = Product::whereBetween('price', [$priceStart, $priceEnd])
                        ->get()->toArray();
    

      return response()->json([
        'product' => $searchPriceProduct,
      ]);
    }







}

