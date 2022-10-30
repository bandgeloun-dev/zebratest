<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenderRequest;
use App\Models\Tender;
use Illuminate\Support\Facades\Storage;

class TenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTenderPage()
    {
        return view('add');
    }

    public function saveTender(TenderRequest $request)
    {
        $tender = new Tender();
        $tender->xml_id = $request->input('xml_id');
        $tender->number = $request->input('number');
        $tender->status = $request->input('status');
        $tender->name = $request->input('tender-name');
        $tender->date_update = $request->input('date_update');

        $tender->save();

        return redirect()->route('add')->with('success-add', trans('newtender.success_add_message'));
    }

    public function csvToTenders()
    {
        $items = [];

        if (($open = fopen(storage_path() . "/app/tenders.csv", "r")) !== false) {

            while (($data = fgetcsv($open, 1000, ",")) !== false) {
                $items[] = $data;
            }

            fclose($open);
        }

        $skip = true;
        foreach ($items as $item) {
            if ($skip) {
                $skip = false;
                continue;
            }
            $tender = new Tender();
            $tender->xml_id = $item[0];
            $tender->number = $item[1];
            $tender->status = $item[2];
            $tender->name = $item[3];
            $tender->date_update = date('Y-m-d H:i:s', strtotime($item[4]));
            $tender->save();
        }
    }
}
