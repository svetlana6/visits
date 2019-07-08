<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class VisitsController extends Controller
{
    private CONST KEY = 'visits';

    public function index()
    {
        try {
            $visits = Redis::hgetall(self::KEY);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
        return response()->json($visits);
    }

    public function update(string $countryCode)
    {
        try {
            Redis::hincrby(self::KEY, $countryCode, 1);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
