<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use DB;

class AuthController extends Controller
{
    public function home()
    {
       
        $category =DB::table('category')->get();
        $Laptopsproducts = Product ::join('category', 'products.cat_id', '=', 'category.id')
        ->where('category.cat_name', '=', 'Laptops')
        ->select('products.*','category.*')
        ->get();

        $Phonesproducts = Product ::join('category', 'products.cat_id', '=', 'category.id')
        ->where('category.cat_name', '=', ' Smartphones')
        ->select('products.*','category.*')
        ->get();

        
    //    echo '<pre>';
    //         print_r($Phonesproducts);
    //         exit();
       
     return view('home',compact('Laptopsproducts','Phonesproducts','category'));
    }

    public function login()
    {
        return view('auth');
    }

    public function dologin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
                if ($user)
                   {
                    if (Hash::check($request->password,$user->password))
                       { 
                           if($request->email == 'admin@gmail.com'){
                            Auth::login($user);
                            return redirect()->route('adminHome');  
                           }else{
                            Auth::login($user);
                            return redirect()->route('home');
                           }
                        
                       }
                       else
                       {
                            return redirect()->back()->with('error_message', 'Wrong Credentials, Please try again.');

                      }
                   }
                   else{
                    return redirect()->back()->with('error_message', 'This Email does not exist. Please create a new account.');
                   }
            
    }

    public function doregister(Request $request)
    {
        //dd($request->all());
        $user = User::where('email', $request->email)->first();
        
        if($user)
        {
            if ($request->email == $user->email) {
                return redirect()->back()->with('error_message', 'Email ID already exists.');
                  }
             else
            {
                return redirect()->back()->with('error_message', 'Something went wrong. Please try again.');
            }
        }else{
            if($request->password != $request->confirmPassword){
                return redirect()->back()->with('error_message', 'Password does not match.');
            }else{
                $user = new User(); 
                $user->name = $request->userName;
                $user->email = $request->email;
                $user->number = $request->number;
                $user->password = bcrypt($request->password);
                $user->created_at = Carbon::now();
                $user->save();
                return redirect()->route('login');
            }
           

        }
     
  
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect(route('login'));
    }

    public function adminHome()
    {
        return view('adminHome');
    }

   public function addProduct(Request $request)
   {
  //  dd($request->all()); 
    
    $this->validate($request,[
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'image' => 'required',

    ]);
//        $path = public_path().'/images';
//        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
    $uploadPath= public_path()."/Images";
    $image= $request->image;
    $tempFileName = Carbon::now()->timestamp.'.'.$image->getClientOriginalExtension();
    $file = $image->move($uploadPath,$tempFileName);
    $products = new Product();
    $products->prod_name = $request->name;
    $products->image = $tempFileName;
    $products->discription = $request->description;
    $products->price = $request->price;
    //  dd($gigs);
    $products->save();

    return redirect()->back()->with('message', 'Succesfully insert');
   }


   public function products()
    {
        $products = Product::all();
        //print_r( $products);
       return view('products',compact('products'));
    }

    public function editProduct(Request $request)
    {
        $products = Product::whereId($request->prodId)->first();
        $products->prod_name = $request->prodName;
        if ($request->hasFile('image'))
        {
        $old_image =  public_path()."/Images"."/".$products->image;
       unlink($old_image);

        $uploadPath= public_path()."/Images";
        $image= $request->image;
        $tempFileName = Carbon::now()->timestamp.'.'.$image->getClientOriginalExtension();
        $file = $image->move($uploadPath,$tempFileName);
        $products->image = $tempFileName;
       
        }
        $products->discription = $request->discription;
        $products->price = $request->price;
        $products->save();

        return redirect()->back()->with('message', 'Product update successfully.');
    }

    public function deleteProduct(Request $request)
    {
        Product::where('id',$request->prodId)->delete();
        return redirect()->back()->with('message', 'Product delete successfully.');
    }

}
