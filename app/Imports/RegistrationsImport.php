<?php

namespace App\Imports;

use App\Models\registration;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegistrationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new registration([
            'updated_at'=>$row['updated_at'],
            'created_at'=> $row['created_at'],
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'cni' => $row['cni'],
            'cne' => $row['cne'],
            'referral' => $row['referral'],
            'turnover' => $row['turnover'],
        ]);
    }
}
