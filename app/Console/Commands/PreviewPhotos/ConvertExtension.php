<?php

namespace App\Console\Commands\PreviewPhotos;

use App\Models\PhotoTable;
use Exception;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;

class ConvertExtension extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preview-photo:convert-to-webp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert previews extension for PhotoTables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $photos = PhotoTable::all();

        $progressBar = $this->output->createProgressBar(count($photos));
        $progressBar->start();

        foreach ($photos as $photo) {
            if (!is_null($photo->preview) && $photo->preview !== "" && $photo->preview !== " ") {
                dump($photo->preview);
                try {
                    $img = Image::make(public_path($photo->preview));

                    if ($img->extension !== "webp") {
                        $img->encode('webp', 100);
                        $img->save(public_path("uploads/" . $img->filename . ".webp"));
                        $photo->preview = "uploads/" . $img->basename;
                        $photo->save();
                        dump($photo->preview);
                    }

                    unset($img);
                } catch (Exception $exception) {
                    dump($exception->getMessage());
                }
            }

            // Шаг для прогрессбара
            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
