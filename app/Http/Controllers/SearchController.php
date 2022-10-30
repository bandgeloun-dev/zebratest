<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Tender;

class SearchController extends Controller
{
    public function submit(SearchRequest $request)
    {
        $session = $request->session();
        $this->forgetOldValues($session);
        $formatData = [];
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            $value = htmlspecialchars($value);
            $formatData[$key] = $value;
            $session->put('_old_input.search_' . $key, $value);
        }

        $data = $this->getTenders($formatData);

        return view('search', $data);
    }

    public function download(SearchRequest $request)
    {
        $formatData = [];
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            $value = htmlspecialchars($value);
            $formatData[$key] = $value;
        }
        $data = json_encode($this->getTenders($formatData)['data']);
        $filename = 'tenders_' . date('Y-m-d H:i:s') . '.json';
        $headers = [
            'Content-type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename=' . $filename . ';',
        ];
        return response()->streamDownload(function () use ($data) {
            echo $data;
        }, $filename, $headers);
    }

    public function getTenders($formatData)
    {
        $result = [];
        if (!empty($formatData)) {
            $tender = new Tender();
            $query = $tender->newQuery();
            $query->orderBy('id');
            if (!empty($formatData['id'])) {
                $query->where('id', '=', $formatData['id']);
            } else {
                if (!empty($formatData['tender-name'])) {
                    $query->where('name', 'like', '%' . $formatData['tender-name'] . '%');
                }
                if (!empty($formatData['date'])) {
                    $query->whereDate('date_update', '=', $formatData['date']);
                }
            }
            $data = $query->get();
            if ($data->count()) {
                $result['data'] = $data;
            } else {
                $result['error'] = trans('search.error_no_elements');
            }
        }
        return $result;
    }

    public function forgetOldValues($session)
    {
        foreach ($this->getFiltrationFields() as $field) {
            $session->forget('_old_input.search_' . $field);
        }
    }

    public function getFiltrationFields()
    {
        return [
            'tender-name',
            'date'
        ];
    }
}
