<div class="row message-previous">
    <div class="col-sm-12 previous">
        <a onclick="previous(this)" id="ankitjain28" name="20">
            Show Previous Message!
        </a>
    </div>
</div>
@foreach ($chatMessage as $chat)
    {{-- @php
        $dt = Carbon\Carbon::create();
        // dd($dt->subMinute());
        $hours = $dt->subMinute();
        dd($hours);
    @endphp

    @dd ( $chat->created_at->format('H:m') < $dt->subMinute() ) --}}

    @if ($chat->user_id == auth()->user()->id)
        <div class="message-body">
            <div class="col-sm-12 message-main-sender">
                <div class="sender">
                    <div class="message-text-user">
                        {{ $chat->message }}
                    </div>
                    <span class="message-time pull-right">
                        {{ $chat->created_at->format('H:m') }}
                        <i class="fa fa-check"></i>
                    </span>
                </div>
            </div>
        </div>
    @else
        <div class="message-body">
            <div class="col-sm-12 message-main-receiver">
                <div class="receiver">
                    <div class="message-text">
                        {{ $chat->message }}
                    </div>
                    <span class="message-time pull-right">
                        {{ $chat->created_at->format('H:m') }}
                    </span>
                </div>
            </div>
        </div>
    @endif
@endforeach
