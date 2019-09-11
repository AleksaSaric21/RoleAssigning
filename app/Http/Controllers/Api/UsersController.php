<?php
namespace App\Http\Controllers\API;
use App\Http\Resources\UserResource;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;
use Validator;
use Illuminate\Support\Str;
class UsersController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = UserResource::collection(User::all()->forget(0));
        return response()->json(['success' => $users], $this-> successStatus);

    }

    public function toggleModerator(User $user)
    {

        $id = Role::where('name','Moderator')->first()->id;

        $user->hasRole('Moderator') ? $user->roles()->detach($id) :
            $user->roles()->attach(Role::where('name','Moderator')->first());

    }

    public function toggleAuthor(User $user)
    {
        $id = Role::where('name','Author')->first()->id;
        $user->hasRole('Author') ? $user->roles()->detach($id) : $user->roles()->attach($id);

    }
    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['api_token'] =  $user->api_token;
            $success['user'] =  $user;
            $success['roles'] =  $user->roles->pluck('name');
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            //'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['api_token'] = Str::random(60);
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->roles()->attach(Role::where('name','Author')->first());
        $user->roles()->attach(Role::where('name','Moderator')->first());
        $success['api_token'] = $input['api_token'];
        $success['user'] =  $user;
        $success['roles'] = $user->roles->pluck('name');
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
}