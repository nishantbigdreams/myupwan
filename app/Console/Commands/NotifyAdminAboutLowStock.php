<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;
use App\Notifications\LowStockNotification;

class NotifyAdminAboutLowStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command notifies about low stock for any product';

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
     * @return mixed
     */
    public function handle()
    {
        $min_stock_for_notification = 10;

        $admin = \App\Admin::find(1);

        //mark old notifications as read
        $admin->notifications//->where('type', 'App\Notifications\LowStockNotification')
                ->markAsRead();

        foreach (Product::withTrashed()->get() as $key => $product) {
            $this->line($product->name.' stock -> '.intVal($product->in_stock));
            if (intVal($product->in_stock) <= $min_stock_for_notification) {
                $admin->notify(new LowStockNotification($product));
                $this->info('Admin notified about low stock');
            }
        }
    }
}
