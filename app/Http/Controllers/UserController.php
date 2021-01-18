<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255','unique:users'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    //
    public function index(Request $request){
        $filter = $request->query('filter');
  
        
        if (!empty($filter)) {
            
            $users = User::whereHas("roles", function($q) use($filter) {
                 $q->where("name",'like',  '%'.$filter.'%'); })
                ->sortable()
                ->paginate(5);
        } else {
            $users = User::with('roles')->sortable()->paginate(10);
        }

        return view('users.index')->with('users',$users);
        
       // return User::with('roles')->sortable()->paginate(10);
        return view('users.index')->with('users',User::with('roles')->sortable()->paginate(10));
    }

    public function store(Request $request){

        // Handle File Upload
        if($request->hasFile('avatar')){
            // Get filename with the extension
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('avatar')->storeAs('public/avatars', $fileNameToStore);
        
        // make thumbnails
        $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('avatar')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/avatars/'.$thumbStore);
        
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $user = new User;
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->username = $request->input('username');
        $user->avatar = $fileNameToStore;
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        $user->assignRole($request->input('role'));

        return redirect('/users')
        ->with('success','User created successfully');
    }

    public function show($id)
    {

        $user =  User::find($id);
        $user->hasRole('admin') ? $user->role = "admin" : $user->role ="client";

        return $user;
    }
    public function update(Request $request, $id){
                //
        $user = User::find($id);
        // Handle File Upload
        if($request->hasFile('avatar')){
            // Get filename with the extension
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('avatar')->storeAs('public/avatars', $fileNameToStore);
        
     
        
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->avatar =  $fileNameToStore;
        $user->username = $request->input('username');
   
        $user->email = $request->input('email');
        $user->save();
        $user->removeRole('client');
        $user->removeRole('admin');
        $user->assignRole($request->input('role'));
        return redirect('/users')
        ->with('success','User updated successfully');
    }

    public function indexFiltering(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $users = User::with('roles')
                ->where('roles.name', 'like', '%'.$filter.'%')
                ->sortable()
                ->paginate(5);
        } else {
            $users = User::with('roles')->sortable()->paginate(10);
        }

        return view('users.index')->with('users',$users);
    }
}
