<?php

namespace App\Http\Controllers\SecretCode;

use App\Decode;
use App\Http\Requests\SecretCodeRequest;
use App\SecretCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecretCodesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'codes' => SecretCode::with('decode')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SecretCodeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecretCodeRequest $request)
    {
        $newCode = SecretCode::create($request->except('_token'));
        $decodeCode = $this->decodeCode($newCode->secret_code);

        foreach ($decodeCode as $item) {
            Decode::create([
                'secret_code_id' => $newCode->id,
                'decode_code' => (int)(strpos($item, '+') === 0) ?
                    mb_strimwidth($item, 1, strlen($item)) : $item,
            ]);
        };

        return redirect()->back()
            ->with('success', 'Your secret code saved!');
    }

    /**
     * String decode and save to db
     *
     * @param $newCode
     * @return array
     */
    public function decodeCode($newCode)
    {
        $startString = $newCode;
        $decodeCodeArray = [];

        for ($i = 0; $i < strlen($startString); $i++) {
            $result = mb_strimwidth($startString, strpos($startString, '{'), strlen($startString));
            $cutString = substr($result, 1, 1);

            if ((int)$cutString || $cutString == "-" || $cutString == "+") {
                $findClose = strpos($result, '}');
                $pushItem = trim(substr($result, 1, $findClose - 1));
                if (is_numeric($pushItem) && !strpos($pushItem, '.')) {
                    array_push($decodeCodeArray, $pushItem);
                }
                $startString = mb_strimwidth($result, $findClose, strlen($startString));
            } else {
                $findOpen = strpos(substr($result, 1, strlen($result)), '{');
                $startString = mb_strimwidth($result, $findOpen, strlen($startString));
            }
        }

        return $decodeCodeArray;
    }

    /**
     * Sort codes -  return json
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sortCodes(Request $request)
    {
        if ($request->input('operator') == 'search') {
            $codes = Decode::where('decode_code', 'LIKE', "%" . $request->input('value') . "%")
                ->with('secretCode.decode')->get()->keyBy('secret_code_id');
        } elseif ($request->input('operator') == 'all') {
            $codes = Decode::with('secretCode.decode')->get()->keyBy('secret_code_id');
        } else {
            $codes = Decode::where('decode_code', $request->input('operator'), (int)$request->input('value'))
                ->with('secretCode.decode')->get()->keyBy('secret_code_id');
        }

        return response()->json($codes);
    }

}
