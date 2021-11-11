<?php

namespace App\Http\Controllers\Api;

use App\Models\Locallevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LocallevelCrudController extends Controller
{
    public function index(Request $request, $value)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'locallevelname');

        $options = Locallevel::query();

        // if no district has been selected, show no options in localevel
        if (!data_get($form, $value)) {
            return [];
        }

        // if a district has been selected, only show localevel from that district
        if (data_get($form, $value)) {
            $options = $options->where('locallevel_id', $form[$value]);
        }

        if ($search_term) {
            $results = $options->where('locallevelname', 'LIKE', '%' . $search_term . '%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $options->paginate(10);
    }

}