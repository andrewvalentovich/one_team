<?php

namespace App\Console\Commands\Products;

use App\Models\Layout;
use App\Models\LayoutPhoto;
use App\Models\Product;
use Illuminate\Console\Command;

class UpdateLayouts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-layouts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take objects and convert it to layouts entity with photos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::where('complex_or_not', 'Да')->doesnthave('layouts')->get();

        foreach ($products as $key => $product) {
            $this->info('Start, product with id = ' . $product->id);

            $objects = json_decode($product->objects);

            if (!is_null($objects) && $objects != "" && count($objects) > 0) {
                foreach ($objects as $i => $object) {
                    $created = Layout::create([
                        'building' => $object->building ?? null,
                        'price' => (int)$object->price ?? null,
                        'price_code' => $object->price_code ?? null,
                        'total_size' => (int)$object->size ?? null,
                        'number_rooms' => $object->apartment_layout ?? null,
                        'floor' => (int)$object->floor ?? null,
                        'complex_id' => $product->id
                    ]);

                    if (is_countable($object->apartment_layout_image)) {
                        $this->info('apartment_layout_image is countable');
                        foreach ($object->apartment_layout_image as $index => $image) {
                            LayoutPhoto::create([
                                'url' => 'uploads/' . $image,
                                'layout_id' => $created->id
                            ]);
                        }
                    } else {
                        $this->error('apartment_layout_image is not countable');
                        LayoutPhoto::create([
                            'url' => 'uploads/' . $object->apartment_layout_image,
                            'layout_id' => $created->id
                        ]);
                    }
                }
            }
            $this->info('Product with id = ' . $product->id . ' successfully updated');
        }
        $this->info('');
        $this->info('COMMAND SUCCESSFULLY DONE!');
    }
}
