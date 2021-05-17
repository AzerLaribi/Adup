<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\tag;
use App\typ;
use App\Venue;

class TagsTypeLocation extends Component
{
    public $tags;
    public $types;
    public $veneus;

    public $selectedtype = null;
    public $selectedtag = null;
    public $selectedveneus = null;

    public function mount($selectedCity = null)
    {
        $this->tags = tag::all();
        $this->types = collect();
        $this->veneus = collect();
        $this->selectedveneus = $selectedveneus;

        if (!is_null($selectedveneus)) {
            $veneus = Venue::with('tags.types')->find($selectedveneus);
            if ($veneus) {
                $this->veneus = Venue::where('state_id', $city->state_id)->get();
                $this->types = State::where('country_id', $city->state->country_id)->get();
                $this->selectedCountry = $city->state->country_id;
                $this->selectedState = $city->state_id;
            }
        }
    }
    public function render()
    {
        return view('livewire.tags-type-location');
    }
}
