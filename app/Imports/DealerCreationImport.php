<?php

namespace App\Imports;

use App\Models\DealerCreation;
use App\Models\ShopCreation;
use Maatwebsite\Excel\Concerns\ToModel;

class DealerCreationImport implements ToModel
{

    private $isFirstRow = true;

    public function model(array $row)
    {

        if ($this->isFirstRow) {
            $this->isFirstRow = false;
            return null;
        }

        $dat = date('Y-m-d');
        $data =([
            'entry_date'    => $dat,
            'manager_name'    => $row['0'],
            'sales_rep_id' => $row['1'],
            'dealer_name'    => $row['2'],
            'mobile_no'   => $row['3'],
            'whatsapp_no'   => $row['4'],
            'address'   => $row['5'],
            'pan_no'   => $row['6'],
            'gst_no'   => $row['7'],
            'aadhar_no'   => $row['8'],
            'driving_licence'   => $row['9'],
            'bank_name'   => $row['10'],
            'check_no'   => $row['11'],
            'state_id'   => $row['12'],
            'district_id'   => $row['13'],
            'area_id'   => $row['14'],
            'status'   => '1',
        ]);

        $dealerCreation = DealerCreation::create($data);
        $lastId = $dealerCreation->id;

        $value =([
            'entry_date'    => $dat,
            'shop_name'   => $row['15'],
            'shop_type_id'    => $row['16'],
            'dealer_id'   => $lastId,
            'beats_id'    => $row['14'],
            'mobile_no'   => $row['17'],
            'whatsapp_no'    => $row['18'],
            'address'   => $row['19'],
            'gst_no'    => $row['20'],
            'language'   => $row['21'],
        ]);

        ShopCreation::create($value);
    }
}
