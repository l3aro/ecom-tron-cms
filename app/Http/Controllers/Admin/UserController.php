<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\UploadFile;
use App\Models\User;
use Auth;
use Hash;
use Theme;

class UserController extends Controller
{
    /**
     * Preview and edit profile
     * 
     * @param Request
     */
    public function info(Request $request) {
        $info = Auth::user();

        $dataView = [];
        $dataView['saved'] = 0;
        
        $image = '';
        if ($request->isMethod('post')) {
            if($request->file('image') && $request->file('image')->isValid()){
                $folder = public_path('media/user/');
                $image = UploadFile::uploadImage($_FILES['image'], $folder, $info->image);
            } else {
                $image = $info->image;
            }
            $info->name = $request->name;
            $info->address = $request->address?$request->address:'';
            $info->mobile = $request->mobile?$request->mobile:'';
            $info->image = $image?$image:'';
            $info->birthday = $request->birthday?$request->birthday:null;
            $info->position = $request->position?$request->position:'';
            
            $info->save();

            $dataView['saved'] = 1;
        }
        
        $dataView['info'] = $info;
        return Theme::uses('visitors')->scope('profile.info',$dataView)->setTitle('Profile')->render();
    }

    /**
     * Change user's password
     * 
     * @param Request
     */
    public function changePassword(Request $request) {
        $user = Auth::user();
        $dataView = [];
        $dataView['saved'] = 0;
        $dataView['error'] = '';

        if ($request->isMethod('post')) {
            // check old password
            if (!Hash::check($request->get('password'), $user->password)) {
                $dataView['error'] = 'incorrect-password';
                return Theme::uses('visitors')->scope('profile.password',$dataView)->setTitle('Change Password')->render();
            }
            // compare new password and confirm password
            if (empty($request->get('new-password')) || 
                empty($request->get('confirm-password')) || 
                $request->get('new-password') !== $request->get('confirm-password')
            ) {
                $dataView['error'] = 'invaild-confirm-password';
                return Theme::uses('visitors')->scope('profile.password',$dataView)->setTitle('Change Password')->render();
            }
            // check if new password is the same as old password
            if (Hash::check($request->get('new-password'), $user->password)) {
                $dataView['error'] = 'same-old-password';
                return Theme::uses('visitors')->scope('profile.password',$dataView)->setTitle('Change Password')->render();
            }

            // save new password
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            $dataView['saved'] = 1;
        }
        return Theme::uses('visitors')->scope('profile.password',$dataView)->setTitle('Change Password')->render();
    }
}
