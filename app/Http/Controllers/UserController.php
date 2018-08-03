<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Event;
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

        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];

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
}
