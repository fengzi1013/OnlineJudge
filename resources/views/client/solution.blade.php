@extends('layouts.client')

@section('title',__('main.Solution').' | '.config('oj.main.siteName'))

@section('content')

    <div class="container">
        <div class="my-container @if($solution->result<4) alert-info
            @elseif($solution->result==4)alert-success @else alert-danger @endif">
            <div style="font-size: 1.6rem">
                @if($solution->result<4)
                    <i class="fa fa-refresh fa-lg" aria-hidden="true"></i>
                @elseif($solution->result==4)
                    <i class="fa fa-check-circle fa-lg" aria-hidden="true"></i>
                @else
                    <i class="fa fa-times fa-lg" aria-hidden="true"></i>
                @endif
                &nbsp;{{config('oj.result.'.$solution->result)}}
            </div>

            <div class="table-responsive">
                <table class="table table-sm mt-1 mb-0">
                    <tr>
                        <td class="text-left border-top-0">{{__('main.Solution').': '.$solution->id}}</td>
                        <td class="text-left border-top-0">{{__('main.Problem').': '}}
                            @if($solution->contest_id!=-1)
                                <a href="{{route('contest.home',$solution->contest_id)}}">contest&nbsp;{{$solution->contest_id}}</a>
                            @else
                                <a href="{{route('problem',$solution->problem_id)}}">{{$solution->problem_id}}</a>
                            @endif
                        </td>
                        <td class="text-left border-top-0">{{__('main.User').': '}}<a href="{{route('user',$solution->username)}}">{{$solution->username}}</a></td>
                        <td class="text-left border-top-0">{{__('main.Submit Time').': '.$solution->submit_time}}</td>
                        <td class="text-left border-top-0">{{__('main.Judge Time').': '.$solution->judge_time}}</td>
                    </tr>
                    <tr>
                        <td class="text-left border-top-0">{{__('main.Judge Type').': '.$solution->judge_type}}</td>
                        <td class="text-left border-top-0">{{__('main.Time').': '.$solution->time}}MS</td>
                        <td class="text-left border-top-0">{{__('main.Memory').': '.round($solution->memory,2)}}MB</td>
                        <td class="text-left border-top-0">{{__('main.Language').': '.config('oj.lang.'.$solution->language)}}</td>
                        <td class="text-left border-top-0">{{__('main.Code Length').': '.$solution->code_length}}B</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <div class="container">

        <div class="my-container bg-white">
            <pre>{{$solution->code}}</pre>
        </div>
    </div>


@endsection
