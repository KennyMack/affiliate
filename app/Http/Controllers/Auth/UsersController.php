<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 10/11/2018
 * Time: 23:14
 */

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\CreateUserFormRequest;
use App\Http\Requests\Auth\UpdateUserFormRequest;
use App\User;
use App\Utils;
use App\Utils\PasswordEx;
use App\Utils\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('txtsearch');

        if (isset($search)) {

            $results = User::search($search)->orderBy('name', 'asc')->paginate(5000);
        }
        else
            $results = User::orderBy('name', 'asc')->paginate(10);
        return view('auth.user.index',[
            'users' => $results,
            'txtsearch' => $search
        ]);
    }

    public function create()
    {
        return view('auth.user.form', [
            'url' => 'admin/users/save'
        ]);
    }

    public function store(CreateUserFormRequest $request)
    {
        $pas = new PasswordEx();
        $passStr = $pas->gerarSenha(8, true, true, true, false);
        $usr = new User();
        $usr->name = $request->input('name');
        $usr->email = $request->input('email');
        $usr->password = Hash::make($passStr);
        $usr->isactive = $request->input('isactive');
        $usr->type = $request->input('type');

        $usr->save();

        $usr->password = $passStr;

        try {
            $send_email = new SendEmail();

            $send_email->sendUserPass($usr->email, $usr);
        }
        catch (\Exception $e)
        {

        }

        \Session::flash('message_success', 'Salvo com sucesso, senha enviada ao usuário.');

        return Redirect::to('admin/users/create');
    }

    public function edit($id)
    {
        $usr = User::findOrFail($id);
        return view('auth.user.form', [
            'user' => $usr,
            'url' => 'admin/users/'.$id.'/update'
        ]);
    }

    public function update($id, UpdateUserFormRequest $request)
    {
        $usr = User::findOrFail($id);
        $usr->name = $request->input('name');

        $usr->isactive = $request->input('isactive');
        $usr->type = $request->input('type');

        $usr->save();

        \Session::flash('message_success', 'Atualizado com sucesso');

        return Redirect::to('admin/users/');
    }

    public function destroy($id)
    {
        try {
            $usr = User::findOrFail($id);

            $usr->delete();

            \Session::flash('message_warning', 'Removido com sucesso');

        }
        catch (\Exception $e){
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1451){
                \Session::flash('message_danger', 'Existem cadastros vinculados a este registro');
            }
        }

        return Redirect::to('admin/users');
    }
}
