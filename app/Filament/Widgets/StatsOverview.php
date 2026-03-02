<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use App\Models\HeroSlide;
use App\Models\Service;
use App\Models\Faq;
use App\Models\CaseStudy;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalSubmissions = ContactSubmission::count();
        $unreadSubmissions = ContactSubmission::whereNull('read_at')->count();
        $thisMonthSubmissions = ContactSubmission::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return [
            Stat::make('Total Inquiries', $totalSubmissions)
                ->description($unreadSubmissions . ' unread')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadSubmissions > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.contact-submissions.index')),

            Stat::make('This Month', $thisMonthSubmissions)
                ->description('Contact submissions')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make('Active Services', Service::where('is_active', true)->count())
                ->description(Service::count() . ' total')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('success'),

            Stat::make('Content Items', HeroSlide::count() + Faq::count() + CaseStudy::count())
                ->description(HeroSlide::count() . ' slides, ' . Faq::count() . ' FAQs, ' . CaseStudy::count() . ' cases')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
        ];
    }
}
