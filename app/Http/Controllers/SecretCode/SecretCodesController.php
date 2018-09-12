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
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecretCodeRequest $request)
    {
        $newCode = SecretCode::create($request->except('_token'));
        $decodeCode = $this->decodeCode($newCode->secret_code);

        foreach ($decodeCode as $item) {
            Decode::create([
                'secret_code_id' => $newCode->id,
                'decode_code' => (strpos($item, '+') === 0) ?
                    mb_strimwidth($item, 1, strlen($item)) : $item,
            ]);
        };
        return redirect()->back()->with('success','You search');
    }

    /**
     *
     * @param $newCode
     * @return array
     */
    public function decodeCode($newCode)
    {
        $startString = $newCode;
        $decodeCodeArray = [];

        for ($i = 0; $i < strlen($startString); $i++) {
            $sql = strpos($startString, '{');
            $result = mb_strimwidth($startString, $sql, strlen($startString));
            $trim = substr($result, 1, 1);

            if ((int)$trim || $trim == "-" || $trim == "+") {
                $findClose = strpos($result, '}');
                $pushItem = trim(substr($result, 1, $findClose - 1));
                if (is_numeric($pushItem) && !strpos($pushItem, '.')) {
                    array_push($decodeCodeArray, $pushItem);
                }
                $startString = mb_strimwidth($result, $findClose, strlen($startString));
            } else {
                $findOpen = strpos(substr($result, 1, strlen($result)), '{');
                $result = mb_strimwidth($result, $findOpen, strlen($startString));
                $startString = $result;
            }
        }

        return $decodeCodeArray;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
