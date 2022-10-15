<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function test(Request $request)
    {
        // Redis::setex('test', 60, 'oooo');
        dump(Redis::get('test'));
        dump(Redis::info());
        return intdiv(10, 3);
    }

    //home page
    public function index()
    {
        $notices = DB::table('notices')
            ->leftJoin('users', 'users.id', '=', 'user_id')
            ->select(['notices.id', 'title', 'state', 'notices.created_at', 'username'])
            ->where('state', '!=', 0)
            ->orderByDesc('state')
            ->orderByDesc('id')->paginate(6);

        if (Redis::exists('home:cache:this_week_top')) {
            $this_week = json_decode(Redis::get('home:cache:this_week_top'));
        } else {
            $this_week = DB::table('solutions')
                ->join('users', 'users.id', '=', 'solutions.user_id')
                ->select(['user_id', 'username', 'school', 'class', 'nick', DB::raw('count(distinct problem_id) as solved'),])
                ->where('submit_time', '>', date('Y-m-d H:i:s', strtotime('last monday')))
                ->where('result', 4)
                ->groupBy(['user_id'])
                ->orderByDesc('solved')
                ->limit(10)->get();
            // 缓存有效期至凌晨
            Redis::setex('home:cache:this_week_top', strtotime('tomorrow') - time(), json_encode($this_week));
        }

        if (Redis::exists('home:cache:last_week_top')) {
            $last_week = json_decode(Redis::get('home:cache:last_week_top'));
        } else {
            $last_week = DB::table('solutions')
                ->join('users', 'users.id', '=', 'solutions.user_id')
                ->select(['user_id', 'username', 'school', 'class', 'nick', DB::raw('count(distinct problem_id) as solved')])
                ->where('submit_time', '>', date('Y-m-d H:i:s', strtotime('last monday') - 3600 * 24 * 7))
                ->where('submit_time', '<', date('Y-m-d H:i:s', strtotime('last monday')))
                ->where('result', 4)
                // ->whereRaw("(select count(*) from privileges P where solutions.user_id=P.user_id and authority='admin')=0")
                ->groupBy(['user_id'])
                ->orderByDesc('solved')
                ->limit(10)->get();
            // 缓存有效期至下周一
            Redis::setex('home:cache:last_week_top', strtotime('next monday') - time(), json_encode($last_week));
        }
        return view('client.home', compact('notices', 'this_week', 'last_week'));
    }

    public function get_notice(Request $request)
    {
        $notice = DB::table('notices')->select(['title', 'content', 'created_at'])->find($request->input('id'));
        if ($notice && $notice->content == null)
            $notice->content = '';
        return json_encode($notice);
    }
}
