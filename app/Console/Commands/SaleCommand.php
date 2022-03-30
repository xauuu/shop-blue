<?php

namespace App\Console\Commands;

use App\Models\Sale;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SaleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sale:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiểm tra thời hạn';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sale = Sale::where('sale_status', 1)->get();
        $day = Carbon::now('Asia/Ho_Chi_Minh')->format('Y/m/d');
        foreach ($sale as $item) {
            if ($day > $item->sale_time) {
                $update_sale = Sale::find($item->sale_id);
                $update_sale->status = 0;

                $product = Product::find($item->product_id);
                $product->product_discount = $product->product_price;
                $product->save();

                $update_sale->save();
            }
        }
    }
}
