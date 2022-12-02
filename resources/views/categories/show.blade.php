<x-deals-layout>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Deal (ID: {{ $deal->id }})</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('deals.index') }}"> Deals list</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $deal->description }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <x-deal>
                    <x-slot name="vulnerable">{{ $deal->vulnerable_human }}</x-slot>
                    <x-slot name="dealer">{{ $deal->dealer }}</x-slot>
                    <x-slot name="cards_N">
                        {!! $deal->getOneLineCards('N') !!}
                    </x-slot>
                    <x-slot name="cards_E">
                        {!! $deal->getOneLineCards('E') !!}
                    </x-slot>
                    <x-slot name="cards_S">
                        {!! $deal->getOneLineCards('S') !!}
                    </x-slot>
                    <x-slot name="cards_W">
                        {!! $deal->getOneLineCards('W') !!}
                    </x-slot>
                </x-deal>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Analysis:</strong><br />
                {!! nl2br($deal->analysis) !!}
            </div>
        </div>

    </div>
</x-deals-layout>
