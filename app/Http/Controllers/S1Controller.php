<?php

namespace App\Http\Controllers;

use App\Models\S1;
use Illuminate\Http\Request;
use App\Http\Resources\S1Resource;
use App\Http\Requests\S1StoreRequest;
use App\Http\Requests\S1UpdateRequest;

class S1Controller extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:view_s1', ['only' => ['index', 'show', 'export']]);
        // $this->middleware('permission:add_s1',  ['only' => ['store']]);
        // $this->middleware('permission:edit_s1', 
        //                         ['only' => ['update', 'active', 'inactive', 'trash', 'restore']]);
        // $this->middleware('permission:delete_s1', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = S1::latest()->paginate(request('paginate') ?? 10);
        $rows = S1Resource::collection($data);
        return response()->json(['rows' => $rows], 200);
    }

    public function store(S1StoreRequest $request)
    {
        $row = S1::createOrUpdate(NULL, $request->all());
        if($row === true) {
            return response()->json(['message' => ''], 201);
        } else {
            return response()->json(['message' => 'Unable to create entry, ' . $row], 500);
        }
    }

    public function show($id)
    {
        $row = new S1Resource(S1::findOrFail(decrypt($id)));
        return response()->json(['row' => $row], 200);
    }

    public function update(S1UpdateRequest $request, $id)
    {
        $row = S1::createOrUpdate(decrypt($id), $request->all());
        if($row === true) {
            return response()->json(['message' => ''], 200);
        } else {
            return response()->json(['message' => 'Unable to update entry, ' . $row], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $row = S1::query();

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
