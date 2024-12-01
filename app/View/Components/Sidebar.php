<?php

namespace App\View\Components;

use App\Models\LogStok;
use App\Models\Penjualan;
use App\Models\Produk;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $produkBaru;
    public $penjualanBaru;
    public $logStokBaru;

    public function __construct()
    {
        $this->produkBaru = Produk::where('created_at', '>=', Carbon::now()->subMinute())->exists();
        $this->penjualanBaru = Penjualan::where('created_at', '>=', Carbon::now()->subMinute())->exists();
        $this->logStokBaru = LogStok::where('created_at', '>=', Carbon::now()->subMinute())->exists();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
