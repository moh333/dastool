<?php

namespace App\Http\Controllers;

use App\Jobs\AddHistoryEntry;
use App\Models\Airport;
use App\Models\CalculatorHistory;
use App\Models\City;
use App\Models\Customer;
use App\Models\Project;
use App\Models\RegionRate;
use App\Models\Setting;
use App\Models\State;
use App\Models\Vehicle;
use App\Models\VehicleGroup;
use App\Models\ZipRegion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Spatie\Geocoder\Geocoder;
use Spatie\Image\Manipulations;
use Spatie\Period\Boundaries;
use Spatie\Period\Period;
use Spatie\Period\Precision;
use Tightenco\Ziggy\Ziggy;


class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator.index', [

        ]);
    }

    public function formData()
    {
        $config = config('settings.calculator');

        $customers = Customer::formDataCached();
        $cities = City::formDataCached();
        $vehicleGroups = VehicleGroup::formDataCached();
        $vehicles = Vehicle::formDataCached();
        $airports = Airport::formDataCached();

        $locations = [
            0 => [
                'text' => 'City',
                'value' => 'C',
                'transfer' => true,
                'multistop' => true
            ],
            1 => [
                'text' => 'Airport',
                'value' => 'A',
                'transfer' => true,
                'multistop' => true
            ],
            2 => [
                'text' => 'GAT',
                'value' => 'G',
                'transfer' => true,
                'multistop' => true
            ],
            3 => [
                'text' => 'Custom',
                'value' => 'X',
                'transfer' => true,
                'multistop' => true
            ],
        ];


        return response()->json([
            'config' => $config,
            'customers' => $customers,
            'cities' => $cities,
            'vehicleGroups' => $vehicleGroups,
            'vehicles' => $vehicles,
            'airports' => $airports,
            'locations' => $locations,
        ]);
    }

    public function customers()
    {
        $customers = Customer::formDataCached();
        return response()->json($customers);
    }

    public function cities()
    {
        $cities = City::formDataCached();

        return response()->json($cities);
    }

    public function vehicleGroups()
    {
        $vehicleGroups = VehicleGroup::formDataCached();

        return response()->json($vehicleGroups);
    }

    public function vehicles()
    {
        $vehicles = Vehicle::formDataCached();

        return response()->json($vehicles);
    }


    public function calculate(Request $request)
    {
        $all = $request->input('form');
        $rawData = $request->input('rawData');

        $prices = \Calcer::calculateFromRequest($all);


        //$prices = \Calcer::calculate($type, $runCode, $pickCode, $dropCode, $city, $customer, $vehicle, $date, $time, $roundNet, $roundGross, $custom);

        ini_set('serialize_precision', 14);

        $hash = false;

        if(isset($all['hash']) && isset($all['is_open']) && $all['is_open'] === true) {
            $hash = $all['hash'];
        } else if(!isset($all['is_pdf']) || $all['is_pdf'] === false ) {

            unset($all['hash']);

            if(!$all['custom']['distance']) {
                $all['custom']['distance'] = $prices['distanceValue'];
                $all['custom']['duration'] = $prices['timeValue'];
            }

            $dataHash = md5(json_encode($all));

            AddHistoryEntry::dispatch($dataHash, $all, $request->user()->id, $prices, $rawData);

            $hash = $dataHash;

        }

        $prices['hash'] = $hash;

        return response()->json($prices);
    }

    public function settings()
    {
        $settings = Setting::all(['name', 'value', 'type']);

        //$settings = $settings->keyBy('name');

        return response()->json([
            'settings' => $settings
        ]);
    }

    public function settingsUpdate(Request $request)
    {
        $all = $request->all();

        Setting::updateFromRequest($all);

        //$settings = $settings->keyBy('name');

        return response()->json([
            //'settings' => $settings
        ]);
    }

    public function ziggy(Request $request)
    {
        return response()->json(new Ziggy);
    }

    public function historyList(Request $request)
    {
        $list = $request->user() ? $request->user()->calculatorhistory()->select(['id', 'user_id', 'data_hash', 'data', 'updated_at', 'created_at'])->orderByDesc('id')->paginate(10) : [];
        //$list = CalculatorHistory::all();

        $config = config('settings.calculator');

        $customers = Customer::formDataCached();
        $cities = City::formDataCached();
        $vehicleGroups = VehicleGroup::formDataCached();
        $vehicles = Vehicle::formDataCached();
        $locations = [
            0 => [
                'text' => 'City',
                'value' => 'C',
                'transfer' => true,
                'multistop' => true
            ],
            1 => [
                'text' => 'Airport',
                'value' => 'A',
                'transfer' => true,
                'multistop' => true
            ],
            2 => [
                'text' => 'GAT',
                'value' => 'G',
                'transfer' => true,
                'multistop' => true
            ],
            3 => [
                'text' => 'Custom',
                'value' => 'X',
                'transfer' => true,
                'multistop' => true
            ],
        ];

        return response()->json([
            'list' => $list,
            'config' => $config,
            'customers' => $customers,
            'cities' => $cities,
            'vehicleGroups' => $vehicleGroups,
            'vehicles' => $vehicles,
            'locations' => $locations,
        ]);
    }

    public function historyEntry(Request $request, CalculatorHistory $entry)
    {
        if ($request->user()->cannot('view', $entry)) {
            abort(403);
        }

        return response()->json([
            'entry' => $entry
        ]);
    }

    public function historyEntryInternal(Request $request, CalculatorHistory $entry)
    {
        return response()->json([
            'entry' => $entry
        ]);
    }

    public function historyEntryDelete(Request $request, CalculatorHistory $entry)
    {
        if ($request->user()->cannot('delete', $entry)) {
            abort(403);
        }

        $entry->delete();
        return response()->json(true);
    }

    public function historyEntryPdf(Request $request, CalculatorHistory $entry)
    {
        if ($request->user()->cannot('view', $entry)) {
            abort(403);
        }

        $url = config('settings.calculator.pdf_url').$entry->id;

        $diskPath = Storage::disk('public')->path('');
        $tmpPath = $diskPath.'tmp/pdf/';
        $fileName = Str::random(15).'.pdf';

        //dd($request->cookies);

        Browsershot::url($url)
            //->useCookies(['calculator_session' => $request->cookie('calculator_session'), 'XSRF-TOKEN' => $request->cookie('XSRF-TOKEN')], '.interline.dev.dev-factory.de')
            //->setIncludePath(config('settings.node_bin_path'))
            ->noSandbox()
            //->setOption('preferCSSPageSize', true)
            //->setScreenshotType('jpeg', 100)
            //->windowSize(1920, 1080)
            //->paperSize(1920, 1080, 'px')
            //->windowSize(250, 1080)
            //->windowSize(1140, 1080)
            //->fit(Manipulations::FIT_CONTAIN, 595, 842)
            //->waitUntilNetworkIdle()
            //->base64Screenshot();
            //->setDelay(2000)
            ->waitUntilNetworkIdle(false)
            //->screenshot();
            ->format('A4')
            //->margins(1, 2, 1, 2)
            ->showBackground()
            ->emulateMedia('screen')
            //->scale(0.5)
            //->fullPage()
            //->landscape()
            //->pdf();
            ->savePdf($tmpPath.$fileName);
        //->save($diskPath.$fileName);

        //return response($pdf)->header('Content-Type', 'application/pdf');

        return Storage::disk('public')->download('tmp/pdf/'.$fileName);

        /*        $url =  Storage::disk('public')->url('tmp/pdf/'.$fileName);
                return response()->json(['url' => $url]);*/

        //return response()->file($tmpPath.$fileName);

    }

    public function historyEntryPdf_(Request $request, CalculatorHistory $entry)
    {
        if ($request->user()->cannot('view', $entry)) {
            abort(403);
        }

        $url = config('settings.calculator.pdf_url').$entry->id;

        $diskPath = Storage::disk('public')->path('');
        $tmpPath = $diskPath.'tmp/pdf/';
        $fileName = Str::random(15).'.pdf';

        //dd($request->cookies);

        $image = Browsershot::url($url)
            //->useCookies(['calculator_session' => $request->cookie('calculator_session'), 'XSRF-TOKEN' => $request->cookie('XSRF-TOKEN')], '.interline.dev.dev-factory.de')
            //->setIncludePath(config('settings.node_bin_path'))
            ->noSandbox()
            ->setScreenshotType('jpeg', 100)
            ->windowSize(1140, 1080)
            //->paperSize(1920, 1080, 'px')
            //->windowSize(250, 1080)
            //->windowSize(1400, 900)
            //->fit(Manipulations::FIT_CONTAIN, 595, 842)
            //->waitUntilNetworkIdle()
            //->base64Screenshot();
            //->setDelay(2000)
            ->waitUntilNetworkIdle(false)
            ->emulateMedia('screen')
            ->fullPage()
            ->screenshot();
            //->format('A4')
            //->margins(1, 2, 1, 2)
            //->showBackground()

            //->scale(0.8)

            //->landscape()
            //->pdf();
            //->savePdf($tmpPath.$fileName);
            //->save($diskPath.$fileName);


        return response($image)->header('Content-Type', 'image/jpg');

        //return Storage::disk('public')->download('tmp/pdf/'.$fileName);

/*        $url =  Storage::disk('public')->url('tmp/pdf/'.$fileName);
        return response()->json(['url' => $url]);*/

        //return response()->file($tmpPath.$fileName);

    }

    public function nearestStartLocation(Request $request)
    {
        $lat = $request->input('lat', false);
        $lng = $request->input('lng', false);

        $nearest = City::nearestCoordinates($lat, $lng);

        return response()->json($nearest);
    }

    public function startLocationZip(Request $request)
    {
        $zip = $request->input('zip', false);
        $lat = $request->input('lat', false);
        $lng = $request->input('lng', false);

        if($zip === false) {
            $zip = $this->zipFromCoordinates($lat, $lng);
        }

        if($zip === false) {
            abort(404);
        }

        $region = ZipRegion::regionForZip($zip);
        $regionRate = RegionRate::where('region', $region->region)->first();
        $start = false;

        if($regionRate->cities()->count() === 1) {
            $start = $regionRate->cities()->first();
        } else {

            $shortest = false;

            foreach ($regionRate->cities as $city) {

                $dist = $this->computeDistance($lat, $lng, $city->start_location_latitude, $city->start_location_longitude);

                if($shortest === false || $dist < $shortest) {
                    $shortest = $dist;
                    $start = $city;
                }

            }

        }

        if($start === false) {
            abort(404);
        }

        return response()->json($start);

    }


    private function zipFromCoordinates($lat, $lng)
    {
        $client = new \GuzzleHttp\Client();
        $geocoder = new Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));

        $zip = false;

        $result = $geocoder->getAddressForCoordinates($lat, $lng);

        foreach ($result['address_components'] as $component) {

            $type = $component->types[0];

            if($type === 'postal_code') {
                $zip = $component->long_name;
            }

        }

        return $zip;
    }


    private function computeDistance($lat1, $lng1, $lat2, $lng2, $radius = 6378137)
    {
        static $x = M_PI / 180;
        $lat1 *= $x; $lng1 *= $x;
        $lat2 *= $x; $lng2 *= $x;
        $distance = 2 * asin(sqrt(pow(sin(($lat1 - $lat2) / 2), 2) + cos($lat1) * cos($lat2) * pow(sin(($lng1 - $lng2) / 2), 2)));

        return $distance * $radius;
    }


    public function test()
    {
        $trip = Period::make('2021-10-02 15:00:00', '2021-10-03 06:00:00', Precision::MINUTE());
        $holiday = Period::make('2021-10-03', '2021-10-03 23:59:59', Precision::MINUTE(), Boundaries::EXCLUDE_NONE());

        //dd($holiday);

        $test = $trip->overlapAny($holiday);

        foreach ($test as $t) {
            dd($t->length());
        }
    }


    public function saveProject(Request $request)
    {
        $data = $request->input();

        $result = [];

        foreach ($data['trips'] as $trip) {
            $result[] = \Calcer::calculateFromRequest($trip['form'], false, false);
        }

        $project = Project::updateOrCreateProject($data, $request->user()->id, $result);

        return response()->json($project->id);

    }


    public function getProject(Request $request, Project $project)
    {
        /*if ($request->user()->cannot('view', $project)) {
            abort(403);
        }*/

        return response()->json([
            'project' => $project
        ]);
    }

    public function deleteproject(Request $request, Project $project)
    {
        if(!$project) {
            abort(404);
        }

        $project->delete();

        return response()->json([
            'result' => true,
        ]);
    }

}
