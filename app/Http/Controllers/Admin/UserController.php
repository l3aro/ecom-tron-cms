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
        return Theme::uses('visitors')->scope('user.detail',$dataView)->setTitle('Profile')->render();
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
                return Theme::uses('visitors')->scope('user.password',$dataView)->setTitle('Change Password')->render();
            }
            // compare new password and confirm password
            if (empty($request->get('new-password')) || 
                empty($request->get('confirm-password')) || 
                $request->get('new-password') !== $request->get('confirm-password')
            ) {
                $dataView['error'] = 'invaild-confirm-password';
                return Theme::uses('visitors')->scope('user.password',$dataView)->setTitle('Change Password')->render();
            }
            // check if new password is the same as old password
            if (Hash::check($request->get('new-password'), $user->password)) {
                $dataView['error'] = 'same-old-password';
                return Theme::uses('visitors')->scope('user.password',$dataView)->setTitle('Change Password')->render();
            }

            // save new password
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            $dataView['saved'] = 1;
        }
        return Theme::uses('visitors')->scope('user.password',$dataView)->setTitle('Change Password')->render();
    }

    /** 
     * List admin
     * 
     * @param Request
     * @return Response
     */
    public function listAdmin(Request $request) {
        $dataView = [];
        $dataView['saved'] = 0;
        
        $users = User::where('admin', '1')->where('id','<>',Auth::id())->latest()->paginate(8);
        $dataView['users'] = $users;

        if ($request->ajax()) {
            return Theme::uses('visitors')->scope('user.list',$dataView)->content();
        }
        return Theme::uses('visitors')->scope('user.index',$dataView)->setTitle('List Admin')->render();
    }

    /** 
     * List admin
     * 
     * @param Request
     * @return Response
     */
    public function listCustomer(Request $request) {
        $dataView = [];
        $dataView['saved'] = 0;
        
        $users = User::where('admin', '0')->latest()->paginate(8);
        $dataView['users'] = $users;
        return Theme::uses('visitors')->scope('user.index',$dataView)->setTitle('List Customer')->render();
    }

    /**
     * Add or edit user
     * 
     * @param Request
     * @return Response
     */
    public function detail(Request $request) {
        // echo (url()->previous() == route('admin.user.list-admin'));die;
        $dataView = [];

        if ($request->id) {
            $user = User::find($request->id);
        }
        else {
            $user = new User;
            $user->image = 'img-avt.png';
        }
        if (url()->previous() == route('admin.user.list-admin')) {
            $user->admin = 1;
        }
        $dataView['saved'] = 0;

        if ($request->isMethod('post')) {
            if($request->file('image') && $request->file('image')->isValid()){
                $folder = public_path('media/user/');
                $image = UploadFile::uploadImage($_FILES['image'], $folder, $user->image);
            } else {
                $image = $user->image;
            }
            $user->image = $image?$image:'img-avt.png';
            if ($request->name) {
                $user->name = $request->name;
            }
            if ($request->email) {
                $user->email = $request->email;
            }
            if ($request->position) {
                $user->position = $request->position;
            }
            if ($request->mobile) {
                $user->mobile = $request->mobile;
            }
            if ($request->address) {
                $user->address = $request->address;
            }
            if ($request->birthday) {
                $user->birthday = $request->birthday;
            }
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->admin = $request->admin==='check'?'1':'0';
            $user->active = $request->active==='check'?'1':'0';
                
            $user->save();
            $dataView['saved'] = 1;
        }
        $dataView['info'] = $user;
        return Theme::uses('visitors')->scope('user.detail',$dataView)->setTitle('Profile')->render();
    }

    /**
     * Change an attribute of [active] to true or false
     * 
     * @param \Request
     */
    public function changefield(Request $request) {
        $field = $request->field;
        $user = User::find($request->id);
        $user->$field = $request->p?'0':'1';
        $user->save();
        die($request->p);
    }

}
