<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getData(Request $request){
        $user_id = $request->id;
        $user = User::find($user_id)->first(['name','email','mobile']);
        // $user = auth()->user();
        return view('users.data',compact('user'));
    }

    public function ageRestrictedPage(){
        $age = Carbon::parse(auth()->user()->dob)->age;
        return 'You can view this page because your age is ' . $age;
    }

    public function storeAvatar(Request $request){
        if($request->hasFile('avatar')){
            try{
                $file = $request->file('avatar');
    
                $fileOriginalName = $file->getClientOriginalName();
    
                $fileOriginalExtension = $file->getClientOriginalExtension();
    
                $fileNameWithoutExtension = pathinfo($fileOriginalName,PATHINFO_FILENAME);

                $uniqueFileName = time() . '-' . Str::slug($fileNameWithoutExtension) . '.' . $fileOriginalExtension;
            
                $location = 'folder-name';
                
                $disk = Storage::disk('public');

                $path = $location . '/' . $uniqueFileName;
                
                //$file->storeAs($location,$uniqueFileName,'public');

                $disk->put($path,file_get_contents($file));

                auth()->user()->avatar = $path;

                auth()->user()->save();
                
            }catch(Exception $e){
                
                return redirect()->route('home')->with('error-message','Error uploading avatar ' . $e->getMessage());
            
            }

            return redirect()->route('home')->with('success-message','User avatar uploaded successfully');

        }
    }
}
