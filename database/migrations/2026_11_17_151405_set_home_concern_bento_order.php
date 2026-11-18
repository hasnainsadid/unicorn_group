<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->setHomeOrder([
            'venture' => 1,
            'care' => 2,
            'landmark' => 3,
            'engineering' => 4,
            'interior' => 5,
            'elevator' => 6,
            'energy' => 7,
        ]);
    }

    public function down(): void
    {
        $this->setHomeOrder([
            'venture' => 1,
            'engineering' => 2,
            'landmark' => 3,
            'elevator' => 4,
            'interior' => 5,
            'energy' => 6,
            'care' => 7,
        ]);
    }

    /**
     * @param  array<string, int>  $orders
     */
    private function setHomeOrder(array $orders): void
    {
        DB::transaction(function () use ($orders): void {
            foreach ($orders as $slug => $order) {
                DB::table('concerns')
                    ->whereNull('parent_id')
                    ->where('slug', $slug)
                    ->update(['home_order' => $order]);
            }
        });
    }
};
