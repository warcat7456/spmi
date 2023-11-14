<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\Prodi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {

        view()->share('data', [
            'j' => Jenjang::NotIn(),
            'p' => Prodi::NotIn(),
            // 'p2' => Prodi::ByFakultas(''),
        ]);
    }

    public function ResponseError($message = '', $error = true, $status = 400)
    {
        $this->Response(null, $message, true, $status);
    }

    public function Response($data = [], $message = '', $error = false, $status = 200)
    {
        echo json_encode(
            [
                'error' => $error,
                'message' => $message,
                'data' => $data,
            ],
            $status
        );
        return;
        // return response()->json(
        //     [
        //         'error' => $error,
        //         'message' => $message,
        //         'data' => $data,
        //     ],
        //     $status
        // );
    }
}
