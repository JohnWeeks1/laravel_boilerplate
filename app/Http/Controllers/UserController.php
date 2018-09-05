<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Event;
use App\Friend;
use Image;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        
        $user = User::findOrFail($id);
        return view('admin.profile.profile', [
            'user' => $user
        ]);
        
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
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ]);

        $image_data = $request->get('image-data');
        $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));

        $country_code = $request['country_code'];
        $mobile = $request['mobile'];
        
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        if(empty($user->mobile)){
            $user->mobile = $country_code . $mobile .":00";
        } else {
            $user->mobile = $country_code . $mobile;
        }
        

        if(!empty($info)) {
            if(!empty($user->path)) {
                $file_path = "images/profile_pics/$user->path";
                unlink($file_path);
            }

            $filename = time().'.png';
            $path = 'images/profile_pics/'.$filename;

            $profile_pic = Image::make($info);
            $profile_pic->save($path);

            $user->path = $filename;
            $user->update();
        }

        $user->update();

        return redirect('admin/profile')->with('success', 'You just updated a your profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function friends()
    {
        $friends = Friend::where("user_requesting_friendship_id", Auth::user()->id)->paginate(20);
        return view('admin.friends.friends', [
            'friends' => $friends
        ]);
    }

    public function unfriend($id) 
    {
        $friend = Friend::where("user_receiveing_friendship_id", $id)
        ->where("user_requesting_friendship_id", Auth::user()->id)
        ->delete();

        return redirect()->back()->with('success','You just removed a friend.');
    }
}
