<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Device;
use Illuminate\Support\Facades\Validator;

  
class DevicesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Devices', [
            'data' => Device::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
        ])->validate();

        Device::create($request->all());

        return redirect()->back()
            ->with('message', 'Device Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            Device::find($request->input('id'))->update($request->all());
            return redirect()->back()
                ->with('message', 'Device Updated Successfully.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Device::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

}
