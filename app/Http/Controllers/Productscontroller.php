<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class Productscontroller extends Controller
{
    //
    function getdata(){
        $data=product::all();
        return $data;
    }
    function dataid($id=null){
        if($id){
            $data=product::find($id);
        }
        else{
            $data=product::all();
        }
        return $data;
    }
    function addData(Request $req ){
        $rules = array(
            "name"=>"required",
            "age"=>"required|min:2|max:5",
        );
        $valid=Validator::make($req->all(),$rules);
        if($valid->fails()){
            // return $valid->errors();
            return response()->join($valid->errors(),401);
        }
        else{
            $Product= new Product;
            $Product->name=$req->name;
            $Product->age=$req->age;
            $result = $Product->save();
            if($result){
                return ["msg" => "Data Added Successfuly"];
            }
            else{
                return ["msg" => "Data not Added "];
            }
        }
    }
    function editData(Request $req ){
        $pro = Product::find($req->id);
        $pro ->name=$req->name;
        $pro ->age=$req->age;
        $result = $pro->save();
        if($result){
            return ["msg" => "Data Edit Successfuly"];
        }
        else{
            return ["msg" => "Data not Edit "];
        }
    }
    function search($data){
        $Product = product::where('name', 'like',"%".$data."%")->get();
        return $Product;
    }
    function delete($id){
        $Product=Product::find($id);
        $result=$Product->delete();
        if($result){
            return ["msg"=>"data deleted"];
        }else{
            return ["msg"=>"data not deleted"];
        }
    }
}