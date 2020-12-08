<?php

namespace App\Http\Controllers;

use App\Models\S2;
use Illuminate\Http\Request;
use App\Http\Resources\S2Resource;
use App\Http\Requests\S2StoreRequest;
use App\Http\Requests\S2UpdateRequest;

class S2Controller extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:view_s2', ['only' => ['index', 'show', 'export']]);
        // $this->middleware('permission:add_s2',  ['only' => ['store']]);
        // $this->middleware('permission:edit_s2', 
        //                         ['only' => ['update', 'active', 'inactive', 'trash', 'restore']]);
        // $this->middleware('permission:delete_s2', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = S2::latest()->paginate(request('paginate') ?? 10);
        $rows = S2Resource::collection($data);
        return response()->json(['rows' => $rows], 200);
    }

    public function store(S2StoreRequest $request)
    {
        $row = S2::createOrUpdate(NULL, $request->all());
        if($row === true) {
            return response()->json(['message' => ''], 201);
        } else {
            return response()->json(['message' => 'Unable to create entry, ' . $row], 500);
        }
    }

    public function show($id)
    {
        $row = new S2Resource(S2::findOrFail(decrypt($id)));
        return response()->json(['row' => $row], 200);
    }

    public function update(S2UpdateRequest $request, $id)
    {
        $row = S2::createOrUpdate(decrypt($id), $request->all());
        if($row === true) {
            return response()->json(['message' => ''], 200);
        } else {
            return response()->json(['message' => 'Unable to update entry, ' . $row], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $row = S2::query();

            if(strpos($id, ',') !== false) {
                foreach(explode(',',$id) as $sid) {
                    $ids[] = $sid;
                }
                $row->whereIN('id', $ids);
            } else {
                $row->where('id', $id);
            }   
            $row->delete();

            return response()->json(['message' => ''], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unable to delete entry, '. $e->getMessage()], 500);
        }
    }
}
