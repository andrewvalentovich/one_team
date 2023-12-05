<?php

namespace App\Http\Resources\NewSite;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CitiesResource extends JsonResource
{
    protected $locale_id;

    public function setLocale($value){
        $this->locale_id = $value;
        return $this;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'best_choice' => ProductsResource::collection(
                Product::where('city_id', $this->id)->leftJoin('layouts', function ($join) {
                    $join->on('products.id', '=', 'layouts.complex_id')
                        ->where('products.complex_or_not', 'Да')
                        ->addSelect(DB::raw('id, price, base_price, price_code, total_size'));
                })
                ->addSelect('products.id', 'products.name', 'products.city_id', 'products.country_id', 'products.price', 'products.base_price', 'products.price_code', 'products.size')
                ->groupBy('products.id')
                ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(layouts.base_price)) ELSE products.base_price END) as min_price'))
                ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(layouts.total_size)) ELSE products.size END) as min_size'))
                ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(max(layouts.total_size)) ELSE products.size END) as max_size'))
                ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(products.base_price) / min(products.size)) ELSE products.base_price / products.size END) as price_size'))

                ->with(['layouts' => function($query) {
                    $query->with('photos');
                }])
                ->with(['country' => function($query) {
                    $query->select('id', 'name');
                }])
                ->with(['city' => function($query) {
                    $query->select('id', 'name');
                }])
                ->with('photo')
                ->with('locale_fields.locale')
                ->limit(rand(4, 20))
                ->get()
            ),
            'market_premier' => ProductsResource::collection(
                Product::where('city_id', $this->id)->leftJoin('layouts', function ($join) {
                    $join->on('products.id', '=', 'layouts.complex_id')
                        ->where('products.complex_or_not', 'Да')
                        ->addSelect(DB::raw('id, price, base_price, price_code, total_size'));
                })
                    ->addSelect('products.id', 'products.name', 'products.city_id', 'products.country_id', 'products.price', 'products.base_price', 'products.price_code', 'products.size')
                    ->groupBy('products.id')
                    ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(layouts.base_price)) ELSE products.base_price END) as min_price'))
                    ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(layouts.total_size)) ELSE products.size END) as min_size'))
                    ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(max(layouts.total_size)) ELSE products.size END) as max_size'))
                    ->addSelect(DB::raw('(CASE WHEN complex_or_not = "Да" THEN any_value(min(products.base_price) / min(products.size)) ELSE products.base_price / products.size END) as price_size'))

                    ->with(['layouts' => function($query) {
                        $query->with('photos');
                    }])
                    ->with(['country' => function($query) {
                        $query->select('id', 'name');
                    }])
                    ->with(['city' => function($query) {
                        $query->select('id', 'name');
                    }])
                    ->with('photo')
                    ->with('locale_fields.locale')
                    ->orderByDesc('products.created_at')
                    ->limit(rand(4, 20))
                    ->get()
            )
        ];
    }

    public static function collection($resource){
        return new CitiesCollection($resource);
    }
}
