<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Airport
 *
 * @mixin IdeHelperAirport
 * @property int $id
 * @property string $name
 * @property string $iata
 * @property string $icao
 * @property string $class
 * @property string $state
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $address_text
 * @property string|null $gat_latitude
 * @property string|null $gat_longitude
 * @property string|null $gat_address_text
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities
 * @property-read int|null $cities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Airport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport newQuery()
 * @method static \Illuminate\Database\Query\Builder|Airport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport query()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereAddressText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereGatAddressText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereGatLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereGatLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereIata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereIcao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Airport withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Airport withoutTrashed()
 */
	class IdeHelperAirport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AirportGlobal
 *
 * @mixin IdeHelperAirportGlobal
 * @property int $id table to store airports data
 * @property string $ident airport identity
 * @property string $type
 * @property string $name
 * @property float $latitude_deg
 * @property float $longitude_deg
 * @property int $elevation_ft
 * @property string $continent
 * @property string $iso_country
 * @property string $iso_region
 * @property string $municipality
 * @property string $scheduled_service
 * @property string $gps_code
 * @property string $iata_code
 * @property string $local_code
 * @property string $home_link
 * @property string $wikipedia_link
 * @property string $keywords
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal query()
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereContinent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereElevationFt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereGpsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereHomeLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereIataCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereIdent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereIsoCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereIsoRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereLatitudeDeg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereLocalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereLongitudeDeg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereMunicipality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereScheduledService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AirportGlobal whereWikipediaLink($value)
 */
	class IdeHelperAirportGlobal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CalculatorHistory
 *
 * @mixin IdeHelperCalculatorHistory
 * @property int $id
 * @property int $user_id
 * @property array $data
 * @property string $data_hash
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $result
 * @property string|null $raw_data
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory newQuery()
 * @method static \Illuminate\Database\Query\Builder|CalculatorHistory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereDataHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereRawData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalculatorHistory whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|CalculatorHistory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CalculatorHistory withoutTrashed()
 */
	class IdeHelperCalculatorHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\City
 *
 * @mixin IdeHelperCity
 * @property int $id
 * @property string|null $name
 * @property string|null $kfz
 * @property int|null $region_rate_id
 * @property int|null $airport_id
 * @property string|null $state
 * @property int|null $t_tcc_a
 * @property int|null $t_tca_a
 * @property int|null $t_tcg_a
 * @property int|null $t_tac_a
 * @property int|null $t_taa_a
 * @property int|null $t_tag_a
 * @property int|null $t_tgc_a
 * @property int|null $t_tga_a
 * @property int|null $t_tgg_a
 * @property int|null $t_tcc_b
 * @property int|null $t_tca_b
 * @property int|null $t_tcg_b
 * @property int|null $t_tac_b
 * @property int|null $t_taa_b
 * @property int|null $t_tag_b
 * @property int|null $t_tgc_b
 * @property int|null $t_tga_b
 * @property int|null $t_tgg_b
 * @property int|null $t_tcc_c
 * @property int|null $t_tca_c
 * @property int|null $t_tcg_c
 * @property int|null $t_tac_c
 * @property int|null $t_taa_c
 * @property int|null $t_tag_c
 * @property int|null $t_tgc_c
 * @property int|null $t_tga_c
 * @property int|null $t_tgg_c
 * @property int|null $s_tcc
 * @property int|null $s_tca
 * @property int|null $s_tcg
 * @property int|null $s_tac
 * @property int|null $s_taa
 * @property int|null $s_tag
 * @property int|null $s_tgc
 * @property int|null $s_tga
 * @property int|null $s_tgg
 * @property int|null $p_apt_auto
 * @property int|null $p_apt_bus
 * @property int|null $p_apt_cargo
 * @property int|null $d_apt_auto
 * @property int|null $d_apt_bus
 * @property int|null $d_apt_cargo
 * @property string|null $start_location_latitude
 * @property string|null $start_location_longitude
 * @property string|null $start_location_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Airport|null $airport
 * @property-read \App\Models\RegionRate|null $regionRate
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereAirportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereDAptAuto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereDAptBus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereDAptCargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereKfz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePAptAuto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePAptBus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePAptCargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereRegionRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTaa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTcc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTcg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTgc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSTgg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereStartLocationLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereStartLocationLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereStartLocationText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTaaA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTaaB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTaaC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTacA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTacB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTacC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTagA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTagB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTagC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTcaA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTcaB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTcaC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTccA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTccB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTccC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTcgA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTcgB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTcgC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTgaA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTgaB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTgaC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTgcA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTgcB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTgcC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTggA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTggB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTTggC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 */
	class IdeHelperCity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @mixin IdeHelperCustomer
 * @property int $id
 * @property int $customer_id
 * @property string $name
 * @property string $customer_type
 * @property int $krg
 * @property string $price_group
 * @property int $lim_speed
 * @property int $lim_t_min
 * @property int $lim_t_max
 * @property int $lim_s_min
 * @property int $lim_s_max
 * @property int $bus_speed
 * @property int $bus_t_min
 * @property int $bus_t_max
 * @property int $bus_s_min
 * @property int $bus_s_max
 * @property mixed|null $start_location_latitude
 * @property mixed|null $start_location_longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBusSMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBusSMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBusSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBusTMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBusTMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereKrg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLimSMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLimSMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLimSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLimTMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLimTMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePriceGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStartLocationLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStartLocationLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 */
	class IdeHelperCustomer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Discount
 *
 * @mixin IdeHelperDiscount
 * @property int $id
 * @property string $customer_type
 * @property string $customer_group
 * @property string $article_group
 * @property float $discount_percent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereArticleGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCustomerGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 */
	class IdeHelperDiscount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RegionRate
 *
 * @mixin IdeHelperRegionRate
 * @property int $id
 * @property string $region
 * @property float $time
 * @property float $distance
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities
 * @property-read int|null $cities_count
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate newQuery()
 * @method static \Illuminate\Database\Query\Builder|RegionRate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|RegionRate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RegionRate withoutTrashed()
 */
	class IdeHelperRegionRate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RideType
 *
 * @mixin IdeHelperRideType
 * @property int $id
 * @property string $code
 * @property string $run_code
 * @property string $run_digit
 * @property string $pick_code
 * @property string $pick_count
 * @property string $pick_digit
 * @property string $drop_code
 * @property string $drop_count
 * @property string $drop_digit
 * @property int $ident
 * @property string $ride_type
 * @property string $pick_up
 * @property string $drop_off
 * @property bool $standard_attribute
 * @property bool $pick_fee
 * @property bool $drop_fee
 * @property string $time_code
 * @property string $path_code
 * @property string $pick_text
 * @property string $drop_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RideType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RideType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RideType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereDropCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereDropCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereDropDigit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereDropFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereDropOff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereDropText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereIdent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType wherePathCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType wherePickCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType wherePickCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType wherePickDigit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType wherePickFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType wherePickText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType wherePickUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereRideType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereRunCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereRunDigit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereStandardAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereTimeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideType whereUpdatedAt($value)
 */
	class IdeHelperRideType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @mixin IdeHelperSetting
 * @property int $id
 * @property string $name
 * @property string|null $value
 * @property string|null $type
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
	class IdeHelperSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\State
 *
 * @mixin IdeHelperState
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Query\Builder|State onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|State withTrashed()
 * @method static \Illuminate\Database\Query\Builder|State withoutTrashed()
 */
	class IdeHelperState extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CalculatorHistory[] $calculatorhistory
 * @property-read int|null $calculatorhistory_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class IdeHelperUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vehicle
 *
 * @mixin IdeHelperVehicle
 * @property int $id
 * @property string $name
 * @property string $example
 * @property string $prov_code
 * @property string $alt_code
 * @property string $category
 * @property string $category_code
 * @property string $group_code
 * @property string $vehicle_code
 * @property int $c_pax
 * @property int $c_res
 * @property int $v_min
 * @property int $v_max
 * @property int $t_min
 * @property int $t_max
 * @property int $s_min
 * @property int $s_max
 * @property string $arg
 * @property int $base_price_time
 * @property int $base_price_km
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAltCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereArg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBasePriceKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBasePriceTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCPax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCategoryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereExample($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereGroupCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereProvCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereSMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereSMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVehicleCode($value)
 */
	class IdeHelperVehicle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VehicleGroup
 *
 * @mixin IdeHelperVehicleGroup
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereUpdatedAt($value)
 */
	class IdeHelperVehicleGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ZipRegion
 *
 * @mixin IdeHelperZipRegion
 * @property int $id
 * @property int $zip
 * @property string $city
 * @property string $region
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion newQuery()
 * @method static \Illuminate\Database\Query\Builder|ZipRegion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ZipRegion whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|ZipRegion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ZipRegion withoutTrashed()
 */
	class IdeHelperZipRegion extends \Eloquent {}
}

