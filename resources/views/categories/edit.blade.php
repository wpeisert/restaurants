<x-deals-layout>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Deal (ID: {{ $deal->id }})</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('deals.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('deals.update',$deal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('Dealer') }}:</strong>
                    <select class="form-control" name="dealer">
                        @foreach ($PLAYERS_NAMES as $player)
                            <option value="{{ $player }}" @selected($player == $deal->dealer)>
                            {{ $player }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>NS vulnerable:</strong>
                    <input type="hidden" name="vulnerable_NS" value="0" />
                    <input type="checkbox" class="form-control" name="vulnerable_NS" @checked($deal->vulnerable_NS) value="1" style="width: 15px"/>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>WE vulnerable:</strong>
                    <input type="hidden" name="vulnerable_WE" value="0" />
                    <input type="checkbox" class="form-control" name="vulnerable_WE" @checked($deal->vulnerable_WE) value="1" style="width: 15px"/>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" style="height:100px" placeholder="Description">{{ $deal->description }}</textarea>
                </div>
            </div>

            @for ($iter = 0; $iter < $PLAYERS_COUNT; ++$iter)
                @php
                    $playerName = $PLAYERS_NAMES[$iter];
                @endphp
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ $playerName }}:</strong>
                        <input class="form-control" name="cards_{{ $playerName }}" value="{{ $deal->getHand($playerName) }}" />
                    </div>
                </div>
            @endfor

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</x-deals-layout>
