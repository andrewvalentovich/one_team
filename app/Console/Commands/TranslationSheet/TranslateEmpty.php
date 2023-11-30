<?php

namespace App\Console\Commands\TranslationSheet;

use App\Models\Locale;
use App\Services\GoogleSheetsServices;
use Illuminate\Console\Command;

class TranslateEmpty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translation_sheet:translate-empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get google sheet and translate empty cells';

    protected $gsheet;

    public function __construct(GoogleSheetsServices $gsheet)
    {
        parent::__construct();
        $this->gsheet = $gsheet;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Start command");

        $locales = Locale::all();
        $this->gsheet->getData();

        $this->line("End command");
    }

//    public function translate(cell, lang) {
//        const content = cell.toString();
//        const keys = [];
//        const enc = content.replace(/:([\w_]+)/ig, function(m, param) {
//            const n = `[§${keys.length}]`;
//            keys.push(param);
//            return n;
//        });
//        return LanguageApp.translate(enc, "es", lang).replace(/\[§(\d+)\]/ig, function(m, param) {
//            return `:${keys[param]}`;
//        });
}
