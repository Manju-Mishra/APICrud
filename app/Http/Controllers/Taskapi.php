<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Demoapi;
use App\Http\Resources\Taskresourcee;

class Taskapi extends Controller
{
   public function index()
   {
      $val = Demoapi::all();
      return response(['tasks' => Taskresourcee::collection($val), 'msg' => 'Data fetch successfully!!']);
   }
   

   public function store(Request $req)
   {
      $val = Validator::make($req->all(), [
         'name' => 'required',
         'description' => 'required',
      ]);
      if ($val->fails()) {
         return response()->json($val->errors());
      } else {
         $data = new Demoapi();
         $data->name = $req->name;
         $data->description = $req->description;
         if ($data->save()) {
            return response()->json(['task' => new Taskresourcee($data), 'msg', 'Data Added']);
         } else
            return response()->json(["msg", "Data not Added"]);
      }
   }



   public function show($id)
   {
      $data=Demoapi::all()->where('id',$id);
      return response()->json($data);
   }

   
   public function update(Request $req,$id)
   {
    
     $data = Demoapi::find($id);
      $data->name=$req->name;
      $data->description=$req->description;
      $res=$data->save();
      if ($res)
       {
         return response(['msg', 'Updated Successfully!!']);
      } 
      else
         return response(["msg", "Data not updated"]);
   }

   //For Delete
   public function destroy(Request $req,$id)
   {
      $data = Demoapi::find($id);
      $deldata=$data->delete();
      if($deldata)
      {
          return response(['msg'=>'data deleted']);
      }
      else
      {
         return response(['msg'=>'data not deleted']);
      }
   }
}
