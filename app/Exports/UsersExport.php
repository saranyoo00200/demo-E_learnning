<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class UsersExport implements FromView,ShouldAutoSize
{
     use Exportable;
     protected $type;

    public function __construct(int $type)
    {
        $this->type = $type;
        if ($type == 1) {
        $this->typename = 'เจ้าหน้าที่';
        }else if ($type == 2) {
        $this->typename = 'ผู้ใช้บริการ';
        }else if ($type == 3){
        $this->typename = 'ครู';
        }else if ($type == 4){
        $this->typename = 'นักเรียน';
        }else{
        $this->typename = 'เลือกทั้งหมด';
        }
    }

    public function view(): View
    {
        if ($this->type != 0) {
        $users = User::Where('user_type',$this->type)->get();
        } else {
        $users = User::all();
        }
        return view('UserManage.export_excel', [
            'Users' => $users,
            'user_type' => $this->typename
        ]);
    }
}
