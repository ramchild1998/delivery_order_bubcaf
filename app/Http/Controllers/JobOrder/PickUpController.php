<?php

namespace App\Http\Controllers\JobOrder;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Setting\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobOrder\Pickup;
use App\Models\JobOrder\PickupDetail;
use App\Models\Master\Kurir;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Alert;

class PickUpController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the next day (h+1)
        $nextDay = Carbon::now()->addDay();
    
        // Retrieve input dateFrom and dateTo from the request
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        if(!$dateFrom && !$dateTo) {
            $pickup = Pickup::with('kurir')
            ->whereIn('status', ['Approved', 'Open'])
            ->whereDate('date_visit', '>=', $nextDay->startOfDay())
            ->whereDate('date_visit', '<=', $nextDay->endOfDay());
        }
        else{
            $pickup = Pickup::with('kurir')
            ->whereIn('status', ['Approved', 'Open'])
            ->whereDate('date_visit', '>=', $dateFrom)
            ->whereDate('date_visit', '<=', $dateTo);
        }

        $pickup = $pickup->latest()->get();
    
        return view('joborder.pickup.index', compact('pickup'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('settings.parameter.create', compact('parameter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = new User();
        // $user->type = $request->type;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->username = $request->username;
        // $user->password = bcrypt($request->password);
        // $user->vendor_id = $request->vendor_id;
        // $user->office_id = $request->office_id;
        // $user->contact_number = $request->contact_number;
        // $user->role_type = $request->role_type;
        // $user->is_active = $request->is_active ?? true;
        // $user->save();
        // return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pickup $pickup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(User $user)
    // {
    //     $vendors = Vendor::all();
    //     $offices = Office::all();
    //     $role = Role::all();
    //     return view('settings.user.edit', compact('user','vendors','offices','role'));
    // }
    public function updateStatus(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        $kurirId = $request->input('kurir_id');
        $pickup = Pickup::find($selectedIds);

        if ($pickup) {
            if ($request->input('kurir_id') == null) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Kurir harus dipilih.',
                        'data' => $kurirId
                    ], 400);
                }
            } else {
                Session::flash('error', 'Kurir harus dipilih.');
                return redirect()->back()->with('error', 'Kurir harus dipilih.');
            }
        }

        if ($selectedIds) {
            // Menggunakan Eloquent untuk memperbarui status
            foreach ($selectedIds as $id) {
                $myArray = explode(',', $id);
                foreach ($myArray as $itemId) {
                    $pickup = Pickup::where('id', $itemId)
                        ->where('status', 'open')
                        ->where('status', '<>', 'approved')
                        ->first();
                
                    if ($pickup) {
                        $pickup->status = 'approved';
                        $pickup->updated_at = Carbon::now()->toDateTimeString();
                        $pickup->save();
                
                        $pickupDetail = new PickupDetail();
                        $pickupDetail->pick_up_id = $itemId;
                        $pickupDetail->time_start = null;
                        $pickupDetail->time_end = null;
                        
                        // Check if data has description and add it into pickupDetail
                        if ($pickup->desc) {
                            $pickupDetail->desc = $pickup->desc;
                        }
                        
                        $pickupDetail->status = 'Pick Up';
                        $pickupDetail->updated_at = Carbon::now()->toDateTimeString();
                        $pickupDetail->save();
                    }
                }
                
                Alert::success('OK!', 'Data Sudah Di Approve!');
            }
            Session::flash('success', 'Status data berhasil diperbarui.');
            return redirect()->back()->with('success', 'Status data berhasil diperbarui.');
        } else {
            Session::flash('error', 'Tidak ada data yang dipilih untuk di-approve.');
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih untuk di-approve.');
        }
    }
    

    public function edit(Pickup $pickup)
    {
        $pickup = Pickup::findOrFail($pickup->id);
        $kurir = Kurir::all();
        return view('joborder.pickup.edit', compact('pickup','kurir'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pickup $pickup)
    {
        $pickup->kurir_id = $request->kurir_id;
        $pickup->save();

        return redirect()->route('pickup.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}