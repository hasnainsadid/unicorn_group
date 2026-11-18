<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->swapHomeOrder();
    }

    public function down(): void
    {
        $this->swapHomeOrder();
    }

    private function swapHomeOrder(): void
    {
        DB::transaction(function (): void {
            $orders = DB::table('concerns')
                ->whereNull('parent_id')
                ->whereIn('slug', ['venture', 'elevator'])
                ->pluck('home_order', 'slug');

            if (!isset($orders['venture'], $orders['elevator'])) {
                return;
            }

            DB::table('concerns')
                ->whereNull('parent_id')
                ->where('slug', 'venture')
                ->update(['home_order' => $orders['elevator']]);

            DB::table('concerns')
                ->whereNull('parent_id')
                ->where('slug', 'elevator')
                ->update(['home_order' => $orders['venture']]);
        });
    }
};
