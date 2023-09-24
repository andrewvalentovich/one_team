<?php

namespace App\Console\Commands\PreviewPhotos;

use App\Models\ExchangeRate;
use App\Models\PhotoTable;
use App\Models\PreviewPhoto;
use App\Models\Product;
use App\Services\PreviewImageService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use function Nette\Utils\data;

class Make extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-preview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command remove all preview images and make new for all products';

    /**
     * Execute the console command.
     * @param PreviewImageService $service
     */
    public function handle(PreviewImageService $service)
    {
        $products = Product::with('photo')->get();

        foreach ($products as $product) {
            foreach ($product->photo as $photo) {
                $photo->update([
                    'preview' => $service->makeForAll($photo->photo)
                ]);
            }
        }
    }
}
