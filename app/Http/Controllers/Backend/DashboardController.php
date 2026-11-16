<?php
 
namespace App\Http\Controllers\Backend;
 
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Client;
use App\Models\Concern;
use App\Models\Contact;
use App\Models\Management;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
 
class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            [
                'label' => 'Main concerns',
                'value' => Concern::whereNull('parent_id')->count(),
                'icon' => 'tabler-building-skyscraper',
                'color' => 'primary',
                'route' => 'concerns.index',
            ],
            [
                'label' => 'Active hero slides',
                'value' => Slider::where('status', true)->count(),
                'icon' => 'tabler-slideshow',
                'color' => 'info',
                'route' => 'sliders.index',
            ],
            [
                'label' => 'Gallery albums',
                'value' => Album::count(),
                'icon' => 'tabler-photo',
                'color' => 'success',
                'route' => 'albums.index',
            ],
            [
                'label' => 'Contact messages',
                'value' => Contact::count(),
                'icon' => 'tabler-message-circle',
                'color' => 'warning',
                'route' => 'contacts.index',
            ],
            [
                'label' => 'Clients',
                'value' => Client::count(),
                'icon' => 'tabler-users-group',
                'color' => 'danger',
                'route' => 'clients.index',
            ],
            [
                'label' => 'Management team',
                'value' => Management::count(),
                'icon' => 'tabler-user-shield',
                'color' => 'secondary',
                'route' => 'managements.index',
            ],
        ];

        $recentContacts = Contact::query()
            ->latest()
            ->limit(5)
            ->get(['id', 'name', 'email', 'created_at']);

        return view('backend.pages.dashboard.index', compact('stats', 'recentContacts'));
    }
}
 