<?php

namespace App\Http\Controllers;

use App\Events\PasswordReset;
use Exception;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\PasswordChange;
// use App\Providers\PasswordChange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(auth()->user(),"User Profile"); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Gate::denies('isSuperAdmin')) {
            return $this->sendError("Unauthenticated",[], 401);
        }
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|min:6',
            'event_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        // $input['role'] = 'admin';
        $user = User::create($input);
   
        return $this->sendResponse($user, 'User register successfully');
    }
        //

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('login')->plainTextToken; 
            $success['user'] =  $user;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('User could not login.', ['error'=>'Unauthorised'], 401);
        } 
    }

    public function register(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'country' => 'required|string',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('login')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function changePassword(Request $request){
        if(Gate::denies("isOwner", $request->user()->id)){
            return $this->sendError('User not authenticated.', [], 401);
        }

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = auth()->user();
        if(Hash::check($request->input('old_password'), $user->password)){
            $user->password = bcrypt($request->input('password'));
            // $user->save();

            try {
            event(new PasswordChange($user));
            }
            catch(Exception $e){
                return $e;
            }

            return $this->sendResponse($user, "Password changed successfully");
        }
   
        
        return $this->sendError("Old password is wrong",[], 400); 
    }
    
    public function forgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status == Password::RESET_LINK_SENT){
            return $this->sendResponse($status, "Password reset link sent successfully");

        }
        
        return $this->sendError("Error Occured", $status);        
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed','min:8'],
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                event(new PasswordReset($user));

            }
        );
        
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            return $this->sendResponse($status,'Password update successfull');
        }

        return $this->sendError('Invalid Token', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->sendResponse(User::find($id), "User Profile"); //
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $validator = Validator::make($request->all(), [
            'image' => 'image|size:2048'
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if(Gate::denies('isOwner', $id) || !Gate::denies('isSuperAdmin'))
            return $this->sendError('User not authorized.', [], 401);

       
        $fields = ["first_name", "last_name", 'last_name', 'phone', 'country','role'];
    
        $user = User::find($id);
        $data = array_filter($request->all("first_name", "last_name", 'last_name', 'phone', 'country'));

        // dd(uploadImage($request, "image", "user-".$user->id));
        if(Gate::allows("isOwner", $id)) 
            $data["image"] = uploadImage($request, "image","user-".$user->id) ?? $user->image;

        if(Gate::allows("isSuperAdmin"))
            array_merge($data, array_filter($request->all("status", "role")));

        $user->update($data);
        return $this->sendResponse($user,"User has been updated successfully");
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user = User::find($id);
       $user->delete(); //
    }
}
