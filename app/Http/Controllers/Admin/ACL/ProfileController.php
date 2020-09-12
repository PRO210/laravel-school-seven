<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Requests\StoreUpdateProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
       // $this->middleware(['can:profiles']);
    }
    //
    //
    public function index()
    {
        $profiles = $this->repository->paginate();

        return view('admin.pages.profiles.index', compact('profiles'));
    }
    //
    //
    public function create()
    {
        return view('admin.pages.profiles.create');
    }
    //
    //
    public function store(StoreUpdateProfile $request)
    {
        $profile =  $this->repository->create($request->all());
        if(!$profile){
            return redirect()->back()->with('error','Operações Não Realizadas!');
        }
        return redirect()->route('profiles.index')->with('message','Operações Realizadas com Sucesso!');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back()->with('error','Operações Não Realizadas!');;
        }

        return view('admin.pages.profiles.show', compact('profile'));
    }
    //
    //
    public function edit($id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.edit', compact('profile'));
    }
    //
    //
    public function update(StoreUpdateProfile $request, $id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back()->with('error','Operações Não Realizadas!');
        }

        $profile->update($request->all());
        return redirect()->route('profiles.index')->with('message','Operações Realizadas com Sucesso!');;
    }
    //
    //
    public function destroy($id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back()->with('error','Operações Não Realizadas!');
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('message','Registro deletado com Sucesso!');
    }
    //
    //
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $profiles = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->where('name', $request->filter)
                                          ->orWhere('description', 'LIKE', "%{$request->filter}%");
                                }
                            })
                            ->paginate();

        return view('admin.pages.profiles.index', compact('profiles', 'filters'));
    }
    //
    //
}
