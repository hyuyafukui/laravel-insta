<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if($request->search){
            $all_users = $this->user->withTrashed()
                        ->where('name', 'LIKE', '%'.$request->search.'%')->latest()->paginate(10);

        }else{
            $all_users = $this->user->withTrashed()->latest()->paginate(10);
            //withTrashed() - includes soft deleted records

        }

        return view('admin.users.index')
                ->with('all_users', $all_users)
                ->with('search', $request->search);
    }

    public function deactivate($id)
    {
        $this->user->destroy($id);

        return redirect()->back();
    }

    public function activate($id)
    {
        //restore() - > undo a soft-delete
        $this->user->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }
}
