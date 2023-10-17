<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry\AttendanceEntry;
use App\Models\MarketManagerCreation;
use App\Models\SalesRepCreation;
use App\Models\DealerCreation;
use Carbon\Carbon;

class AttendanceEntryController extends Controller
{
    public function retrieve($id)
    {
        if ($id == '') {
            return AttendanceEntry::select('id', 'entry_date', 'shift_type', 'attendance_status','category_type')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('entry_date')->get();
        } else {
            return AttendanceEntry::select('id', 'entry_date', 'shift_type', 'shift_type1', 'manager_name', 'attendance_status', "category_type", "description",'checkbox')->where('id', '=', $id)->get('id', 'entry_date', 'shift_type', 'shift_type1', 'manager_name', 'attendance_status', "category_type", 'description','checkbox')->first();
        }
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $tb = new AttendanceEntry();
            $tb->entry_date = $request->input('entry_date');
            $tb->shift_type = $request->input('shift_type');
            $tb->shift_type1 = $request->input('shift_type1');
            $tb->manager_name = $request->input('manager_name');
            $tb->category_type = $request->input('category_type');
            $tb->attendance_status = $request->input('attendance_status');
            $tb->checkbox = $request->input('checkbox');
            $tb->description = $request->input('description');
            $tb->save();
        } else if ($action == 'update') {
            $tb = AttendanceEntry::find($request->input('id'));
            if ($tb) {
                $tb->entry_date = $request->input('entry_date');
                $tb->shift_type = $request->input('shift_type');
                $tb->shift_type1 = $request->input('shift_type1');
                $tb->manager_name = $request->input('manager_name');
                $tb->category_type = $request->input('category_type');
                $tb->attendance_status = $request->input('attendance_status');
                $tb->checkbox = $request->input('checkbox');
                $tb->description = $request->input('description');
                $tb->save();
            }
        } else if ($action == 'delete') {
            $tb = AttendanceEntry::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        } else if ($action == 'retrieve') {
            $attendance_entry = $this->retrieve('');
            return view('Entry.attendance_entry.list', ['attendance_entry' => $attendance_entry]);
        } else if ($action == 'create_form') {
            $attendance_entry = $this->retrieve($request->input('id'));
            return view('Entry.attendance_entry.create');
        } else if ($action == 'sublist_form') {

            if ($request->input('category_type') == 0) {

                $attendance_category_type = MarketManagerCreation::select('id', 'manager_name')
                    ->where('manager_name', '!=', '')
                    ->orderBy('manager_name')
                    ->get();

                $category_id = 0;
            } else if ($request->input('category_type') == 1) {

                $attendance_category_type = SalesRepCreation::select('id', 'sales_ref_name')
                    ->where('sales_ref_name', '!=', '')
                    ->orderBy('sales_ref_name')
                    ->get();

                $category_id = 1;
            } else if ($request->input('category_type') == 2) {

                $attendance_category_type = DealerCreation::select('id', 'dealer_name')
                    ->where('dealer_name', '!=', '')
                    ->orderBy('dealer_name')
                    ->get();

                $category_id = 2;
            }

            $attendance_entry = $this->retrieve($request->input('id'));
            return view(
                'Entry.attendance_entry.sublist',
                ['attendance_category_type' => $attendance_category_type, 'category_id' => $category_id]
            );

        } else if ($action == 'update_sublist_form') {

            if ($request->input('category_type') == 0) {

                $attendance_category_type = MarketManagerCreation::select('id', 'manager_name')
                    ->where('manager_name', '!=', '')
                    ->orderBy('manager_name')
                    ->get();

                $category_id = 0;
            } else if ($request->input('category_type') == 1) {

                $attendance_category_type = SalesRepCreation::select('id', 'sales_ref_name')
                    ->where('sales_ref_name', '!=', '')
                    ->orderBy('sales_ref_name')
                    ->get();

                $category_id = 1;
            } else if ($request->input('category_type') == 2) {

                $attendance_category_type = DealerCreation::select('id', 'dealer_name')
                    ->where('dealer_name', '!=', '')
                    ->orderBy('dealer_name')
                    ->get();

                $category_id = 2;
            }

            $attendance_entry = $this->retrieve($request->input('id'));
            return view('Entry.attendance_entry.sublist_update',
                ['attendance_category_type' => $attendance_category_type, 'category_id' => $category_id,"attendance_entry" => $attendance_entry]
            );

        }
        else if ($action == 'view_sublist_form') {

            if ($request->input('category_type') == 0) {

                $attendance_category_type = MarketManagerCreation::select('id', 'manager_name')
                    ->where('manager_name', '!=', '')
                    ->orderBy('manager_name')
                    ->get();

                $category_id = 0;
            } else if ($request->input('category_type') == 1) {

                $attendance_category_type = SalesRepCreation::select('id', 'sales_ref_name')
                    ->where('sales_ref_name', '!=', '')
                    ->orderBy('sales_ref_name')
                    ->get();

                $category_id = 1;
            } else if ($request->input('category_type') == 2) {

                $attendance_category_type = DealerCreation::select('id', 'dealer_name')
                    ->where('dealer_name', '!=', '')
                    ->orderBy('dealer_name')
                    ->get();

                $category_id = 2;
            }

            $attendance_entry = $this->retrieve($request->input('id'));
            return view('Entry.attendance_entry.view',
                ['attendance_category_type' => $attendance_category_type, 'category_id' => $category_id,"attendance_entry" => $attendance_entry]
            );

        }
        else if ($action == 'update_form') {

            $attendance_entry = $this->retrieve($request->input('id'));
            return view('Entry.attendance_entry.update', ['attendance_entry' => $attendance_entry]);
        }
    }
}
