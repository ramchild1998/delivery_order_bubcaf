<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Master\Vendor;
use App\Models\Master\Office;
use App\Models\Setting\Role;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        return User::join('vendors', 'users.vendor_id', '=', 'vendors.id')
        ->join('offices', 'users.office_id', '=', 'offices.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'vendors.name as vendor_name', 'offices.name as office_name', 'roles.name as role_name')
        ->get();
    }
}
